@extends('admin.layouts.app')
@section('title', 'Tambah Artikel')
@section('heading', 'Tambah Artikel')
@section('subheading', 'Publikasikan berita atau informasi baru')
@section('content')
<form method="POST" action="{{ route('admin.blogs.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.blogs._form', ['submitLabel' => 'Simpan Artikel'])
</form>
@endsection
