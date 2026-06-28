<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Batch Stok Masuk') }}
            </h2>
            <a href="{{ route('product-batches.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow text-sm">
                + Tambah Stok
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 shadow-sm">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Form Pencarian -->
            <div class="bg-white p-4 rounded-lg shadow mb-6">
                <form action="{{ route('product-batches.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" placeholder="Cari no batch atau nama produk..." value="{{ request('search') }}" 
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded shadow">Cari</button>
                        <a href="{{ route('product-batches.index') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded shadow flex items-center justify-center">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Tabel Data -->
            <div class="bg-white shadow overflow-x-auto sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No Batch</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Qty</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Expired Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status Kelayakan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($batches as $batch)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $batch->batch_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $batch->product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $batch->qty }} {{ $batch->product->unit }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ \Carbon\Carbon::parse($batch->expired_date)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $expDate = \Carbon\Carbon::parse($batch->expired_date);
                                    $isExpired = $expDate->isPast();
                                    $isWarning = !$isExpired && $expDate->diffInDays(\Carbon\Carbon::now()) <= 30;
                                @endphp

                                @if($isExpired)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Kedaluwarsa</span>
                                @elseif($isWarning)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Hampir Expired</span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Aman</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium flex gap-2">
                                <a href="{{ route('product-batches.edit', $batch->id) }}" class="text-yellow-700 bg-yellow-100 hover:bg-yellow-200 px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('product-batches.destroy', $batch->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus batch ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-700 bg-red-100 hover:bg-red-200 px-3 py-1 rounded">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">Data batch tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $batches->links() }}
            </div>

        </div>
    </div>
</x-app-layout>