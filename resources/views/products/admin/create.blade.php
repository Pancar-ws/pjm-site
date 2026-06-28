<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Produk Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow sm:rounded-lg p-6">
                
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="shadow-sm appearance-none border @error('name') border-red-500 @else border-gray-300 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Slug (Opsional, otomatis dari nama jika kosong)</label>
                        <input type="text" name="slug" value="{{ old('slug') }}" 
                            class="shadow-sm appearance-none border @error('slug') border-red-500 @else border-gray-300 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('slug')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
                        <select name="category_id" class="shadow-sm appearance-none border @error('category_id') border-red-500 @else border-gray-300 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Kategori...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Harga Dasar (Rp)</label>
                        <input type="number" name="base_price" value="{{ old('base_price') }}" required
                            class="shadow-sm appearance-none border @error('base_price') border-red-500 @else border-gray-300 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        @error('base_price')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Satuan</label>
                        <select name="unit" required class="shadow-sm appearance-none border @error('unit') border-red-500 @else border-gray-300 @enderror rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Pilih Satuan...</option>
                            <option value="pcs" {{ old('unit') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                            <option value="dus" {{ old('unit') == 'dus' ? 'selected' : '' }}>Dus</option>
                            <option value="karton" {{ old('unit') == 'karton' ? 'selected' : '' }}>Karton</option>
                        </select>
                        @error('unit')
                            <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4 mt-8">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow">
                            Simpan Produk
                        </button>
                        <a href="{{ route('products.index') }}" class="font-semibold text-sm text-gray-600 hover:text-gray-900">Batal</a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
