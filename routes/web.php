<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController; 

/*
|--------------------------------------------------------------------------
| 1. AKSES PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Menampilkan 8 produk terbaru di halaman home
    $products = Product::latest()->take(8)->get();
    return view('user.home', compact('products'));
})->name('home');


/*
|--------------------------------------------------------------------------
| 2. AKSES ADMIN (Hanya Role Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    
    // Halaman Dashboard Utama Admin
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUD Kategori
    Route::resource('category', CategoryController::class);

    /* --- MANAJEMEN PRODUK --- */
    // Route 'create' aman di sini karena dilindungi middleware admin
    // dan route wildcard '{product}' sudah dipindah ke paling bawah
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::post('products', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Route test view (bisa dihapus nanti jika tidak dipakai)
    Route::get('test-view', function() {
        return view('products.create', ['categories' => \App\Models\Category::all()]);
    });
});


/*
|--------------------------------------------------------------------------
| 3. AKSES TERAUTENTIKASI (Admin & User Biasa)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Keranjang Pesanan (Cart)
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

    // Checkout & Pembayaran 
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/sukses', [CheckoutController::class, 'sukses'])->name('checkout.sukses');
    
    // Upload bukti pembayaran
    Route::put('/checkout/{order}/bukti-pembayaran', [CheckoutController::class, 'updatePaymentProof'])->name('checkout.updatePaymentProof');

    // Riwayat Pesanan
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
});


/*
|--------------------------------------------------------------------------
| 4. ROUTE DINAMIS (Akses Publik Detail Produk)
|--------------------------------------------------------------------------
| PENTING: Ditaruh paling bawah agar tidak memblokir route lain seperti 'create'
*/
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


require __DIR__.'/auth.php';