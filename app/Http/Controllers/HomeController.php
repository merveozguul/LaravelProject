<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category; // Kategoriler

class HomeController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        // Üst menüde ve dinamik filtrelerde listelemek için tüm kategorileri çekiyoruz
        $categories = \App\Models\Category::all();

        // Sorguyu başlatıyoruz
        $query = \App\Models\Product::query()->with('category');

        // 1. ÜST MENÜ: DİNAMİK KATEGORİ FİLTRESİ
        if ($request->has('category_id') && $request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // 2. ÜST BAR: ARAMA MOTORU
        if ($request->has('search') && $request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // 3. SOL SIDEBAR: MARKA, RENK VE BEDEN FİLTRELERİ
        if ($request->has('brand') && $request->filled('brand')) { $query->whereIn('brand', $request->input('brand')); }
        if ($request->has('color') && $request->filled('color')) { $query->whereIn('color', $request->input('color')); }
        if ($request->has('size') && $request->filled('size')) { $query->whereIn('size', $request->input('size')); }

        // 4. SAĞ ÜST: AKILLI SIRALAMA MOTORU (Fiyat, Yeni, vb.)
        $sort = $request->input('sort', 'recommended');
        switch ($sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'best_seller':
                $query->orderBy('stock', 'asc');
                break;
            default:
                $query->orderBy('id', 'desc');
                break;
        }

        // Filtrelenmiş ve sıralanmış ürünleri çekiyoruz
        $products = $query->get();

        // Filtre panelini dolduracak benzersiz marka ve renkleri topluyoruz
        $brands = \App\Models\Product::distinct()->pluck('brand')->filter();
        $colors = \App\Models\Product::distinct()->pluck('color')->filter();

        // Verileri jilet gibi welcome.blade.php dosyasına gönderiyoruz
        return view('welcome', compact('products', 'categories', 'brands', 'colors'));
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
