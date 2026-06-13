<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | Add New Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .bg-orange { background-color: #f27a1a !important; }
        .text-orange { color: #f27a1a !important; }
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
        .sidebar {
            background-color: #1e293b;
            min-height: 100vh;
            color: #cbd5e1;
        }
        .sidebar .nav-link {
            color: #94a3b8;
            font-weight: 500;
            padding: 12px 20px;
            border-radius: 8px;
        }
        .sidebar .nav-link.active {
            background-color: rgba(242, 122, 26, 0.1);
            color: #f27a1a;
        }
        .form-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);
            max-width: 650px; /* Kategoriler için daha tatlı dar bir form */
        }
        .form-label {
            color: #334155;
            font-size: 0.875rem;
        }
        .form-control {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.9rem;
        }
        .form-control:focus {
            border-color: #f27a1a;
            box-shadow: 0 0 0 3px rgba(242, 122, 26, 0.15);
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 col-lg-2 px-0 sidebar d-flex flex-column p-3">
            <div class="py-3 px-2 mb-4">
                <a class="fs-3 fw-bolder text-white text-decoration-none" href="{{ route('home') }}">
                    merve<span class="text-orange">shop</span>
                </a>
                <div class="badge bg-orange text-white px-2 py-1 mt-1 rounded-3" style="font-size: 10px;">ADMIN PANEL</div>
            </div>
            <ul class="nav flex-column gap-2 flex-grow-1">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.product.index') }}"><i class="fa-solid fa-box-open me-2"></i> Products</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('admin.categories.index') }}"><i class="fa-solid fa-tags me-2"></i> Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders') }}"><i class="fa-solid fa-receipt me-2"></i> Orders</a></li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 px-md-4 py-4 d-flex flex-column align-items-start">

            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom w-100">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">Add New Category</h1>
                    <p class="text-muted small mb-0">Establish a new classification node inside store structural index.</p>
                </div>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-secondary rounded-3 px-3 py-2">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                </a>
            </div>

            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4 w-100" style="max-width: 650px;">
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card form-card p-4 p-md-5 w-100">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Smart Electronics, Winter Fashion" value="{{ old('name') }}" required>
                        <div class="form-text text-muted small mt-2">
                            <i class="fa-solid fa-circle-info text-orange me-1"></i> The URL routing system will automatically compile a search-optimized slug descriptor (e.g. <code>/category/winter-fashion</code>).
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-light border rounded-3 px-4 py-2.5 fw-semibold text-secondary">Cancel</a>
                        <button type="submit" class="btn btn-orange rounded-3 px-5 py-2.5">
                            <i class="fa-solid fa-circle-check me-2"></i>Deploy Category
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
