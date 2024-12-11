<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Products::all();

        return view('admin.product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Products::create([
            'name' => $validatedData['name'],
            'qty' => $validatedData['qty'],
            'price' => $validatedData['price'],
            'image' => $imagePath
        ]);

        return redirect()->route('product.index')->with('success', 'Product uploaded successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        // Temukan produk yang akan diupdate

        // Validasi data input
        $validatedData = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Proses update gambar (opsional)
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Simpan gambar baru
            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            // Gunakan gambar lama jika tidak ada upload baru
            $imagePath = $product->image;
        }

        // Update produk
        $product->update([
            'name' => $validatedData['name'],
            'qty' => $validatedData['qty'],
            'price' => $validatedData['price'],
            'image' => $imagePath
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        // Temukan produk yang akan dihapus

        // Hapus gambar terkait jika ada
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Hapus produk dari database
        $product->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
