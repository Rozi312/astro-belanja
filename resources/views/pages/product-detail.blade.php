@extends('layouts.app')
@section('title', $product->name.' - Astro Belanja')
@section('content')
<div class="container mt-5"><div class="row g-5 align-items-center"><div class="col-lg-6">@if($product->image_url)<img src="{{ $product->image_url }}" class="img-fluid rounded-4 shadow" alt="{{ $product->name }}">@endif</div><div class="col-lg-6"><span class="section-kicker">Produk & Layanan</span><h1 class="fw-bold text-primary mt-2">{{ $product->name }}</h1><p class="lead text-muted">{{ $product->short_description }}</p><div class="mt-4" style="white-space:pre-line">{{ $product->description }}</div><div class="d-flex gap-2 mt-4"><a href="{{ route('partnership') }}" class="btn btn-primary">Ajukan Kerja Sama</a><a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Kembali</a></div></div></div></div>
@endsection
