<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meet Us | Merve Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
        }
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)), url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?q=80&w=1600&auto=format&fit=crop') no-repeat center center;
            background-size: cover;
            height: 450px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
        }
        .text-orange { color: #f27a1a !important; }
        .bg-orange { background-color: #f27a1a !important; }

        .stat-card {
            border: none;
            background-color: #f8fafc;
            border-radius: 16px;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .culture-img {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

<!-- Geri Dönüş Navbarı -->
<nav class="navbar navbar-expand-lg bg-white border-bottom py-3 sticky-top">
    <div class="container">
        <a class="fs-3 fw-bolder text-dark text-decoration-none" href="{{ route('home') }}" style="letter-spacing: -1px; font-family: 'Arial Black', sans-serif;">
            Merve Shop<span class="text-orange" style="font-family: 'Segoe UI'; font-size: 1rem; font-weight: bold; ms-2"> | Meet Us</span>
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Back to Shopping</a>
    </div>
</nav>

<!-- 1. BÖLÜM: BÜYÜK KARŞILAMA (HERO) -->
<section class="hero-section">
    <div class="container">
        <h1 class="display-3 fw-extrabold mb-3" style="letter-spacing: -1px;">We Are Merve Shop</h1>
        <p class="lead fs-4 max-w-2xl mx-auto">Impactful, tech-driven, and customer-first. Discover the story behind the technology that delivers smiles across the country.</p>
    </div>
</section>

<!-- 2. BÖLÜM: RAKAMLARLA BİZ (STATISTICS) -->
<section class="container py-5 my-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold tracking-tight">Merve Shop by the Numbers</h2>
        <p class="text-muted">Continuously growing, dreaming big, and breaking barriers every single day.</p>
    </div>
    <div class="row g-4 text-center">
        <div class="col-6 col-md-3">
            <div class="card stat-card p-4">
                <h2 class="display-5 fw-bold text-orange">30M+</h2>
                <span class="text-secondary fw-semibold">Active Customers</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-4">
                <h2 class="display-5 fw-bold text-dark">150K+</h2>
                <span class="text-secondary fw-semibold">Registered Sellers</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-4">
                <h2 class="display-5 fw-bold text-orange">2.5M+</h2>
                <span class="text-secondary fw-semibold">Packages Per Day</span>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card stat-card p-4">
                <h2 class="display-5 fw-bold text-dark">4,000+</h2>
                <span class="text-secondary fw-semibold">Team Members</span>
            </div>
        </div>
    </div>
</section>

<!-- 3. BÖLÜM: GÖRSELLİ HİKAYE VE VİZYON (OUR CULTURE) -->
<section class="bg-light py-5">
    <div class="container py-4">
        <div class="row align-items-center g-5">
            <div class="col-md-6">
                <span class="badge bg-orange text-white mb-2 px-3 py-2 rounded-pill uppercase fw-bold">Our Culture</span>
                <h2 class="fw-bold mb-4" style="font-size: 2.5rem; letter-spacing: -1px;">Driven by Technology, Sustained by Passion</h2>
                <p class="text-secondary mb-3 fs-5">At Merve Shop, we believe that shopping should be seamless, accessible, and delightful. We don't just list products; we build robust architectures to match millions of users with what they love in milliseconds.</p>
                <p class="text-secondary fs-5">Every single employee works with an entrepreneurial mindset, focused entirely on creating positive impacts for local businesses and global shoppers alike.</p>
            </div>
            <div class="col-md-6">
                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?q=80&w=800&auto=format&fit=crop" class="culture-img" alt="Store and Fashion Culture">
            </div>
        </div>
    </div>
</section>

<!-- 4. BÖLÜM: GALERİ VE TAKIM RUHU (GALLERY) -->
<section class="container py-5 my-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Life at Merve Shop</h2>
        <p class="text-muted">A collaborative tech ecosystem focused on innovation, speed, and fun.</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <img src="https://images.unsplash.com/photo-1531538606174-0f90ff5dce83?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded-4 shadow-sm" style="height: 250px; width: 100%; object-fit: cover;" alt="Office Area">
        </div>
        <div class="col-md-4">
            <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded-4 shadow-sm" style="height: 250px; width: 100%; object-fit: cover;" alt="Logistics Center">
        </div>
        <div class="col-md-4">
            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=600&auto=format&fit=crop" class="img-fluid rounded-4 shadow-sm" style="height: 250px; width: 100%; object-fit: cover;" alt="Meeting Room">
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white py-4">
    <div class="container text-center">
        <p class="mb-1 fw-bold">merve<span class="text-orange">shop</span> © 2026</p>
        <small class="text-muted">Meet Us Concept - Replicated beautifully for showcase.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
