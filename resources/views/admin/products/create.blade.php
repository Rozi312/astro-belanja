@extends('admin.layouts.app')
@section('title', 'Tambah Produk')
@section('heading', 'Tambah Produk atau Layanan')
@section('subheading', 'Tambahkan layanan baru ke website')
@section('content')
<form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">@csrf @include('admin.products._form', ['submitLabel' => 'Simpan Produk'])</form>
@endsection
