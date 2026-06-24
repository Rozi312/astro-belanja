@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('heading', 'Dashboard')
@section('subheading', 'Ringkasan konten dan aktivitas website')
@section('content')
<div class="row g-4 mb-4">
    @foreach ([
        ['Artikel', $stats['blog'], '▤', 'admin.blogs.index'],
        ['Profil', $stats['profile_configured'] ? 'Sudah Diatur' : 'Belum Diatur', '◉', 'admin.profile.edit'],
        ['Produk', $stats['product'], '◇', 'admin.products.index'],
        ['Galeri', $stats['gallery'], '▧', 'admin.galleries.index'],
        ['Inquiry', $stats['inquiry'], '✉', 'admin.inquiries.index'],
    ] as [$label, $count, $icon, $route])
    <div class="col-sm-6 col-xl">
        <a href="{{ route($route) }}" class="text-decoration-none text-dark">
            <div class="surface stat-card">
                <div class="d-flex justify-content-between align-items-start">
                    <div><div class="text-muted">{{ $label }}</div><div class="stat-number">{{ $count }}</div></div>
                    <div class="stat-icon">{{ $icon }}</div>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
<div class="row g-4">
    <div class="col-xl-7">
        <div class="surface p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Artikel Terbaru</h5>
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary btn-sm">+ Artikel</a>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead><tr><th>Judul</th><th>Status</th><th>Tanggal</th></tr></thead>
                    <tbody>
                    @forelse($recentBlogs as $blog)
                        <tr>
                            <td><a href="{{ route('admin.blogs.show', $blog) }}" class="fw-semibold text-decoration-none">{{ $blog->title }}</a><small class="d-block text-muted">{{ $blog->author }}</small></td>
                            <td><span class="badge {{ $blog->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst($blog->status) }}</span></td>
                            <td>{{ $blog->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty<tr><td colspan="3" class="text-center text-muted py-4">Belum ada artikel.</td></tr>@endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-xl-5">
        <div class="surface p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0">Pengajuan Mitra</h5>
                <a href="{{ route('admin.inquiries.index') }}" class="small text-decoration-none">Lihat semua</a>
            </div>
            @forelse($recentInquiries as $inquiry)
                <a href="{{ route('admin.inquiries.show', $inquiry) }}" class="d-flex justify-content-between text-decoration-none text-dark border-bottom py-3">
                    <span><strong>{{ $inquiry->name }}</strong><small class="d-block text-muted">{{ $inquiry->email }}</small></span>
                    <span class="badge text-bg-light align-self-center">{{ ucfirst($inquiry->status) }}</span>
                </a>
            @empty<div class="empty-state">Belum ada pengajuan partnership.</div>@endforelse
        </div>
    </div>
</div>
@endsection
