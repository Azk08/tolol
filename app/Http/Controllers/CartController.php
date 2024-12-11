<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'integer|min:1'
        ]);

        $product = Products::findOrFail($request->product_id);
        
        // Cek stok produk
        if ($product->qty < $request->quantity) {
            return back()->withErrors('Stok produk tidak mencukupi');
        }

        $cart = cart::where('user_id', Auth::id())
                    ->where('product_id', $product->id)
                    ->first();

        if ($cart) {
            // Update jumlah jika produk sudah ada di keranjang
            $newQuantity = $cart->quantity + $request->quantity;
            
            if ($product->qty < $newQuantity) {
                return back()->withErrors('Stok produk tidak mencukupi');
            }

            $cart->update([
                'quantity' => $newQuantity
            ]);
        } else {
            // Tambah produk baru ke keranjang
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $request->quantity
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function viewCart()
    {
        $carts = Cart::where('user_id', Auth::id())
                     ->with('product')
                     ->get();

        $total = $carts->sum(function($cart) {
            return $cart->quantity * $cart->product->price;
        });

        return view('cart', compact('carts', 'total'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = Cart::findOrFail($request->cart_id);
        
        // Pastikan hanya pemilik keranjang yang bisa update
        if ($cart->user_id != Auth::id()) {
            return back()->withErrors('Anda tidak diizinkan');
        }

        $product = $cart->product;

        // Cek stok produk
        if ($product->qty < $request->quantity) {
            return back()->withErrors('Stok produk tidak mencukupi');
        }

        $cart->update([
            'quantity' => $request->quantity
        ]);

        return back()->with('success', 'Keranjang berhasil diperbarui');
    }

    public function removeFromCart($cartId)
    {
        $cart = Cart::findOrFail($cartId);

        // Pastikan hanya pemilik keranjang yang bisa hapus
        if ($cart->user_id != Auth::id()) {
            return back()->withErrors('Anda tidak diizinkan');
        }

        $cart->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
