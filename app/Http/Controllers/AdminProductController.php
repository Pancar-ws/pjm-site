<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('filter_unit')) {
            $query->where('unit', $request->filter_unit);
        }

        $products = $query->paginate(10)->withQueryString();

        return view('products.admin.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.admin.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'base_price' => 'required|numeric|min:0',
            'unit' => 'required|in:pcs,dus,karton',
            'category_id' => 'nullable|exists:categories,id',
            'slug' => 'nullable|string|unique:products,slug',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'base_price.required' => 'Harga dasar wajib diisi.',
            'unit.in' => 'Satuan harus berupa pcs, dus, atau karton.'
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        }

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Data produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.admin.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'base_price' => 'required|numeric|min:0',
            'unit' => 'required|in:pcs,dus,karton',
            'category_id' => 'nullable|exists:categories,id',
            'slug' => 'nullable|string|unique:products,slug,' . $product->id,
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
        }

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Data produk berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')
            ->with('success', 'Data produk berhasil dihapus!');
    }
}
