<!DOCTYPE html>
<html lang="en">
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

        /* Merve Shop Header Color and Transition Settings */
        .text-orange {
            color: #f27a1a !important;
        }
        .border-orange {
            border-color: #f27a1a !important;
        }
        .hover-orange:hover {
            color: #f27a1a !important;
            transition: color 0.1s ease-in-out;
        }

        /* Slider Settings */
        .carousel-item img {
            height: 400px;
            object-fit: cover;
            border-radius: 16px;
        }

        /* Modern Product Cards */
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

        .hide-product-card {
            display: none !important;
        }

        #promoSlider .carousel-control-prev {
            left: -50px !important;
        }

        #promoSlider .carousel-control-next {
            right: -50px !important;
        }

        #promoSlider .carousel-control-prev-icon,
        #promoSlider .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.3);
            padding: 20px;
            border-radius: 50%;
            background-size: 50%;
        }
    </style>
</head>
<body>

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
                    <div class="dropdown">
                        <a class="text-dark text-decoration-none fw-semibold dropdown-toggle btn btn-light btn-sm px-2" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="fa-regular fa-user me-2 fs-5 text-secondary"></i>My Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                            <li class="px-3 py-1 text-muted small">Hello, {{ auth()->user()->name }}</li>
                            @if(auth()->user()->hasRole('admin'))
                                <li><a class="dropdown-item fw-bold text-primary" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-sliders me-2"></i>Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i>Log Out</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-dark text-decoration-none fw-semibold hover-orange">
                        <i class="fa-regular fa-user me-2 fs-5 text-secondary"></i>Log In
                    </a>
                @endauth

                <a href="{{ route('my.favorites') }}" class="text-dark text-decoration-none fw-semibold hover-orange d-none d-sm-inline">
                    <i class="fa-regular fa-heart me-2 fs-5 text-secondary"></i>My Favorites
                </a>

                <a href="{{ route('cart.index') }}" class="text-dark text-decoration-none fw-semibold hover-orange position-relative">
                    <i class="fa-solid fa-cart-shopping me-2 fs-5 text-secondary"></i>My Cart
                    @if(session('cart') && count(session('cart')) > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 10px; padding: 3px 6px;">
                            {{ array_sum(array_column(session('cart'), 'quantity')) }}
                        </span>
                    @endif
                </a>

            </div>
        </div>
    </div>

    <div class="border-top d-none d-lg-block">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center fw-bold text-secondary py-2 gap-4" style="font-size: 13px;">

                <a href="#" class="text-dark text-decoration-none hover-orange category-filter-btn" onclick="filterProducts('all', this)">
                    All Products
                </a>

                @foreach($categories as $category)
                    <a href="#" class="text-dark text-decoration-none hover-orange category-filter-btn" onclick="filterProducts('cat-{{ $category->id }}', this)">
                        {{ $category->name }}
                    </a>
                @endforeach

                <a href="#" class="text-dark text-decoration-none hover-orange category-filter-btn" onclick="filterProducts('flash', this)">
                    Flash Products <span class="badge bg-danger ms-1" style="font-size: 9px; padding: 2px 4px;">New</span>
                </a>

                <a href="#" class="text-dark text-decoration-none hover-orange category-filter-btn" onclick="filterProducts('best', this)">
                    Best Sellers <span class="badge bg-danger ms-1" style="font-size: 9px; padding: 2px 4px;">New</span>
                </a>

            </div>
        </div>
    </div>

</header>

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
            <button type="button" data-bs-target="#promoSlider" data-bs-slide-to="3"></button> <!-- Yeni eklenen 4. nokta -->
        </div>
        <div class="carousel-inner text-white">

            <!--13-17 Haziran Babalar Günü-->
            <div class="carousel-item active">
                <img src="{{ asset('uploads/sliders/fathers-day-brand-days.png') }}" class="d-block w-100" alt="Father's Day Brand Days">
            </div>

            <div class="carousel-item">
                <img src="{{ asset('uploads/sliders/sale-banner.jpg') }}" class="d-block w-100" alt="Season Sale">
                <div class="carousel-caption d-none d-md-block text-start bg-dark bg-opacity-50 p-4 rounded-3" style="max-width: 450px; bottom: 40px; left: 40px;">
                    <span class="badge bg-danger mb-2 fs-6">AN OPPORTUNITY NOT TO BE MISSED</span>
                    <h3 class="fw-bold">The Big Season Sale Has Begun!</h3>
                    <p>Discover massive discounts of up to 50% on select products across all categories.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1200&auto=format&fit=crop" class="d-block w-100" alt="Technology Days">
                <div class="carousel-caption d-none d-md-block text-start bg-dark bg-opacity-50 p-4 rounded-3" style="max-width: 450px; bottom: 40px; left: 40px;">
                    <span class="badge bg-warning text-dark mb-2 fs-6">TECHNOLOGY DAYS</span>
                    <h3 class="fw-bold">The Technology of the Future is Here</h3>
                    <p>The latest generation of headphones, smart devices, and accessories with interest-free installment options.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="{{ asset('uploads/sliders/summer-season.jpg') }}" class="d-block w-100" alt="Summer">
                <div class="carousel-caption d-none d-md-block text-start bg-dark bg-opacity-50 p-4 rounded-3" style="max-width: 450px; bottom: 40px; left: 40px;">
                    <span class="badge bg-success mb-2 fs-6">NEW SEASON</span>
                    <h3 class="fw-bold">Show your style.</h3>
                    <p>The trendiest summer style outfits and combinations are delivered to your door with Merve Shop quality.</p>
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
        <h4 class="fw-bold text-dark mb-4"><i class="fa-solid fa-fire text-danger me-2"></i> Our Selections for You</h4>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @forelse($products as $product)
                <div class="col product-item-card"
                     data-category="cat-{{ $product->category_id }}"
                     data-discount="{{ $product->discount_rate }}"
                     data-stock="{{ $product->stock }}">

                    <div class="card product-card p-2">
                        <a href="{{ route('product.detail', $product) }}" class="text-decoration-none">
                            <div class="product-img-container">
                                @if($product->discount_rate > 0)
                                    <span class="badge badge-discount bg-danger text-white position-absolute" style="top: 10px; left: 10px; z-index: 10;">
                                        %{{ $product->discount_rate }} Discount
                                    </span>
                                @endif

                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                                @else
                                    @if(str_contains(strtolower($product->category->name ?? ''), 'elektronik'))
                                        <i class="fa-solid fa-headphones product-img-placeholder"></i>
                                    @else
                                        <i class="fa-solid fa-box-open product-img-placeholder"></i>
                                    @endif
                                @endif
                            </div>
                        </a>

                        <div class="card-body px-1 py-3 d-flex flex-column justify-content-between flex-grow-1">
                            <div>
                                <span class="text-muted small fw-bold text-uppercase">{{ $product->category->name ?? 'General' }}</span>
                                <a href="{{ route('product.detail', $product) }}" class="text-decoration-none text-dark">
                                    <h5 class="product-title mt-1 mb-2" title="{{ $product->name }}">
                                        <strong>{{ $product->name }}</strong> {{ $product->description }}
                                    </h5>
                                </a>

                                <div class="mb-2">
                                    @if($product->stock > 5)
                                        <span class="badge bg-light text-success border border-success-subtle"><i class="fa-solid fa-check me-1"></i> In Stock ({{ $product->stock }})</span>
                                    @elseif($product->stock > 0)
                                        <span class="badge bg-light text-warning border border-warning-subtle"><i class="fa-solid fa-triangle-exclamation me-1"></i> Only {{ $product->stock }} Left!</span>
                                    @else
                                        <span class="badge bg-light text-danger border border-danger-subtle"><i class="fa-solid fa-xmark me-1"></i> Out of Stock</span>
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

                                <div class="d-flex gap-2">
                                    @if($product->stock > 0)
                                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-grow-1">
                                            @csrf
                                            <button type="submit" class="btn btn-add-to-cart py-2 fs-6 w-100">
                                                <i class="fa-solid fa-cart-plus me-1"></i> Add
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary py-2 text-white fw-semibold flex-grow-1" disabled style="border-radius: 8px; font-size: 0.9rem;">
                                            Out of Stock
                                        </button>
                                    @endif

                                    <button class="btn btn-outline-danger py-2 px-3 wishlist-btn" style="border-radius: 8px;" onclick="toggleWishlist(this)">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div> </div> @empty
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
<script>
    function toggleWishlist(button) {
        const isLoggedIn = @json(auth()->check());

        if (!isLoggedIn) {
            alert("Please log in to add products to your favorites.");
            return;
        }

        const icon = button.querySelector('i');
        if (icon.classList.contains('fa-regular')) {
            icon.classList.remove('fa-regular', 'fa-heart');
            icon.classList.add('fa-solid', 'fa-heart');
            button.style.backgroundColor = '#fff0f0';
            button.style.borderColor = '#ff4d4f';
        } else {
            icon.classList.remove('fa-solid', 'fa-heart');
            icon.classList.add('fa-regular', 'fa-heart');
            button.style.backgroundColor = '';
            button.style.borderColor = '';
        }
    }

    function filterProducts(filterType, element) {
        document.querySelectorAll('.category-filter-btn').forEach(btn => {
            btn.classList.remove('text-orange', 'border-bottom', 'border-2', 'border-orange', 'pb-2');
        });
        element.classList.add('text-orange', 'border-bottom', 'border-2', 'border-orange', 'pb-2');

        const products = document.querySelectorAll('.product-item-card');

        products.forEach(product => {
            const productCat = product.getAttribute('data-category');
            const productDiscount = parseFloat(product.getAttribute('data-discount')) || 0;
            const productStock = parseInt(product.getAttribute('data-stock')) || 0;

            let shouldShow = false;

            if (filterType === 'all') {
                shouldShow = true;
            }
            else if (filterType === 'flash') {
                if (productDiscount >= 20) shouldShow = true;
            }
            else if (filterType === 'best') {
                if (productStock > 5) shouldShow = true;
            }
            else {
                if (productCat === filterType) shouldShow = true;
            }

            // 🌟 CSS sınıfını tetikleyerek jilet gibi yan yana dizilimi koruyoruz
            if (shouldShow) {
                product.classList.remove('hide-product-card');
            } else {
                product.classList.add('hide-product-card');
            }
        });
    }
</script>
</body>
</html>
