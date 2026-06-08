<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // Kategoriler

class HomeController extends Controller
{
    public function index()
    {
        // 1. Veritabanındaki ürünler
        $products = Product::with('category')->get();

        // 2. Kategorileri çektik
        $categories = Category::all();

        // 3. kategori eklendi
        return view('welcome', compact('products', 'categories'));
    }

    public function aboutUs()
    {
        return view('about_us');
    }

    public function helpSupport()
    {
        return view('help_support');
    }

    public function myCoupons()
    {
        return view('my_coupons');
    }

    public function productDetail(Product $product)
    {
        // İlişkili kategoriyi ve diğer ürünleri de çekebilmek için ürünü gönderiyoruz
        return view('product_detail', compact('product'));
    }

    public function myFavorites()
    {
        // Şimdilik sayfayı doldurmak için mağazadaki mevcut ürünleri favoriymiş gibi listeleyelim
        $products = \App\Models\Product::take(2)->get();
        return view('my_favorites', compact('products'));
    }
}
