<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Manajemen Pergudangan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Alert -->
            <div class="bg-blue-50 border border-blue-200 text-blue-800 p-6 rounded-2xl shadow-sm">
                <h3 class="font-bold text-lg">Selamat Datang di Sistem Internal SnackDist!</h3>
                <p class="text-sm mt-1">Anda masuk sebagai <strong>{{ Auth::user()->name }}</strong> (Role: {{ ucfirst(Auth::user()->role) }}). Gunakan modul di bawah untuk mengelola inventori produk dan melacak rotasi batch stok FEFO.</p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Stat 1 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                        👥
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 block font-bold uppercase tracking-wider">Total User</span>
                        <span class="text-2xl font-extrabold text-gray-900">{{ $stats['users_count'] }}</span>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                        🍟
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 block font-bold uppercase tracking-wider">Total Produk</span>
                        <span class="text-2xl font-extrabold text-gray-900">{{ $stats['products_count'] }}</span>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                        📦
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 block font-bold uppercase tracking-wider">Total Batch</span>
                        <span class="text-2xl font-extrabold text-gray-900">{{ $stats['batches_count'] }}</span>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center text-2xl shadow-inner">
                        📊
                    </div>
                    <div>
                        <span class="text-xs text-gray-400 block font-bold uppercase tracking-wider">Total Qty Stok</span>
                        <span class="text-2xl font-extrabold text-gray-900">{{ number_format($stats['total_qty'], 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Recent Batches Table -->
                <div class="lg:col-span-8 bg-white border border-gray-100 rounded-2xl shadow-sm p-6 space-y-4">
                    <h3 class="font-bold text-lg text-gray-900">📦 Batch Stok Terbaru Ditambahkan</h3>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100 text-sm">
                            <thead class="bg-gray-50 text-gray-500">
                                <tr>
                                    <th class="px-4 py-3 text-left font-bold uppercase text-xs">Nomor Batch</th>
                                    <th class="px-4 py-3 text-left font-bold uppercase text-xs">Produk</th>
                                    <th class="px-4 py-3 text-left font-bold uppercase text-xs">Kuantitas</th>
                                    <th class="px-4 py-3 text-left font-bold uppercase text-xs">Kedaluwarsa</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 text-gray-600">
                                @forelse($recent_batches as $batch)
                                    <tr>
                                        <td class="px-4 py-4 whitespace-nowrap font-bold text-slate-800">{{ $batch->batch_number }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap font-medium">{{ $batch->product->name ?? 'Produk Dihapus' }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap font-semibold">{{ $batch->qty }} {{ $batch->product->unit ?? '' }}</td>
                                        <td class="px-4 py-4 whitespace-nowrap text-xs">
                                            {{ \Carbon\Carbon::parse($batch->expired_date)->translatedFormat('d M Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-8 text-center text-gray-400">Belum ada batch stok terdaftar.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Fast Shortcuts -->
                <div class="lg:col-span-4 bg-white border border-gray-100 rounded-2xl shadow-sm p-6 space-y-4">
                    <h3 class="font-bold text-lg text-gray-900">⚡ Pintasan Cepat</h3>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('products.index') }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition text-sm">
                            Manajemen Produk
                        </a>
                        <a href="{{ route('product-batches.index') }}" class="block text-center bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 rounded-xl transition text-sm">
                            Manajemen Batch Stok
                        </a>
                        <a href="/" class="block text-center border border-gray-200 hover:bg-gray-50 text-gray-700 font-bold py-3 rounded-xl transition text-sm">
                            Kembali ke Halaman Publik
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
