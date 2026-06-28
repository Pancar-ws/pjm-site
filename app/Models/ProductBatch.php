<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{
    // Mengizinkan mass-assignment
    protected $fillable = ['product_id', 'batch_number', 'qty', 'expired_date'];

    // Relasi: Batch ini milik satu produk tertentu (belongsTo)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
