@extends('admin.layouts.app')
@section('title', 'Detail Galeri')
@section('heading', 'Detail Galeri')
@section('subheading', $gallery->title)
@section('content')
<div class="row justify-content-center"><div class="col-xl-9"><div class="surface p-4"><img src="{{ $gallery->image_url }}" class="preview-image mb-4" alt="{{ $gallery->title }}"><div class="d-flex justify-content-between"><div><h2 class="fw-bold">{{ $gallery->title }}</h2><p class="text-muted">{{ $gallery->caption ?: 'Tidak ada caption.' }}</p></div><span class="badge {{ $gallery->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }} align-self-start">{{ ucfirst($gallery->status) }}</span></div><a href="{{ route('admin.galleries.edit', $gallery) }}" class="btn btn-primary">Edit Galeri</a></div></div></div>
@endsection
