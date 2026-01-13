<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| 1. AKSES PUBLIK (Bisa diakses siapa saja)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $products = Product::latest()->take(8)->get();
    return view('user.home', compact('products'));
})->name('home');

// Detail produk bisa dilihat tanpa login
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


/*
|--------------------------------------------------------------------------
| 2. AKSES ADMIN (Hanya Role Admin)
|--------------------------------------------------------------------------
| Menambahkan middleware 'admin' yang tadi sudah kita daftarkan
*/
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    // Halaman Dashboard Utama Admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD Kategori & Produk
    Route::resource('/category', CategoryController::class);
    Route::resource('/products', ProductController::class)->except(['show']);
});


/*
|--------------------------------------------------------------------------
| 3. AKSES USER TERAUTENTIKASI (Admin & User Biasa bisa masuk)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Keranjang Pesanan
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

require __DIR__.'/auth.php';