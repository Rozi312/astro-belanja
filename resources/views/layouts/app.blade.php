<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Astro Belanja')</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/frontend.css') }}">
    
    <style>
        .bg-astro { background-color: #0d6dfd !important; }
        .text-astro { color: #0d6dfd !important; }
        footer { background-color:  #1a1a1a !important; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-astro shadow-sm">
        <div class="container">
            <a href="/" class="navbar-brand fw-bold">ASTRO BELANJA</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('blog.index') }}" class="nav-link {{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('gallery.index') }}" class="nav-link {{ request()->routeIs('gallery.*') ? 'active' : '' }}">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">Tentang Astro</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('partnership') }}" class="nav-link {{ request()->routeIs('partnership*') ? 'active' : '' }}">Partnership</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="text-white mt-5 py-4">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
            <span>&copy; 2026 Astro Belanja - 241011750248. All rights reserved.</span>
            <a href="{{ route('admin.login') }}" class="footer-link">Administrator</a>
        </div>
    </footer>

    <script src="{{ asset('bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
