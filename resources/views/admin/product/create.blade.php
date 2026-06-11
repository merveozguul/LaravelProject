<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ürün Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
    <h2>Add New Product</h2>
    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary mb-3">⬅ Return to List</a>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Product Photo</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Select a Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Select a Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" required placeholder="Example: Wireless Headphones">
                </div>

                <div class="mb-3">
                    <label class="form-label">Explanation</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Product features..."></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price (TL)</label>
                        <input type="number" step="0.01" name="price" class="form-control" required placeholder="Example: 1250.50">
                    </div>

                    <div class="mb-3">
                        <label for="discount_rate" class="form-label fw-bold">Discount Rate (%)</label>
                        <input type="number" class="form-control" id="discount_rate" name="discount_rate" min="0" max="100" value="0">
                        <small class="text-muted">Leave 0 if you don't want to apply a discount.</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" name="stock" class="form-control" required placeholder="Example: 50">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="brand" class="form-label fw-bold">Brand</label>
                            <input type="text" name="brand" id="brand" class="form-control" placeholder="e.g. Nike, Apple, Samsung">
                        </div>

                        <div class="col-md-4">
                            <label for="color" class="form-label fw-bold">Color</label>
                            <input type="text" name="color" id="color" class="form-control" placeholder="e.g. Black, White, Red">
                        </div>

                        <div class="col-md-4">
                            <label for="size" class="form-label fw-bold">Size</label>
                            <select name="size" id="size" class="form-select">
                                <option value="">Choose Size (Optional)</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="Free Size">Free Size</option>
                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Save Product</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
