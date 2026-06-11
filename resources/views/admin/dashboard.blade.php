<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | Management Control Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Merve Shop Brand Colors */
        .bg-orange {
            background-color: #f27a1a !important;
        }
        .text-orange {
            color: #f27a1a !important;
        }
        .border-orange {
            border-color: #f27a1a !important;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #1e293b;
            min-height: 100vh;
            color: #cbd5e1;
            box-shadow: 4px 0 10px rgba(0,0,0,0.05);
        }
        .sidebar .nav-link {
            color: #94a3b8;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: rgba(242, 122, 26, 0.1);
            color: #f27a1a;
        }

        /* Dashboard Metric Cards */
        .metric-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02), 0 2px 4px -1px rgba(0,0,0,0.01);
        }
        .metric-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.02);
        }
        .icon-box {
            width: 55px;
            height: 55px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 col-lg-2 px-0 sidebar d-flex flex-column p-3">
            <div class="py-3 px-2 mb-4">
                <a class="fs-3 fw-bolder text-white text-decoration-none" href="{{ route('home') }}" style="letter-spacing: -1px; font-family: 'Arial Black', sans-serif;">
                    merve<span class="text-orange">shop</span>
                </a>
                <div class="badge bg-orange text-white px-2 py-1 mt-1 rounded-3" style="font-size: 10px;">ADMIN PANEL</div>
            </div>

            <ul class="nav flex-column gap-2 flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-chart-pie me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.product.index') }}">
                        <i class="fa-solid fa-box-open me-2"></i> Products Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">
                        <i class="fa-solid fa-tags me-2"></i> Categories Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.orders') }}">
                        <i class="fa-solid fa-receipt me-2"></i> Orders & Sales
                    </a>
                </li>
            </ul>

            <hr class="text-secondary">

            <div class="dropdown p-2">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle btn btn-dark btn-sm w-100 justify-content-between p-2 rounded-3 border-0" style="background-color: #0f172a;" data-bs-toggle="dropdown">
                    <span class="small fw-semibold"><i class="fa-regular fa-circle-user text-orange me-2"></i>{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark shadow w-100 border-0 mt-2 rounded-3">
                    <li><a class="dropdown-item small" href="{{ route('home') }}" target="_blank"><i class="fa-solid fa-store me-2 text-muted"></i>View Storefront</a></li>
                    <li><hr class="dropdown-divider border-secondary"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item small text-danger"><i class="fa-solid fa-power-off me-2"></i>Log Out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-9 col-lg-10 px-md-4 py-4">

            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">System Overview</h1>
                    <p class="text-muted small mb-0">Welcome back, Administrator. Here is the latest operational data for Merve Shop.</p>
                </div>
                <div class="text-end d-none d-sm-block">
                    <span class="badge bg-white text-secondary shadow-sm px-3 py-2 border rounded-pill">
                        <i class="fa-regular fa-calendar me-2 text-orange"></i>System Date: 2026
                    </span>
                </div>
            </div>

            <div class="row g-4 mb-5">

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card metric-card p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-bold text-uppercase">Total Products</span>
                                <h2 class="fw-bold text-dark mt-2 mb-0">{{ $totalProducts ?? 0 }}</h2>
                            </div>
                            <div class="icon-box bg-orange bg-opacity-10 text-orange">
                                <i class="fa-solid fa-box text-orange"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.product.index') }}" class="text-orange text-decoration-none small fw-semibold hover-orange">
                                Manage Products <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card metric-card p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-bold text-uppercase">Active Categories</span>
                                <h2 class="fw-bold text-dark mt-2 mb-0">{{ $totalCategories ?? 0 }}</h2>
                            </div>
                            <div class="icon-box bg-primary bg-opacity-10 text-primary">
                                <i class="fa-solid fa-tags text-primary"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.categories.index') }}" class="text-primary text-decoration-none small fw-semibold">
                                Manage Categories <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-lg-4">
                    <div class="card metric-card p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="text-muted small fw-bold text-uppercase">Incoming Orders</span>
                                <h2 class="fw-bold text-dark mt-2 mb-0">{{ $totalOrders ?? 0 }}</h2>
                            </div>
                            <div class="icon-box bg-success bg-opacity-10 text-success">
                                <i class="fa-solid fa-receipt text-success"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.orders') }}" class="text-success text-decoration-none small fw-semibold">
                                Track Orders & Sales <i class="fa-solid fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
                <h5 class="fw-bold text-dark mb-3"><i class="fa-solid fa-circle-info text-orange me-2"></i>Administrator Quick Start Guide</h5>
                <p class="text-secondary small">From this control center, you can completely customize the inventory, change filters, and check sales metrics for merve**shop**.</p>
                <div class="row g-3 mt-1">
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 border">
                            <h6 class="fw-bold text-dark mb-1">Step 1: Inventory Setup</h6>
                            <small class="text-muted">Ensure you have registered categories before pushing new technological or fashion products.</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 border">
                            <h6 class="fw-bold text-dark mb-1">Step 2: Rich Filters</h6>
                            <small class="text-muted">When editing products, provide accurate Brand and Color information to populate the client sidebar.</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 bg-light rounded-3 border">
                            <h6 class="fw-bold text-dark mb-1">Step 3: Stocks Defenses</h6>
                            <small class="text-muted">The client checkout method automatically diminishes stock levels on successful order creations.</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
