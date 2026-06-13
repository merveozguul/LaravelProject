<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | Secure Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f5f7; font-family: 'Segoe UI', sans-serif; }
        .text-orange { color: #f27a1a !important; }
        .bg-orange { background-color: #f27a1a !important; }
        .btn-orange {
            background-color: #f27a1a !important;
            color: white !important;
            font-weight: 600;
            border-radius: 10px;
            transition: all 0.2s ease;
        }
        .btn-orange:hover {
            background-color: #d96614 !important;
            box-shadow: 0 4px 12px rgba(242, 122, 26, 0.2);
        }
        .checkout-card { background: #ffffff; border: none; border-radius: 16px; box-shadow: 0 4px 10px rgba(0,0,0,0.01); }
        .form-control, .form-select { border-radius: 8px; padding: 12px; border: 1px solid #e2e8f0; }
        .form-control:focus, .form-select:focus { border-color: #f27a1a; box-shadow: 0 0 0 3px rgba(242, 122, 26, 0.15); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark py-3 mb-5">
    <div class="container">
        <a class="navbar-brand fw-bolder fs-3" href="{{ route('home') }}">
            merve<span class="text-orange">shop</span>
        </a>
        <span class="badge bg-orange px-3 py-2 rounded-3"><i class="fa-solid fa-lock me-1"></i> SECURE GATEWAY</span>
    </div>
</nav>

<div class="container mb-5">

    @if(session('error'))
        <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
            <i class="fa-solid fa-circle-exclamation me-2"></i> {{ session('error') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card checkout-card p-4 p-md-5">
                <h4 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-truck-fast text-orange me-2"></i>Shipping & Billing Address</h4>

                <form action="{{ route('cart.placeOrder') }}" method="POST" id="checkoutForm">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold text-secondary small">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold text-secondary small">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="e.g. +905..." required>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold text-secondary small">Detailed Street Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Apartment, suite, unit, building, floor, etc." required></textarea>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-secondary small">City</label>
                            <input type="text" name="city" class="form-control" placeholder="e.g. Istanbul" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-secondary small">Country</label>
                            <input type="text" name="country" class="form-control" value="Turkey" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold text-secondary small">Zip Code</label>
                            <input type="text" name="zip_code" class="form-control" placeholder="e.g. 34000">
                        </div>
                    </div>

                    <input type="hidden" name="shipping_method" value="Standard Shipping">
                    <input type="hidden" name="payment_method" value="Cash / Bank Transfer">

                    <button type="submit" class="btn btn-orange w-100 py-3 fw-bold mt-4 fs-5 shadow-sm">
                        <i class="fa-solid fa-shield-halved me-2"></i>Complete Order & Pay
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card checkout-card p-4 bg-white">
                <h5 class="fw-bold mb-4 text-dark"><i class="fa-solid fa-basket-shopping text-orange me-2"></i>Order Summary</h5>

                <div class="d-flex flex-column gap-3 mb-4">
                    @foreach($cartItems as $id => $item)
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-bold text-dark">{{ $item['name'] }}</span>
                                <small class="text-muted d-block">Qty: {{ $item['quantity'] }}</small>
                            </div>
                            <span class="fw-semibold text-dark">{{ number_format($item['price'] * $item['quantity'], 2) }} TL</span>
                        </div>
                    @endforeach
                </div>

                <hr class="border-secondary opacity-20">

                <div class="d-flex justify-content-between small text-secondary mb-2">
                    <span>Subtotal</span>
                    <span>{{ number_format($subtotal, 2) }} TL</span>
                </div>
                <div class="d-flex justify-content-between small text-secondary mb-3">
                    <span>Shipping Logistics</span>
                    <span class="text-success fw-bold">FREE</span>
                </div>

                <hr class="border-secondary opacity-20">

                <div class="d-flex justify-content-between align-items-center fw-bold fs-5 text-dark">
                    <span>Total Bill:</span>
                    <span class="text-orange">{{ number_format($total, 2) }} TL</span>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Form gönderilirken donma olmaması için butona tıklanınca yükleniyor efekti veriyoruz
    document.getElementById('checkoutForm').addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i>Processing Secure Gateway...';
        btn.disabled = true;
    });
</script>
</body>
</html>
