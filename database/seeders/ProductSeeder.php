<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductBatch;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // --- Produk 1 ---
        $produk1 = Product::create([
            'name' => 'Keripik Kentang BBQ',
            'base_price' => 120000,
            'unit' => 'karton',
        ]);

        // Batch stok untuk Produk 1 (Expired 6 bulan ke depan)
        ProductBatch::create([
            'product_id' => $produk1->id,
            'batch_number' => 'BATCH-KRPK-001',
            'qty' => 150,
            'expired_date' => Carbon::now()->addMonths(6)->format('Y-m-d'),
        ]);

        // --- Produk 2 ---
        $produk2 = Product::create([
            'name' => 'Kopi Susu Botol 250ml',
            'base_price' => 45000,
            'unit' => 'dus',
        ]);

        // Batch stok untuk Produk 2 (Ada 2 batch dengan expired berbeda untuk tes FEFO)
        ProductBatch::create([
            'product_id' => $produk2->id,
            'batch_number' => 'BATCH-KOPI-001',
            'qty' => 50,
            'expired_date' => Carbon::now()->addMonths(1)->format('Y-m-d'), // Expired lebih cepat
        ]);

        ProductBatch::create([
            'product_id' => $produk2->id,
            'batch_number' => 'BATCH-KOPI-002',
            'qty' => 200,
            'expired_date' => Carbon::now()->addMonths(5)->format('Y-m-d'), // Expired lebih lama
        ]);
    }
}