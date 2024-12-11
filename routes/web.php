<?php

use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/dashboard', [AdminController::class, 'admin']);
Route::resource('/admin/product', AdminProductController::class);
Route::get('/', [UserController::class, 'index']);
Route::resource('/admin/contact', AdminContactController::class);
Route::get('/product', [ProductController::class, 'index']);
Route::middleware(['auth'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
    Route::put('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/{cartId}', [CartController::class, 'removeFromCart'])->name('cart.remove');
});
Route::middleware(['auth'])->group(function () {
    Route::post('/buy-now', [CheckoutController::class, 'buyNow'])->name('buy.now');
    Route::get('/checkout/{orderId}', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/checkout/{orderId}/complete', [CheckoutController::class, 'completeCheckout'])->name('checkout.complete');
    Route::get('/checkout/{orderId}/konfirmasi', [CheckoutController::class, 'konfirmasiCheckout'])->name('checkout.konfirmasi');
});

require __DIR__ . '/auth.php';
