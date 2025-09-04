<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Home page
Route::get('/', [StoreController::class, 'index']);

// Products pages
// Route::get('/products', [StoreController::class, 'products'])->name('products');
// Route::get('/product/{id}', [StoreController::class, 'productDetails'])->name('product.details');

// Other pages
Route::get('/cart', [StoreController::class, 'cart'])->name('cart');
Route::get('/about', [StoreController::class, 'about'])->name('about');
Route::get('/contact', [StoreController::class, 'contact'])->name('contact');

// Products pages
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');