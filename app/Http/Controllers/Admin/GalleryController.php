<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\GalleryRequest;
use App\Models\Gallery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(Request $request): View
    {
        $galleries = Gallery::query()
            ->when($request->filled('search'), fn ($query) => $query
                ->where('title', 'like', '%'.$request->search.'%'))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->status))
            ->orderBy('sort_order')->latest()->paginate(12)->withQueryString();

        return view('admin.galleries.index', compact('galleries'));
    }

    public function create(): View
    {
        return view('admin.galleries.create');
    }

    public function store(GalleryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('galleries', 'public');
        Gallery::create($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(Gallery $gallery): View
    {
        return view('admin.galleries.show', compact('gallery'));
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.galleries.edit', compact('gallery'));
    }

    public function update(GalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $this->deleteUploadedImage($gallery->image);
            $data['image'] = $request->file('image')->store('galleries', 'public');
        } else {
            unset($data['image']);
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        $this->deleteUploadedImage($gallery->image);
        $gallery->delete();

        return back()->with('success', 'Galeri berhasil dihapus.');
    }

    private function deleteUploadedImage(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'seed:')) {
            Storage::disk('public')->delete($path);
        }
    }
}
