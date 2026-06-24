<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\CompanyProfile;
use App\Models\Gallery;
use App\Models\PartnershipInquiry;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'blog' => Blog::count(),
                'profile_configured' => CompanyProfile::query()->exists(),
                'product' => Product::count(),
                'gallery' => Gallery::count(),
                'inquiry' => PartnershipInquiry::count(),
            ],
            'recentInquiries' => PartnershipInquiry::latest()->limit(5)->get(),
            'recentBlogs' => Blog::latest()->limit(5)->get(),
        ]);
    }
}
