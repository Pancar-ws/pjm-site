@extends('layouts.frontend')

@section('title', 'Pemesanan Agen')

@section('content')
<!-- Header Page -->
<section class="bg-slate-900 text-white py-16 relative overflow-hidden">
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[100px] pointer-events-none"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-4 relative z-10">
        <h1 class="text-4xl font-extrabold tracking-tight">Formulir Pemesanan Mandiri</h1>
        <p class="text-slate-400 max-w-2xl mx-auto text-base sm:text-lg">Selamat datang, <strong>{{ Auth::user()->name }}</strong>. Ajukan pemesanan pasokan barang ritel secara langsung di sini.</p>
    </div>
</section>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
        
        <!-- Order Placement Form -->
        <div class="lg:col-span-5 bg-white border border-slate-100 p-8 rounded-3xl shadow-sm space-y-6 h-fit">
            <h2 class="text-xl font-bold text-slate-900 flex items-center gap-2">🛒 Buat Pesanan Baru</h2>
            
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-xs">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('orders.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-slate-700 text-xs font-bold mb-1.5 uppercase tracking-wider">Pilih Produk</label>
                    <select name="product_id" required id="product_select"
                        class="w-full border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm bg-white">
                        <option value="">-- Pilih Produk --</option>
                        @foreach($products as $prod)
                            @php
                                $totalStock = $prod->batches->sum('qty');
                            @endphp
                            <option value="{{ $prod->id }}" data-price="{{ $prod->base_price }}" data-unit="{{ $prod->unit }}" data-stock="{{ $totalStock }}" {{ request('product_id') == $prod->id ? 'selected' : '' }}>
                                {{ $prod->name }} (Stok: {{ $totalStock }} {{ $prod->unit }}) - Rp {{ number_format($prod->base_price, 0, ',', '.') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-slate-700 text-xs font-bold mb-1.5 uppercase tracking-wider">Jumlah (Qty)</label>
                    <input type="number" name="qty" id="qty_input" min="1" required value="1"
                        class="w-full border-slate-200 rounded-xl px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500 shadow-sm">
                    @error('qty')
                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Price summary calculation (interactive via JS) -->
                <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 space-y-2 text-xs">
                    <div class="flex justify-between text-slate-500">
                        <span>Harga Satuan:</span>
                        <span id="summary_unit_price">Rp 0</span>
                    </div>
                    <div class="flex justify-between text-slate-500 border-b border-slate-100 pb-2">
                        <span>Kuantitas:</span>
                        <span id="summary_qty">1</span>
                    </div>
                    <div class="flex justify-between text-slate-900 font-bold text-sm">
                        <span>Total Pembayaran:</span>
                        <span id="summary_total" class="text-blue-600">Rp 0</span>
                    </div>
                </div>

                <div>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-md transition">
                        Kirim Pesanan
                    </button>
                </div>
            </form>
        </div>

        <!-- Order Logs / History -->
        <div class="lg:col-span-7 bg-white border border-slate-100 p-8 rounded-3xl shadow-sm space-y-6">
            <h2 class="text-xl font-bold text-slate-900">📜 Riwayat Transaksi Anda</h2>
            <p class="text-slate-500 text-xs">Daftar transaksi pesanan supply yang pernah diajukan oleh akun agen Anda.</p>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50 text-slate-500">
                        <tr>
                            <th class="px-4 py-3 text-left font-bold text-xs uppercase">No Order</th>
                            <th class="px-4 py-3 text-left font-bold text-xs uppercase">Tanggal</th>
                            <th class="px-4 py-3 text-left font-bold text-xs uppercase">Rincian Item</th>
                            <th class="px-4 py-3 text-left font-bold text-xs uppercase">Total Pembayaran</th>
                            <th class="px-4 py-3 text-left font-bold text-xs uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-600">
                        @forelse($orders as $order)
                            <tr>
                                <td class="px-4 py-4 whitespace-nowrap font-bold text-slate-800">#ORD-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-xs">{{ \Carbon\Carbon::parse($order->order_date)->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-4 text-xs">
                                    @foreach($order->items as $item)
                                        <div>{{ $item->product->name ?? 'Produk Dihapus' }} ({{ $item->qty }} {{ $item->product->unit ?? '' }})</div>
                                    @endforeach
                                </td>
                                <td class="px-4 py-4 whitespace-nowrap font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="px-4 py-4 whitespace-nowrap text-xs">
                                    @if($order->status == 'pending')
                                        <span class="px-2 py-1 rounded bg-amber-100 text-amber-800 font-bold">Pending</span>
                                    @elseif($order->status == 'diproses')
                                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 font-bold">Diproses</span>
                                    @elseif($order->status == 'dikirim')
                                        <span class="px-2 py-1 rounded bg-indigo-100 text-indigo-800 font-bold">Dikirim</span>
                                    @else
                                        <span class="px-2 py-1 rounded bg-green-100 text-green-800 font-bold">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-slate-400">Belum ada riwayat pesanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    const select = document.getElementById('product_select');
    const qtyInput = document.getElementById('qty_input');
    const summaryUnitPrice = document.getElementById('summary_unit_price');
    const summaryQty = document.getElementById('summary_qty');
    const summaryTotal = document.getElementById('summary_total');

    function updateSummary() {
        const selectedOption = select.options[select.selectedIndex];
        if (!selectedOption || select.value === '') {
            summaryUnitPrice.innerText = 'Rp 0';
            summaryQty.innerText = '0';
            summaryTotal.innerText = 'Rp 0';
            return;
        }

        const price = parseInt(selectedOption.getAttribute('data-price')) || 0;
        const unit = selectedOption.getAttribute('data-unit') || '';
        const qty = parseInt(qtyInput.value) || 0;
        const total = price * qty;

        summaryUnitPrice.innerText = `Rp ${price.toLocaleString('id-ID')} / ${unit}`;
        summaryQty.innerText = qty;
        summaryTotal.innerText = `Rp ${total.toLocaleString('id-ID')}`;
    }

    select.addEventListener('change', updateSummary);
    qtyInput.addEventListener('input', updateSummary);

    // Initial load check
    updateSummary();
</script>
@endsection
