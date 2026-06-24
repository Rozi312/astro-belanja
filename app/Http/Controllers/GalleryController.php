<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    public function index(): View
    {
        $galleries = Gallery::published()->orderBy('sort_order')->paginate(12);

        return view('pages.gallery', compact('galleries'));
    }
}
