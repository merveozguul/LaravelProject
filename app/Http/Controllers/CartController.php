<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order; // Sipariş modelimizi dahil ediyoruz

class CartController extends Controller
{
    // 1. Sepet Sayfasını Listeler
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // 2. Sepete Ürün Ekler
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "category" => $product->category->name
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Ürün sepete başarıyla eklendi!');
    }

    // 3. Sepetten Ürün Siler
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Ürün sepetten kaldırıldı!');
    }

    // 4. Siparişi Onaylar ve MySQL Veritabanına Kaydeder
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            return redirect()->back()->with('error', 'Sepetiniz boş olduğu için sipariş verilemez.');
        }

        // Toplam tutarı hesapla
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Orders tablosuna siparişi kaydet
        Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'status' => 'Beklemede'
        ]);

        // Sepeti boşalt
        session()->forget('cart');

        // Kullanıcıyı teşekkür mesajıyla ana sayfaya fırlat
        return redirect()->route('home')->with('success', 'Siparişiniz başarıyla alındı! Teşekkür ederiz.');
    }
}
