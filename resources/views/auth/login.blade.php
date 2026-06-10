<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Merve Shop</title>
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
        }

        .text-orange {
            color: #f27a1a !important;
        }

        .bg-orange {
            background-color: #f27a1a !important;
        }

        /* Modern Giriş Kartı */
        .login-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        /* Giriş Input Alanları */
        .form-control {
            border: 1px solid #cbd5e1;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 0.95rem;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            border-color: #f27a1a;
            box-shadow: 0 0 0 3px rgba(242, 122, 26, 0.15);
        }

        /* Giriş Butonu */
        .btn-login {
            background: #f27a1a;
            color: white;
            font-weight: 600;
            padding: 12px;
            border-radius: 10px;
            border: none;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            background: #d96814;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(242, 122, 26, 0.3);
        }

        /* Sosyal Giriş Butonu Süsü */
        .social-btn {
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            padding: 10px;
            background: white;
            color: #334155;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .social-btn:hover {
            background: #f8fafc;
            border-color: #94a3b8;
            color: #1e293b;
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
        <div class="col-12 col-sm-10 col-md-7 col-lg-5">

            <!-- Logo Alanı -->
            <div class="text-center mb-4">
                <a class="fs-1 fw-bolder text-dark text-decoration-none brand-logo" href="{{ route('home') }}">
                    merve<span class="text-orange">shop</span>
                </a>
                <p class="text-muted small mt-1">The Address for Reliable & Modern Shopping</p>
            </div>

            <!-- Giriş Kartı -->
            <div class="card login-card p-4 p-sm-5 border-0">
                <h3 class="fw-bold text-dark mb-1">Welcome Back</h3>
                <p class="text-secondary small mb-4">Please enter your details to sign in to your account.</p>

                <!-- Laravel Giriş Formu -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- E-mail Alanı -->
                    <div class="mb-3">
                        <label for="email" class="form-label small fw-semibold text-secondary">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="fa-regular fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror"
                                   id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="name@example.com"
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
                        <div class="d-flex justify-content-between align-items-center">
                            <label for="password" class="form-label small fw-semibold text-secondary mb-1">Password</label>
                            @if (Route::has('password.request'))
                                <a class="text-orange text-decoration-none small" href="{{ route('password.request') }}">Forgot Password?</a>
                            @endif
                        </div>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0 text-muted" style="border-radius: 10px 0 0 10px; border-color: #cbd5e1;">
                                <i class="fa-solid fa-lock"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 @error('password') is-invalid @enderror"
                                   id="password" name="password" required autocomplete="current-password" placeholder="••••••••"
                                   style="border-radius: 0 10px 10px 0;">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- Beni Hatırla Seçeneği -->
                    <div class="mb-4 form-check d-flex align-items-center gap-2">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} style="cursor: pointer; box-shadow: none;">
                        <label class="form-check-label small text-secondary" for="remember" style="cursor: pointer; user-select: none;">Remember me on this device</label>
                    </div>

                    <!-- Giriş Yap Butonu -->
                    <button type="submit" class="btn btn-login w-100 mb-3">
                        <i class="fa-solid fa-right-to-bracket me-2"></i> Sign In
                    </button>
                </form>

                <div class="position-relative my-4 text-center">
                    <hr class="text-muted">
                    <span class="position-absolute top-50 start-50 translate-middle bg-white px-3 small text-muted" style="background: rgba(255,255,255,0.95) !important; border-radius: 10px;">or</span>
                </div>

                <!-- Kayıt Ol Yönlendirmesi -->
                <div class="text-center">
                    <span class="text-secondary small">Don't have an account yet?</span>
                    <a href="{{ route('register') }}" class="text-orange text-decoration-none small fw-bold ms-1">Create an Account</a>
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
