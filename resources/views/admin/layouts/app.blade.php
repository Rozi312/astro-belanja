<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Administrator') - Astro Belanja</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <a class="admin-brand" href="{{ route('admin.dashboard') }}">
                ASTRO BELANJA
                <small>ADMINISTRATION PANEL</small>
            </a>
            <nav class="admin-nav">
                <a class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">▦ Dashboard</a>
                <a class="{{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}"
                    href="{{ route('admin.blogs.index') }}">▤ Artikel & Berita</a>
                <a class="{{ request()->routeIs('admin.profile.*') ? 'active' : '' }}"
                    href="{{ route('admin.profile.edit') }}">◉ Profil Perusahaan</a>
                <a class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}"
                    href="{{ route('admin.products.index') }}">◇ Produk & Layanan</a>
                <a class="{{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}"
                    href="{{ route('admin.galleries.index') }}">▧ Galeri</a>
                <a class="{{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}"
                    href="{{ route('admin.inquiries.index') }}">✉ Partnership</a>
            </nav>
        </aside>
        <div class="admin-content">
            <header class="admin-topbar">
                <div>
                    <h1 class="page-title">@yield('heading', 'Dashboard')</h1>
                    <p class="page-subtitle">@yield('subheading', 'Kelola konten Astro Belanja')</p>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="text-end d-none d-sm-block">
                        <div class="fw-bold">{{ $currentAdmin->name ?? session('admin_name') }}</div>
                        <small class="text-muted">Administrator</small>
                    </div>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="btn btn-outline-danger btn-sm">Logout</button>
                    </form>
                </div>
            </header>
            <main class="admin-main">
                @include('admin.partials.alerts')
                @yield('content')
            </main>
        </div>
    </div>
    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        document.querySelectorAll('[data-confirm]').forEach(form => {
            form.addEventListener('submit', event => {
                if (!confirm(form.dataset.confirm)) event.preventDefault();
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
