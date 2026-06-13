<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | Order Details #ORD-{{ $order->id }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f5f7; font-family: 'Segoe UI', sans-serif; }
        .bg-orange { background-color: #f27a1a !important; }
        .text-orange { color: #f27a1a !important; }
        .sidebar { background-color: #1e293b; min-height: 100vh; color: #cbd5e1; }
        .sidebar .nav-link { color: #94a3b8; padding: 12px 20px; border-radius: 8px; text-decoration: none; display: block; }
        .sidebar .nav-link.active { background-color: rgba(242, 122, 26, 0.1); color: #f27a1a; }
        .invoice-card { background: #ffffff; border: none; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    </style>
</head>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // 🌟 Admin Durum Güncelleme Bildirim Motoru
    document.addEventListener('DOMContentLoaded', function () {
        // Form gönderilirken butonu kilitle ve yükleniyor efekti ver
        const statusForm = document.querySelector('form[action*="update-status"]');
        if (statusForm) {
            statusForm.addEventListener('submit', function() {
                const btn = this.querySelector('button[type="submit"]');
                btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i>Updating...';
                btn.disabled = true;
            });
        }

        // Backend'den (AdminOrderController) gelen başarı mesajını yakala ve patlat
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Ledger Updated!',
            text: '{{ session('success') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            background: '#1e293b', // Koyu Sol Menü Rengimizle Uyumlu Koyu Arka Plan
            color: '#ffffff',      // Beyaz Yazı
            iconColor: '#f27a1a'   // Merve Shop Turuncusu
        });
        @endif
    });
</script>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 px-0 sidebar p-3">
            <div class="py-3 px-2 mb-4">
                <h3 class="fw-bolder text-white">merve<span class="text-orange">shop</span></h3>
            </div>
            <ul class="nav flex-column gap-2">
                <li><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a></li>
                <li><a class="nav-link" href="{{ route('admin.product.index') }}"><i class="fa-solid fa-box-open me-2"></i> Products</a></li>
                <li><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fa-solid fa-tags me-2"></i> Categories</a></li>
                <li><a class="nav-link active" href="{{ route('admin.orders') }}"><i class="fa-solid fa-receipt me-2"></i> Orders</a></li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 p-4">
            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h3 fw-bold text-dark">Order Details Ledger</h1>
                    <p class="text-muted small mb-0">Invoice and fulfillment auditing console for Order #ORD-{{ $order->id }}</p>
                </div>
                <a href="{{ route('admin.orders') }}" class="btn btn-sm btn-outline-secondary rounded-3"><i class="fa-solid fa-arrow-left"></i> Back to Orders</a>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card invoice-card p-4 mb-4">
                        <h5 class="fw-bold mb-3"><i class="fa-solid fa-basket-shopping text-orange me-2"></i> Purchased Basket Items</h5>
                        <table class="table table-borderless align-middle">
                            <thead class="table-light">
                            <tr>
                                <th>Product Node</th>
                                <th class="text-center">Price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end">Total Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $item->product_title }}</div>
                                        <small class="text-muted">SKU Node: #PROD-{{ $item->product_id }}</small>
                                    </td>
                                    <td class="text-center">{{ number_format($item->price, 2) }} TL</td>
                                    <td class="text-center">x{{ $item->quantity }}</td>
                                    <td class="text-end fw-bold">{{ number_format($item->total, 2) }} TL</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card invoice-card p-4">
                        <h5 class="fw-bold mb-3"><i class="fa-solid fa-truck text-orange me-2"></i> Delivery Logistics Destination</h5>
                        <p class="mb-1 text-dark fw-semibold">{{ $order->name }}</p>
                        <p class="text-secondary small mb-2"><i class="fa-regular fa-envelope me-1"></i> {{ $order->email }} | <i class="fa-solid fa-phone me-1"></i> {{ $order->phone ?? 'No Phone Provided' }}</p>
                        <div class="p-3 bg-light rounded-3 border text-dark">
                            {{ $order->address }}, {{ $order->city }} / {{ $order->country }} (ZIP: {{ $order->zip_code ?? '—' }})
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card invoice-card p-4 mb-4 bg-dark text-white">
                        <h5 class="fw-bold mb-3 text-orange">Financial Summary</h5>
                        <div class="d-flex justify-content-between small mb-2"><span>Subtotal:</span><span>{{ number_format($order->subtotal, 2) }} TL</span></div>
                        <div class="d-flex justify-content-between small mb-2"><span>Logistics Fees:</span><span>{{ number_format($order->shipping_price, 2) }} TL</span></div>
                        <hr class="border-secondary">
                        <div class="d-flex justify-content-between fw-bold fs-5 text-orange"><span>Total Bill:</span><span>{{ number_format($order->total, 2) }} TL</span></div>
                    </div>

                    <div class="card invoice-card p-4">
                        <h5 class="fw-bold mb-3">Fulfillment Status</h5>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <select name="status" class="form-select fw-semibold text-dark">
                                    @foreach($statuses as $st)
                                        <option value="{{ $st }}" {{ $order->status == $st ? 'selected' : '' }}>{{ $st }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn bg-orange text-white w-100 fw-bold rounded-3">Update Order Pipeline</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
