<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | The Address for Reliable Shopping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background-color: #ffffff !important;
            border-bottom: 1px solid #e2e8f0;
        }
        .navbar-brand {
            font-weight: 800;
            letter-spacing: -1px;
            color: #f27a1a !important;
        }
        /* Slider Ayarları */
        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 16px;
        }
        /* Kategori Butonları */
        .category-badge {
            background-color: #ffffff;
            color: #4a5568;
            border: 1px solid #e2e8f0;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }
        .category-badge:hover, .category-badge.active {
            background-color: #f27a1a;
            color: #ffffff;
            border-color: #f27a1a;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(242, 122, 26, 0.2);
        }
        /* Modern Ürün Kartları */
        .product-card {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        }

        .product-img-container {
            position: relative;
            background-color: #ffffff !important;
            border-radius: 12px 12px 0 0;
            height: 320px;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            overflow: hidden;
            padding: 10px;
        }

        .product-img-container img {
            width: 100% !important;
            height: 100% !important;
            object-fit: contain !important;
        }
        .product-img-placeholder {
            font-size: 4rem;
            color: #cbd5e1;
        }
        .badge-discount {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: #ff4d4f;
            color: white;
            padding: 4px 8px;
            font-size: 0.75rem;
            font-weight: 700;
            border-radius: 4px;
        }
        .product-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: #1e293b;
            line-height: 1.4;
            height: 40px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .product-price {
            font-size: 1.25rem;
            font-weight: 700;
            color: #f27a1a;
        }
        .btn-add-to-cart {
            background-color: #ffffff;
            border: 1px solid #f27a1a;
            color: #f27a1a;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
            width: 100%;
        }
        .btn-add-to-cart:hover {
            background-color: #f27a1a;
            color: #ffffff;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top shadow-sm py-3">
    <div class="container">
        <a class="navbar-brand fs-3" href="{{ route('home') }}"><i class="fa-solid fa-bag-shopping me-2"></i>merve<span style="color: #1e293b;">shop</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="d-flex mx-auto w-50 d-none d-lg-flex">
                <div class="input-group">
                    <input type="text" class="form-control border-end-0 bg-light" placeholder="Enter the product, category, or brand you are looking for..." style="border-radius: 8px 0 0 8px;">
                    <button class="btn btn-light border border-start-0 text-muted" type="button" style="border-radius: 0 8px 8px 0;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </form>

            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item me-3">
                    <a class="nav-link position-relative fw-semibold text-dark fs-5" href="{{ route('cart.index') }}">
                        <i class="fa-solid fa-cart-shopping text-muted me-1"></i> Shopping Cart
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.7rem;">
                                {{ array_sum(array_column(session('cart'), 'quantity')) }}
                            </span>
                        @endif
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold text-dark btn btn-light px-3" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-user me-1"></i> {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            @if(auth()->user()->hasRole('admin'))
                                <li><a class="dropdown-menu-item dropdown-item fw-bold text-primary" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-sliders me-2"></i>Admin Paneli</a></li>
                                <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Çıkış Yap</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="btn btn-outline-dark fw-semibold px-4 me-2" href="{{ route('login') }}" style="border-radius: 8px;">Giriş Yap</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-orange text-white fw-semibold px-4" href="{{ route('register') }}" style="background-color: #f27a1a; border-radius: 8px;">Üye Ol</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show shadow-sm border-0" role="alert">
            🎉 {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif
@if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show shadow-sm border-0" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif

<div class="container mt-4">
    <div id="promoSlider" class="carousel slide shadow-sm mb-5" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#promoSlider" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#promoSlider" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#promoSlider" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner text-white">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?q=80&w=1200&auto=format&fit=crop" class="d-block w-100" alt="Büyük Yaz İndirimi">
                <div class="carousel-caption d-none d-md-block text-start bg-dark bg-opacity-50 p-4 rounded-3" style="max-width: 450px; bottom: 40px; left: 40px;">
                    <span class="badge bg-danger mb-2 fs-6">AN OPPORTUNITY NOT TO BE MISSED</span>
                    <h3 class="fw-bold">The Big Season Sale Has Begun!</h3>
                    <p>Discover massive discounts of up to 50% on select products across all categories.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop" class="d-block w-100" alt="Elektronik Fırsatları">
                <div class="carousel-caption d-none d-md-block text-start bg-dark bg-opacity-50 p-4 rounded-3" style="max-width: 450px; bottom: 40px; left: 40px;">
                    <span class="badge bg-warning text-dark mb-2 fs-6">TECHNOLOGY DAYS</span>
                    <h3 class="fw-bold">The Technology of the Future is Here</h3>
                    <p>The latest generation of headphones, smart devices, and accessories with interest-free installment options.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?q=80&w=1200&auto=format&fit=crop" class="d-block w-100" alt="Moda Trendleri">
                <div class="carousel-caption d-none d-md-block text-start bg-dark bg-opacity-50 p-4 rounded-3" style="max-width: 450px; bottom: 40px; left: 40px;">
                    <span class="badge bg-success mb-2 fs-6">NEW SEASON</span>
                    <h3 class="fw-bold">Show your style.</h3>
                    <p>The trendiest street style outfits and combinations are delivered to your door with Merve Shop quality.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#promoSlider" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#promoSlider" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="mb-5">
        <h4 class="fw-bold text-dark mb-3"><i class="fa-solid fa-border-all text-muted me-2"></i> Explore the Category</h4>
        <div class="d-flex flex-wrap gap-2">
            <a href="#" class="category-badge active">All Products</a>
            @foreach($categories as $category)
                <a href="#" class="category-badge">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <div class="mb-5">
        <h4 class="fw-bold text-dark mb-4"><i class="fa-solid fa-fire text-danger me-2"></i> Our Selections for You</h4>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse($products as $product)
                <div class="col">
                    <div class="card product-card p-2">
                        <div class="product-img-container">
                            @if($product->discount_rate > 0)
                                <span class="badge badge-discount bg-danger text-white position-absolute" style="top: 10px; left: 10px; z-index: 10;">
                                    %{{ $product->discount_rate }} Discount
                                </span>
                            @endif

                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <!-- Eğer resim hiç yüklenmediyse şık ikonlarımız devreye giriyor -->
                                @if(str_contains(strtolower($product->category->name ?? ''), 'elektronik'))
                                    <i class="fa-solid fa-headphones product-img-placeholder"></i>
                                @else
                                    <i class="fa-solid fa-box-open product-img-placeholder"></i>
                                @endif
                            @endif
                        </div>

                        <div class="card-body px-1 py-3 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <span class="text-muted small fw-bold text-uppercase">{{ $product->category->name ?? 'Genel' }}</span>
                                <h5 class="product-title mt-1 mb-2" title="{{ $product->name }}">
                                    <strong>{{ $product->name }}</strong> {{ $product->description }}
                                </h5>

                                <div class="mb-2">
                                    @if($product->stock > 5)
                                        <span class="badge bg-light text-success border border-success-subtle"><i class="fa-solid fa-check me-1"></i> Stokta Var ({{ $product->stock }})</span>
                                    @elseif($product->stock > 0)
                                        <span class="badge bg-light text-warning border border-warning-subtle"><i class="fa-solid fa-triangle-exclamation me-1"></i> Son {{ $product->stock }} Ürün!</span>
                                    @else
                                        <span class="badge bg-light text-danger border border-danger-subtle"><i class="fa-solid fa-xmark me-1"></i> Tükendi</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mt-2">
                                <div class="mb-2">
                                    @if($product->discount_rate > 0)
                                        <span class="text-muted text-decoration-line-through small me-2">
                                            {{ number_format($product->price, 2) }} TL
                                        </span>

                                        <span class="product-price fw-bold" style="color: #f27a1a; font-size: 1.3rem;">
                                            {{ number_format($product->price * (1 - $product->discount_rate / 100), 2) }} TL
                                        </span>
                                    @else
                                        <span class="product-price fw-bold text-dark" style="font-size: 1.25rem;">
                                            {{ number_format($product->price, 2) }} TL
                                        </span>
                                    @endif
                                </div>

                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-add-to-cart py-2 fs-6">
                                            <i class="fa-solid fa-cart-plus me-2"></i> Add to Cart
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary py-2 w-100 text-white fw-semibold" disabled style="border-radius: 8px;">
                                        <i class="fa-solid fa-ban me-2"></i> Out of Stock
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="text-muted fs-3 mb-2"> Our store is still empty.</div>
                    <p class="text-secondary">You can add new products right from the admin panel!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<footer class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-1 fw-bold">merve<span style="color: #f27a1a;">shop</span> © 2026</p>
        <small class="text-muted">Merve Shop is at your service with its modern e-commerce structure.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
