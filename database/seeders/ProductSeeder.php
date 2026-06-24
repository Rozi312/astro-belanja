<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['Belanja Kilat', 'belanja-kilat', 'Kebutuhan harian tiba maksimal 15 menit.', 'Layanan pengiriman cepat untuk bahan makanan, sembako, dan kebutuhan rumah tangga pilihan.', 'si.png'],
            ['Astro Fresh', 'astro-fresh', 'Produk segar pilihan langsung dari mitra lokal.', 'Buah, sayur, dan protein segar yang dikurasi untuk menjaga mutu sampai ke tangan pelanggan.', 'scm.png'],
            ['Astro Business', 'astro-business', 'Solusi pasokan rutin untuk bisnis dan komunitas.', 'Pengadaan kebutuhan rutin dengan dukungan inventori dan jadwal pengiriman yang fleksibel.', 'erp.png'],
        ];

        foreach ($products as $index => [$name, $slug, $short, $description, $image]) {
            Product::create([
                'name' => $name,
                'slug' => $slug,
                'short_description' => $short,
                'description' => $description,
                'image' => 'seed:'.$image,
                'status' => 'published',
                'is_featured' => true,
                'sort_order' => $index + 1,
            ]);
        }
    }
}
