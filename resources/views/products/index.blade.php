@extends('layouts.frontend')

@section('title', 'Katalog Produk')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Katalog Produk Snack & Minuman</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-lg">Cari dan temukan pasokan makanan ringan serta minuman bersertifikasi higienis untuk kebutuhan ritel maupun bisnis kuliner Anda.</p>
    </div>
</section>

<!-- Katalog Main Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        <!-- Sidebar Filter (Desktop) -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-6">
                <div>
                    <h3 class="text-slate-900 font-bold text-base mb-3">Pencarian</h3>
                    <form action="{{ route('public.products.index') }}" method="GET" class="relative">
                        @if(request('category'))
                            <input type="hidden" name="category" value="{{ request('category') }}">
                        @endif
                        @if(request('unit'))
                            <input type="hidden" name="unit" value="{{ request('unit') }}">
                        @endif
                        <input type="text" name="search" placeholder="Cari nama produk..." value="{{ request('search') }}"
                            class="w-full border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                        <button type="submit" class="absolute right-3 top-2.5 text-slate-400 hover:text-blue-600">🔍</button>
                    </form>
                </div>

                <div>
                    <h3 class="text-slate-900 font-bold text-base mb-3">Kategori</h3>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('public.products.index', request()->except('category')) }}" 
                            class="text-sm px-3 py-2 rounded-lg transition {{ !request('category') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                            Semua Kategori
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('public.products.index', array_merge(request()->all(), ['category' => $cat->slug])) }}"
                                class="text-sm px-3 py-2 rounded-lg transition {{ request('category') == $cat->slug ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                                {{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <h3 class="text-slate-900 font-bold text-base mb-3">Satuan Kemasan</h3>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('public.products.index', request()->except('unit')) }}"
                            class="text-sm px-3 py-2 rounded-lg transition {{ !request('unit') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                            Semua Satuan
                        </a>
                        <a href="{{ route('public.products.index', array_merge(request()->all(), ['unit' => 'pcs'])) }}"
                            class="text-sm px-3 py-2 rounded-lg transition {{ request('unit') == 'pcs' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                            Pcs
                        </a>
                        <a href="{{ route('public.products.index', array_merge(request()->all(), ['unit' => 'dus'])) }}"
                            class="text-sm px-3 py-2 rounded-lg transition {{ request('unit') == 'dus' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                            Dus
                        </a>
                        <a href="{{ route('public.products.index', array_merge(request()->all(), ['unit' => 'karton'])) }}"
                            class="text-sm px-3 py-2 rounded-lg transition {{ request('unit') == 'karton' ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}">
                            Karton
                        </a>
                    </div>
                </div>

                @if(request()->anyFilled(['search', 'category', 'unit']))
                    <a href="{{ route('public.products.index') }}" class="block text-center text-xs font-bold text-red-500 hover:underline pt-2">
                        Reset Semua Filter
                    </a>
                @endif
            </div>
        </div>

        <!-- Product Grid (Right side) -->
        <div class="lg:col-span-3 space-y-8">
            <!-- Search status or metadata -->
            @if(request()->anyFilled(['search', 'category', 'unit']))
                <div class="bg-slate-100 px-4 py-2.5 rounded-xl text-xs font-medium text-slate-600 flex items-center justify-between">
                    <span>
                        Hasil filter untuk: 
                        @if(request('search')) "<strong>{{ request('search') }}</strong>" @endif
                        @if(request('category')) Kategori "<strong>{{ request('category') }}</strong>" @endif
                        @if(request('unit')) Satuan "<strong>{{ request('unit') }}</strong>" @endif
                    </span>
                    <a href="{{ route('public.products.index') }}" class="text-blue-600 hover:underline">Hapus filter</a>
                </div>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($products as $prod)
                    <div class="bg-white rounded-2xl border border-slate-100 hover:border-blue-100 shadow-sm hover:shadow-lg transition duration-300 overflow-hidden flex flex-col group justify-between">
                        <div class="h-44 bg-slate-50 flex items-center justify-center text-4xl text-slate-400">
                            @if($prod->category && $prod->category->slug == 'makanan-ringan')
                                🍟
                            @elseif($prod->category && $prod->category->slug == 'minuman-segar')
                                ☕
                            @else
                                🍲
                            @endif
                        </div>
                        <div class="p-6 space-y-4 flex-grow flex flex-col justify-between">
                            <div>
                                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-2.5 py-1 rounded-md">{{ $prod->category->name ?? 'F&B' }}</span>
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
                        <p class="text-lg font-medium">Produk tidak ditemukan atau belum tersedia.</p>
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