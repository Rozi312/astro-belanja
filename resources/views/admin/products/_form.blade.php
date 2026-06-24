@php($product = $product ?? null)
<div class="row g-4">
    <div class="col-lg-8">
        <div class="surface p-4">
            <div class="mb-3"><label class="form-label fw-semibold">Nama Produk/Layanan</label><input name="name" value="{{ old('name', $product?->name) }}" class="form-control @error('name') is-invalid @enderror" required>@error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
            <div class="mb-3"><label class="form-label fw-semibold">Slug</label><input name="slug" value="{{ old('slug', $product?->slug) }}" class="form-control @error('slug') is-invalid @enderror" required>@error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
            <div class="mb-3"><label class="form-label fw-semibold">Deskripsi Singkat</label><textarea name="short_description" rows="3" maxlength="500" class="form-control @error('short_description') is-invalid @enderror" required>{{ old('short_description', $product?->short_description) }}</textarea>@error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
            <div><label class="form-label fw-semibold">Deskripsi Lengkap</label><textarea name="description" rows="10" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $product?->description) }}</textarea>@error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="surface p-4 mb-4">
            <div class="mb-3"><label class="form-label fw-semibold">Status</label><select name="status" class="form-select">@foreach(['draft' => 'Draft', 'published' => 'Published'] as $value => $label)<option value="{{ $value }}" @selected(old('status', $product?->status ?? 'draft') === $value)>{{ $label }}</option>@endforeach</select></div>
            <div class="mb-3"><label class="form-label fw-semibold">Urutan Tampil</label><input type="number" min="0" name="sort_order" value="{{ old('sort_order', $product?->sort_order ?? 0) }}" class="form-control @error('sort_order') is-invalid @enderror" required>@error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror</div>
            <div class="form-check form-switch"><input type="hidden" name="is_featured" value="0"><input class="form-check-input" type="checkbox" name="is_featured" value="1" id="featured" @checked(old('is_featured', $product?->is_featured))><label class="form-check-label" for="featured">Tampilkan sebagai unggulan</label></div>
        </div>
        <div class="surface p-4">
            @if($product?->image_url)<img src="{{ $product->image_url }}" class="preview-image mb-3" alt="">@endif
            <label class="form-label fw-semibold">Gambar Produk</label><input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="form-control @error('image') is-invalid @enderror"><div class="form-text">Maksimal 2 MB.</div>@error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
<div class="d-flex justify-content-end gap-2 mt-4"><a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Batal</a><button class="btn btn-primary">{{ $submitLabel }}</button></div>
