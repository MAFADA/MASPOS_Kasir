<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});


Route::get('/category', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');

Route::get('/dashboard/{category?}', [ProductController::class, 'index'])->name('dashboard');
Route::get('/product', [ProductController::class, 'create'])->name('product.create');
Route::post('/product', [ProductController::class, 'store'])->name('product.store');
Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add/{id}', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
Route::get('/payment-success', [CartController::class, 'showPayementSuccess'])->name('cart.paymentSuccess');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
