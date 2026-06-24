# Astro Belanja Company Profile

Website Company Profile berbasis Laravel 13 dengan frontend Bootstrap dan panel administrator untuk mengelola artikel, profil perusahaan, produk/layanan, galeri, serta pengajuan partnership.

## Fitur

- Login/logout admin manual berbasis session dan password hash.
- Dashboard ringkasan seluruh modul.
- CRUD Artikel, Produk/Layanan, dan Galeri.
- Pengaturan tunggal Profil Perusahaan untuk halaman Tentang Astro.
- Upload gambar melalui Laravel public storage.
- Form Partnership publik dan pengelolaan status inquiry.
- Export laporan artikel PDF menggunakan DomPDF.
- Frontend dinamis dengan filter konten published.

## Instalasi

Pastikan PHP 8.3+, Composer, ekstensi PDO MySQL, dan MySQL tersedia.

```bash
composer install
cp .env.example .env
php artisan key:generate
```

Buat database MySQL `db_astro_belanja`, sesuaikan kredensial database pada `.env`, lalu jalankan:

```bash
php artisan migrate:fresh --seed
php artisan storage:link
php artisan serve
```

Website tersedia di `http://127.0.0.1:8000` dan login admin di `http://127.0.0.1:8000/admin/login`.

## Akun Admin Default

- Email: `admin@astrobelanja.com`
- Password: `Admin123!`

Ganti password default sebelum penggunaan produksi.

## Export PDF

Login sebagai admin, buka menu **Artikel & Berita**, lalu tekan **Export PDF**. Laporan berisi judul, penulis, status, tanggal terbit, tanggal cetak, dan ringkasan jumlah artikel.

## Pengujian

Automated test menggunakan SQLite in-memory sehingga tidak memerlukan database MySQL:

```bash
php artisan test
```

Untuk memeriksa daftar route:

```bash
php artisan route:list
```
