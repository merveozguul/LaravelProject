<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favorites | Merve Shop</title>
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

        .fav-card {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            transition: all 0.2s ease;
            position: relative;
        }
        .fav-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .fav-img-container {
            height: 240px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            padding: 10px;
            border-radius: 12px 12px 0 0;
            overflow: hidden;
        }
        .fav-img-container img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        .btn-remove-fav {
            position: absolute;
            top: 10px;
            right: 10px;
            background: white;
            border: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            color: #ff4d4f;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white border-bottom py-3 sticky-top">
    <div class="container">
        <a class="fs-2 fw-bolder text-dark text-decoration-none" href="{{ route('home') }}" style="letter-spacing: -1px; font-family: 'Arial Black', sans-serif;">
            merve<span class="text-orange">shop</span><span class="text-secondary" style="font-family: 'Segoe UI'; font-size: 1.1rem; font-weight: bold;"> My Favorites</span>
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Back to Feed</a>
    </div>
</nav>

<div class="container my-5">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="fw-bold mb-0"><i class="fa-solid fa-heart text-danger me-2"></i> My Wishlist ({{ count($products) }})</h4>
        <span class="badge bg-dark px-3 py-2 rounded-pill">User: {{ auth()->user()->name }}</span>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
        @forelse($products as $product)
            <div class="col">
                <div class="card fav-card p-2 h-100 d-flex flex-column justify-content-between">

                    <!-- Ürünü favorilerden silme butonu (Dolu Kalp) -->
                    <button class="btn-remove-fav" onclick="removeFavoriteCard(this)">
                        <i class="fa-solid fa-heart"></i>
                    </button>

                    <div>
                        <div class="fav-img-container">
                            @if($product->image)
                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                            @else
                                <i class="fa-solid fa-box-open text-muted fs-1"></i>
                            @endif
                        </div>

                        <div class="p-2">
                            <span class="text-muted small fw-bold text-uppercase">{{ $product->category->name ?? 'General' }}</span>
                            <h6 class="fw-bold text-dark text-truncate mt-1 mb-2">{{ $product->name }}</h6>

                            <div class="mb-2">
                                @if($product->discount_rate > 0)
                                    <span class="text-muted text-decoration-line-through small me-2">{{ number_format($product->price, 2) }} TL</span>
                                    <span class="fw-bold text-orange">{{ number_format($product->price * (1 - $product->discount_rate / 100), 2) }} TL</span>

                                @else
                                    <span class="fw-bold text-dark">{{ number_format($product->price, 2) }} TL</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="p-2">
                        @if($product->stock > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-warning text-orange border-orange w-100 fw-bold btn-sm py-2" style="background: transparent; border-radius: 8px;">
                                    <i class="fa-solid fa-cart-shopping me-2"></i> Add to Cart
                                </button>
                            </form>
                        @else
                            <button class="btn btn-secondary btn-sm py-2 w-100 text-white fw-semibold" disabled style="border-radius: 8px;">
                                Out of Stock
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="fa-regular fa-heart text-muted mb-3" style="font-size: 4rem;"></i>
                <div class="text-muted fs-4">Your wishlist is empty.</div>
                <p class="text-secondary">Explore products and tap the heart icon to save them here!</p>
                <a href="{{ route('home') }}" class="btn bg-orange text-white px-4 fw-bold mt-2" style="border-radius: 20px;">Start Exploring</a>
            </div>
        @endforelse
    </div>
</div>

<footer class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-1 fw-bold">merve<span class="text-orange">shop</span> © 2026</p>
        <small class="text-muted">Personalized Wishlist Secure Hub.</small>
    </div>
</footer>

<script>
    function removeFavoriteCard(button) {
        // Önce kullanıcıya o bildirim uyarısını gösterelim
        alert('Removed from favorites!');

        /*
           Butondan yukarı doğru çıkarak en yakın ".col" klasmanındaki ürün kutusunu buluyoruz.
           Böylece sadece tıkladığımız ürünün kartını hedef almış oluyoruz.
        */
        const productColumn = button.closest('.col');

        if (productColumn) {
            // Pürüzsüz bir kaybolma efekti için CSS opaklığını sıfıra çekiyoruz
            productColumn.style.transition = 'all 0.4s ease';
            productColumn.style.opacity = '0';
            productColumn.style.transform = 'scale(0.9)';

            // Animasyon bittiğinde (400 milisaniye sonra) elementi HTML kodundan tamamen siliyoruz
            setTimeout(() => {
                productColumn.remove();

                // Opsiyonel: Eğer sayfada hiç favori ürün kalmadıysa "Listeniz boş" uyarısını tetikleyebilirsin
                const remainingCards = document.querySelectorAll('.fav-card');
                if (remainingCards.length === 0) {
                    location.reload(); // Sayfayı yenileyerek o şık "Wishlist is empty" ekranını getirir
                }
            }, 400);
        }
    }
</script>

</body>
</html>
