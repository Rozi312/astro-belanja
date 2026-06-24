<?php

namespace App\Http\Controllers;

use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::published()->latest('published_at')->paginate(6);

        return view('pages.blog', compact('blogs'));
    }

    public function show(string $identifier)
    {
        $blog = Blog::published()
            ->where(fn ($query) => $query->where('slug', $identifier)
                ->when(is_numeric($identifier), fn ($q) => $q->orWhere('id', (int) $identifier)))
            ->firstOrFail();

        return view('pages.blog-detail', compact('blog'));
    }
}
