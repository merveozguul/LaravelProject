<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // 1. Ödeme Formu Ekranı (Checkout Page)
    public function checkout()
    {
        // Sepeti session'dan çekiyoruz
        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Your shopping cart is empty.');
        }

        // Subtotal hesaplama (Session yapısına uygun)
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $shippingPrice = 0; // Free Shipping
        $total = $subtotal + $shippingPrice;

        // View'a gönderirken view içinde $cartItems yerine doğrudan $cart kullanacağız
        return view('checkout', [
            'cartItems' => $cart,
            'subtotal' => $subtotal,
            'shippingPrice' => $shippingPrice,
            'total' => $total
        ]);
    }

    // 2. Siparişi Kaydetme ve Stok Düşme (Place Order)
    public function placeOrder(Request $request)
    {
        // Hocanın istediği validasyonlar
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:30',
            'address' => 'required|string',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:50',
            'shipping_method' => 'required|string|max:255',
            'payment_method' => 'required|string|max:255',
        ]);

        $cart = session()->get('cart', []);

        if (count($cart) == 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        try {
            // Güvenli Kodlama: DB Transaction başlatıyoruz
            DB::transaction(function () use ($request, $cart) {

                $subtotal = 0;
                foreach ($cart as $item) {
                    $subtotal += $item['price'] * $item['quantity'];
                }

                $shippingPrice = $request->shipping_method === 'Standard Shipping' ? 40 : 0;
                $total = $subtotal + $shippingPrice;

                // 1. Ana Sipariş Kaydını Oluştur (Hocanın Şeması)
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'country' => $request->country,
                    'zip_code' => $request->zip_code,
                    'subtotal' => $subtotal,
                    'shipping_price' => $shippingPrice,
                    'total' => $total,
                    'shipping_method' => $request->shipping_method,
                    'payment_method' => $request->payment_method,
                    'status' => 'New',
                    'total_amount' => $total,
                ]);

                // 2. Sipariş Kalemlerini Döngüyle Ekle & Stok Kontrolü Yap
                foreach ($cart as $id => $item) {
                    $product = Product::find($id);

                    // Stok Savunma Bariyeri
                    if (!$product || $product->stock < $item['quantity']) {
                        throw new \Exception(($product ? $product->name : 'Product') . ' does not have enough stock.');
                    }

                    // Sipariş kalemi oluşturma (Hocanın Şeması)
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $product->id,
                        'product_title' => $product->name, // Bizim projedeki name alanı
                        'price' => $item['price'],
                        'quantity' => $item['quantity'],
                        'total' => $item['price'] * $item['quantity'],
                    ]);

                    // Stok seviyesini güvenle düşür
                    $product->decrement('stock', $item['quantity']);
                }

                // 3. Sipariş bittiği için Session sepetini uçur
                session()->forget('cart');
            });

            return redirect()->route('home')->with('success', 'Your order has been placed successfully.');

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
