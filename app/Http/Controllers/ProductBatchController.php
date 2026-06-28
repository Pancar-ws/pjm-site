<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductBatch;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProductBatchController extends Controller
{
    public function index(Request $request)
    {
        // Menggunakan Eager Loading 'product' untuk menghindari N+1 Query problem
        $query = ProductBatch::with('product');

        // Fitur Wajib: Search (Berdasarkan nomor batch atau nama produk) [1]
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('batch_number', 'like', "%{$search}%")
                  ->orWhereHas('product', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
        }

        // Fitur Wajib: Pagination minimal 10 data & withQueryString [1]
        $batches = $query->orderBy('expired_date', 'asc')->paginate(10)->withQueryString();

        return view('product_batches.index', compact('batches'));
    }

    public function create()
    {
        // Mengirim data produk untuk dropdown pilihan
        $products = Product::orderBy('name', 'asc')->get();
        return view('product_batches.create', compact('products'));
    }

    public function store(Request $request)
    {
        // Fitur Wajib: Validasi Form Server-side [1]
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'batch_number' => 'required|string|max:50|unique:product_batches,batch_number',
            'qty' => 'required|integer|min:1',
            'expired_date' => 'required|date',
        ], [
            'product_id.required' => 'Produk wajib dipilih.',
            'batch_number.unique' => 'Nomor batch ini sudah terdaftar.',
            'qty.min' => 'Jumlah (Qty) minimal 1.',
        ]);

        ProductBatch::create($validated);

        // Fitur Wajib: Flash Message [1]
        return redirect()->route('product-batches.index')
            ->with('success', 'Batch stok baru berhasil ditambahkan!');
    }

    public function edit(ProductBatch $productBatch)
    {
        $products = Product::orderBy('name', 'asc')->get();
        return view('product_batches.edit', compact('productBatch', 'products'));
    }

    public function update(Request $request, ProductBatch $productBatch)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            // Ignore validasi unique untuk batch yang sedang diedit
            'batch_number' => 'required|string|max:50|unique:product_batches,batch_number,' . $productBatch->id,
            'qty' => 'required|integer|min:0',
            'expired_date' => 'required|date',
        ]);

        $productBatch->update($validated);

        return redirect()->route('product-batches.index')
            ->with('success', 'Data batch stok berhasil diperbarui!');
    }

    public function destroy(ProductBatch $productBatch)
    {
        $productBatch->delete();
        return redirect()->route('product-batches.index')
            ->with('success', 'Batch stok berhasil dihapus!');
    }
}