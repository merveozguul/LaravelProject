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
}
