@extends('layouts.frontend')

@section('title', 'Layanan')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Layanan Distribusi & Supply F&B</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-lg">Solusi rantai pasok makanan dan minuman terpercaya untuk kelancaran rantai operasional bisnis ritel dan kuliner Anda.</p>
    </div>
</section>

<!-- Services Detail -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-20">
        
        <!-- Service 1: Horeca Supply -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <span class="text-xs font-bold text-blue-600 bg-blue-50 px-3 py-1 rounded-full uppercase tracking-wider">Horeca Solution</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Pasokan Rutin Hotel, Restoran & Kafe (Horeca)</h2>
                <p class="text-slate-600 leading-relaxed">
                    Kami menyuplai berbagai kebutuhan bahan baku makanan ringan, minuman siap saji, dan pelengkap pangan untuk hotel berbintang, jaringan restoran waralaba, hingga kafe lokal. Dengan jaminan kontinuitas produk dan pengiriman terjadwal yang presisi.
                </p>
                <ul class="space-y-2.5 text-sm text-slate-600 font-semibold">
                    <li>✅ Kontrak supply tetap dengan harga stabil</li>
                    <li>✅ Kualitas produk bersertifikasi BPOM & Halal</li>
                    <li>✅ Layanan pengiriman terjadwal & fleksibel</li>
                </ul>
            </div>
            <div class="lg:col-span-6 bg-slate-50 border border-slate-100 rounded-3xl p-12 text-center text-8xl shadow-inner select-none">
                🏨🏨
            </div>
        </div>

        <!-- Service 2: Reseller Supply -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center lg:flex-row-reverse">
            <div class="lg:col-span-6 lg:order-2 space-y-6">
                <span class="text-xs font-bold text-amber-600 bg-amber-50 px-3 py-1 rounded-full uppercase tracking-wider">Partnership</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Distribusi Grosir Ritel & Mitra Reseller</h2>
                <p class="text-slate-600 leading-relaxed">
                    Bagi Anda agen grosir maupun pemilik minimarket mandiri, kami menawarkan skema harga bertingkat khusus (bulk order discount). Didukung rotasi stok **FEFO** yang menjamin barang yang sampai ke toko Anda memiliki masa kedaluwarsa panjang.
                </p>
                <ul class="space-y-2.5 text-sm text-slate-600 font-semibold">
                    <li>✅ Diskon grosir bertingkat (makin banyak, makin hemat)</li>
                    <li>✅ Jaminan masa kadaluwarsa terpanjang (metode FEFO)</li>
                    <li>✅ Support marketing toolkit & spanduk kemitraan</li>
                </ul>
            </div>
            <div class="lg:col-span-6 lg:order-1 bg-slate-50 border border-slate-100 rounded-3xl p-12 text-center text-8xl shadow-inner select-none">
                🚚🚚
            </div>
        </div>

        <!-- Service 3: National Shipping -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6 space-y-6">
                <span class="text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full uppercase tracking-wider">Logistics</span>
                <h2 class="text-3xl font-extrabold text-slate-900">Pengiriman Cepat & Ekspedisi Nasional</h2>
                <p class="text-slate-600 leading-relaxed">
                    Didukung armada pergudangan logistik modern dan kemitraan kurir kargo berpendingin (cold chain) terpercaya, kami melayani pengiriman produk F&B ke berbagai kota besar dan pulau di seluruh wilayah Indonesia dengan aman tanpa merusak struktur kemasan pangan.
                </p>
                <ul class="space-y-2.5 text-sm text-slate-600 font-semibold">
                    <li>✅ Tracking status pengiriman kargo real-time</li>
                    <li>✅ Armada logistik berpendingin khusus</li>
                    <li>✅ Garansi ganti rugi 100% jika kemasan rusak di jalan</li>
                </ul>
            </div>
            <div class="lg:col-span-6 bg-slate-50 border border-slate-100 rounded-3xl p-12 text-center text-8xl shadow-inner select-none">
                ✈️🚢
            </div>
        </div>

    </div>
</section>
@endsection
