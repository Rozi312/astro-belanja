@extends('layouts.app')
@section('title', 'Tentang Kami - Astro Belanja')
@section('content')
@php
    $companyName = $profile?->company_name ?? 'Astro Belanja Indonesia';
    $tagline = $profile?->tagline ?? 'Mengenal lebih dekat solusi belanja masa depan Anda.';
@endphp
<div class="container mt-5">
    <div class="text-center mb-5"><span class="section-kicker">Tentang kami</span><h1 class="fw-bold text-primary display-4 mt-2">{{ $companyName }}</h1><p class="lead text-muted">{{ $tagline }}</p><hr class="mx-auto border-primary border-2" style="width:100px"></div>
    <div class="row align-items-center g-5">
        <div class="col-md-7"><div class="p-4 bg-white shadow-sm rounded-4 border-start border-primary border-5"><h3 class="fw-bold mb-4">Siapa Kami?</h3><p><strong>Nama Brand:</strong> {{ $companyName }}</p><p><strong>Domisili Operasional:</strong> {{ $profile?->location ?? 'Jabodetabek, Jawa Barat' }}</p><p><strong>Visi Kami:</strong> {{ $profile?->vision ?? 'Menjadi platform nomor satu dalam penyediaan kebutuhan harian.' }}</p><p><strong>Deskripsi:</strong></p><p class="text-secondary" style="text-align:justify;white-space:pre-line">{{ $profile?->description ?? 'Astro Belanja hadir untuk memberikan kemudahan berbelanja kebutuhan harian secara cepat dan terpercaya.' }}</p>@if($profile?->email)<p class="mb-0"><strong>Kontak:</strong> {{ $profile->email }}{{ $profile->phone ? ' · '.$profile->phone : '' }}</p>@endif</div></div>
        <div class="col-md-5 text-center">@if($profile?->image_url)<img src="{{ $profile->image_url }}" alt="{{ $companyName }}" class="img-fluid rounded-4 shadow">@else<img src="{{ asset('bootstrap-5.3.8-dist/images/astro_about2.png') }}" alt="Tentang Astro" class="img-fluid rounded-4 shadow">@endif</div>
    </div>
    <div class="card bg-primary text-white p-4 text-center border-0 shadow rounded-4 mt-5"><div class="row"><div class="col-md-4"><h4>🌱 Segar</h4><p class="small mb-0">Langsung dari petani lokal</p></div><div class="col-md-4"><h4>⚡ Kilat</h4><p class="small mb-0">Pengiriman maksimal 15 menit</p></div><div class="col-md-4"><h4>🤝 Terpercaya</h4><p class="small mb-0">Layanan pelanggan responsif</p></div></div></div>
</div>
@endsection
