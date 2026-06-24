@php($blog = $blog ?? null)
<div class="row g-4">
    <div class="col-lg-8">
        <div class="surface p-4">
            <div class="mb-3">
                <label class="form-label fw-semibold">Judul Artikel</label>
                <input name="title" value="{{ old('title', $blog?->title) }}" class="form-control @error('title') is-invalid @enderror" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Slug</label>
                <input name="slug" value="{{ old('slug', $blog?->slug) }}" class="form-control @error('slug') is-invalid @enderror" required>
                <div class="form-text">Gunakan huruf kecil dan tanda hubung, contoh: promo-astro-terbaru.</div>
                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Ringkasan</label>
                <textarea name="excerpt" rows="3" maxlength="500" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $blog?->excerpt) }}</textarea>
                @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="form-label fw-semibold">Isi Artikel</label>
                <textarea name="content" rows="12" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $blog?->content) }}</textarea>
                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="surface p-4 mb-4">
            <div class="mb-3">
                <label class="form-label fw-semibold">Penulis</label>
                <input name="author" value="{{ old('author', $blog?->author ?? session('admin_name')) }}" class="form-control @error('author') is-invalid @enderror" required>
                @error('author')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    @foreach(['draft' => 'Draft', 'published' => 'Published'] as $value => $label)
                        <option value="{{ $value }}" @selected(old('status', $blog?->status ?? 'draft') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div>
                <label class="form-label fw-semibold">Tanggal Terbit</label>
                <input type="datetime-local" name="published_at" value="{{ old('published_at', $blog?->published_at?->format('Y-m-d\TH:i')) }}" class="form-control @error('published_at') is-invalid @enderror">
                @error('published_at')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
        </div>
        <div class="surface p-4">
            @if($blog?->image_url)<img src="{{ $blog->image_url }}" class="preview-image mb-3" alt="">@endif
            <label class="form-label fw-semibold">Gambar Artikel</label>
            <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp" class="form-control @error('image') is-invalid @enderror">
            <div class="form-text">JPG, PNG, atau WebP. Maksimal 2 MB.</div>
            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>
</div>
<div class="d-flex justify-content-end gap-2 mt-4">
    <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary">Batal</a>
    <button class="btn btn-primary">{{ $submitLabel }}</button>
</div>
