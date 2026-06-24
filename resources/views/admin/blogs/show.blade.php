@extends('admin.layouts.app')
@section('title', 'Detail Artikel')
@section('heading', 'Detail Artikel')
@section('subheading', $blog->title)
@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="surface p-4">
            @if($blog->image_url)<img src="{{ $blog->image_url }}" class="preview-image mb-4" alt="{{ $blog->title }}">@endif
            <span class="badge {{ $blog->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst($blog->status) }}</span>
            <h2 class="fw-bold mt-3">{{ $blog->title }}</h2>
            @if($blog->excerpt)<p class="lead text-muted">{{ $blog->excerpt }}</p>@endif
            <div style="white-space: pre-line">{{ $blog->content }}</div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="surface p-4">
            <dl class="mb-0">
                <dt>Penulis</dt><dd>{{ $blog->author }}</dd>
                <dt>Slug</dt><dd>{{ $blog->slug }}</dd>
                <dt>Tanggal terbit</dt><dd>{{ $blog->published_at?->format('d M Y H:i') ?? '-' }}</dd>
            </dl>
            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-primary w-100 mt-3">Edit Artikel</a>
        </div>
    </div>
</div>
@endsection
