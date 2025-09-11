<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\StoreController;

Route::get('/', function () {
    return view('welcome');
});
//shop
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Home page
Route::get('/', [ProductController::class, 'index'])->name('home');

// Other pages
Route::get('/cart', [StoreController::class, 'cart'])->name('cart');
Route::get('/about', [StoreController::class, 'about'])->name('about');
Route::get('/contact', [StoreController::class, 'contact'])->name('contact');

// Products pages
Route::get('/products', [StoreController::class, 'products'])->name('products');
Route::get('/product/{id}', [StoreController::class, 'productDetails'])->name('product.details');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Administrative Control Panel Paths (Protected by Authentication and Privileges)
Route::middleware(['auth', 'can:access-admin-panel'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    
    // Toggle product sale status
    Route::post('/admin/products/{id}/toggle-sale', [ProductController::class, 'toggleSale'])
        ->name('admin.products.toggle-sale');
});

// Product paths (protected by permissions)
Route::resource('products', ProductController::class)->middleware(['auth', 'can:access-admin-panel']);

// Product paths (protected by permissions)
Route::resource('categories', CategoryController::class)->middleware(['auth', 'can:access-admin-panel']);

// Mail and notification test paths
Route::middleware(['auth', 'can:access-admin-panel'])->prefix('test')->group(function () {
    Route::get('/welcome-email', function () {
        $user = auth()->user();
        \App\Mail\WelcomeEmail::send($user);
        return 'Welcome email sent to ' . $user->email;
    });
    
    Route::get('/test-notification', function () {
        $user = auth()->user();
        
        // Create a dummy test request
        $mockOrder = (object) [
            'id' => rand(1000, 9999),
            'customer_name' => $user->name,
            'total_amount' => rand(50, 500),
        ];
        
        $user->notify(new \App\Notifications\NewOrderNotification($mockOrder));
        
        return 'Test notification sent to ' . $user->email;
    });
});
require __DIR__.'/auth.php';
