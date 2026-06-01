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
}
