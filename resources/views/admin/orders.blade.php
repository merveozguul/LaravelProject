<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | Orders & Sales Management</title>
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

        /* Mini Stats Cards in Order Page */
        .mini-stat-card {
            background: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.01);
            border-left: 4px solid #cbd5e1;
        }
        .stat-orange { border-left-color: #f27a1a; }
        .stat-success { border-left-color: #2ec4b6; }
        .stat-info { border-left-color: #3a86ff; }
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
                    <a class="nav-link active" href="{{ route('admin.orders') }}">
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

        <!-- 📊 ORDERS MANAGEMENT CONTENT (Sağ Panel) -->
        <div class="col-md-9 col-lg-10 px-md-4 py-4">

            <!-- Top Header Bar -->
            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">Orders & Sales</h1>
                    <p class="text-muted small mb-0">Track incoming customer purchases, transactions, and fulfillment states.</p>
                </div>
            </div>

            <!-- 📈 MINI FINANCIAL SUMMARY SUB-BAR -->
            <div class="row g-3 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="card mini-stat-card stat-orange p-3">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">Total Volume</small>
                        <h5 class="fw-bold text-dark mb-0 mt-1">{{ count($orders ?? []) }} Orders</h5>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card mini-stat-card stat-success p-3">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">Gross Revenue</small>
                        <h5 class="fw-bold text-success mb-0 mt-1">
                            {{ number_format(collect($orders ?? [])->sum('total_amount'), 2) }} TL
                        </h5>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="card mini-stat-card stat-info p-3">
                        <small class="text-muted text-uppercase fw-bold" style="font-size: 11px;">Average Basket</small>
                        <h5 class="fw-bold text-dark mb-0 mt-1">
                            {{ count($orders ?? []) > 0 ? number_format(collect($orders ?? [])->avg('total_amount'), 2) : '0.00' }} TL
                        </h5>
                    </div>
                </div>
            </div>

            <!-- 📋 MASTER ORDERS LOG TABLE CARD -->
            <div class="card table-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                        <tr>
                            <th style="width: 100px;">Order ID</th>
                            <th>Customer Details</th>
                            <th>Purchased Items</th>
                            <th>Placement Date</th>
                            <th>Total Amount</th>
                            <th>Payment Status</th>
                            <th>Fulfillment</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($orders ?? [] as $order)
                            <tr>
                                <!-- Order Hash/ID -->
                                <td class="text-dark fw-bold">#ORD-{{ $order->id }}</td>

                                <!-- Customer Profile Details (Using User Relation) -->
                                <td>
                                    <div class="fw-semibold text-dark">{{ $order->user->name ?? 'Guest Shopper' }}</div>
                                    <div class="text-muted small" style="font-size: 12px;">{{ $order->user->email ?? '—' }}</div>
                                </td>

                                <!-- Dynamic Items or Description summary -->
                                <td>
                                        <span class="text-dark fw-medium">
                                            {{ $order->items_summary ?? 'Standard Check-out Package' }}
                                        </span>
                                </td>

                                <!-- Raw Placement Date Formatted safely -->
                                <td class="text-secondary small">
                                    {{ $order->created_at ? $order->created_at->format('M d, Y - H:i') : 'Recent' }}
                                </td>

                                <!-- Financial Total Revenue Column -->
                                <td class="fw-bold text-dark">
                                    {{ number_format($order->total_amount, 2) }} TL
                                </td>

                                <!-- Dynamic Payment status badge indicators -->
                                <td>
                                    @if(($order->payment_status ?? 'paid') == 'paid')
                                        <span class="badge bg-success-subtle text-success px-2 py-1.5 rounded-3 fw-semibold">
                                                <i class="fa-solid fa-circle-check me-1"></i>Captured
                                            </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning px-2 py-1.5 rounded-3 fw-semibold">
                                                <i class="fa-solid fa-clock me-1"></i>Pending
                                            </span>
                                    @endif
                                </td>

                                <!-- Fulfillment operational progress state logic -->
                                <td>
                                        <span class="badge bg-light text-primary border border-primary-subtle px-2 py-1.5 rounded-3 fw-medium">
                                            <i class="fa-solid fa-truck-fast me-1 text-primary"></i>
                                            {{ $order->status ?? 'Processing' }}
                                        </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-receipt d-block fs-1 mb-3 text-secondary"></i>
                                    No sales or customer checkout logs recorded in the database yet.
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
