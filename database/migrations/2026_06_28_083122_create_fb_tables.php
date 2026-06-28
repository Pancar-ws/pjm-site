<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Create categories table
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->timestamps();
        });

        // 2. Alter products table to add category_id and slug
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')->nullable()->after('id')->constrained('categories')->onDelete('set null');
            $table->string('slug', 150)->nullable()->after('name');
        });

        // 3. Create posts table
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('slug', 200)->unique();
            $table->text('content');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });

        // 4. Create partners table
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('logo_url')->nullable();
            $table->timestamps();
        });

        // 5. Create certifications table
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
        Schema::dropIfExists('partners');
        Schema::dropIfExists('posts');
        
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn(['category_id', 'slug']);
        });

        Schema::dropIfExists('categories');
    }
};
