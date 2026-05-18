<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ürün Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
    <h2>Ürünü Düzenle</h2>
    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary mb-3">⬅ Listeye Dön</a>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Kategori Seçin</label>
                    <select name="category_id" class="form-select" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ürün Adı</label>
                    <input type="text" name="name" class="form-control" required value="{{ $product->name }}">
                </div>

                <div class="mb-3">
                    <label class="form-label">Açıklama</label>
                    <textarea name="description" class="form-control" rows="3">{{ $product->description }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fiyat (TL)</label>
                        <input type="number" step="0.01" name="price" class="form-control" required value="{{ $product->price }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok Adedi</label>
                        <input type="number" name="stock" class="form-control" required value="{{ $product->stock }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Değişiklikleri Kaydet</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
