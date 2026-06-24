@extends('admin.layouts.app')
@section('title', 'Edit Artikel')
@section('heading', 'Edit Artikel')
@section('subheading', 'Perbarui informasi artikel')
@section('content')
<form method="POST" action="{{ route('admin.blogs.update', $blog) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.blogs._form', ['submitLabel' => 'Simpan Perubahan'])
</form>
@endsection
