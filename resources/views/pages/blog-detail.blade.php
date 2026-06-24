@extends('layouts.app')

@section('title', 'Blog Detail')
@section('content')
<style>
    .card-img-top {
        width: 100%;
        max-height: 100%;
        object-fit: cover;
        object-position: center;
    }
</style>
<div class="container">
    <div class="row mt-5 justify-content-center">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm">
                @if($blog->image_url)<img class="card-img-top" src="{{ $blog->image_url }}" alt="{{ $blog->title }}">@endif
                
                <div class="card-body">
                    <h5 class="card-title fw-bold text-primary">{{ $blog->title }}</h5>
                    <p class="card-text" style="text-align: justify;">{{ $blog->content }}</p>
                <div class="mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Penulis Berita</h5>
                        <p class="card-text lead text-primary">{{ $blog->author }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Tanggal Terbit</h5>
                        <p class="card-text lead">{{ ($blog->published_at ?? $blog->created_at)->format('d M Y') }}</p>
                    </div>
                </div>
            </div>
            <a href="{{ route('blog.index') }}" class="btn btn-primary w-100 mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection
