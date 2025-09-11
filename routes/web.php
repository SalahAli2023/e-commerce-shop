<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;

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
});


//Administrative Control Panel Paths (Protected by Authentication and Privileges)
Route::middleware(['auth', 'can:access-admin-panel'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
});

// Product paths (protected by permissions)
Route::resource('products', ProductController::class)->middleware(['auth', 'can:access-admin-panel']);


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
