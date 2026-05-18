<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | E-Ticaret</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-card { transition: transform 0.2s; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">🛒 Merve Shop</a>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('home') }}">Ana Sayfa</a>
                </li>

                <li class="nav-item">
                    @php
                        $totalQuantity = 0;
                        if(session('cart')) {
                            foreach(session('cart') as $item) {
                                $totalQuantity += $item['quantity'];
                            }
                        }
                    @endphp
                    <a class="nav-link btn btn-sm btn-outline-info text-white px-3 ms-2" href="{{ route('cart.index') }}">
                        🛒 Sepetim (<span class="fw-bold">{{ $totalQuantity }}</span>)
                    </a>
                </li>

                @if (Route::has('login'))
                    @auth
                        <li class="nav-item">
                            <a class="nav-link text-info" href="{{ url('/dashboard') }}">👤 Hesabım</a>
                        </li>
                        @if(Auth::user()->hasRole('admin'))
                            <li class="nav-item">
                                <a class="btn btn-sm btn-warning ms-2" href="{{ route('admin.dashboard') }}">⚙ Admin Panel</a>
                            </li>
                        @endif
                        <li class="nav-item ms-2">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">Çıkış</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Giriş Yap</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Kayıt Ol</a>
                        </li>
                    @endauth
                @endif
            </ul>
        </div>
    </div>
</nav>

@if(session('success'))
    <div class="container mt-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

@if(session('error'))
    <div class="container mt-3">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
@endif

<header class="bg-primary text-white text-center py-5 mb-5 shadow-sm">
    <div class="container">
        <h1 class="display-4 fw-bold">Hoş Geldiniz!</h1>
        <p class="lead">En kaliteli ürünler, en avantajlı fiyatlarla burada.</p>
    </div>
</header>

<div class="container mb-5">
    <h2 class="mb-4 fw-bold">✨ Öne Çıkan Ürünler</h2>

    <div class="row">
        @forelse($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 product-card shadow-sm border-0">
                    <img src="https://via.placeholder.com/300x200?text={{ urlencode($product->name) }}" class="card-img-top" alt="{{ $product->name }}">

                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-secondary mb-2 align-self-start">{{ $product->category->name }}</span>
                        <h5 class="card-title fw-bold text-dark mb-1">{{ $product->name }}</h5>
                        <p class="card-text text-muted small mb-3">{{ Str::limit($product->description, 60, '...') }}</p>

                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-bold text-primary">{{ number_format($product->price, 2) }} TL</span>
                            <span class="text-muted small">Stok: {{ $product->stock }}</span>
                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-0 p-3 pt-0">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 fw-bold">🛒 Sepete Ekle</button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <h3>Henüz mağazaya hiçbir ürün eklenmemiş.</h3>
            </div>
        @endforelse
    </div>
</div>

<footer class="py-4 bg-dark text-white-50 text-center mt-5">
    <div class="container">
        <small>&copy; 2026 Merve Shop. Tüm Hakları Saklıdır.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
