<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminOrderController extends Controller
{
    // Tüm Siparişleri Listeleme Paneli
    public function index(Request $request)
    {
        $status = $request->input('status');

        $orders = Order::with('user')
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->paginate(10);

        $statuses = Order::STATUSES;

        return view('admin.orders.index', compact('orders', 'statuses', 'status'));
    }

    // Tek Bir Siparişin Detay Ekranı
    public function show($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        $statuses = Order::STATUSES;

        return view('admin.orders.show', compact('order', 'statuses'));
    }

    // Sipariş Durumunu Değiştirme (Kargoya verildi, onaylandı vs.)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:New,Accepted,Cancelled,Onshipping,Completed',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Order status updated successfully in Merve Shop ledger.');
    }
}
