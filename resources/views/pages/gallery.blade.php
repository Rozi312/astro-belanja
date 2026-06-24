@extends('layouts.app')
@section('title', 'Galeri - Astro Belanja')
@section('content')
<div class="container mt-5">
    <div class="text-center mb-5"><span class="section-kicker">Dokumentasi</span><h1 class="fw-bold text-primary mt-2">Galeri Astro</h1><p class="lead text-muted">Program, promo, dan aktivitas terbaru Astro Belanja.</p></div>
    <div class="row g-4">
        @forelse($galleries as $gallery)
            <div class="col-md-6 col-lg-4"><div class="card public-card h-100"><img src="{{ $gallery->image_url }}" class="gallery-image" alt="{{ $gallery->title }}"><div class="card-body p-4"><h5 class="fw-bold">{{ $gallery->title }}</h5><p class="text-muted mb-0">{{ $gallery->caption }}</p></div></div></div>
        @empty<div class="col-12 text-center py-5"><p class="lead text-muted">Belum ada galeri yang dipublikasikan.</p></div>@endforelse
    </div>
    <div class="d-flex justify-content-center mt-5">{{ $galleries->links('pagination::bootstrap-5') }}</div>
</div>
@endsection
