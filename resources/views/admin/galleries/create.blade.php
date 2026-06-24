@extends('admin.layouts.app')
@section('title', 'Tambah Galeri')
@section('heading', 'Tambah Galeri')
@section('subheading', 'Unggah dokumentasi visual baru')
@section('content')
<form method="POST" action="{{ route('admin.galleries.store') }}" enctype="multipart/form-data">@csrf @include('admin.galleries._form', ['submitLabel' => 'Simpan Galeri'])</form>
@endsection
