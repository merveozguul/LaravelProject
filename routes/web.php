<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminMessageController;

// Müşteri Vitrini Ana Sayfası
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact/store', [HomeController::class, 'storeMessage'])->name('contact.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('cart.checkout');
    Route::post('/place-order', [OrderController::class, 'placeOrder'])->name('cart.placeOrder');
});

// Müşteri Yorum Gönderme Rotası
Route::middleware('auth')->post('/product/storecomment', [CommentController::class, 'storeComment'])->name('product.storeComment');

// ==============================================================================
// 🚨 ADMİN KONTROL PANELİ ROTALARI
// ==============================================================================
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    // Admin Ana Sayfası
    Route::get('/dashboard', function () {
        $totalProducts = \App\Models\Product::count();
        $totalCategories = \App\Models\Category::count();
        $totalOrders = \App\Models\Order::count();

        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalOrders'));
    })->name('dashboard');

    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [AdminMessageController::class, 'index'])->name('index');
        Route::get('/show/{id}', [AdminMessageController::class, 'show'])->name('show');
        Route::post('/update/{id}', [AdminMessageController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [AdminMessageController::class, 'destroy'])->name('destroy');
    });

    // 🌟 YORUM YÖNETİMİ ROTALARI (Çakışmalar tamamen temizlendi, jilet gibi oldu)
    Route::prefix('comments')->name('comments.')->group(function () {
        Route::get('/', [AdminCommentController::class, 'index'])->name('index');
        Route::get('/show/{id}', [AdminCommentController::class, 'show'])->name('show');
        Route::post('/update/{id}', [AdminCommentController::class, 'update'])->name('update');
        Route::post('/destroy/{id}', [AdminCommentController::class, 'destroy'])->name('destroy');
    });

    // Admin Panel Kullanıcı Yönetim Rotaları
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/show/{id}', [AdminUserController::class, 'show'])->name('show');
        Route::post('/{id}/add-role', [AdminUserController::class, 'addRole'])->name('addRole');
        Route::delete('/{userId}/role/{roleId}', [AdminUserController::class, 'removeRole'])->name('removeRole');
    });

    // Kategori Rotaları
    Route::prefix('categories')->name('categories.')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{category}', 'edit')->name('edit');
        Route::put('/update/{category}', 'update')->name('update');
        Route::delete('/delete/{category}', 'destroy')->name('destroy');
    });

    // Ürün Rotaları
    Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
        Route::get('/', 'adminIndex')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{product}', 'edit')->name('edit');
        Route::put('/update/{product}', 'update')->name('update');
        Route::delete('/delete/{product}', 'destroy')->name('destroy');
    });

    // Sipariş Rotaları
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders');
    Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/update-status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

// ==============================================================================
// SEPET ROTALARI
// ==============================================================================
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('add');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->middleware('auth')->name('checkout');
});

// Diğer Sayfalar
Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('about.us');
Route::get('/help-and-support', [HomeController::class, 'helpSupport'])->name('help.support');
Route::get('/my-discount-coupons', [HomeController::class, 'myCoupons'])->middleware('auth')->name('my.coupons');
Route::get('/product/{product}', [HomeController::class, 'productDetail'])->name('product.detail');
Route::get('/my-favorites', [HomeController::class, 'myFavorites'])->middleware('auth')->name('my.favorites');

require __DIR__.'/auth.php';
