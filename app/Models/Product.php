<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Mengizinkan mass-assignment untuk kolom berikut
    protected $fillable = ['name', 'base_price', 'unit', 'category_id', 'slug'];

    // Relasi: Satu produk memiliki banyak batch stok (hasMany)
    public function batches()
    {
        return $this->hasMany(ProductBatch::class);
    }

    // Relasi: Satu produk milik satu kategori (belongsTo)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
