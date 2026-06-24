<?php

namespace Database\Seeders;

use App\Models\CompanyProfile;
use Illuminate\Database\Seeder;

class CompanyProfileSeeder extends Seeder
{
    public function run(): void
    {
        CompanyProfile::updateOrCreate([
            'id' => 1,
        ], [
            'company_name' => 'Astro Belanja Indonesia',
            'tagline' => 'Solusi belanja masa depan Anda',
            'location' => 'Jabodetabek, Jawa Barat',
            'vision' => 'Menjadi platform nomor satu dalam penyediaan kebutuhan harian yang mengutamakan kecepatan dan kesegaran produk.',
            'description' => 'Astro Belanja lahir dari semangat untuk memberikan kemudahan bagi mahasiswa dan warga di area Jabodetabek. Kami memahami bahwa waktu sangat berharga, oleh karena itu kami menjamin pengiriman dalam 15 menit agar Anda bisa langsung memasak atau menikmati kebutuhan harian tanpa hambatan.',
            'email' => 'support@astrobelanja.com',
            'phone' => '021-555-1500',
            'image' => 'seed:astro_about2.png',
            'is_active' => true,
        ]);
    }
}
