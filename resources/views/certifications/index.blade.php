@extends('layouts.frontend')

@section('title', 'Sertifikasi Keamanan Pangan')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Sertifikasi & Kepatuhan Mutu</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-lg">Kepatuhan regulasi pangan adalah prioritas kami. Semua produk dan pergudangan kami telah terakreditasi oleh lembaga audit mutu pangan nasional.</p>
    </div>
</section>

<!-- Certifications list -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        <div class="max-w-3xl mx-auto text-center space-y-4">
            <h2 class="text-3xl font-extrabold text-slate-900">Jaminan Mutu Standardisasi Nasional</h2>
            <p class="text-slate-500">Kami menjamin seluruh jajanan snack dan minuman yang kami distribusikan diproses secara higienis, halal, dan aman dikonsumsi masyarakat.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($certifications as $cert)
                <div class="border border-slate-100 bg-slate-50/50 hover:bg-white rounded-3xl p-8 hover:shadow-xl hover:shadow-slate-100 transition duration-300 flex items-start gap-6 group hover:border-amber-200">
                    <div class="w-16 h-16 bg-amber-50 group-hover:bg-amber-500 text-amber-500 group-hover:text-white rounded-2xl flex items-center justify-center text-3xl transition duration-300 shrink-0 shadow-inner">
                        🛡️
                    </div>
                    <div class="space-y-2">
                        <h3 class="font-bold text-lg text-slate-950">{{ $cert->name }}</h3>
                        <p class="text-xs text-slate-550 leading-relaxed">
                            Standar kepatuhan resmi yang terdaftar dan diuji berkala untuk memastikan keamanan produk pangan dari risiko cemaran fisik, kimia, maupun biologi.
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
