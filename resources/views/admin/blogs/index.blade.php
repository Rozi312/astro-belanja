@extends('admin.layouts.app')
@section('title', 'Artikel & Berita')
@section('heading', 'Artikel & Berita')
@section('subheading', 'Kelola informasi dan berita yang tampil di website')
@section('content')
<div class="d-flex flex-wrap justify-content-between gap-2 mb-4">
    <a href="{{ route('admin.blogs.export-pdf') }}" class="btn btn-outline-danger">Export PDF</a>
    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">+ Tambah Artikel</a>
</div>
<div class="surface p-4">
    @include('admin.partials.list-filters')
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead><tr><th>Artikel</th><th>Penulis</th><th>Status</th><th>Terbit</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse($blogs as $blog)
                <tr>
                    <td><div class="d-flex align-items-center gap-3">
                        @if($blog->image_url)<img src="{{ $blog->image_url }}" class="thumb" alt="">@endif
                        <div><strong>{{ $blog->title }}</strong><small class="d-block text-muted">{{ Str::limit($blog->excerpt ?: $blog->content, 55) }}</small></div>
                    </div></td>
                    <td>{{ $blog->author }}</td>
                    <td><span class="badge {{ $blog->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst($blog->status) }}</span></td>
                    <td>{{ $blog->published_at?->format('d M Y H:i') ?? '-' }}</td>
                    <td>@include('admin.partials.actions', ['prefix' => 'admin.blogs', 'model' => $blog])</td>
                </tr>
            @empty<tr><td colspan="5"><div class="empty-state">Belum ada artikel. Mulai dengan menambahkan artikel pertama.</div></td></tr>@endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $blogs->links('pagination::bootstrap-5') }}</div>
</div>
@endsection
