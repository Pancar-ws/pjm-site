<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SnackDist - Sistem Manajemen Inventory</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Memuat Tailwind CSS melalui Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 text-gray-900 font-sans">

    <!-- Navbar / Header Auth -->
    <div class="relative w-full max-w-7xl mx-auto px-6 py-4 flex justify-between items-center sm:px-8">
        <div class="flex items-center gap-2">
            <!-- Logo Sederhana -->
            <div class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center font-bold text-xl shadow-lg">
                SD
            </div>
            <span class="font-bold text-xl tracking-tight text-gray-800">SnackDist</span>
        </div>

        <!-- Menu Login/Register bawaan Breeze -->
        @if (Route::has('login'))
            <div class="flex gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-blue-600 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-blue-600 transition">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="font-semibold text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md shadow transition">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <!-- Hero Section -->
    <main class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col items-center justify-center text-center mt-16 sm:mt-24">
        <h1 class="text-4xl sm:text-6xl font-extrabold text-gray-900 tracking-tight mb-6">
            Sistem Distribusi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-cyan-500">Snack & Minuman</span>
        </h1>
        <p class="mt-4 text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto mb-10">
            Kelola inventory gudang, pantau kedaluwarsa produk dengan sistem FEFO (First Expired First Out), dan proses pesanan agen retail secara otomatis dengan mudah.
        </p>

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg text-lg transition transform hover:-translate-y-1">
                    Masuk ke Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-full shadow-lg text-lg transition transform hover:-translate-y-1">
                    Mulai Sekarang
                </a>
            @endauth
        @endif
    </main>

    <!-- Fitur Section (Grid Responsif) -->
    <div class="max-w-7xl mx-auto px-6 lg:px-8 mt-24 mb-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            
            <!-- Fitur 1 -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    📦
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Manajemen FEFO</h3>
                <p class="text-gray-600 text-sm">
                    Sistem otomatis memprioritaskan pengeluaran stok berdasarkan tanggal kedaluwarsa paling dekat untuk meminimalisir kerugian produk basi.
                </p>
            </div>

            <!-- Fitur 2 -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    💰
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Diskon Grosir Dinamis</h3>
                <p class="text-gray-600 text-sm">
                    Kalkulasi diskon bertingkat secara otomatis saat agen melakukan pemesanan dalam partai besar (bulk order).
                </p>
            </div>

            <!-- Fitur 3 -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-full flex items-center justify-center mx-auto mb-4 text-2xl">
                    🚚
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Tracking Distribusi</h3>
                <p class="text-gray-600 text-sm">
                    Pantau alur kerja (workflow) pesanan agen secara real-time, mulai dari status pending, diproses, dikirim, hingga selesai.
                </p>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-8 text-gray-500 text-sm border-t border-gray-200 mt-auto">
        &copy; {{ date('Y') }} Sistem Manajemen Inventory SnackDist. Dibuat untuk Ujian CPMK-02 Pemrograman Web II.
    </footer>

</body>
</html>