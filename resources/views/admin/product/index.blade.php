<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | Products Management</title>
    <!-- Bootstrap 5 & FontAwesome 6 -->
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
        .btn-orange {
            background-color: #f27a1a !important;
            color: white !important;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .btn-orange:hover {
            background-color: #d96614 !important;
            box-shadow: 0 4px 12px rgba(242, 122, 26, 0.2);
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

        /* Modern Table Card */
        .table-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
            overflow: hidden;
        }
        .table th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 700;
            text-uppercase: true;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            padding: 16px;
            border-bottom: 2px solid #edf2f7;
        }
        .table td {
            padding: 16px;
            vertical-align: middle;
            color: #334155;
            font-size: 0.875rem;
            border-bottom: 1px solid #f1f5f9;
        }
        .table tr:last-child td {
            border-bottom: none;
        }

        /* Mini Image Preview */
        .admin-prod-img {
            width: 45px;
            height: 45px;
            object-fit: contain;
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 4px;
            border: 1px solid #e2e8f0;
        }
        .icon-placeholder {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f1f5f9;
            color: #94a3b8;
            border-radius: 8px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- 🧭 NAVIGATION SIDEBAR (Sol Menü) -->
        <div class="col-md-3 col-lg-2 px-0 sidebar d-flex flex-column p-3">
            <div class="py-3 px-2 mb-4">
                <a class="fs-3 fw-bolder text-white text-decoration-none" href="{{ route('home') }}" style="letter-spacing: -1px; font-family: 'Arial Black', sans-serif;">
                    merve<span class="text-orange">shop</span>
                </a>
                <div class="badge bg-orange text-white px-2 py-1 mt-1 rounded-3" style="font-size: 10px;">ADMIN PANEL</div>
            </div>

            <ul class="nav flex-column gap-2 flex-grow-1">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="fa-solid fa-chart-pie me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('admin.product.index') }}">
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
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.comments.index') }}">
                        <i class="fa-solid fa-comments me-2"></i> Product Reviews
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">
                        <i class="fa-solid fa-users me-2"></i> Users Management
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.messages.index') }}">
                        <i class="fa-solid fa-envelope me-2"></i> Contact Messages
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

        <!-- 📊 PRODUCTS TABLE CONTENT (Sağ Panel) -->
        <div class="col-md-9 col-lg-10 px-md-4 py-4">

            <!-- Alert Session Notification Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Top Header Bar with Add New Button -->
            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">Products Management</h1>
                    <p class="text-muted small mb-0">Create, update, or clear products from your store's live catalog.</p>
                </div>
                <div>
                    <a href="{{ route('admin.product.create') }}" class="btn btn-orange px-4 py-2">
                        <i class="fa-solid fa-plus me-2"></i>Add New Product
                    </a>
                </div>
            </div>

            <!-- 📋 LIVE INVENTORY MASTER TABLE CARD -->
            <div class="card table-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                        <tr>
                            <th style="width: 70px;">Image</th>
                            <th>Product Details</th>
                            <th>Category</th>
                            <th>Brand & Color</th>
                            <th>Size</th>
                            <th>Base Price</th>
                            <th>Stock Protection</th>
                            <th class="text-end" style="width: 140px;">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($products as $product)
                            <tr>
                                <!-- Product Image column -->
                                <td>
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" class="admin-prod-img" alt="Product Image">
                                    @else
                                        <div class="icon-placeholder">
                                            <i class="fa-solid fa-box-open"></i>
                                        </div>
                                    @endif
                                </td>

                                <!-- Name and Description details -->
                                <td>
                                    <div class="fw-bold text-dark">{{ $product->name }}</div>
                                    <div class="text-muted small text-truncate" style="max-width: 200px;">{{ $product->description }}</div>
                                </td>

                                <!-- Dynamic Category Relation -->
                                <td>
                                        <span class="badge bg-light text-secondary border px-2 py-1.5 rounded-3 fw-semibold">
                                            {{ $product->category->name ?? 'Unassigned' }}
                                        </span>
                                </td>

                                <!-- Brand and Color fields combined -->
                                <td>
                                    <div class="fw-semibold text-dark">{{ $product->brand ?? '—' }}</div>
                                    <div class="text-muted small"><i class="fa-solid fa-circle me-1" style="font-size: 8px; color: #cbd5e1;"></i>{{ $product->color ?? 'No Color' }}</div>
                                </td>

                                <!-- Size column -->
                                <td>
                                    <span class="text-dark fw-medium">{{ $product->size ?? 'Universal' }}</span>
                                </td>

                                <!-- Price column with custom dynamic mathematical badge logic -->
                                <td>
                                    @if($product->discount_rate > 0)
                                        <div class="text-muted text-decoration-line-through xsmall" style="font-size: 11px;">{{ number_format($product->price, 2) }} TL</div>
                                        <div class="fw-bold text-orange">{{ number_format($product->price * (1 - $product->discount_rate / 100), 2) }} TL</div>
                                    @else
                                        <div class="fw-bold text-dark">{{ number_format($product->price, 2) }} TL</div>
                                    @endif
                                </td>

                                <!-- Stock Protection Status Alert levels -->
                                <td>
                                    @if($product->stock > 5)
                                        <span class="badge bg-success-subtle text-success px-2 py-1.5 rounded-3"><i class="fa-solid fa-square-check me-1"></i>{{ $product->stock }} Units</span>
                                    @elseif($product->stock > 0)
                                        <span class="badge bg-warning-subtle text-warning px-2 py-1.5 rounded-3"><i class="fa-solid fa-triangle-exclamation me-1"></i>Low ({{ $product->stock }})</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger px-2 py-1.5 rounded-3"><i class="fa-solid fa-circle-xmark me-1"></i>Critical (0)</span>
                                    @endif
                                </td>

                                <!-- Interactive Action Management triggers -->
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('admin.product.edit', $product) }}" class="btn btn-sm btn-outline-primary border-0 rounded-3 p-2" title="Edit Product">
                                            <i class="fa-solid fa-pen-to-square fs-5"></i>
                                        </a>
                                        <form action="{{ route('admin.product.destroy', $product) }}" method="POST" onsubmit="return confirm('Are you sure you want to completely delete this product from database?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger border-0 rounded-3 p-2" title="Delete Product">
                                                <i class="fa-solid fa-trash-can fs-5"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-box-open d-block fs-1 mb-3 text-secondary"></i>
                                    No products have been added to the database yet.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
