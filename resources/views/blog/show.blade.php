@extends('layouts.frontend')

@section('title', $post->title)

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <!-- Back to blog link -->
    <div class="mb-8">
        <a href="{{ route('public.blog.index') }}" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-blue-600 transition">
            &larr; Kembali ke Blog
        </a>
    </div>

    <!-- Article layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        <!-- Main Content -->
        <article class="lg:col-span-8 bg-white border border-slate-100 p-8 sm:p-12 rounded-3xl shadow-sm space-y-6">
            <header class="space-y-4">
                <span class="text-xs font-semibold text-slate-400 block">Diterbitkan pada {{ $post->created_at->translatedFormat('d F Y') }}</span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 leading-tight tracking-tight">{{ $post->title }}</h1>
            </header>

            <div class="h-64 bg-slate-50 rounded-2xl flex items-center justify-center text-6xl shadow-inner select-none">
                📖
            </div>

            <div class="prose max-w-none text-slate-650 leading-relaxed text-base space-y-4 pt-4 border-t border-slate-100">
                <p>{{ $post->content }}</p>
                <p>Distribusi produk pangan dari pabrikan ke pedagang eceran memerlukan pemahaman mendalam tentang siklus logistik. SnackDist terus berkomitmen mengedukasi mitra untuk bersama-sama membangun ekosistem distribusi yang terpercaya dan bebas dari kerugian barang kedaluwarsa.</p>
            </div>
        </article>

        <!-- Sidebar (Recent Posts) -->
        <aside class="lg:col-span-4 space-y-6">
            <div class="bg-white border border-slate-100 p-6 rounded-2xl shadow-sm space-y-4">
                <h3 class="font-bold text-slate-900 text-base">Artikel Terbaru Lainnya</h3>
                
                <div class="space-y-4">
                    @forelse($recent_posts as $recent)
                        <a href="{{ route('public.blog.show', $recent->slug) }}" class="block group space-y-1">
                            <span class="text-[10px] text-slate-450">{{ $recent->created_at->translatedFormat('d M Y') }}</span>
                            <h4 class="font-bold text-sm text-slate-800 group-hover:text-blue-600 transition leading-snug line-clamp-2">{{ $recent->title }}</h4>
                        </a>
                    @empty
                        <p class="text-xs text-slate-400">Tidak ada artikel lain.</p>
                    @endforelse
                </div>
            </div>
        </aside>
    </div>
</div>
@endsection
