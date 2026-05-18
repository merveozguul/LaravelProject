<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

// ADMİN KONTROL PANELİ ROTALARI
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    // Admin Ana Sayfası (Dinamik İstatistikli)
    Route::get('/dashboard', function () {
        // Veritabanındaki toplam kayıt sayılarını alıp değişkenlere atıyoruz
        $totalProducts = \App\Models\Product::count();
        $totalCategories = \App\Models\Category::count();
        $totalOrders = 0; // İleride sipariş tablosu eklenince saydıracağız

        // compact() fonksiyonu ile bu verileri tasarıma (Blade) gönderiyoruz
        return view('admin.dashboard', compact('totalProducts', 'totalCategories', 'totalOrders'));
    })->name('dashboard');

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
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{product}', 'edit')->name('edit');
        Route::put('/update/{product}', 'update')->name('update');
        Route::delete('/delete/{product}', 'destroy')->name('destroy');
    });

});

require __DIR__.'/auth.php';
