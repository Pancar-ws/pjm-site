<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel orders dengan cascade delete
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            
            // Relasi ke tabel products
            $table->foreignId('product_id')->constrained('products');
            
            $table->integer('qty');
            $table->decimal('price_per_unit', 10, 2);
            $table->decimal('discount_applied', 10, 2)->default(0);
            $table->decimal('subtotal', 12, 2);
            
            // Catatan: Pada rancangan DDL asli tidak diwajibkan ada created_at/updated_at untuk tabel ini,
            // Namun jika Anda ingin mengikuti standar Laravel sepenuhnya, Anda bisa meng-uncomment kode di bawah:
            // $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
