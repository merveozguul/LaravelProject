<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | Add New Product</title>
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
        }
        .form-label {
            color: #334155;
            font-size: 0.875rem;
        }
        .form-control, .form-select {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.9rem;
        }
        .form-control:focus, .form-select:focus {
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
                <li class="nav-item"><a class="nav-link active" href="{{ route('admin.product.index') }}"><i class="fa-solid fa-box-open me-2"></i> Products</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fa-solid fa-tags me-2"></i> Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders') }}"><i class="fa-solid fa-receipt me-2"></i> Orders</a></li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 px-md-4 py-4">

            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">Add New Product</h1>
                    <p class="text-muted small mb-0">Fill in the fields below to deploy a brand new product to the marketplace showcase.</p>
                </div>
                <a href="{{ route('admin.product.index') }}" class="btn btn-sm btn-outline-secondary rounded-3 px-3 py-2">
                    <i class="fa-solid fa-arrow-left me-1"></i> Back to List
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger border-0 rounded-3 shadow-sm mb-4">
                    <ul class="mb-0 small">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card form-card p-4 p-md-5">
                <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label fw-bold">Product Title <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="e.g. iPhone 15 Pro Max" value="{{ old('name') }}" required>
                        </div>

                        <div class="col-md-6">
                            <label for="category_id" class="form-label fw-bold">Assigned Category <span class="text-danger">*</span></label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="brand" class="form-label fw-bold">Brand Name</label>
                            <input type="text" name="brand" id="brand" class="form-control" placeholder="e.g. Apple, Nike" value="{{ old('brand') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="color" class="form-label fw-bold">Color Palette</label>
                            <input type="text" name="color" id="color" class="form-control" placeholder="e.g. Space Gray, Black" value="{{ old('color') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="size" class="form-label fw-bold">Size Scale</label>
                            <select name="size" id="size" class="form-select">
                                <option value="">Universal / No Size</option>
                                <option value="S" {{ old('size') == 'S' ? 'selected' : '' }}>S</option>
                                <option value="M" {{ old('size') == 'M' ? 'selected' : '' }}>M</option>
                                <option value="L" {{ old('size') == 'L' ? 'selected' : '' }}>L</option>
                                <option value="XL" {{ old('size') == 'XL' ? 'selected' : '' }}>XL</option>
                                <option value="Free Size" {{ old('size') == 'Free Size' ? 'selected' : '' }}>Free Size</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="price" class="form-label fw-bold">Base Price (TL) <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control" placeholder="0.00" value="{{ old('price') }}" required>
                        </div>
                        <div class="col-md-4">
                            <label for="discount_rate" class="form-label fw-bold">Discount Percentage (%)</label>
                            <input type="number" min="0" max="100" name="discount_rate" id="discount_rate" class="form-control" placeholder="0" value="{{ old('discount_rate', 0) }}">
                        </div>
                        <div class="col-md-4">
                            <label for="stock" class="form-label fw-bold">Initial Inventory Stock <span class="text-danger">*</span></label>
                            <input type="number" name="stock" id="stock" class="form-control" placeholder="10" value="{{ old('stock') }}" required>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label fw-bold">Product Showcase Description</label>
                            <textarea name="description" id="description" rows="4" class="form-control" placeholder="Provide an informative marketing text regarding product characteristics...">{{ old('description') }}</textarea>
                        </div>

                        <div class="col-12">
                            <label for="image" class="form-label fw-bold">Product Representative Media Image</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <div class="form-text text-muted">Supported formats: JPG, PNG, WEBP. Maximum file constraints safe recommendation: 2MB.</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-3 mt-5 pt-3 border-top">
                        <a href="{{ route('admin.product.index') }}" class="btn btn-light border rounded-3 px-4 py-2.5 fw-semibold text-secondary">Cancel</a>
                        <button type="submit" class="btn btn-orange rounded-3 px-5 py-2.5">
                            <i class="fa-solid fa-circle-check me-2"></i>Publish Product
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
