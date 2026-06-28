@extends('layouts.frontend')

@section('title', 'Kategori ' . $category->name)

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <span class="text-xs font-bold text-blue-400 bg-blue-500/10 px-3 py-1 rounded-full uppercase tracking-wider">Kategori F&B</span>
        <h1 class="text-4xl font-extrabold tracking-tight">{{ $category->name }}</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base">Menampilkan seluruh pasokan produk premium dalam kategori {{ strtolower($category->name) }}.</p>
    </div>
</section>

<!-- Katalog Main Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Sidebar Filter (Desktop) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-6">
                <div>
                    <h3 class="text-slate-900 font-bold text-base mb-3">Semua Kategori</h3>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('public.products.index') }}" 
                            class="text-sm px-3 py-2 rounded-lg transition text-slate-600 hover:bg-slate-50">
                            Semua Kategori
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('public.categories.show', $cat->slug) }}"
                                class="text-sm px-3 py-2 rounded-lg transition {{ $category->id == $cat->id ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Grid (Right side) -->
        <div class="lg:col-span-3 space-y-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $prod)
                    <div class="bg-white rounded-2xl border border-slate-100 hover:border-blue-100 shadow-sm hover:shadow-lg transition duration-300 overflow-hidden flex flex-col group justify-between">
                        <div class="h-44 bg-slate-50 flex items-center justify-center text-4xl text-slate-400">
                            @if($category->slug == 'makanan-ringan')
                                🍟
                            @elseif($category->slug == 'minuman-segar')
                                ☕
                            @else
                                🍲
                            @endif
                        </div>
                        <div class="p-6 space-y-4 flex-grow flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md">{{ $category->name }}</span>
                                <h3 class="text-lg font-bold text-slate-900 mt-3 group-hover:text-blue-600 transition">{{ $prod->name }}</h3>
                            </div>
                            <div class="flex justify-between items-end pt-4 border-t border-slate-100">
                                <div>
                                    <span class="text-[10px] text-slate-400 block uppercase font-bold tracking-wider">Harga per {{ $prod->unit }}</span>
                                    <span class="text-lg font-extrabold text-slate-900">Rp {{ number_format($prod->base_price, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('public.products.show', $prod->slug) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-xl text-xs transition">
                                    Detail &rarr;
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-16 text-center text-slate-400 space-y-4">
                        <span class="text-6xl">📭</span>
                        <p class="text-lg font-medium">Produk belum tersedia di kategori ini.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div>
                {{ $products->links() }}
            </div>
        </div>

    </div>
</div>
@endsection
