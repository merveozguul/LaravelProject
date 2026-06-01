<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;  // Ürün modelimizi çağırıyoruz
use App\Models\Category; // Ürün eklerken kategorileri seçtirebilmek için Kategori modelini de çağırıyoruz

class ProductController extends Controller
{
    // 1. Ürünleri Listeleme Sayfası
    public function index()
    {
        // Ürünleri çekerken yanlarında kategorilerini de getir (with ile performanslı çekim yapıyoruz)
        $products = Product::with('category')->get();
        return view('admin.product.index', compact('products'));
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
        ]);

        // Veritabanına ürünü kaydet
        Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        // İşlem bitince ürün listesine yönlendir ve başarı mesajı ver
        return redirect()->route('admin.product.index')->with('success', 'Ürün başarıyla eklendi!');
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
