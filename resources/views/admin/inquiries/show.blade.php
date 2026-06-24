@extends('admin.layouts.app')
@section('title', 'Detail Inquiry')
@section('heading', 'Detail Partnership Inquiry')
@section('subheading', $inquiry->name)
@section('content')
<div class="row g-4">
    <div class="col-lg-8"><div class="surface p-4"><h5 class="fw-bold">Pesan / Penawaran</h5><div class="bg-light rounded-3 p-4 mt-3" style="white-space:pre-line">{{ $inquiry->message }}</div></div></div>
    <div class="col-lg-4"><div class="surface p-4"><p><strong>Nama/Perusahaan</strong><br>{{ $inquiry->name }}</p><p><strong>Email</strong><br><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></p><p><strong>Kategori</strong><br>{{ ucfirst($inquiry->category) }}</p><p><strong>Tanggal</strong><br>{{ $inquiry->created_at->format('d M Y H:i') }}</p><hr><form method="POST" action="{{ route('admin.inquiries.status', $inquiry) }}">@csrf @method('PATCH')<label class="form-label fw-semibold">Status Tindak Lanjut</label><select name="status" class="form-select mb-3">@foreach(['baru','diproses','diterima','ditolak'] as $status)<option value="{{ $status }}" @selected($inquiry->status === $status)>{{ ucfirst($status) }}</option>@endforeach</select><button class="btn btn-primary w-100">Perbarui Status</button></form></div></div>
</div>
@endsection
