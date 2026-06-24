@extends('admin.layouts.app')
@section('title', 'Galeri')
@section('heading', 'Galeri')
@section('subheading', 'Kelola dokumentasi dan banner visual')
@section('content')
<div class="text-end mb-4"><a href="{{ route('admin.galleries.create') }}" class="btn btn-primary">+ Tambah Galeri</a></div>
<div class="surface p-4">
    @include('admin.partials.list-filters')
    <div class="row g-4">
    @forelse($galleries as $gallery)
        <div class="col-md-6 col-xl-4">
            <div class="card h-100 border-0 shadow-sm">
                <img src="{{ $gallery->image_url }}" class="card-img-top" style="height:190px;object-fit:cover" alt="{{ $gallery->title }}">
                <div class="card-body"><div class="d-flex justify-content-between gap-2"><h5 class="fw-bold">{{ $gallery->title }}</h5><span class="badge {{ $gallery->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }} align-self-start">{{ ucfirst($gallery->status) }}</span></div><p class="text-muted small">{{ Str::limit($gallery->caption, 90) }}</p><p class="small">Urutan: {{ $gallery->sort_order }}</p>@include('admin.partials.actions', ['prefix' => 'admin.galleries', 'model' => $gallery])</div>
            </div>
        </div>
    @empty<div class="col-12"><div class="empty-state">Belum ada gambar galeri.</div></div>@endforelse
    </div>
    <div class="mt-4">{{ $galleries->links('pagination::bootstrap-5') }}</div>
</div>
@endsection
