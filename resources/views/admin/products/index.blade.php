@extends('admin.layouts.app')
@section('title', 'Produk & Layanan')
@section('heading', 'Produk & Layanan')
@section('subheading', 'Kelola layanan unggulan Astro Belanja')
@section('content')
<div class="text-end mb-4"><a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Tambah Produk</a></div>
<div class="surface p-4">
    @include('admin.partials.list-filters')
    <div class="table-responsive">
        <table class="table mb-0">
            <thead><tr><th>Produk</th><th>Urutan</th><th>Featured</th><th>Status</th><th>Aksi</th></tr></thead>
            <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        <div class="d-flex gap-3 align-items-center">
                            
                            <img src="{{ 
                                $product->name == 'Belanja Kilat' ? asset('bootstrap-5.3.8-dist/images/astro_home1.png') : 
                                ($product->name == 'Astro Fresh' ? asset('bootstrap-5.3.8-dist/images/astro_home2.png') : 
                                ($product->name == 'Astro Business' ? asset('bootstrap-5.3.8-dist/images/astro_home3.png') : 
                                $product->image_url)) 
                            }}" class="thumb" style="object-fit: cover;" alt="{{ $product->name }}">
                            
                            <div>
                                <strong>{{ $product->name }}</strong>
                                <small class="d-block text-muted">{{ Str::limit($product->short_description, 55) }}</small>
                            </div>
                        </div>
                    </td>
                    <td>{{ $product->sort_order }}</td>
                    <td>{{ $product->is_featured ? 'Ya' : 'Tidak' }}</td>
                    <td><span class="badge {{ $product->status === 'published' ? 'text-bg-success' : 'text-bg-secondary' }}">{{ ucfirst($product->status) }}</span></td>
                    <td>@include('admin.partials.actions', ['prefix' => 'admin.products', 'model' => $product])</td>
                </tr>
            @empty
                <tr><td colspan="5"><div class="empty-state">Belum ada produk atau layanan.</div></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">{{ $products->links('pagination::bootstrap-5') }}</div>
</div>
@endsection