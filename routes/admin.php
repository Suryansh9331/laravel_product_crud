<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\DashboardController;

// Admin Authentication Routes
Route::middleware(['web'])->prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

// Protected Admin Routes
Route::middleware(['web', 'auth:admin'])->prefix('admin')->group(function () {
 //   Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});