@extends('admin.layouts.app')
@section('title', 'Edit Produk')
@section('heading', 'Edit Produk atau Layanan')
@section('subheading', $product->name)
@section('content')
<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">@csrf @method('PUT') @include('admin.products._form', ['submitLabel' => 'Simpan Perubahan'])</form>
@endsection
