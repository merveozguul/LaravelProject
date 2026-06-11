<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;  // Ürün modelimizi çağırıyoruz
use App\Models\Category; // Ürün eklerken kategorileri seçtirebilmek için Kategori modelini de çağırıyoruz

class ProductController extends Controller
{
    // 1. Ürünleri Listeleme Sayfası
    // 🛒 1. FONKSİYON: Ziyaretçilerin gördüğü Müşteri Ana Sayfası
    public function index(Request $request)
    {
        $categories = \App\Models\Category::all();
        $query = \App\Models\Product::query()->with('category');

        // Kategori Filtresi
        if ($request->has('category_id') && $request->filled('category_id')) {
            $query->where('category_id', $request->input('category_id'));
        }

        // Arama Motoru
        if ($request->has('search') && $request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function($q) use ($searchTerm) {
                $q->where('name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('description', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Marka, Renk, Beden Filtreleri
        if ($request->has('brand') && $request->filled('brand')) { $query->whereIn('brand', $request->input('brand')); }
        if ($request->has('color') && $request->filled('color')) { $query->whereIn('color', $request->input('color')); }
        if ($request->has('size') && $request->filled('size')) { $query->whereIn('size', $request->input('size')); }

        // Sıralama Motoru
        $sort = $request->input('sort', 'recommended');
        switch ($sort) {
            case 'price_low': $query->orderBy('price', 'asc'); break;
            case 'price_high': $query->orderBy('price', 'desc'); break;
            case 'newest': $query->orderBy('created_at', 'desc'); break;
            default: $query->orderBy('id', 'desc'); break;
        }

        $products = $query->get();
        $brands = \App\Models\Product::distinct()->pluck('brand')->filter();
        $colors = \App\Models\Product::distinct()->pluck('color')->filter();

        // 🌟 Burası MÜŞTERİYİ ana sayfaya (welcome) gönderiyor
        return view('welcome', compact('products', 'categories', 'brands', 'colors'));
    }


// 🛠️ 2. FONKSİYON: Sadece Admin Panelindeki Ürün Listesi İçin
    public function adminIndex()
    {
        // Admin panelinde filtre karmaşasına gerek yok, tüm ürünleri listelesin
        $products = \App\Models\Product::with('category')->latest()->get();
        $brands = \App\Models\Product::distinct()->pluck('brand')->filter();
        $colors = \App\Models\Product::distinct()->pluck('color')->filter();

        // 🌟 Burası ADMİNİ paneldeki listeye (admin.products.index) gönderiyor
        return view('admin.product.index', compact('products', 'brands', 'colors'));
    }

    // 2. Yeni Ürün Ekleme Sayfası
    public function create()
    {
        // Formdaki açılır kutuda (select) göstermek için tüm kategorileri çekiyoruz
        $categories = Category::all();
        return view('admin.product.create', compact('categories'));
    }

    // 3. Formdan Gelen Ürün Verisini Kaydetme
    public function store(Request $request)
    {
        // Gelen verileri doğrula (Validation)
        $request->validate([
            'category_id' => 'required|exists:categories,id', // Gelen kategori ID veritabanında var mı?
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0', // Fiyat sayı olmalı ve 0'dan küçük olamaz
            'stock' => 'required|integer|min:0', // Stok tam sayı olmalı
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
        ]);

        // Veritabanına ürünü kaydet
        Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }

    // 4. Ürün Düzenleme Sayfası (Formu Gösterir)
    public function edit(Product $product)
    {
        // Ürünün kategorisini değiştirebilmek için tüm kategorileri de sayfaya gönderiyoruz
        $categories = Category::all();
        return view('admin.product.edit', compact('product', 'categories'));
    }

    // 5. Düzenlenen Ürünü Veritabanında Günceller
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        // 🌟 EĞER YENİ BİR FOTOĞRAF YÜKLENDİYSE:
        if ($request->hasFile('image')) {
            // Eski fotoğraf varsa ve klasörde duruyorsa temizlik yapıp bilgisayardan siliyoruz
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            // Yeni fotoğrafı benzersiz bir isimle kaydediyoruz
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/products'), $imageName);

            $data['image'] = 'uploads/products/' . $imageName;
        }

        // Verileri güncelliyoruz
        $product->update($data);

        return redirect()->route('admin.product.index')->with('success', 'Ürün başarıyla güncellendi!');
    }

    // 6. Ürünü Veritabanından Siler
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Ürün başarıyla silindi!');
    }
}
