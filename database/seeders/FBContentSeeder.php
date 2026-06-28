<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Partner;
use App\Models\Certification;
use Illuminate\Database\Seeder;

class FBContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed Blog Posts
        Post::create([
            'title' => 'Tips Menyimpan Snack Agar Tetap Renyah di Gudang',
            'slug' => 'tips-menyimpan-snack-gudang',
            'content' => 'Menjaga kerenyahan produk snack di gudang memerlukan kontrol kelembaban yang baik. Pastikan produk diletakkan di atas pallet kayu dan tidak bersentuhan langsung dengan lantai beton untuk mencegah kondensasi. Suhu gudang ideal berkisar antara 20-25 derajat Celcius.',
            'image_url' => null,
        ]);

        Post::create([
            'title' => 'Tren Konsumsi Kopi Botol bagi Anak Muda Masa Kini',
            'slug' => 'tren-konsumsi-kopi-botol-muda',
            'content' => 'Kopi susu botol siap saji (Ready to Drink) semakin diminati oleh kalangan gen-Z karena kepraktisannya. Distribusi produk ini harus memperhatikan rantai pendingin (cold chain) untuk menjaga kualitas rasa kopi susu segar tetap optimal dari produsen hingga ke tangan konsumen.',
            'image_url' => null,
        ]);

        Post::create([
            'title' => 'Bagaimana Sistem FEFO Membantu Meminimalkan Kerugian Retail Anda',
            'slug' => 'sistem-fefo-meminimalkan-kerugian-retail',
            'content' => 'First Expired First Out (FEFO) adalah metode penyimpanan barang di mana barang yang memiliki tanggal kadaluwarsa terdekat harus dikeluarkan terlebih dahulu. Sistem ini sangat efektif untuk produk pangan basah maupun kering guna menghindari penumpukan produk kedaluwarsa di gudang.',
            'image_url' => null,
        ]);

        // 2. Seed Partners
        Partner::create(['name' => 'Indomaret Group', 'logo_url' => null]);
        Partner::create(['name' => 'Alfamart Retail', 'logo_url' => null]);
        Partner::create(['name' => 'Super Indo Supermarket', 'logo_url' => null]);
        Partner::create(['name' => 'Transmart Hypermarket', 'logo_url' => null]);

        // 3. Seed Certifications
        Certification::create(['name' => 'Halal Indonesia', 'image_url' => null]);
        Certification::create(['name' => 'BPOM RI MD', 'image_url' => null]);
        Certification::create(['name' => 'HACCP Certified (Hazard Analysis Critical Control Point)', 'image_url' => null]);
        Certification::create(['name' => 'ISO 22000 Food Safety Management', 'image_url' => null]);
    }
}
