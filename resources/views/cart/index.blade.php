<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart | Merve Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .text-orange {
            color: #f27a1a !important;
        }
        .bg-orange {
            background-color: #f27a1a !important;
        }
        .hover-orange:hover {
            color: #f27a1a !important;
            transition: color 0.1s ease-in-out;
        }

        /* Modern Cart Cards */
        .cart-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            transition: all 0.2s ease;
        }

        .cart-item-row {
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 0;
        }
        .cart-item-row:last-child {
            border-bottom: none;
        }

        .cart-img-container {
            width: 90px;
            height: 90px;
            background-color: #ffffff;
            border-radius: 12px;
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #f1f5f9;
        }
        .cart-img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        /* Quantity Counter */
        .quantity-group {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            overflow: hidden;
            max-width: 110px;
        }
        .quantity-btn {
            background: #f8fafc;
            border: none;
            width: 32px;
            height: 32px;
            font-weight: bold;
            transition: background 0.2s;
        }
        .quantity-btn:hover {
            background: #e2e8f0;
        }
        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            font-weight: 600;
            background: transparent;
        }
        .quantity-input:focus {
            outline: none;
        }

        /* Order Summary Card */
        .summary-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            position: sticky;
            top: 100px;
        }

        .btn-checkout {
            background-color: #f27a1a;
            color: white;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            padding: 14px;
            transition: all 0.2s ease;
            width: 100%;
        }
        .btn-checkout:hover {
            background-color: #d96814;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(242, 122, 26, 0.2);
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header class="bg-white border-bottom shadow-sm sticky-top">
    <div class="bg-light py-1 border-bottom d-none d-md-block" style="font-size: 11px;">
        <div class="container d-flex justify-content-end gap-3 text-secondary">
            <a href="{{ route('my.coupons') }}" class="text-secondary text-decoration-none hover-orange">My Discount Coupons</a>
            <a href="{{ route('about.us') }}" class="text-secondary text-decoration-none hover-orange">About Us</a>
            <a href="{{ route('help.support') }}" class="text-secondary text-decoration-none hover-orange"><i class="fa-solid fa-headset me-1"></i> Help & Support</a>
        </div>
    </div>

    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-6 col-md-2">
                <a class="fs-2 fw-bolder text-dark text-decoration-none" href="{{ route('home') }}" style="letter-spacing: -1px; font-family: 'Arial Black', sans-serif;">
                    merve<span class="text-orange">shop</span>
                </a>
            </div>

            <div class="col-12 col-md-6 order-3 order-md-2 mt-2 mt-md-0">
                <div class="input-group" style="background-color: #f3f3f3; border-radius: 6px; overflow: hidden;">
                    <input type="text" class="form-control border-0 bg-transparent py-2 ps-3" placeholder="Search for products, categories or brands" style="font-size: 14px; box-shadow: none;">
                    <button class="btn bg-transparent border-0 text-orange fw-bold px-3" type="button">
                        <i class="fa-solid fa-magnifying-glass fs-5" style="color: #f27a1a;"></i>
                    </button>
                </div>
            </div>

            <div class="col-6 col-md-4 order-2 order-md-3 d-flex justify-content-end align-items-center gap-4" style="font-size: 14px;">
                @auth
                    <span class="fw-semibold text-dark"><i class="fa-regular fa-user me-2 text-secondary"></i>{{ auth()->user()->name }}</span>
                @else
                    <a href="{{ route('login') }}" class="text-dark text-decoration-none fw-semibold hover-orange">Log In</a>
                @endauth

                <a href="{{ route('my.favorites') }}" class="text-dark text-decoration-none fw-semibold hover-orange">
                    <i class="fa-regular fa-heart me-2 text-secondary"></i>My Favorites
                </a>

                <a href="{{ route('cart.index') }}" class="text-orange text-decoration-none fw-semibold position-relative">
                    <i class="fa-solid fa-cart-shopping me-2"></i>My Cart
                </a>
            </div>
        </div>
    </div>
</header>

<div class="container mt-5 mb-5">
    <h3 class="fw-bold text-dark mb-4"><i class="fa-solid fa-bag-shopping text-orange me-2"></i> My Cart</h3>

    @if(session('cart') && count(session('cart')) > 0)
        <div class="row g-4">
            <!--SEPETTEKİ ÜRÜNLER-->
            <div class="col-12 col-lg-8">
                <div class="card cart-card p-4">
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $id => $details)
                        @php
                            // 🌟 GÜVENLİ KONTROL: discount_rate dizide yoksa varsayılan olarak 0 al
                            $discountRate = $details['discount_rate'] ?? 0;
                            $itemPrice = $details['price'] * (1 - $discountRate / 100);
                            $total += $itemPrice * $details['quantity'];
                        @endphp

                        <div class="row align-items-center cart-item-row" id="cart-item-{{ $id }}">
                            <!-- Ürün Görseli -->
                            <div class="col-3 col-sm-2">
                                <div class="cart-img-container">
                                    <!-- 🌟 GÜVENLİ KONTROL: image anahtarı var mı ve içi dolu mu? -->
                                    @if(isset($details['image']) && $details['image'])
                                        <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}">
                                    @else
                                        <i class="fa-solid fa-box-open text-muted fs-3"></i>
                                    @endif
                                </div>
                            </div>

                            <!-- Ürün Detayları -->
                            <div class="col-9 col-sm-4 mt-2 mt-sm-0">
                                <h6 class="fw-bold mb-1 text-dark">{{ $details['name'] }}</h6>
                                <!-- 🌟 GÜVENLİ KONTROL: category_name yoksa 'General' yaz -->
                                <p class="text-muted small mb-0">Category: {{ $details['category_name'] ?? 'General' }}</p>
                            </div>

                            <!-- Adet Kontrolü -->
                            <div class="col-6 col-sm-3 mt-3 mt-sm-0">
                                <div class="d-flex quantity-group align-items-center">
                                    <button class="quantity-btn" onclick="changeQuantity('{{ $id }}', -1)">-</button>
                                    <input type="text" class="quantity-input" id="qty-{{ $id }}" value="{{ $details['quantity'] }}" readonly>
                                    <button class="quantity-btn" onclick="changeQuantity('{{ $id }}', 1)">+</button>
                                </div>
                            </div>

                            <!-- Fiyat ve Silme Butonu -->
                            <div class="col-6 col-sm-3 text-end mt-3 mt-sm-0">
                                <div class="fw-bold text-dark mb-1" style="font-size: 1.1rem;">
                                    {{ number_format($itemPrice * $details['quantity'], 2) }} TL
                                </div>

                                <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item from your cart?')">
                                    @csrf
                                    <button type="submit" class="btn btn-link text-danger text-decoration-none small p-0">
                                        <i class="fa-regular fa-trash-can me-1"></i> Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- SİPARİŞ ÖZETİ-->
            <div class="col-12 col-lg-4">
                <div class="card summary-card p-4">
                    <h5 class="fw-bold text-dark mb-4">Order Summary</h5>

                    <div class="d-flex justify-content-between mb-2 text-secondary">
                        <span>Subtotal</span>
                        <span class="fw-semibold text-dark">{{ number_format($total, 2) }} TL</span>
                    </div>

                    <div class="d-flex justify-content-between mb-3 text-secondary">
                        <span>Shipping</span>
                        <span class="text-success fw-semibold"><i class="fa-solid fa-truck-fast me-1"></i> Free Shipping</span>
                    </div>

                    <hr class="text-muted">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="fw-bold text-dark fs-5">Total</span>
                        <span class="fw-bold text-orange fs-4">{{ number_format($total, 2) }} TL</span>
                    </div>

                    <a href="{{ route('cart.checkout') }}" class="btn btn-checkout py-3 d-block text-center text-decoration-none">
                        <i class="fa-solid fa-credit-card me-2"></i> Proceed to Checkout
                    </a>

                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}" class="text-secondary text-decoration-none small hover-orange">
                            <i class="fa-solid fa-arrow-left me-1"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!--SEPET BOŞ EKRANI-->
        <div class="card cart-card p-5 text-center">
            <div class="text-muted mb-4">
                <i class="fa-solid fa-cart-arrow-down" style="font-size: 5rem; color: #cbd5e1;"></i>
            </div>
            <h4 class="fw-bold text-dark mb-2">Your Cart is Currently Empty</h4>
            <p class="text-secondary mb-4">Looks like you haven't added any products to your cart yet.</p>
            <div class="d-flex justify-content-center">
                <a href="{{ route('home') }}" class="btn btn-checkout px-5 py-2" style="max-width: 300px;">
                    <i class="fa-solid fa-house me-2"></i> Explore Products
                </a>
            </div>
        </div>
    @endif
</div>

<footer class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-1 fw-bold">merve<span style="color: #f27a1a;">shop</span> © 2026</p>
        <small class="text-muted">Merve Shop is at your service with its modern e-commerce structure.</small>
    </div>
</footer>

<script>
    // Mevcut changeQuantity fonksiyonun burada durmaya devam ediyor...
    function changeQuantity(id, amount) {
        // ... (eski kodlar aynen duruyor) ...
        if (amount === 1) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/cart/add/${id}`;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            document.body.appendChild(form);
            form.submit();
        } else if (amount === -1) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/cart/remove/${id}`;
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = 'decrease';
            form.appendChild(actionInput);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // 🌟 YENİ: Laravel'den Gelen Mesajları Yakalayan Pop-up Motoru
    document.addEventListener('DOMContentLoaded', function () {
        // Eğer stok hatası veya başka bir hata (error) geldiyse
        @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '{{ session('error') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            background: '#fff',
            iconColor: '#dc3545'
        });
        @endif

        // Eğer başarılı (success) bir işlem olduysa
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#fff',
            iconColor: '#f27a1a' // Merve Shop Turuncusu
        });
        @endif
    });
</script>

</body>
</html>
