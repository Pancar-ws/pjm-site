@extends('layouts.frontend')

@section('title', 'Blog & Artikel')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Blog Edukasi & Berita F&B</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-lg">Dapatkan wawasan seputar dunia distribusi pangan, tips pergudangan retail, dan tren kuliner masa kini.</p>
    </div>
</section>

<!-- Blog Posts Grid -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($posts as $post)
            <div class="bg-white border border-slate-100 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition duration-300 flex flex-col justify-between group">
                <div class="h-48 bg-slate-100 flex items-center justify-center text-5xl select-none group-hover:scale-102 transition duration-300">
                    📝
                </div>
                <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
                    <div class="space-y-2">
                        <span class="text-xs text-slate-400 block">{{ $post->created_at->translatedFormat('d M Y') }}</span>
                        <h3 class="text-lg font-bold text-slate-950 group-hover:text-blue-600 transition">{{ $post->title }}</h3>
                        <p class="text-xs text-slate-500 line-clamp-3 leading-relaxed">{{ $post->content }}</p>
                    </div>
                    <div class="pt-4 border-t border-slate-100">
                        <a href="{{ route('public.blog.show', $post->slug) }}" class="text-xs font-bold text-blue-600 hover:text-blue-700 transition flex items-center gap-1">
                            Baca Selengkapnya &rarr;
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-16 text-center text-slate-400 space-y-4">
                <span class="text-6xl">📭</span>
                <p class="text-lg font-medium">Belum ada artikel blog yang diterbitkan.</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $posts->links() }}
    </div>
</div>
@endsection
