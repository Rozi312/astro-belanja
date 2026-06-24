@extends('layouts.app')
@section('title', 'Home - Astro Belanja')
@section('content')
<style>
    .promo-container { position: relative; overflow: hidden; border-radius: 16px; height: 100%; }
    .promo-img { width: 100%; height: 100%; object-fit: cover; transition: transform .3s; }
    .promo-container:hover .promo-img { transform: scale(1.04); }
    .promo-text { position: absolute; inset: auto 0 0; padding: 22px; background: linear-gradient(transparent, rgba(0,0,0,.82)); color: white; }
    .main-grid { height: 450px; } .side-grid { height: 215px; }
</style>
<div class="container mt-4">
    @if($galleries->isNotEmpty())
        @php($main = $galleries->first())
        <div class="row g-3">
            <div class="col-md-7">
                <div class="promo-container shadow-sm main-grid">
                    <img src="{{ $main->image_url }}" class="promo-img" alt="{{ $main->title }}">
                    <div class="promo-text">
                        <h3 class="fw-bold">{{ $main->title }}</h3>
                        <p class="mb-0">{{ $main->caption }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row g-3">
                    @foreach($galleries->skip(1)->take(4) as $gallery)
                        <div class="col-6">
                            <div class="promo-container shadow-sm side-grid">
                                <img src="{{ $gallery->image_url }}" class="promo-img" alt="{{ $gallery->title }}">
                                <div class="promo-text">
                                    <small class="fw-bold">{{ $gallery->title }}</small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="hero-empty text-center p-5">
            <div>
                <h1 class="fw-bold">Astro Belanja</h1>
                <p class="lead mb-0">Belanja kebutuhan harian dengan cepat dan mudah.</p>
            </div>
        </div>
    @endif

    <div class="row mt-5 text-center">
        @foreach([['15 Menit','Kecepatan Pengiriman'],['100% Segar','Kualitas Terjamin'],['Gratis Ongkir','Khusus Pengguna Baru']] as [$value,$label])
            <div class="col-md-4 mb-3">
                <div class="card border-0 shadow-sm rounded-4">
                    <div class="card-body py-4">
                        <h4 class="text-success fw-bold">{{ $value }}</h4>
                        <p class="mb-0 text-muted">{{ $label }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if($featuredProducts->isNotEmpty())
    <section class="py-5">
        <div class="text-center mb-4">
            <span class="section-kicker">Pilihan Astro</span>
            <h2 class="fw-bold mt-2">Produk & Layanan Unggulan</h2>
            <p class="text-muted">Layanan yang dirancang untuk membuat kebutuhan harian terasa lebih ringan.</p>
        </div>
        <div class="row g-4">
            @foreach($featuredProducts as $product)
                <div class="col-md-4">
                    <div class="card public-card h-100">
                        
                        <!-- LOGIKA BYPASS GAMBAR UNTUK PRODUK UNGGULAN -->
                        <img src="{{ 
                            $product->name == 'Belanja Kilat' ? asset('bootstrap-5.3.8-dist/images/astro_home1.png') : 
                            ($product->name == 'Astro Fresh' ? asset('bootstrap-5.3.8-dist/images/astro_home2.png') : 
                            ($product->name == 'Astro Business' ? asset('bootstrap-5.3.8-dist/images/astro_home3.png') : 
                            $product->image_url)) 
                        }}" class="product-image" alt="{{ $product->name }}">
                        
                        <div class="card-body p-4">
                            <h4 class="fw-bold">{{ $product->name }}</h4>
                            <p class="text-muted">{{ $product->short_description }}</p>
                            <a href="{{ route('products.show', $product->slug) }}" class="btn btn-outline-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('products.index') }}" class="btn btn-primary px-4">Lihat Semua Produk</a>
        </div>
    </section>
    @endif

    @if($latestBlogs->isNotEmpty())
    <section class="pb-4">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <span class="section-kicker">Kabar terbaru</span>
                <h2 class="fw-bold mt-2 mb-0">Artikel Astro</h2>
            </div>
            <a href="{{ route('blog.index') }}">Lihat semua</a>
        </div>
        <div class="row g-4">
            @foreach($latestBlogs as $blog)
                <div class="col-md-4">
                    <div class="card public-card h-100">
                        @if($blog->image_url)
                            <img src="{{ $blog->image_url }}" class="product-image" alt="{{ $blog->title }}">
                        @endif
                        <div class="card-body p-4">
                            <small class="text-muted">{{ $blog->published_at?->format('d M Y') }}</small>
                            <h5 class="fw-bold mt-2">{{ $blog->title }}</h5>
                            <p class="text-muted">{{ Str::limit($blog->excerpt ?: $blog->content, 90) }}</p>
                            <a href="{{ route('blog.show', $blog->slug) }}" class="stretched-link">Baca artikel</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection