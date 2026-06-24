<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Administrator - Astro Belanja</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.8-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="login-page">
<div class="card login-card">
    <div class="row g-0">
        <div class="col-lg-5 login-side d-none d-lg-flex flex-column justify-content-between">
            <div>
                <span class="badge rounded-pill text-bg-light text-primary mb-4">ASTRO CMS</span>
                <h1 class="display-5 fw-bold">Kelola website dalam satu tempat.</h1>
                <p class="lead opacity-75">Perbarui artikel, produk, profil, galeri, dan pengajuan mitra dengan aman.</p>
            </div>
            <small class="opacity-75">Astro Belanja Administration Panel</small>
        </div>
        <div class="col-lg-7 bg-white p-4 p-md-5 d-flex align-items-center">
            <div class="w-100">
                <a href="{{ route('home') }}" class="text-decoration-none fw-bold">← Kembali ke website</a>
                <h2 class="fw-bold mt-5 mb-2">Login Administrator</h2>
                <p class="text-muted mb-4">Masukkan akun admin untuk melanjutkan.</p>
                @include('admin.partials.alerts')
                <form method="POST" action="{{ route('admin.login.attempt') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required autofocus>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button class="btn btn-primary w-100 py-2">Masuk ke Dashboard</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
