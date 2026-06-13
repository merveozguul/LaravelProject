<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;  // Ürün modelimizi çağırıyoruz
use App\Models\Category; // Ürün eklerken kategorileri seçtirebilmek için Kategori modelini de çağırıyoruz

class ProductController extends Controller
{
    // 1. Ürünleri Listeleme Sayfası
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

    public function store(Request $request)
    {
        // 1. Verileri Doğruluyoruz
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Formdan gelen tüm verileri bir diziye alıyoruz
        $data = $request->all();

        // 3. 🌟 RESİM YÜKLEME MOTORU (Kırık görseli önleyen kısım)
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Resme benzersiz bir isim veriyoruz (Örn: 1718219425.jpg)
            $imageName = time() . '.' . $image->getClientOriginalExtension();

            // Resmi public klasörünün altındaki 'uploads/products' içine taşıyoruz
            $image->move(public_path('uploads/products'), $imageName);

            // 🚨 Veritabanına kaydedilecek dosya yolunu başına '/' KOYMADAN jilet gibi yazıyoruz:
            $data['image'] = 'uploads/products/' . $imageName;
        }

        // 4. Ürünü veritabanına kaydediyoruz
        \App\Models\Product::create($data);

        // 5. Bağıra bağıra başarı mesajı göndererek listeye geri fırlatıyoruz
        return redirect()->route('admin.product.index')->with('success', 'Product deployed and published successfully!');
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

        return redirect()->route('admin.product.index')->with('success', 'The product has been successfully updated!');
    }

    // 6. Ürünü Veritabanından Siler
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product successfully deleted!');
    }
}
