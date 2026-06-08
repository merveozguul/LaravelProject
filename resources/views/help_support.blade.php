<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support | Merve Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1e293b;
        }
        .text-orange { color: #f27a1a !important; }
        .bg-orange { background-color: #f27a1a !important; }

        .search-hero {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 40px 0;
        }
        .faq-card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
            margin-bottom: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            overflow: hidden;
        }
        .faq-trigger {
            width: 100%;
            text-align: left;
            background: none;
            border: none;
            padding: 20px;
            font-weight: 600;
            font-size: 1.05rem;
            color: #1e293b;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .faq-trigger:focus { outline: none; }
        .faq-content {
            padding: 0 20px 20px 20px;
            color: #475569;
            line-height: 1.6;
        }
        .support-box {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            transition: transform 0.2s ease;
        }
        .support-box:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white border-bottom py-3 sticky-top">
    <div class="container">
        <a class="fs-2 fw-bolder text-dark text-decoration-none" href="{{ route('home') }}" style="letter-spacing: -1px; font-family: 'Arial Black', sans-serif;">
            merve<span class="text-orange">shop</span><span class="text-secondary" style="font-family: 'Segoe UI'; font-size: 1.1rem; font-weight: bold;"> Help Center</span>
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm fw-semibold"><i class="fa-solid fa-arrow-left me-2"></i>Back to Store</a>
    </div>
</nav>

<!-- Search Hero Area -->
<section class="search-hero text-center">
    <div class="container">
        <h2 class="fw-bold mb-3">Hi, how can we help you?</h2>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group shadow-sm" style="border-radius: 30px; overflow: hidden; border: 1px solid #cbd5e1;">
                    <span class="input-group-text bg-white border-0 ps-3"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                    <input type="text" class="form-control border-0 py-3" placeholder="Describe your issue or ask a question...">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Support Layout -->
<div class="container my-5">
    <div class="row g-4">

        <!-- Left Side: FAQ Accordion -->
        <div class="col-lg-8">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-fire text-orange me-2"></i> Popular Questions</h4>

            <div class="accordion" id="faqAccordion">

                <!-- 🌟 CRITICAL REQUESTED ELITE QUESTION -->
                <div class="faq-card">
                    <button class="faq-trigger" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                        What are the privileges of Elite membership?
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </button>
                    <div id="faq1" class="collapse show" data-bs-parent="#faqAccordion">
                        <div class="faq-content border-top pt-3">
                            <ul class="mb-0 ps-3">
                                <li class="mb-2">You will receive <strong>3 free 10-pack Merve Passes</strong> to use during your Elite membership.</li>
                                <li class="mb-2">Become an Elite member and receive a <strong>500 TL coupon</strong> as a gift.</li>
                                <li><strong>Priority customer service</strong> for elite clients to solve any issue instantly.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- FAQ Question 2 -->
                <div class="faq-card">
                    <button class="faq-trigger collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                        Where is my order? How can I track it?
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </button>
                    <div id="faq2" class="collapse" data-bs-parent="#faqAccordion">
                        <div class="faq-content border-top pt-3">
                            You can easily track your cargo by logging into your account, navigating to the "My Orders" tab, and clicking on the "Where is my Cargo?" button on the relevant order.
                        </div>
                    </div>
                </div>

                <!-- FAQ Question 3 -->
                <div class="faq-card">
                    <button class="faq-trigger collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                        What is Merve Shop's return policy?
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </button>
                    <div id="faq3" class="collapse" data-bs-parent="#faqAccordion">
                        <div class="faq-content border-top pt-3">
                            You can return any product you purchased within 14 days from the date of delivery completely free of charge. Simply generate a free return code from your orders panel and drop it off at the nearest shipping point.
                        </div>
                    </div>
                </div>

                <!-- FAQ Question 4 -->
                <div class="faq-card">
                    <button class="faq-trigger collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                        How can I use my 500 TL Elite welcome coupon?
                        <i class="fa-solid fa-chevron-down text-muted"></i>
                    </button>
                    <div id="faq4" class="collapse" data-bs-parent="#faqAccordion">
                        <div class="faq-content border-top pt-3">
                            Your 500 TL coupon is automatically loaded into your "My Discount Coupons" wallet upon becoming an Elite member. You can select and apply it on the checkout screen for any purchase above 2,000 TL.
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Right Side: Fast Support Boxes -->
        <div class="col-lg-4">
            <h4 class="fw-bold mb-4"><i class="fa-solid fa-headset text-secondary me-2"></i> Live Channels</h4>

            <div class="p-4 support-box text-center mb-3">
                <i class="fa-solid fa-comments text-orange mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Merve Assistant</h5>
                <p class="text-muted small">Chat with our AI bot to get answers to your questions 24/7 in seconds.</p>
                <button class="btn bg-orange text-white w-100 fw-semibold rounded-pill py-2">Start Live Chat</button>
            </div>

            <div class="p-4 support-box text-center">
                <i class="fa-solid fa-phone text-success mb-3" style="font-size: 2.5rem;"></i>
                <h5 class="fw-bold">Call Center</h5>
                <p class="text-muted small">Speak directly to our premium customer support specialists regarding your orders.</p>
                <a href="tel:08500000000" class="btn btn-outline-success w-100 fw-semibold rounded-pill py-2">0850 000 00 00</a>
            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white py-4 mt-auto">
    <div class="container text-center">
        <p class="mb-1 fw-bold">merve<span class="text-orange">shop</span> © 2026</p>
        <small class="text-muted">Customer Support Hub - Built elegantly with Bootstrap 5.</small>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
