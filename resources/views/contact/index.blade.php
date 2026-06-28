@extends('layouts.frontend')

@section('title', 'Hubungi Kami')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Hubungi Sales & Support Kami</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-lg">Punya pertanyaan seputar ketersediaan produk, kemitraan ritel, atau butuh bantuan order? Hubungi tim responsif kami sekarang.</p>
    </div>
</section>

<!-- Contact Form and Details -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Contact Form -->
        <div class="lg:col-span-7 bg-white border border-slate-100 p-8 sm:p-12 rounded-3xl shadow-sm space-y-6">
            <h2 class="text-2xl font-bold text-slate-900">Kirimkan Pesan Anda</h2>
            <p class="text-slate-500 text-sm">Gunakan formulir di bawah ini untuk mengirim email langsung ke sales administrator kami.</p>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('public.contact.submit') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-slate-700 text-xs font-bold mb-1.5 uppercase tracking-wider">Nama Lengkap</label>
                        <input type="text" name="name" required value="{{ old('name') }}"
                            class="w-full border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                    <div>
                        <label class="block text-slate-700 text-xs font-bold mb-1.5 uppercase tracking-wider">Alamat Email</label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                            class="w-full border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-slate-700 text-xs font-bold mb-1.5 uppercase tracking-wider">Subjek Pesan</label>
                    <input type="text" name="subject" required value="{{ old('subject') }}"
                        class="w-full border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                </div>

                <div>
                    <label class="block text-slate-700 text-xs font-bold mb-1.5 uppercase tracking-wider">Isi Pesan / Kebutuhan</label>
                    <textarea name="message" rows="5" required
                        class="w-full border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm"></textarea>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 rounded-xl shadow-md transition">
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>

        <!-- Contact Info & Map Mock -->
        <div class="lg:col-span-5 space-y-6">
            <!-- Details -->
            <div class="bg-white border border-slate-100 p-8 rounded-3xl shadow-sm space-y-6">
                <h3 class="font-bold text-slate-900 text-lg">Informasi Kontak Kantor</h3>
                <div class="space-y-4 text-sm text-slate-600">
                    <div class="flex items-start gap-3">
                        <span class="text-xl">📍</span>
                        <p><strong>Alamat Gudang Utama:</strong><br>Pergudangan Bizpark, Blok C-12, Raya Cakung, Jakarta Timur, DKI Jakarta</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-xl">📞</span>
                        <p><strong>Telepon Sales:</strong><br>+62 812-3456-7890 (Ritel)<br>+62 811-9876-5432 (Horeca)</p>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-xl">✉️</span>
                        <p><strong>Email Bisnis:</strong><br>info@snackdist.com<br>sales@snackdist.com</p>
                    </div>
                </div>
            </div>

            <!-- Map Mock -->
            <div class="bg-slate-200 border border-slate-300 rounded-3xl h-60 flex flex-col items-center justify-center text-center p-6 shadow-inner select-none">
                <span class="text-4xl mb-2">🗺️</span>
                <span class="font-bold text-slate-800 text-sm">Peta Interaktif Gudang SnackDist</span>
                <span class="text-[10px] text-slate-500 mt-1">Jakarta Timur, Indonesia</span>
            </div>
        </div>

    </div>
</div>
@endsection
