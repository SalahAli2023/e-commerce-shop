<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

// Route::get('/', function () {
//     return view('welcome.blade');
// });


// Home page
Route::get('/', [ProductController::class, 'index'])->name('home');

// Products pages
Route::get('/products', [StoreController::class, 'products'])->name('products');
Route::get('/product/{id}', [StoreController::class, 'productDetails'])->name('product.details');

// Other pages
Route::get('/shop', [StoreController::class, 'products'])->name('shop');
Route::get('/cart', [StoreController::class, 'cart'])->name('cart');
Route::get('/about', [StoreController::class, 'about'])->name('about');
Route::get('/contact', [StoreController::class, 'contact'])->name('contact');

// Products pages
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
// Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
// Route::post('/products', [ProductController::class, 'store'])->name('products.store');
// Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
// Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

Route::get('/admin/products_dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/products/{id}', [AdminController::class, 'show'])->name('products.show');
Route::get('/admin/products/create', [AdminController::class, 'create'])->name('products.create');
Route::post('/admin/products', [AdminController::class, 'store'])->name('products.store');
Route::get('/admin/products/{id}/edit', [AdminController::class, 'edit'])->name('products.edit');
Route::put('/admin/products/{id}', [AdminController::class, 'update'])->name('products.update');
Route::delete('/admin/products/{id}', [AdminController::class, 'destroy'])->name('products.destroy');
Route::post('/products/{id}/toggle-sale', [AdminController::class, 'toggleSale'])->name('products.toggle-sale');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');


Route::prefix('admin')->name('admin.')->group(function () {
    // Route::resource('products', AdminController::class);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');

});