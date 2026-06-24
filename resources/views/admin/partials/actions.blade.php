<div class="d-flex gap-1 flex-wrap">
    <a href="{{ route($prefix.'.show', $model) }}" class="btn btn-sm btn-outline-primary">Detail</a>
    <a href="{{ route($prefix.'.edit', $model) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
    <form method="POST" action="{{ route($prefix.'.destroy', $model) }}" data-confirm="Hapus data ini secara permanen?">
        @csrf @method('DELETE')
        <button class="btn btn-sm btn-outline-danger">Hapus</button>
    </form>
</div>
