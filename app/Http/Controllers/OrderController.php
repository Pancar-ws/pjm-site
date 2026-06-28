<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\ProductBatch;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $products = Product::with(['batches' => function($q) {
            $q->where('qty', '>', 0)->orderBy('expired_date', 'asc');
        }])->get();

        // Get past orders for the authenticated user
        $orders = Order::with('items.product')
            ->where('user_id', Auth::id())
            ->orderBy('order_date', 'desc')
            ->get();

        return view('orders.index', compact('products', 'orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        $requestedQty = (int) $request->qty;

        // Count total available stock in all active batches for this product
        $availableStock = ProductBatch::where('product_id', $product->id)
            ->where('expired_date', '>', now())
            ->sum('qty');

        if ($requestedQty > $availableStock) {
            return back()->withErrors([
                'qty' => 'Stok produk tidak mencukupi. Tersedia: ' . $availableStock . ' ' . $product->unit,
            ]);
        }

        // Run in transaction to deduct stock and place order
        DB::transaction(function () use ($product, $requestedQty) {
            $totalAmount = $product->base_price * $requestedQty;

            // 1. Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'order_date' => now()->format('Y-m-d'),
                'total_amount' => $totalAmount,
                'status' => 'pending',
            ]);

            // 2. Create order item
            $orderItem = OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'qty' => $requestedQty,
                'price_per_unit' => $product->base_price,
                'discount_applied' => 0,
                'subtotal' => $totalAmount,
            ]);

            // 3. Deduct stock from batches using FEFO (First Expired First Out)
            $remainingToDeduct = $requestedQty;
            $batches = ProductBatch::where('product_id', $product->id)
                ->where('qty', '>', 0)
                ->where('expired_date', '>', now())
                ->orderBy('expired_date', 'asc') // Expired first out
                ->get();

            foreach ($batches as $batch) {
                if ($remainingToDeduct <= 0) {
                    break;
                }

                if ($batch->qty >= $remainingToDeduct) {
                    $batch->qty -= $remainingToDeduct;
                    $batch->save();
                    $remainingToDeduct = 0;
                } else {
                    $remainingToDeduct -= $batch->qty;
                    $batch->qty = 0;
                    $batch->save();
                }
            }
        });

        return redirect()->route('orders.index')->with('success', 'Pesanan Anda berhasil dikirim dan stok gudang terpotong otomatis (FEFO)!');
    }
}
