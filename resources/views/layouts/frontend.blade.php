<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'SnackDist') - Distributor Snack & Minuman Premium</title>

    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Memuat Tailwind CSS melalui Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 antialiased flex flex-col min-h-screen">

    <!-- Header / Navbar Publik -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/90 border-b border-slate-100 shadow-sm transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 bg-gradient-to-tr from-blue-600 to-indigo-600 text-white rounded-xl flex items-center justify-center font-bold text-xl shadow-md transition group-hover:scale-105">
                            SD
                        </div>
                        <span class="font-extrabold text-2xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 to-slate-700">SnackDist</span>
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}" class="font-medium text-slate-600 hover:text-blue-600 transition {{ request()->routeIs('home') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : '' }}">Home</a>
                    <a href="{{ route('public.products.index') }}" class="font-medium text-slate-600 hover:text-blue-600 transition {{ request()->routeIs('public.products.*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : '' }}">Produk</a>
                    <a href="{{ route('public.services') }}" class="font-medium text-slate-600 hover:text-blue-600 transition {{ request()->routeIs('public.services') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : '' }}">Layanan</a>
                    <a href="{{ route('public.about') }}" class="font-medium text-slate-600 hover:text-blue-600 transition {{ request()->routeIs('public.about') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : '' }}">Tentang Kami</a>
                    <a href="{{ route('public.blog.index') }}" class="font-medium text-slate-600 hover:text-blue-600 transition {{ request()->routeIs('public.blog.*') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : '' }}">Blog</a>
                    <a href="{{ route('public.partners') }}" class="font-medium text-slate-600 hover:text-blue-600 transition {{ request()->routeIs('public.partners') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : '' }}">Partner</a>
                    <a href="{{ route('public.certifications') }}" class="font-medium text-slate-600 hover:text-blue-600 transition {{ request()->routeIs('public.certifications') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : '' }}">Sertifikasi</a>
                    <a href="{{ route('public.contact') }}" class="font-medium text-slate-600 hover:text-blue-600 transition {{ request()->routeIs('public.contact') ? 'text-blue-600 font-semibold border-b-2 border-blue-600' : '' }}">Kontak</a>
                </nav>

                <!-- Auth / Order Buttons (Desktop) -->
                <div class="hidden md:flex items-center gap-4">
                    @auth
                        <a href="{{ route('orders.index') }}" class="font-semibold text-slate-600 hover:text-blue-600 transition">Pemesanan</a>
                        <a href="{{ route('dashboard') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-800 px-4 py-2 rounded-xl text-sm font-semibold transition">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition shadow-sm">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-slate-600 hover:text-blue-600 transition">Log in</a>
                        <a href="{{ route('orders.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-sm font-semibold shadow-md shadow-blue-200 hover:shadow-lg transition">Mulai Pemesanan</a>
                    @endauth
                </div>

                <!-- Hamburger Button (Mobile) -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-slate-600 hover:text-slate-900 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobile-menu" class="hidden md:hidden border-t border-slate-100 bg-white">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600">Home</a>
                <a href="{{ route('public.products.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600">Produk</a>
                <a href="{{ route('public.services') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600">Layanan</a>
                <a href="{{ route('public.about') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600">Tentang Kami</a>
                <a href="{{ route('public.blog.index') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600">Blog</a>
                <a href="{{ route('public.partners') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600">Partner</a>
                <a href="{{ route('public.certifications') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600">Sertifikasi</a>
                <a href="{{ route('public.contact') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:bg-slate-50 hover:text-blue-600">Kontak</a>
                
                <div class="border-t border-slate-100 pt-4 pb-2 px-3 flex flex-col gap-2">
                    @auth
                        <a href="{{ route('orders.index') }}" class="block text-center bg-blue-600 text-white px-4 py-2 rounded-xl text-base font-medium">Pemesanan</a>
                        <a href="{{ route('dashboard') }}" class="block text-center bg-slate-100 text-slate-800 px-4 py-2 rounded-xl text-base font-medium">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-center bg-red-500 text-white px-4 py-2 rounded-xl text-base font-medium">Log Out</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block text-center bg-slate-100 text-slate-800 px-4 py-2 rounded-xl text-base font-medium">Log in</a>
                        <a href="{{ route('orders.index') }}" class="block text-center bg-blue-600 text-white px-4 py-2 rounded-xl text-base font-medium">Mulai Pemesanan</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Column 1: Brand -->
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-lg">
                            SD
                        </div>
                        <span class="font-extrabold text-xl tracking-tight text-white">SnackDist</span>
                    </div>
                    <p class="text-sm leading-relaxed">
                        Distributor resmi makanan ringan dan minuman berkualitas premium. Menjamin supply cepat, aman, dan berstandar keamanan pangan nasional.
                    </p>
                </div>
                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="text-white font-bold text-base mb-4">Sitemap</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('public.products.index') }}" class="hover:text-white transition">Daftar Produk</a></li>
                        <li><a href="{{ route('public.services') }}" class="hover:text-white transition">Layanan Distribusi</a></li>
                        <li><a href="{{ route('public.about') }}" class="hover:text-white transition">Profil Kami</a></li>
                        <li><a href="{{ route('public.blog.index') }}" class="hover:text-white transition">Artikel Blog</a></li>
                    </ul>
                </div>
                <!-- Column 3: Contact Info -->
                <div>
                    <h4 class="text-white font-bold text-base mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm">
                        <li>📍 Pergudangan Bizpark, Blok C-12, Jakarta</li>
                        <li>📞 +62 812-3456-7890</li>
                        <li>✉️ info@snackdist.com</li>
                        <li>🕒 Senin - Sabtu: 08.00 - 17.00</li>
                    </ul>
                </div>
                <!-- Column 4: Newsletter/WhatsApp -->
                <div class="space-y-4">
                    <h4 class="text-white font-bold text-base mb-4">Ingin Menjadi Agen?</h4>
                    <p class="text-sm">Hubungi sales eksekutif kami untuk mendapatkan katalog harga grosir khusus daerah Anda.</p>
                    <a href="https://wa.me/6281234567890" target="_blank" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-xl text-sm font-bold shadow transition">
                        💬 Hubungi WhatsApp Sales
                    </a>
                </div>
            </div>
            <div class="border-t border-slate-800 mt-12 pt-8 text-center text-xs space-y-2">
                <p>&copy; {{ date('Y') }} Sistem Manajemen Inventory SnackDist. Semua hak dilindungi.</p>
                <p class="text-slate-600">Dibuat untuk Ujian CPMK-02 Pemrograman Web II.</p>
            </div>
        </div>
    </footer>

    <!-- Script Menu Mobile -->
    <script>
        const btn = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
