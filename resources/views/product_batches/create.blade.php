<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Batch Stok Masuk') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                
                <form action="{{ route('product-batches.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Produk</label>
                        <select name="product_id" class="shadow-sm appearance-none border @error('product_id') border-red-500 @else border-gray-300 @enderror rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-blue-500">
                            <option value="">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                                    {{ $product->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('product_id')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nomor Batch</label>
                        <input type="text" name="batch_number" value="{{ old('batch_number') }}" placeholder="Contoh: BATCH-001"
                            class="shadow-sm appearance-none border @error('batch_number') border-red-500 @else border-gray-300 @enderror rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-blue-500">
                        @error('batch_number')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah Kuantitas (Qty)</label>
                        <input type="number" name="qty" value="{{ old('qty') }}" 
                            class="shadow-sm appearance-none border @error('qty') border-red-500 @else border-gray-300 @enderror rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-blue-500">
                        @error('qty')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Kedaluwarsa (Expired Date)</label>
                        <input type="date" name="expired_date" value="{{ old('expired_date') }}" 
                            class="shadow-sm appearance-none border @error('expired_date') border-red-500 @else border-gray-300 @enderror rounded w-full py-2 px-3 text-gray-700 focus:outline-none focus:ring-blue-500">
                        @error('expired_date')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 mt-8">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow">
                            Simpan Stok
                        </button>
                        <a href="{{ route('product-batches.index') }}" class="font-semibold text-sm text-gray-600 hover:text-gray-900">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>