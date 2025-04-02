<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

Route::get('/login', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AdminController::class, 'login']);
Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
Route::get('/register', [AdminController::class, 'showRegister'])->name('admin.register.form');
Route::post('/register', [AdminController::class, 'register'])->name('admin.register');


// Admin Dashboard
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // User Management
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::delete('/user/delete/{id}', [AdminController::class, 'deleteUser'])->name('admin.user.delete');

    // Product Management
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/product/create', [AdminController::class, 'createProduct'])->name('admin.product.create');
    Route::post('/product/store', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::get('/product/edit/{id}', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::put('/product/update/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::delete('/product/delete/{id}', [AdminController::class, 'deleteProduct'])->name('admin.product.delete');
});





