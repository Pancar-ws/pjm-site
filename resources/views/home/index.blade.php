@extends('layouts.frontend')

@section('title', 'Beranda')

@section('content')
<!-- Hero Section -->
<section class="relative bg-slate-900 overflow-hidden min-h-[85vh] flex items-center">
    <!-- Background Decor (Gradient Circle) -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-blue-500/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="absolute -top-40 -right-40 w-[400px] h-[400px] bg-indigo-500/15 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
        <div class="lg:col-span-7 text-left space-y-8">
            <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-semibold bg-blue-500/10 text-blue-400 border border-blue-500/20">
                🚀 Distributor Resmi F&B Indonesia
            </span>
            <h1 class="text-5xl sm:text-7xl font-extrabold text-white tracking-tight leading-none">
                Sistem Distribusi <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-indigo-300 to-cyan-300">Snack & Minuman</span>
            </h1>
            <p class="text-lg sm:text-xl text-slate-300 leading-relaxed max-w-2xl">
                Solusi inventory pergudangan terintegrasi dengan metode pengeluaran stok otomatis **FEFO** (First Expired First Out). Menjamin kualitas supply makanan dan minuman Anda tetap segar dan higienis.
            </p>
            <div class="flex flex-wrap gap-4 pt-4">
                <a href="{{ route('public.products.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-xl shadow-lg shadow-blue-900/30 transition transform hover:-translate-y-0.5 text-base">
                    Lihat Katalog Produk
                </a>
                <a href="{{ route('orders.index') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-200 border border-slate-700 font-semibold py-4 px-8 rounded-xl transition transform hover:-translate-y-0.5 text-base">
                    Mulai Order Agen
                </a>
            </div>
        </div>

        <div class="lg:col-span-5 hidden lg:block relative">
            <!-- Decorative Visual (Modern F&B card mockup) -->
            <div class="relative bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 shadow-2xl space-y-6">
                <div class="flex justify-between items-center border-b border-white/10 pb-4">
                    <span class="text-white font-bold text-lg">💡 Metode FEFO Aktif</span>
                    <span class="text-xs font-bold text-emerald-400 bg-emerald-400/10 px-2.5 py-1 rounded-full border border-emerald-400/20">Stok Terjaga</span>
                </div>
                <div class="space-y-4">
                    <div class="bg-white/5 p-4 rounded-xl flex justify-between items-center border border-white/5">
                        <div>
                            <p class="text-white font-semibold text-sm">Kopi Susu Botol 250ml</p>
                            <p class="text-xs text-slate-400">Batch: BATCH-KOPI-001</p>
                        </div>
                        <div class="text-right">
                            <p class="text-amber-400 font-bold text-sm">Exp: 1 Bulan Lagi</p>
                            <p class="text-xs text-slate-400">Prioritas: UTAMA</p>
                        </div>
                    </div>
                    <div class="bg-white/5 p-4 rounded-xl flex justify-between items-center opacity-60">
                        <div>
                            <p class="text-white font-semibold text-sm">Kopi Susu Botol 250ml</p>
                            <p class="text-xs text-slate-400">Batch: BATCH-KOPI-002</p>
                        </div>
                        <div class="text-right">
                            <p class="text-slate-300 font-bold text-sm">Exp: 5 Bulan Lagi</p>
                            <p class="text-xs text-slate-400">Prioritas: KEDUA</p>
                        </div>
                    </div>
                </div>
                <div class="text-xs text-center text-slate-400 pt-2">
                    Sistem otomatis merotasi stok untuk mencegah produk kedaluwarsa.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Highlight Kategori -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-16">
        <div class="max-w-3xl mx-auto space-y-4">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Kategori Produk Unggulan</h2>
            <p class="text-slate-500">Kami menyediakan variasi makanan ringan dan minuman segar yang dikemas dalam standar higienis tinggi untuk didistribusikan ke jaringan retail Anda.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($categories as $cat)
                <a href="{{ route('public.categories.show', $cat->slug) }}" class="group bg-slate-50 border border-slate-100 hover:border-blue-200 rounded-2xl p-8 hover:shadow-xl hover:shadow-slate-100 transition duration-300 flex flex-col items-center text-center space-y-6">
                    <div class="w-16 h-16 bg-blue-100 group-hover:bg-blue-600 text-blue-600 group-hover:text-white rounded-2xl flex items-center justify-center text-3xl transition duration-300 shadow-inner">
                        @if($cat->slug == 'makanan-ringan')
                            📦
                        @elseif($cat->slug == 'minuman-segar')
                            🥤
                        @else
                            🥫
                        @endif
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-slate-900 group-hover:text-blue-600 transition">{{ $cat->name }}</h3>
                        <p class="text-sm text-slate-500 mt-2">Jelajahi produk segar premium di kategori ini.</p>
                    </div>
                    <span class="text-sm font-semibold text-blue-600 group-hover:translate-x-1 transition flex items-center gap-1 pt-2">
                        Lihat Produk &rarr;
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Best Seller Section -->
<section class="py-24 bg-slate-50 border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">
            <div class="space-y-4 max-w-2xl">
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Rekomendasi Produk Terlaris</h2>
                <p class="text-slate-500">Produk F&B berkualitas tinggi yang telah dipercaya oleh ratusan mitra grosir dan merchant ritel di seluruh wilayah nusantara.</p>
            </div>
            <a href="{{ route('public.products.index') }}" class="font-bold text-blue-600 hover:text-blue-700 transition flex items-center gap-1 group">
                Semua Produk <span class="group-hover:translate-x-1 transition">&rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($best_sellers as $prod)
                <div class="bg-white rounded-2xl border border-slate-100 hover:border-blue-100 shadow-sm hover:shadow-lg transition duration-300 overflow-hidden flex flex-col group">
                    <div class="h-48 bg-slate-100 flex items-center justify-center text-4xl text-slate-400 group-hover:scale-102 transition">
                        @if($prod->category && $prod->category->slug == 'makanan-ringan')
                            🍟
                        @elseif($prod->category && $prod->category->slug == 'minuman-segar')
                            ☕
                        @else
                            🍲
                        @endif
                    </div>
                    <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                        <div>
                            <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md">{{ $prod->category->name ?? 'F&B' }}</span>
                            <h3 class="text-lg font-bold text-slate-900 mt-3 group-hover:text-blue-600 transition">{{ $prod->name }}</h3>
                        </div>
                        <div class="flex justify-between items-center pt-2">
                            <div>
                                <span class="text-xs text-slate-400 block">Harga / {{ $prod->unit }}</span>
                                <span class="text-lg font-extrabold text-slate-900">Rp {{ number_format($prod->base_price, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('public.products.show', $prod->slug) }}" class="bg-slate-100 hover:bg-blue-600 text-slate-700 hover:text-white p-2.5 rounded-xl transition">
                                🔍
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Certification Section -->
<section class="py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-16">
        <div class="max-w-3xl mx-auto space-y-4">
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-900">Jaminan Mutu & Keamanan Pangan</h2>
            <p class="text-slate-500">Seluruh produk dan gudang distribusi kami telah memenuhi standar regulasi pangan ketat yang berlaku di Indonesia.</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center">
            @foreach($certifications as $cert)
                <div class="bg-slate-50 border border-slate-100 rounded-2xl p-6 flex flex-col items-center space-y-3 group hover:border-amber-200 transition">
                    <span class="text-4xl">🛡️</span>
                    <span class="font-bold text-sm text-slate-800 tracking-wide text-center">{{ $cert->name }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="py-16 bg-slate-50 border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-8">
        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Telah Dipercaya oleh Jaringan Retail Terbaik</p>
        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16 opacity-60">
            @foreach($partners as $partner)
                <div class="text-slate-800 font-extrabold text-lg tracking-wide hover:opacity-100 transition cursor-default">
                    🏢 {{ $partner->name }}
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
