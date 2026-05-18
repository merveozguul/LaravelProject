<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Ürünleri çekebilmek için modelimizi dahil ediyoruz

class HomeController extends Controller
{
    // Müşterilerin göreceği ana sayfa (Vitrin) için index metodu
    public function index()
    {
        // Tüm ürünleri kategorileriyle birlikte veritabanından çekiyoruz
        $products = Product::with('category')->get();

        // Verileri 'welcome.blade.php' sayfasına gönderiyoruz
        return view('welcome', compact('products'));
    }
}
