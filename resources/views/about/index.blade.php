@extends('layouts.frontend')

@section('title', 'Tentang Kami')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Profil Perusahaan SnackDist</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-lg">Berdedikasi menjadi jembatan rantai pasok makanan dan minuman bersertifikasi mutu unggul di Indonesia.</p>
    </div>
</section>

<!-- Company Profile Content -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-16">
        
        <!-- Story / History -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-7 space-y-6">
                <h2 class="text-3xl font-extrabold text-slate-900">Sejarah & Dedikasi Kami</h2>
                <p class="text-slate-600 leading-relaxed">
                    Didirikan pada tahun 2020, **SnackDist** bermula dari komitmen sederhana untuk mendistribusikan jajanan kering berkualitas ke warung ritel lokal. Seiring pertumbuhan industri F&B nasional, kini kami mengelola jaringan gudang modern terintegrasi yang dipercaya mensuplai ratusan swalayan, kafe, dan ritel modern di seluruh wilayah Jawa dan Sumatera.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Dengan implementasi manajemen pergudangan otomatis berbasis **FEFO**, kami menjamin setiap mitra mendapatkan pengiriman produk pangan dengan masa kedaluwarsa optimal, sehingga menekan potensi kerugian retur produk kadaluwarsa hingga mendekati 0%.
                </p>
            </div>
            <div class="lg:col-span-5 bg-slate-50 border border-slate-100 rounded-3xl p-12 text-center text-[120px] shadow-inner select-none">
                🏢✨
            </div>
        </div>

        <!-- Vision and Mission -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-slate-100">
            <div class="bg-slate-50 border border-slate-100 p-8 rounded-2xl space-y-4 hover:border-blue-100 transition">
                <span class="text-3xl">👁️</span>
                <h3 class="text-xl font-bold text-slate-950">Visi Kami</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Menjadi jaringan pergudangan logistik dan distributor produk pangan F&B terbesar, teraman, dan terdepan di Indonesia melalui integrasi teknologi pergudangan cerdas.
                </p>
            </div>
            <div class="bg-slate-50 border border-slate-100 p-8 rounded-2xl space-y-4 hover:border-indigo-100 transition">
                <span class="text-3xl">🎯</span>
                <h3 class="text-xl font-bold text-slate-950">Misi Kami</h3>
                <p class="text-sm text-slate-600 leading-relaxed">
                    Menjamin ketersediaan supply pangan segar bermutu tinggi, menerapkan standar rotasi keamanan pangan FEFO secara ketat, serta memberikan layanan kemitraan logistik yang efisien dan responsif bagi semua pelaku UMKM ritel dan korporat.
                </p>
            </div>
        </div>

        <!-- Infrastructure & Warehouse Info -->
        <div class="pt-8 border-t border-slate-100 text-center space-y-12">
            <div class="max-w-2xl mx-auto space-y-4">
                <h2 class="text-3xl font-extrabold text-slate-900">Infrastruktur & Gudang Logistik</h2>
                <p class="text-slate-500">Kapasitas penyimpanan modern berpendingin dan kontrol sanitasi ketat untuk menjamin produk pangan terjaga kebersihannya.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-3 shadow-sm hover:shadow-md transition">
                    <span class="text-4xl block">🌡️</span>
                    <h4 class="font-bold text-slate-900">Suhu Terkontrol</h4>
                    <p class="text-xs text-slate-500">Gudang penyimpanan dilengkapi dengan pendingin AC konstan untuk menjaga kualitas cokelat, susu, dan produk minuman rentan panas.</p>
                </div>
                <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-3 shadow-sm hover:shadow-md transition">
                    <span class="text-4xl block">🧹</span>
                    <h4 class="font-bold text-slate-900">Sanitasi & Higenitas</h4>
                    <p class="text-xs text-slate-500">Pemberbersihan area pallet gudang secara rutin setiap hari untuk menjamin kebersihan dan bebas dari hama serangga.</p>
                </div>
                <div class="bg-white border border-slate-100 rounded-2xl p-6 space-y-3 shadow-sm hover:shadow-md transition">
                    <span class="text-4xl block">⚡</span>
                    <h4 class="font-bold text-slate-900">Sistem Cadangan Energi</h4>
                    <p class="text-xs text-slate-500">Genset otomatis darurat untuk mencegah gangguan kestabilan suhu AC penyimpanan ketika terjadi pemadaman listrik kota.</p>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
