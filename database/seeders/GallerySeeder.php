<?php

namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Belanja Hemat Saat Gajian',
            'Promo Terbaru',
            'Belanja Hemat',
            'Makin Hemat',
            'Promo THR',
        ];

        foreach ($titles as $index => $title) {
            Gallery::create([
                'title' => $title,
                'caption' => 'Program dan aktivitas terbaru Astro Belanja.',
                'image' => 'seed:astro_home'.($index + 1).'.png',
                'status' => 'published',
                'sort_order' => $index + 1,
            ]);
        }
    }
}
