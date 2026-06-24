@extends('layouts.app')

@section('title', 'Partnership - Astro Belanja')

@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button class="btn-close" data-bs-dismiss="alert"></button></div>
    @endif
    <div class="row mb-5 text-center">
        <div class="col-md-12">
            <h1 class="fw-bold text-primary display-4">Kemitraan Astro</h1>
            <p class="lead text-muted">Bergabunglah menjadi mitra strategis kami untuk menyuplai produk segar ke seluruh Jabodetabek.</p>
            <hr class="mx-auto border-primary border-2" style="width: 80px;">
        </div>
    </div>

    <div class="row g-5">
        <div class="col-lg-5">
            <div class="p-4 bg-primary text-white rounded-4 shadow h-100">
                <h3 class="fw-bold mb-4">Kenapa Menjadi Mitra?</h3>
                <ul class="list-unstyled">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill me-3"></i>
                        <span><strong>Jangkauan Luas:</strong> Produk Anda akan dipasarkan ke ribuan pelanggan di area Jabodetabek.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill me-3"></i>
                        <span><strong>Pembayaran Cepat:</strong> Sistem pembayaran mitra yang transparan dan tepat waktu.</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle-fill me-3"></i>
                        <span><strong>Dukungan Logistik:</strong> Kami bantu pengelolaan distribusi dari gudang ke pelanggan.</span>
                    </li>
                </ul>
                <div class="mt-5 p-3 bg-white bg-opacity-10 rounded-3">
                    <h5>Butuh Bantuan?</h5>
                    <p class="small mb-0">Hubungi tim kurasi produk kami di:</p>
                    <p class="fw-bold">support@astrobelanja.com</p>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <h3 class="fw-bold text-primary mb-4">Ajukan Kerja Sama</h3>
                <form action="{{ route('partnership.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Lengkap / Perusahaan</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control border-primary @error('name') is-invalid @enderror" placeholder="Contoh: PT. Sayur Segar" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email Bisnis</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control border-primary @error('email') is-invalid @enderror" placeholder="nama@email.com" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori Produk</label>
                        <select name="category" class="form-select border-primary @error('category') is-invalid @enderror" required>
                            <option value="" disabled @selected(!old('category'))>Pilih kategori...</option>
                            <option value="buah" @selected(old('category') === 'buah')>Buah-buahan</option>
                            <option value="sayur" @selected(old('category') === 'sayur')>Sayuran Segar</option>
                            <option value="daging" @selected(old('category') === 'daging')>Daging & Protein</option>
                            <option value="sembako" @selected(old('category') === 'sembako')>Sembako</option>
                            <option value="lainnya" @selected(old('category') === 'lainnya')>Lainnya</option>
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pesan / Penawaran</label>
                        <textarea name="message" class="form-control border-primary @error('message') is-invalid @enderror" rows="5" placeholder="Ceritakan singkat tentang produk Anda..." required>{{ old('message') }}</textarea>
                        @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold py-2">Kirim Penawaran Kerja Sama</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
