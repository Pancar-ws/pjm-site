<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category', 'batches');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Custom filter kebutuhan (misal filter berdasarkan satuan atau kemasan)
        if ($request->filled('unit')) {
            $query->where('unit', $request->unit);
        }

        $products = $query->paginate(9)->withQueryString();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with(['category', 'batches' => function ($query) {
            $query->where('qty', '>', 0)->orderBy('expired_date', 'asc'); // FEFO ordering
        }])->where('slug', $slug)->firstOrFail();

        // Get related products in the same category
        $related_products = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('products.show', compact('product', 'related_products'));
    }
}