<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Gallery;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        return view('pages.home', [
            'galleries' => Gallery::published()->orderBy('sort_order')->limit(5)->get(),
            'featuredProducts' => Product::published()->where('is_featured', true)->orderBy('sort_order')->limit(3)->get(),
            'latestBlogs' => Blog::published()->latest('published_at')->limit(3)->get(),
        ]);
    }
}
