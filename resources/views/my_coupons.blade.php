<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Discount Coupons | Merve Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
        }
        .text-orange { color: #f27a1a !important; }
        .bg-orange { background-color: #f27a1a !important; }

        /* Dashed Coupon Design style */
        .coupon-card {
            background: #fff;
            border: 2px dashed #e2e8f0;
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.2s ease;
            position: relative;
        }
        .coupon-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            border-color: #f27a1a;
        }
        .coupon-left {
            background: linear-gradient(135deg, #f27a1a, #ff9233);
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px 20px;
            font-weight: bold;
            min-width: 140px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white border-bottom py-3 sticky-top">
    <div class="container">
        <a class="fs-2 fw-bolder text-dark text-decoration-none" href="{{ route('home') }}" style="letter-spacing: -1px; font-family: 'Arial Black', sans-serif;">
            merve<span class="text-orange">shop</span><span class="text-secondary" style="font-family: 'Segoe UI'; font-size: 1.1rem; font-weight: bold;"> Coupon Wallet</span>
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Back to Shopping</a>
    </div>
</nav>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">

            <div class="d-flex align-items-center justify-content-between mb-4">
                <h4 class="fw-bold mb-0"><i class="fa-solid fa-ticket text-orange me-2"></i> Available Coupons (2)</h4>
                <span class="badge bg-dark px-3 py-2 rounded-pill">Active User: {{ auth()->user()->name }}</span>
            </div>

            <!-- COUPON 1: THE ELITE WELCOME COUPON -->
            <div class="card coupon-card mb-4">
                <div class="d-flex flex-column flex-sm-row">
                    <div class="coupon-left text-center">
                        <div class="fs-3">500 TL</div>
                        <div class="small text-white-50">DISCOUNT</div>
                    </div>
                    <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-danger mb-2">Special Gift</span>
                            <h5 class="fw-bold mb-1">Elite Membership Welcome Reward</h5>
                            <p class="text-muted small mb-0">Valid on all Merve Shop purchases over 2,000 TL. Experience the premium privilege.</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top">
                            <span class="text-secondary small"><i class="fa-regular fa-clock me-1"></i> Expires: 31 Dec 2026</span>
                            <button class="btn btn-sm btn-light border fw-bold px-3 text-orange" onclick="alert('Coupon code copied: ELITE500')">Code: ELITE500</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COUPON 2: FREE SHIPPING COUPON -->
            <div class="card coupon-card mb-4">
                <div class="d-flex flex-column flex-sm-row">
                    <div class="coupon-left text-center" style="background: linear-gradient(135deg, #10b981, #34d399);">
                        <div class="fs-4">FREE</div>
                        <div class="small text-white-50">SHIPPING</div>
                    </div>
                    <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                        <div>
                            <span class="badge bg-success mb-2">New Season Campaign</span>
                            <h5 class="fw-bold mb-1">Free Delivery on Your Next Clothes Purchase</h5>
                            <p class="text-muted small mb-0">Applicable to categories under Fashion & Wear. No minimum cart limit required.</p>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3 pt-2 border-top">
                            <span class="text-secondary small"><i class="fa-regular fa-clock me-1"></i> Expires: 30 Jun 2026</span>
                            <button class="btn btn-sm btn-light border fw-bold px-3 text-success" onclick="alert('Coupon code copied: FREESHIP')">Code: FREESHIP</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<footer class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-1 fw-bold">merve<span class="text-orange">shop</span> © 2026</p>
        <small class="text-muted">Secure Coupon Hub protected via Laravel Cryptography.</small>
    </div>
</footer>

</body>
</html>
