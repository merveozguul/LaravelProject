<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
    <h2>Edit Product</h2>
    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary mb-3">⬅ Return to List</a>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.product.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Select a Category</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Product Name</label>
                    <input type="text" name="name" class="form-control" required value="{{ $product->name }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Explanation</label>
                    <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Price (TL)</label>
                        <input type="number" step="0.01" name="price" class="form-control" required value="{{ $product->price }}">
                    </div>
                    <div class="mb-3">
                        <label for="discount_rate" class="form-label fw-bold">Discount Rate (%)</label>
                        <input type="number" class="form-control" id="discount_rate" name="discount_rate" min="0" max="100" value="{{ $product->discount_rate ?? 0 }}">
                        <small class="text-muted">Leave 0 if you don't want to apply a discount.</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok Adedi</label>
                        <input type="number" name="stock" class="form-control" required value="{{ $product->stock }}">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="brand" class="form-label fw-bold">Brand</label>
                            <input type="text" name="brand" id="brand" class="form-control"
                                   value="{{ old('brand', $product->brand) }}" placeholder="e.g. Nike, Apple">
                        </div>

                        <div class="col-md-4">
                            <label for="color" class="form-label fw-bold">Color</label>
                            <input type="text" name="color" id="color" class="form-control"
                                   value="{{ old('color', $product->color) }}" placeholder="e.g. Black, White">
                        </div>

                        <div class="col-md-4">
                            <label for="size" class="form-label fw-bold">Size</label>
                            <select name="size" id="size" class="form-select">
                                <option value="">Choose Size (Optional)</option>
                                <option value="S" {{ old('size', $product->size) == 'S' ? 'selected' : '' }}>S</option>
                                <option value="M" {{ old('size', $product->size) == 'M' ? 'selected' : '' }}>M</option>
                                <option value="L" {{ old('size', $product->size) == 'L' ? 'selected' : '' }}>L</option>
                                <option value="XL" {{ old('size', $product->size) == 'XL' ? 'selected' : '' }}>XL</option>
                                <option value="Free Size" {{ old('size', $product->size) == 'Free Size' ? 'selected' : '' }}>Free Size</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Product Photo</label>

                        <!-- Eğer ürünün halihazırda bir resmi varsa burada küçük bir önizleme gösteriyoruz -->
                        @if($product->image && file_exists(public_path($product->image)))
                            <div class="mb-2">
                                <img src="{{ asset($product->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 100px;">
                                <p class="text-muted small">Current Product Photo</p>
                            </div>
                        @endif

                        <!-- Yeni resim seçme alanı -->
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">If you don't want to change the photo, you can leave it blank.</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Save Changes</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
