<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\GuruPendampingController;
use App\Http\Controllers\KepalaSekolahController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('category.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Role-specific dashboards
//guru_pendamping
Route::middleware(['auth', 'role:guru_pendamping'])->prefix('guru_pendamping')->name('guru_pendamping.')->group(function () {
    Route::get('/dashboard', [GuruPendampingController::class, 'dashboard'])->name('dashboard');
});

//kepala_sekolah
Route::middleware(['auth', 'role:kepala_sekolah'])->prefix('kepala_sekolah')->name('kepala_sekolah.')->group(function () {
    Route::get('/dashboard', [KepalaSekolahController::class, 'dashboard'])->name('dashboard');
});

//penjual
Route::middleware(['auth', 'role:penjual'])->prefix('penjual')->name('penjual.')->group(function () {
    Route::get('/dashboard', [PenjualController::class, 'dashboard'])->name('dashboard');
});

//pembeli
Route::middleware(['auth', 'role:pembeli'])->prefix('pembeli')->name('pembeli.')->group(function () {
    Route::get('/dashboard', [PembeliController::class, 'dashboard'])->name('dashboard');
}); 

//admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // User management routes
    Route::resource('users', UserController::class);
});
        
require __DIR__.'/auth.php';