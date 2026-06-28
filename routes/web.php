<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\ProductBatchController;

// Halaman Publik
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [ProductController::class, 'index'])->name('public.products.index');
Route::get('/produk/{slug}', [ProductController::class, 'show'])->name('public.products.show');
Route::get('/kategori/{slug}', [CategoryController::class, 'show'])->name('public.categories.show');
Route::get('/layanan', [ServiceController::class, 'index'])->name('public.services');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('public.about');
Route::get('/blog', [BlogController::class, 'index'])->name('public.blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('public.blog.show');
Route::get('/partner', [PartnerController::class, 'index'])->name('public.partners');
Route::get('/sertifikasi', [CertificationController::class, 'index'])->name('public.certifications');

Route::get('/kontak', [ContactController::class, 'index'])->name('public.contact');
Route::post('/kontak', [ContactController::class, 'submit'])->name('public.contact.submit');

// Autentikasi (Sederhana untuk mengganti Breeze yang terhapus/belum dibuat)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Halaman Terproteksi Middleware Auth (Pemesanan & Manajemen)
Route::middleware(['auth'])->group(function () {
    Route::get('/pemesanan', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/pemesanan', [OrderController::class, 'store'])->name('orders.store');
    
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::resource('products', AdminProductController::class);
    Route::resource('product-batches', ProductBatchController::class);
});