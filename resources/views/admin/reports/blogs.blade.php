<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Artikel Astro Belanja</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 10px; color: #1f2937; }
        h1 { color: #0d6efd; margin-bottom: 4px; }
        .meta { color: #6b7280; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #d1d5db; padding: 7px; text-align: left; }
        th { background: #0d6efd; color: white; }
        .summary { margin-top: 16px; font-weight: bold; }
    </style>
</head>
<body>
    <h1>Laporan Artikel & Berita Astro Belanja</h1>
    <div class="meta">Tanggal cetak: {{ $printedAt->format('d M Y H:i') }}</div>
    <table>
        <thead><tr><th>No</th><th>Judul</th><th>Penulis</th><th>Status</th><th>Tanggal Terbit</th></tr></thead>
        <tbody>
        @forelse($blogs as $blog)
            <tr><td>{{ $loop->iteration }}</td><td>{{ $blog->title }}</td><td>{{ $blog->author }}</td><td>{{ ucfirst($blog->status) }}</td><td>{{ $blog->published_at?->format('d M Y H:i') ?? '-' }}</td></tr>
        @empty<tr><td colspan="5">Belum ada data artikel.</td></tr>@endforelse
        </tbody>
    </table>
    <div class="summary">Total artikel: {{ $blogs->count() }} | Published: {{ $blogs->where('status', 'published')->count() }} | Draft: {{ $blogs->where('status', 'draft')->count() }}</div>
</body>
</html>
