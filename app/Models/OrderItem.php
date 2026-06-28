<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Table order_items does not have timestamps in migration, let's disable them
    public $timestamps = false;

    protected $fillable = ['order_id', 'product_id', 'qty', 'price_per_unit', 'discount_applied', 'subtotal'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
