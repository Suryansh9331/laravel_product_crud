<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
// Redirect root URL to login page if not authenticated
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes (Login, Register, Logout)
Auth::routes();

// Protect product routes with 'auth' middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}/show', [ProductController::class, 'show'])->name('products.show');
});



// Cart Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index'); // View Cart
    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add'); // Add to Cart
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove'); // Remove from Cart
    Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

});
