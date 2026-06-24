<?php

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CompanyProfileController as AdminCompanyProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\PartnershipInquiryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\AstroController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{identifier}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/about', [AstroController::class, 'about'])->name('about');
Route::get('/partnership', [AstroController::class, 'partnership'])->name('partnership');
Route::post('/partnership', [AstroController::class, 'storePartnership'])->name('partnership.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.attempt');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
        Route::get('/blogs/export/pdf', [AdminBlogController::class, 'exportPdf'])->name('blogs.export-pdf');
        Route::resource('blogs', AdminBlogController::class);
        Route::get('/profile', [AdminCompanyProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [AdminCompanyProfileController::class, 'update'])->name('profile.update');
        Route::resource('products', AdminProductController::class);
        Route::resource('galleries', AdminGalleryController::class);
        Route::get('/inquiries', [PartnershipInquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [PartnershipInquiryController::class, 'show'])->name('inquiries.show');
        Route::patch('/inquiries/{inquiry}/status', [PartnershipInquiryController::class, 'updateStatus'])->name('inquiries.status');
        Route::delete('/inquiries/{inquiry}', [PartnershipInquiryController::class, 'destroy'])->name('inquiries.destroy');
    });
});
