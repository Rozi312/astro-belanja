<form class="row g-2 mb-4" method="GET">
    <div class="col-md-6">
        <input type="search" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari data...">
    </div>
    @if(($showStatus ?? true))
    <div class="col-md-3">
        <select name="status" class="form-select">
            <option value="">Semua status</option>
            @foreach(($statuses ?? ['draft' => 'Draft', 'published' => 'Published']) as $value => $label)
                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
            @endforeach
        </select>
    </div>
    @endif
    <div class="col-md-3 d-flex gap-2">
        <button class="btn btn-outline-primary flex-grow-1">Filter</button>
        <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Reset</a>
    </div>
</form>
