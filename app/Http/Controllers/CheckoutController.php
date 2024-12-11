<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Products;
use App\Services\RajaOngkirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function buyNow(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Products::findOrFail($request->product_id);

        // Cek stok produk
        if ($product->qty < $request->quantity) {
            return back()->withErrors('Stok produk tidak mencukupi');
        }

        // Buat order langsung
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $product->price * $request->quantity,
            'status' => 'pending'
        ]);

        // Buat order item
        $order->orderItems()->create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'price' => $product->price
        ]);

        // Kurangi stok produk
        $product->decrement('qty', $request->quantity);

        // Redirect ke halaman checkout
        return redirect()->route('checkout', $order->id);
    }

    public function processCheckout($orderId)
    {
        $order = Order::with('orderItems.product')
            ->where('user_id', Auth::id())
            ->findOrFail($orderId);

        return view('checkout', compact('order'));
    }

    protected $rajaOngkirService;

    public function __construct(RajaOngkirService $rajaOngkirService)
    {
        $this->rajaOngkirService = $rajaOngkirService;
    }

    public function completeCheckout(Request $request, $orderId)
    {
        $request->validate([
            // ... existing validations
            'origin_city_id' => 'required|exists:cities,id',
            'destination_city_id' => 'required|exists:cities,id',
            'courier' => 'required|in:jne,pos,tiki'
        ]);

        $order = Order::findOrFail($orderId);

        // Hitung ongkos kirim
        $totalWeight = $order->orderItems->sum(function ($item) {
            return $item->product->weight * $item->quantity;
        });

        $shippingCosts = $this->rajaOngkirService->calculateShippingCost(
            $request->origin_city_id,
            $request->destination_city_id,
            $totalWeight,
            $request->courier
        );

        // Pilih layanan pertama (bisa dimodifikasi sesuai kebutuhan)
        $selectedShipping = $shippingCosts[0];

        // Update order dengan biaya kirim
        $order->update([
            // ... existing update
            'shipping_cost' => $selectedShipping['cost'][0]['value'],
            'total_price' => $order->total_price + $selectedShipping['cost'][0]['value']
        ]);

        return redirect()->route('checkout', $order->id);
    }
}
