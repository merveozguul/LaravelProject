<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} | Merve Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f5f7; font-family: 'Segoe UI', sans-serif; }
        .text-orange { color: #f27a1a !important; }
        .bg-orange { background-color: #f27a1a !important; }
        .product-img-box { background: #fff; border-radius: 16px; padding: 20px; height: 450px; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .product-img-box img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .review-star { color: #ffc107; }
    </style>
</head>
<body>

<!-- Mini Header -->
<nav class="navbar navbar-expand-lg bg-white border-bottom py-3 sticky-top">
    <div class="container">
        <a class="fs-2 fw-bolder text-dark text-decoration-none" href="{{ route('home') }}" style="letter-spacing: -1px; font-family: 'Arial Black', sans-serif;">
            merve<span class="text-orange">shop</span>
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Back to Feed</a>
    </div>
</nav>

<div class="container my-5">
    <div class="row g-5">

        <!-- Sol Taraf: Ürün Görseli -->
        <div class="col-lg-6">
            <div class="product-img-box shadow-sm position-relative">
                @if($product->discount_rate > 0)
                    <span class="badge bg-danger p-2 position-absolute" style="top: 20px; left: 20px; font-size: 0.9rem;">%{{ $product->discount_rate }} OFF</span>
                @endif

                @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                @else
                    <i class="fa-solid fa-box-open text-muted" style="font-size: 8rem;"></i>
                @endif
            </div>
        </div>

        <!-- Sağ Taraf: Ürün Detayları ve Satın Alma -->
        <div class="col-lg-6">
            <span class="text-muted text-uppercase fw-bold small">{{ $product->category->name ?? 'General' }}</span>
            <h1 class="fw-bold text-dark mt-1 mb-2">{{ $product->name }}</h1>

            <!-- Sahte Yıldız Puanlaması -->
            <div class="d-flex align-items-center mb-3">
                <div class="me-2">
                    <i class="fa-solid fa-star review-star"></i>
                    <i class="fa-solid fa-star review-star"></i>
                    <i class="fa-solid fa-star review-star"></i>
                    <i class="fa-solid fa-star review-star"></i>
                    <i class="fa-solid fa-star-half-stroke review-star"></i>
                </div>
                <span class="text-muted small fw-semibold">(4.7 / 5 based on 24 reviews)</span>
            </div>

            <!-- Fiyat Alanı -->
            <div class="mb-4">
                @if($product->discount_rate > 0)
                    <span class="text-muted text-decoration-line-through fs-5 me-2">{{ number_format($product->price, 2) }} TL</span>
                    <span class="fw-bold fs-2 text-orange">{{ number_format($product->price * (1 - $product->discount_rate / 100), 2) }} TL</span>
                @else
                    <span class="fw-bold fs-2 text-dark">{{ number_format($product->price, 2) }} TL</span>
                @endif
            </div>

            <hr>

            <h5 class="fw-bold mt-4">Product Description</h5>
            <p class="text-secondary lh-lg">{{ $product->description ?? 'No extra description provided for this premium item.' }}</p>

            <!-- Stok Bilgisi -->
            <div class="my-3">
                @if($product->stock > 0)
                    <span class="text-success fw-semibold"><i class="fa-solid fa-circle-check me-1"></i> In Stock ({{ $product->stock }} units available)</span>
                @else
                    <span class="text-danger fw-semibold"><i class="fa-solid fa-circle-xmark me-1"></i> Temporarily Out of Stock</span>
                @endif
            </div>

            <!-- Aksiyon Butonları (Sepet + Kalp) -->
            <div class="d-flex gap-3 mt-4">
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex-grow-1">
                        @csrf
                        <button type="submit" class="btn bg-orange text-white w-100 py-3 fw-bold btn-hover-dark" style="border-radius: 10px;">
                            <i class="fa-solid fa-cart-plus me-2 fs-5"></i> ADD TO CART
                        </button>
                    </form>
                @endif

                <!-- İstediğin Detay Sayfası Kalp Butonu -->
                <button class="btn btn-outline-danger px-4 wishlist-btn" style="border-radius: 10px;" onclick="toggleWishlist(this)">
                    <i class="fa-regular fa-heart fs-4"></i>
                </button>
            </div>
        </div>

    </div>

    <!-- MÜŞTERİ YORUMLARI BÖLÜMÜ (CUSTOMER REVIEWS) -->
    <div class="row mt-5 pt-5 border-top">
        <div class="col-12">
            <h3 class="fw-bold mb-4"><i class="fa-regular fa-comments text-orange me-2"></i> Customer Reviews</h3>

            <!-- Örnek Hazır Yorum 1 -->
            <div class="bg-white p-4 rounded-3 shadow-sm mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0">Emma W. <span class="badge bg-light text-success border border-success-subtle ms-2"><i class="fa-solid fa-circle-check"></i> Verified Purchaser</span></h6>
                    <small class="text-muted">3 days ago</small>
                </div>
                <div class="mb-2">
                    <i class="fa-solid fa-star review-star"></i><i class="fa-solid fa-star review-star"></i><i class="fa-solid fa-star review-star"></i><i class="fa-solid fa-star review-star"></i><i class="fa-solid fa-star review-star"></i>
                </div>
                <p class="text-secondary mb-0">Absolutely loved the packaging and speed of delivery! The item quality matches Merve Shop's premium standards perfectly. Highly recommended.</p>
            </div>

            <!-- Örnek Hazır Yorum 2 -->
            <div class="bg-white p-4 rounded-3 shadow-sm mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0">John D.</h6>
                    <small class="text-muted">1 week ago</small>
                </div>
                <div class="mb-2">
                    <i class="fa-solid fa-star review-star"></i><i class="fa-solid fa-star review-star"></i><i class="fa-solid fa-star review-star"></i><i class="fa-solid fa-star review-star"></i><i class="fa-regular fa-star text-muted"></i>
                </div>
                <p class="text-secondary mb-0">Great price-to-performance value. Super fast customer service responses from the Elite chat hub too.</p>
            </div>
        </div>
    </div>
</div>
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
        } else {
            icon.classList.remove('fa-solid', 'fa-heart');
            icon.classList.add('fa-regular', 'fa-heart');
            button.style.backgroundColor = '';
        }
    }
</script>
</body>
</html>
