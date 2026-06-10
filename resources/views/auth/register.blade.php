<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create an Account | Merve Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f4f5f7 0%, #e2e8f0 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px 0;
        }

        .text-orange {
            color: #f27a1a !important;
        }

        .bg-orange {
            background-color: #f27a1a !important;
        }

        /* Modern Kayıt Kartı */
        .register-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        /* Input Alanları */
        .form-control {
            border: 1px solid #cbd5e1;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.95rem;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #f27a1a;
            box-shadow: 0 0 0 3px rgba(242, 122, 26, 0.15);
        }

        /* Kayıt Butonu */
        .btn-register {
            background: #f27a1a;
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-register:hover {
            background: #d96814;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(242, 122, 26, 0.3);
        }

        .brand-logo {
            letter-spacing: -1px;
            font-family: 'Arial Black', sans-serif;
            text-shadow: 1px 1px 0px rgba(255,255,255,0.8);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-5">

            <!-- Logo Alanı -->
            <div class="text-center mb-4">
                <a class="fs-1 fw-bolder text-dark text-decoration-none brand-logo" href="{{ route('home') }}">
                    merve<span class="text-orange">shop</span>
                </a>
                <p class="text-muted small mt-1">The Address for Reliable & Modern Shopping</p>
            </div>

            <!-- Kayıt Kartı -->
            <div class="card register-card p-4 p-sm-5 border-0">
                <h3 class="fw-bold text-dark mb-1">Create Account</h3>
                <p class="text-secondary small mb-4">Join us today! It only takes a few steps to set up your profile.</p>

                <!-- Laravel Kayıt Formu -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Full Name Alanı -->
                    <div class="mb-3">
                        <label for="name" class="form-label small fw-semibold text-secondary">Full Name</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="fa-regular fa-user"></i>
                            </span>
                            <input type="text" class="form-control border-start-0 @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="John Doe"
                                   style="border-radius: 0 10px 10px 0;">

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- E-mail Alanı -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold text-secondary">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input type="family" class="form-control border-start-0 @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="name@example.com"
                                   style="border-radius: 0 10px 10px 0;">

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Şifre Alanı -->
                    <div class="mb-3">
                        <label for="password" class="form-label small fw-semibold text-secondary">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror"
                                   id="password" name="password" required autocomplete="new-password" placeholder="Minimum 8 characters"
                                   style="border-radius: 0 10px 10px 0;">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Şifre Tekrar Alanı -->
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label small fw-semibold text-secondary">Confirm Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="fa-solid fa-lock-open"></i>
                            </span>
                            <input type="password" class="form-control border-start-0"
                                   id="password-confirm" name="password_confirmation" required autocomplete="new-password" placeholder="Repeat your password"
                                   style="border-radius: 0 10px 10px 0;">
                        </div>
                    </div>

                    <!-- Kayıt Ol Butonu -->
                    <button type="submit" class="btn btn-register w-100 mb-3">
                        <i class="fa-solid fa-user-plus me-2"></i> Create an Account
                    </button>
                </form>

                <div class="position-relative my-4 text-center">
                    <hr class="text-muted">
                    <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 small text-muted" style="background: rgba(255,255,255,0.95) !important; border-radius: 10px;">or</span>
                </div>

                <!-- Giriş Yap Sayfasına Dönüş -->
                <div class="text-center">
                    <span class="text-secondary small">Already have an account?</span>
                    <a href="{{ route('login') }}" class="text-orange text-decoration-none small fw-bold ms-1">Sign In instead</a>
                </div>

            </div>

            <!-- Footer Süsü -->
            <div class="text-center mt-4 text-secondary small">
                <a href="{{ route('home') }}" class="text-secondary text-decoration-none hover-orange me-3"><i class="fa-solid fa-arrow-left me-1"></i> Back to Store</a>
                <span>merve<b>shop</b> © 2026</span>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
