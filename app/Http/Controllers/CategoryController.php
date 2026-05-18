<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Veritabanı tablomuzu (Model) buraya tanıtıyoruz

class CategoryController extends Controller
{
    // 1. Kategorileri Listeleme Sayfası
    public function index()
    {
        $categories = Category::all(); // Veritabanındaki tüm kategorileri çek
        return view('admin.categories.index', compact('categories')); // Tasarım dosyasına gönder
    }

    // 2. Yeni Kategori Ekleme Sayfası
    public function create()
    {
        return view('admin.categories.create'); // Sadece formu göster
    }

    // 3. Formdan Gelen Veriyi Veritabanına Kaydetme
    public function store(Request $request)
    {
        // Önce kullanıcının girdiği verileri kontrol et (Boş bırakılamaz kuralları)
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        // Kurallara uyuyorsa veritabanına kaydet
        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        // Kayıt bitince kategori listesine geri dön ve başarı mesajı ver
        return redirect()->route('admin.categories.index')->with('success', 'Kategori başarıyla eklendi!');
    }

    // 4. Kategori Düzenleme Sayfası (Formu Gösterir)
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // 5. Düzenlenen Kategoriyi Veritabanında Günceller
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Kategori başarıyla güncellendi!');
    }

    // 6. Kategoriyi Veritabanından Siler
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori başarıyla silindi!');
    }
}
