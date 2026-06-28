<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cat1 = Category::create([
            'name' => 'Makanan Ringan',
            'slug' => 'makanan-ringan',
        ]);

        $cat2 = Category::create([
            'name' => 'Minuman Segar',
            'slug' => 'minuman-segar',
        ]);

        $cat3 = Category::create([
            'name' => 'Bahan Baku',
            'slug' => 'bahan-baku',
        ]);

        // Update existing products with slugs and categories
        $p1 = Product::where('name', 'like', '%Keripik%')->first();
        if ($p1) {
            $p1->update([
                'category_id' => $cat1->id,
                'slug' => 'keripik-kentang-bbq',
            ]);
        }

        $p2 = Product::where('name', 'like', '%Kopi%')->first();
        if ($p2) {
            $p2->update([
                'category_id' => $cat2->id,
                'slug' => 'kopi-susu-botol-250ml',
            ]);
        }
    }
}
