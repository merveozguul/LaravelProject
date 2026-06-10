<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    // 2. Sepete Ürün Ekler ve 🌟 STOK KONTROLÜ YAPAR
    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        // Eğer ürün sepette zaten varsa
        if(isset($cart[$product->id])) {

            // 🛑 STOK DUVARI: Sepetteki miktar, ürünün gerçek stoğuna ulaştıysa daha fazla ekletme!
            if ($cart[$product->id]['quantity'] >= $product->stock) {
                return redirect()->back()->with('error', "Sorry, you cannot add more than {$product->stock} items. Out of stock!");
            }

            $cart[$product->id]['quantity']++;
        } else {
            // Eğer ürün sepete İLK DEFA ekleniyorsa ve stokta hiç yoksa engelle
            if ($product->stock < 1) {
                return redirect()->back()->with('error', 'This product is out of stock!');
            }

            // GÖRSEL KORUMASI: Veritabanında image boşsa veya hatalıysa null dönmesin diye trim ekledik
            $productImage = $product->image ? trim($product->image) : null;

            $cart[$product->id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $productImage,
                "discount_rate" => $product->discount_rate ?? 0,
                "category_name" => $product->category->name ?? 'General'
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    // 🌟 HİBRİT REMOVE: Hem tamamen siler hem de 'action=decrease' gelirse adeti 1 azaltır!
    public function remove(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            // Eğer JavaScript'ten 'decrease' (azalt) emri geldiyse
            if ($request->has('action') && $request->input('action') === 'decrease') {
                $cart[$id]['quantity']--;

                // Adet 1'in altına düşerse ürünü sepetten tamamen uçur
                if ($cart[$id]['quantity'] < 1) {
                    unset($cart[$id]);
                }
            } else {
                // Eğer doğrudan kırmızı "Remove" linkine basıldıysa ürünü direkt sil
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    // 4. Siparişi Onaylar ve Stokları Azaltır
    public function checkout()
    {
        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            return redirect()->back()->with('error', 'Your shopping cart is empty, so you cannot place an order.');
        }

        // Önce stok tarama
        foreach ($cart as $id => $item) {
            $product = Product::find($id);

            // Eğer ürün silindiyse veya sepetteki miktar stoktan fazlaysa siparişi komple durdur
            if (!$product || $item['quantity'] > $product->stock) {
                return redirect()->route('cart.index')->with('error', "An error occurred during the ordering process! '{$item['name']}' The product is either out of stock or no longer available.");
            }
        }

        // Siparişi kaydedip stokları düş.
        $totalAmount = 0;
        foreach ($cart as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Siparişi oluştur
        Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $totalAmount,
            'status' => 'Pending'
        ]);

        // VERİTABANINDAN STOKLARI DÜŞ
        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            $product->stock = $product->stock - $item['quantity'];
            $product->save(); // Yeni stoğu MySQL'e kaydet
        }

        // Sepeti temizle
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Your order has been successfully received! Stock levels have been updated.');
    }
}
