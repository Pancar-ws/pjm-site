@extends('layouts.frontend')

@section('title', 'Mitra Partner')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Kemitraan Jaringan Ritel & Client</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-lg">Kami bangga bekerja sama dengan beberapa jaringan retail dan supermarket terbesar di Indonesia untuk mengantarkan kelezatan ke masyarakat.</p>
    </div>
</section>

<!-- Partners Galery -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        <div class="max-w-3xl mx-auto text-center space-y-4">
            <h2 class="text-3xl font-extrabold text-slate-900">Mitra Kerja Sama Kami</h2>
            <p class="text-slate-500">Mulai dari swalayan berskala nasional hingga gerai warung ritel lokal, kami terus memperkuat keandalan supply produk pangan terpercaya.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($partners as $partner)
                <div class="bg-slate-50 border border-slate-100 hover:border-blue-100 hover:bg-blue-50/10 rounded-2xl p-8 flex flex-col items-center justify-center text-center space-y-4 hover:shadow-lg hover:shadow-slate-100 transition duration-300">
                    <span class="text-5xl">🏢</span>
                    <div>
                        <h3 class="font-bold text-lg text-slate-900">{{ $partner->name }}</h3>
                        <span class="text-xs font-semibold text-slate-400">Merchant Partner</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
