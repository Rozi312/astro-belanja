@extends('admin.layouts.app')

@section('title', 'Profil Perusahaan')
@section('heading', 'Profil Perusahaan')
@section('subheading', 'Atur identitas dan informasi utama Astro Belanja')

@section('content')
<form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="surface p-4">
                <div class="row">
                    <div class="col-md-7 mb-3">
                        <label class="form-label fw-semibold">Nama Perusahaan</label>
                        <input name="company_name" value="{{ old('company_name', $profile?->company_name) }}"
                            class="form-control @error('company_name') is-invalid @enderror" required>
                        @error('company_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-5 mb-3">
                        <label class="form-label fw-semibold">Lokasi</label>
                        <input name="location" value="{{ old('location', $profile?->location) }}"
                            class="form-control @error('location') is-invalid @enderror" required>
                        @error('location')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Tagline</label>
                    <input name="tagline" value="{{ old('tagline', $profile?->tagline) }}"
                        class="form-control @error('tagline') is-invalid @enderror">
                    @error('tagline')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Visi</label>
                    <textarea name="vision" rows="4"
                        class="form-control @error('vision') is-invalid @enderror"
                        required>{{ old('vision', $profile?->vision) }}</textarea>
                    @error('vision')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div>
                    <label class="form-label fw-semibold">Deskripsi Perusahaan</label>
                    <textarea name="description" rows="9"
                        class="form-control @error('description') is-invalid @enderror"
                        required>{{ old('description', $profile?->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="surface p-4 mb-4">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email', $profile?->email) }}"
                        class="form-control @error('email') is-invalid @enderror">
                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="form-label fw-semibold">Telepon</label>
                    <input name="phone" value="{{ old('phone', $profile?->phone) }}"
                        class="form-control @error('phone') is-invalid @enderror">
                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="surface p-4">
                @if($profile?->image_url)
                    <img src="{{ $profile->image_url }}" class="preview-image mb-3" alt="{{ $profile->company_name }}">
                @endif
                <label class="form-label fw-semibold">Gambar Perusahaan</label>
                <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp"
                    class="form-control @error('image') is-invalid @enderror">
                <div class="form-text">JPG, PNG, atau WebP. Maksimal 2 MB.</div>
                @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>
@endsection
