@extends('admin.layouts.app')
@section('title', 'Edit Galeri')
@section('heading', 'Edit Galeri')
@section('subheading', $gallery->title)
@section('content')
<form method="POST" action="{{ route('admin.galleries.update', $gallery) }}" enctype="multipart/form-data">@csrf @method('PUT') @include('admin.galleries._form', ['submitLabel' => 'Simpan Perubahan'])</form>
@endsection
