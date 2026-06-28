<x-app-layout>
    <!-- Slot Header Bawaan Breeze -->
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Produk (Admin)') }}
            </h2>
            <a href="{{ route('products.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow text-sm">
                + Tambah Produk
            </a>
        </div>
    </x-slot>

    <!-- Konten Utama (Otomatis masuk ke variabel $slot di app.blade.php) -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Flash Message -->
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 shadow-sm">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Form Search & Filter -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <form action="{{ route('products.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" placeholder="Cari nama produk..." value="{{ request('search') }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="w-full md:w-1/4">
                        <select name="filter_unit" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Semua Satuan</option>
                            <option value="pcs" {{ request('filter_unit') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="dus" {{ request('filter_unit') == 'dus' ? 'selected' : '' }}>Dus</option>
                            <option value="karton" {{ request('filter_unit') == 'karton' ? 'selected' : '' }}>Karton</option>
                        </select>
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded shadow">Cari</button>
                        <a href="{{ route('products.index') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded shadow flex items-center justify-center">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Tabel Data Responsif -->
            <div class="bg-white shadow overflow-x-auto sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Dasar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Satuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($products as $product)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $products->firstItem() + $loop->index }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $product->name }}<br>
                                <span class="text-xs text-gray-400">Slug: {{ $product->slug }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $product->category->name ?? 'Tanpa Kategori' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($product->base_price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($product->unit) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                <a href="{{ route('products.edit', $product->id) }}" class="text-yellow-700 bg-yellow-100 hover:bg-yellow-200 px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-700 bg-red-100 hover:bg-red-200 px-3 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Data produk tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $products->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
