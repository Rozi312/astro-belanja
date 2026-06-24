@extends('layouts.app')
@section('title', 'Produk & Layanan - Astro Belanja')
@section('content')
<div class="container mt-5">
    <div class="text-center mb-5"><span class="section-kicker">Solusi Astro</span><h1 class="fw-bold text-primary mt-2">Produk & Layanan</h1><p class="lead text-muted">Layanan pilihan untuk kebutuhan rumah, komunitas, dan bisnis Anda.</p></div>
    <div class="row g-4">
        @forelse($products as $product)
            <div class="col-md-6 col-lg-4">
                <div class="card public-card h-100">
                    
                    <img src="{{ 
                        $product->name == 'Belanja Kilat' ? asset('bootstrap-5.3.8-dist/images/astro_home1.png') : 
                        ($product->name == 'Astro Fresh' ? asset('bootstrap-5.3.8-dist/images/astro_home2.png') : 
                        ($product->name == 'Astro Business' ? asset('bootstrap-5.3.8-dist/images/astro_home3.png') : 
                        $product->image_url)) 
                    }}" class="product-image" alt="{{ $product->name }}">
                    
                    <div class="card-body p-4 d-flex flex-column">
                        <h4 class="fw-bold">{{ $product->name }}</h4>
                        <p class="text-muted">{{ $product->short_description }}</p>
                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-primary mt-auto">Lihat Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="lead text-muted">Belum ada produk atau layanan yang dipublikasikan.</p>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-5">{{ $products->links('pagination::bootstrap-5') }}</div>
</div>
@endsection