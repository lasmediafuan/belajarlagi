<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // POS routes
    Route::get('/pos', [App\Http\Controllers\PosController::class, 'index'])->name('pos.index');
    Route::post('/pos/add-to-cart', [App\Http\Controllers\PosController::class, 'addToCart'])->name('pos.addToCart');
    Route::post('/pos/checkout', [App\Http\Controllers\PosController::class, 'checkout'])->name('pos.checkout');

    // Admin routes
    Route::middleware('can:admin')->group(function () {
        Route::resource('admin/categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('admin/products', App\Http\Controllers\Admin\ProductController::class);
        Route::resource('admin/users', App\Http\Controllers\Admin\UserController::class);
        Route::resource('admin/sales', App\Http\Controllers\Admin\SaleController::class)->only(['index', 'show']);
    });
});

require __DIR__.'/auth.php';
