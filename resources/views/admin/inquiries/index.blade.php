@extends('admin.layouts.app')
@section('title', 'Partnership Inquiry')
@section('heading', 'Partnership Inquiry')
@section('subheading', 'Tindak lanjuti penawaran kerja sama dari website')
@section('content')
<div class="surface p-4">
    @include('admin.partials.list-filters', ['statuses' => ['baru' => 'Baru', 'diproses' => 'Diproses', 'diterima' => 'Diterima', 'ditolak' => 'Ditolak']])
    <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Pengirim</th><th>Kategori</th><th>Status</th><th>Dikirim</th><th>Aksi</th></tr></thead><tbody>
    @forelse($inquiries as $inquiry)
        <tr><td><strong>{{ $inquiry->name }}</strong><small class="d-block text-muted">{{ $inquiry->email }}</small></td><td>{{ ucfirst($inquiry->category) }}</td><td><span class="badge text-bg-{{ ['baru'=>'primary','diproses'=>'warning','diterima'=>'success','ditolak'=>'danger'][$inquiry->status] ?? 'secondary' }}">{{ ucfirst($inquiry->status) }}</span></td><td>{{ $inquiry->created_at->format('d M Y H:i') }}</td><td><div class="d-flex gap-1"><a href="{{ route('admin.inquiries.show', $inquiry) }}" class="btn btn-sm btn-outline-primary">Detail</a><form method="POST" action="{{ route('admin.inquiries.destroy', $inquiry) }}" data-confirm="Hapus pengajuan ini?">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Hapus</button></form></div></td></tr>
    @empty<tr><td colspan="5"><div class="empty-state">Belum ada pengajuan partnership.</div></td></tr>@endforelse
    </tbody></table></div><div class="mt-4">{{ $inquiries->links('pagination::bootstrap-5') }}</div>
</div>
@endsection
