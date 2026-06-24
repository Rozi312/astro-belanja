<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        Blog::insert([
            [
                'title' => 'Promo Grand Opening Astro Belanja',
                'slug' => 'promo-grand-opening-astro-belanja',
                'excerpt' => 'Dapatkan diskon hingga 50% untuk semua kebutuhan pokok.',
                'content' => 'Dapatkan diskon hingga 50% untuk semua kebutuhan pokok di minggu pertama pembukaan!',
                'author' => 'Admin Astro',
                'image' => 'seed:astro_blog1.png',
                'status' => 'published',
                'published_at' => now()->subDays(8),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Tips Belanja Hemat di Akhir Bulan',
                'slug' => 'tips-belanja-hemat-di-akhir-bulan',
                'excerpt' => 'Belanja pintar dengan fitur Astro Pay.',
                'content' => 'Belanja pintar dengan fitur Astro Pay dan kumpulkan poin sebanyak-banyaknya.',
                'author' => 'Tim Kreatif',
                'image' => 'seed:astro_blog2.png',
                'status' => 'published',
                'published_at' => now()->subDays(6),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Kerjasama Baru dengan Petani Lokal',
                'slug' => 'kerjasama-baru-dengan-petani-lokal',
                'excerpt' => 'Sayuran segar kini hadir langsung dari petani Bogor.',
                'content' => 'Astro Belanja kini menghadirkan sayuran segar langsung dari petani Bogor.',
                'author' => 'Logistik Astro',
                'image' => 'seed:astro_blog3.png',
                'status' => 'published',
                'published_at' => now()->subDays(4),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Update Fitur Pengiriman Kilat',
                'slug' => 'update-fitur-pengiriman-kilat',
                'excerpt' => 'Nikmati pengiriman instan kurang dari 15 menit.',
                'content' => 'Nikmati pengiriman instan kurang dari 15 menit untuk area Jabodetabek.',
                'author' => 'Tech Team',
                'image' => 'seed:astro_blog4.png',
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
