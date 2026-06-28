@extends('layouts.frontend')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Back link -->
    <div class="mb-8">
        <a href="{{ route('public.products.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-blue-600 transition">
            &larr; Kembali ke Katalog
        </a>
    </div>

    <!-- Product Detail Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 bg-white border border-slate-100 p-8 sm:p-12 rounded-3xl shadow-sm">
        
        <!-- Left Column: Visual Icon & Info -->
        <div class="lg:col-span-5 space-y-6">
            <div class="h-80 bg-slate-50 rounded-2xl flex items-center justify-center text-8xl shadow-inner select-none">
                @if($product->category && $product->category->slug == 'makanan-ringan')
                    🍟
                @elseif($product->category && $product->category->slug == 'minuman-segar')
                    ☕
                @else
                    🍲
                @endif
            </div>
            <div class="bg-blue-50/50 rounded-2xl p-6 border border-blue-50 space-y-3">
                <h4 class="text-blue-800 font-bold text-sm">💡 Jaminan Kualitas FEFO</h4>
                <p class="text-xs text-blue-700 leading-relaxed">
                    Kami menggunakan sistem rotasi stok **First Expired First Out (FEFO)**. Batch produk dengan tanggal kedaluwarsa paling dekat otomatis diprioritaskan untuk dikirim terlebih dahulu untuk menjamin kesegaran maksimal.
                </p>
            </div>
        </div>

        <!-- Right Column: Product Metadata & Batches -->
        <div class="lg:col-span-7 space-y-8">
            <div class="space-y-4">
                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wider">
                    {{ $product->category->name ?? 'Kategori Pangan' }}
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight">{{ $product->name }}</h1>
                
                <div class="flex items-baseline gap-2 pt-2">
                    <span class="text-3xl font-extrabold text-slate-900">Rp {{ number_format($product->base_price, 0, ',', '.') }}</span>
                    <span class="text-slate-400 text-sm">/ {{ $product->unit }}</span>
                </div>
            </div>

            <!-- Stok per Batch (Visual FEFO) -->
            <div class="space-y-4 pt-4 border-t border-slate-100">
                <h3 class="text-slate-900 font-bold text-base flex items-center gap-2">
                    📦 Daftar Batch Stok Aktif (Urutan Pengeluaran)
                </h3>
                
                @if($product->batches->count() > 0)
                    <div class="space-y-3">
                        @foreach($product->batches as $batch)
                            @php
                                $daysLeft = \Carbon\Carbon::parse($batch->expired_date)->diffInDays(now());
                                $isNearExpired = $daysLeft <= 60;
                            @endphp
                            <div class="border {{ $loop->first ? 'border-blue-200 bg-blue-50/30' : 'border-slate-100 bg-slate-50/30' }} p-4 rounded-xl flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                                <div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-sm text-slate-800">{{ $batch->batch_number }}</span>
                                        @if($loop->first)
                                            <span class="text-[9px] font-bold text-white bg-blue-600 px-2 py-0.5 rounded-full uppercase tracking-wide">Prioritas Utama (FEFO)</span>
                                        @endif
                                    </div>
                                    <p class="text-xs text-slate-400 mt-1">Jumlah Stok Tersedia: <strong>{{ $batch->qty }} {{ $product->unit }}</strong></p>
                                </div>
                                <div class="text-left sm:text-right">
                                    <span class="text-xs text-slate-400 block">Tanggal Kedaluwarsa:</span>
                                    <span class="text-sm font-bold {{ $isNearExpired ? 'text-amber-600' : 'text-slate-700' }}">
                                        {{ \Carbon\Carbon::parse($batch->expired_date)->translatedFormat('d F Y') }}
                                        <span class="text-xs font-normal">({{ round($daysLeft) }} hari lagi)</span>
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-red-50 text-red-700 border border-red-100 p-4 rounded-xl text-sm">
                        ⚠️ Maaf, stok produk ini sedang kosong atau belum terdaftar di gudang.
                    </div>
                @endif
            </div>

            <!-- Action CTA -->
            <div class="pt-6 border-t border-slate-100 flex flex-col sm:flex-row gap-4">
                <a href="{{ route('orders.index', ['product_id' => $product->id]) }}" 
                   class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-6 rounded-xl shadow-md shadow-blue-200 hover:shadow-lg transition">
                    🛒 Buat Pesanan Agen
                </a>
                <a href="https://wa.me/6281234567890?text=Halo%20Sales%20SnackDist,%20saya%20tertarik%20dengan%20produk%20{{ urlencode($product->name) }}" 
                   target="_blank" 
                   class="bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold py-4 px-6 rounded-xl transition flex items-center justify-center gap-2">
                    💬 Chat Sales WA
                </a>
            </div>
        </div>

    </div>

    <!-- Related Products -->
    @if($related_products->count() > 0)
        <div class="mt-20 space-y-8">
            <h2 class="text-2xl font-extrabold text-slate-900">Produk Terkait Lainnya</h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                @foreach($related_products as $rel)
                    <a href="{{ route('public.products.show', $rel->slug) }}" class="bg-white rounded-2xl border border-slate-100 hover:border-blue-100 p-6 shadow-sm hover:shadow-lg transition duration-300 flex items-center gap-4 group">
                        <div class="w-16 h-16 bg-slate-50 rounded-xl flex items-center justify-center text-3xl shrink-0">
                            @if($rel->category && $rel->category->slug == 'makanan-ringan')
                                🍟
                            @elseif($rel->category && $rel->category->slug == 'minuman-segar')
                                ☕
                            @else
                                🍲
                            @endif
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-950 group-hover:text-blue-600 transition text-base">{{ $rel->name }}</h3>
                            <span class="text-sm font-extrabold text-slate-700 block mt-1">Rp {{ number_format($rel->base_price, 0, ',', '.') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
