<?php declare(strict_types=1); 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SeoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public routes
Route::get('/', [SeoController::class, 'home'])->name('home');

// Product routes
Route::get('/products', [SeoController::class, 'products'])->name('products.index');
Route::get('/products/{product:slug}', [SeoController::class, 'product'])->name('products.show');

// Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category:slug}', [SeoController::class, 'category'])->name('categories.show');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');

// Authentication routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');
    
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

// Admin routes
Route::middleware(['auth', 'role:admin|super-admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Product management
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    
    // Category management
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    
    // Order management
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
    
    // User management
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
});

// Assistant routes
Route::middleware(['auth', 'role:assistant|admin|super-admin'])->prefix('assistant')->name('assistant.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'assistant'])->name('dashboard');
    Route::resource('orders', \App\Http\Controllers\Assistant\OrderController::class);
    Route::resource('products', \App\Http\Controllers\Assistant\ProductController::class);
});

// SEO routes
Route::get('/sitemap.xml', [SeoController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [SeoController::class, 'robots'])->name('robots');
