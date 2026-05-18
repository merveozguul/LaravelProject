<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { min-height: 100vh; background-color: #343a40; color: white; }
        .sidebar a { color: #cfd8dc; text-decoration: none; display: block; padding: 10px; }
        .sidebar a:hover { background-color: #495057; color: white; }
    </style>
</head>
<body class="bg-light">

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar p-3">
            <h4 class="text-center mb-4">⚙️ Admin Panel</h4>
            <hr>
            <a href="{{ route('admin.dashboard') }}">🏠 Dashboard</a>
            <a href="{{ route('admin.categories.index') }}">📁 Categories</a>
            <a href="{{ route('admin.product.index') }}">📦 Products</a>
            <a href="{{ route('admin.orders') }}" class="nav-link text-white">📦 Orders</a>
            <hr>

            <form action="{{ route('logout') }}" method="POST" class="d-inline mt-3">
                @csrf
                <button type="submit" class="btn btn-danger w-100">🚪 Logout</button>
            </form>
        </div>

        <div class="col-md-10 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Dashboard</h2>
                @if(Auth::check())
                    <span class="badge bg-primary fs-6">👤 Hoş geldin, {{ Auth::user()->name }}</span>
                @endif
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Toplam Ürün</h5>
                            <p class="card-text fs-2">{{ $totalProducts }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-warning mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Toplam Kategori</h5>
                            <p class="card-text fs-2">{{ $totalCategories }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white bg-info mb-3">
                        <div class="card-body">
                            <h5 class="card-title">Yeni Siparişler</h5>
                            <p class="card-text fs-2">{{ $totalOrders }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
