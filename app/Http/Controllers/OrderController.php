<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // Admin Panelinde Gelen Siparişleri Listeler
    public function index()
    {
        // Siparişi veren kullanıcının bilgileriyle (user) birlikte en yeni siparişleri çekiyoruz
        $orders = Order::with('user')->latest()->get();

        return view('admin.orders', compact('orders'));
    }
}
