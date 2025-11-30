<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
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
Route::get('/search', [\App\Http\Controllers\SearchController::class, 'index'])->name('search.index');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.show');
Route::get('/category/{slug}', [ProductController::class, 'category'])->name('category.show');
Route::get('/shop/{id}', [\App\Http\Controllers\ShopProfileController::class, 'show'])->name('shop.show');

Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
});

Route::get('/dashboard', function () {
    $user = Illuminate\Support\Facades\Auth::user();
    if ($user->hasRole('admin')) return redirect()->route('admin.dashboard');
    if ($user->hasRole('penjual')) return redirect()->route('seller.dashboard');
    if ($user->hasRole('kepala_sekolah')) return redirect()->route('kepala_sekolah.dashboard');
    if ($user->hasRole('guru_pendamping')) return redirect()->route('guru_pendamping.dashboard');
    if ($user->hasRole('pembeli')) return redirect()->route('pembeli.dashboard');
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
    Route::get('/students', [GuruPendampingController::class, 'students'])->name('students.index');
    Route::get('/reports/sales', [GuruPendampingController::class, 'salesReport'])->name('reports.sales');
});

//kepala_sekolah
Route::middleware(['auth', 'role:kepala_sekolah'])->prefix('kepala_sekolah')->name('kepala_sekolah.')->group(function () {
    Route::get('/dashboard', [KepalaSekolahController::class, 'dashboard'])->name('dashboard');
    Route::get('/verifikasi-penjual', [KepalaSekolahController::class, 'verifikasiPenjual'])->name('verifikasi_penjual');
    Route::get('/verifikasi-penjual/{id}', [KepalaSekolahController::class, 'showVerifikasi'])->name('verifikasi.show');
    Route::put('/verifikasi-penjual/{id}/approve', [KepalaSekolahController::class, 'approvePenjual'])->name('verifikasi.approve');
    Route::put('/verifikasi-penjual/{id}/reject', [KepalaSekolahController::class, 'rejectPenjual'])->name('verifikasi.reject');
});

//penjual
Route::middleware(['auth', 'role:penjual'])->prefix('penjual')->name('seller.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Seller\DashboardController::class, 'index'])->name('dashboard');
    
    // Product Management
    Route::resource('products', \App\Http\Controllers\Seller\ProductController::class);
    Route::delete('products/{product}/images/{image}', [\App\Http\Controllers\Seller\ProductController::class, 'destroyImage'])->name('products.images.destroy');
    
    // Order Management
    Route::get('/orders', [\App\Http\Controllers\Seller\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\Seller\OrderController::class, 'show'])->name('orders.show');
    
    // Shop Profile
    Route::get('/shop', [\App\Http\Controllers\Seller\ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/shop', [\App\Http\Controllers\Seller\ShopController::class, 'update'])->name('shop.update');
});

//pembeli
Route::middleware(['auth', 'role:pembeli'])->prefix('pembeli')->name('pembeli.')->group(function () {
    Route::get('/dashboard', [PembeliController::class, 'dashboard'])->name('dashboard');
    Route::get('/become-seller', [PembeliController::class, 'becomeSeller'])->name('become-seller.create');
    Route::post('/become-seller', [PembeliController::class, 'storeSeller'])->name('become-seller.store');
    Route::get('/orders', [PembeliController::class, 'orders'])->name('orders.index');
    Route::get('/history', [PembeliController::class, 'history'])->name('history.index');
}); 

//admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // User management routes
    Route::resource('users', UserController::class);
    
    // Category management
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);
    
    // Product management
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    
    // Order management
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update', 'destroy']);
    
    // Payment confirmation
    Route::get('/payments', [\App\Http\Controllers\Admin\PaymentController::class, 'index'])->name('payments.index');
    Route::post('/payments/{order}/confirm', [\App\Http\Controllers\Admin\PaymentController::class, 'confirm'])->name('payments.confirm');
    Route::post('/payments/{order}/reject', [\App\Http\Controllers\Admin\PaymentController::class, 'reject'])->name('payments.reject');
    
    // Verifikasi Penjual
    Route::resource('verifikasi-penjual', \App\Http\Controllers\Admin\VerifikasiPenjualController::class)->only(['index', 'show', 'update']);

    // Payment Methods
    Route::resource('payment-methods', \App\Http\Controllers\Admin\PaymentMethodController::class);
    
    // Banners
    Route::resource('banners', \App\Http\Controllers\Admin\BannerController::class);
    
    // Reports
    Route::get('/reports/sales', [\App\Http\Controllers\Admin\ReportController::class, 'sales'])->name('reports.sales');
    Route::get('/reports/products', [\App\Http\Controllers\Admin\ReportController::class, 'products'])->name('reports.products');
    Route::get('/reports/sellers', [\App\Http\Controllers\Admin\ReportController::class, 'sellers'])->name('reports.sellers');
    
    // Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');
});
        
require __DIR__.'/auth.php';