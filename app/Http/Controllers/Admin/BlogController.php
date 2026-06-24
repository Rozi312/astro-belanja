<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function index(Request $request): View
    {
        $blogs = Blog::query()
            ->when($request->filled('search'), fn ($query) => $query->where(fn ($q) => $q
                ->where('title', 'like', '%'.$request->search.'%')
                ->orWhere('author', 'like', '%'.$request->search.'%')))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('admin.blogs.create');
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')?->store('blogs', 'public');
        Blog::create($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function show(Blog $blog): View
    {
        return view('admin.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog): View
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deleteUploadedImage($blog->image);
            $data['image'] = $request->file('image')->store('blogs', 'public');
        } else {
            unset($data['image']);
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $this->deleteUploadedImage($blog->image);
        $blog->delete();

        return back()->with('success', 'Artikel berhasil dihapus.');
    }

    public function exportPdf(): Response
    {
        $blogs = Blog::latest()->get();
        $pdf = Pdf::loadView('admin.reports.blogs', [
            'blogs' => $blogs,
            'printedAt' => now(),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('laporan-artikel-'.now()->format('Y-m-d').'.pdf');
    }

    private function deleteUploadedImage(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'seed:')) {
            Storage::disk('public')->delete($path);
        }
    }
}
