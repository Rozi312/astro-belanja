@extends('layouts.app')

@section('title', 'Blog Berita - Astro Belanja')

@section('content')
<style>

    .card-img-top {
        width: 100%;
        height: 220px;
        object-fit: cover;
        object-position: center;
        transition: transform 0.3s ease;
    }
    .card:hover .card-img-top {
        transform: scale(1.05);
    }
    .card {
        transition: all 0.3s ease;
        border: none;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
</style>

<div class="container mt-5">
    <div class="row mb-4 text-center">
        <div class="col-md-12">
            <h2 class="fw-bold text-primary">Berita & Promo Terbaru</h2>
            <p class="text-muted">Update informasi seputar kebutuhan harian dan promo menarik di Astro Belanja.</p>
            <hr class="mx-auto border-primary border-2" style="width: 60px;">
        </div>
    </div>

    <div class="row">
        @forelse ($blogs as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <div class="overflow-hidden">
                    @if($item->image_url)<img src="{{ $item->image_url }}" class="card-img-top" alt="{{ $item->title }}">@endif
                </div>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold text-primary">{{ $item->title }}</h5>   
                    <p class="card-text text-muted mb-4">{{ Str::limit($item->excerpt ?: $item->content, 90) }}</p>
                    
                    <div class="mt-auto">
                        <p class="card-text mb-2 small text-secondary">
                            <i class="bi bi-person"></i> Penulis: <strong>{{ $item->author }}</strong>
                        </p>
                        <a href="{{ route('blog.show', $item->slug) }}" class="btn btn-primary w-100">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <p class="lead text-muted">Belum ada berita yang diterbitkan saat ini.</p>
        </div>
        @endforelse
    </div>

    <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-center">
            {{ $blogs->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection
