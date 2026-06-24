<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::published()->orderBy('sort_order')->paginate(9);

        return view('pages.products', compact('products'));
    }

    public function show(string $slug): View
    {
        $product = Product::published()->where('slug', $slug)->firstOrFail();

        return view('pages.product-detail', compact('product'));
    }
}
