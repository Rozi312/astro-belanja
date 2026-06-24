@extends('admin.layouts.app')
@section('title', 'Detail Produk')
@section('heading', 'Detail Produk atau Layanan')
@section('subheading', $product->name)
@section('content')
<div class="row g-4">
    <div class="col-lg-7"><div class="surface p-4">@if($product->image_url)<img src="{{ $product->image_url }}" class="preview-image mb-4" alt="">@endif<h2 class="fw-bold">{{ $product->name }}</h2><p class="lead text-muted">{{ $product->short_description }}</p><div style="white-space: pre-line">{{ $product->description }}</div></div></div>
    <div class="col-lg-5"><div class="surface p-4"><p><strong>Status:</strong> {{ ucfirst($product->status) }}</p><p><strong>Slug:</strong> {{ $product->slug }}</p><p><strong>Featured:</strong> {{ $product->is_featured ? 'Ya' : 'Tidak' }}</p><p><strong>Urutan:</strong> {{ $product->sort_order }}</p><a href="{{ route('admin.products.edit', $product) }}" class="btn btn-primary w-100">Edit Produk</a></div></div>
</div>
@endsection
