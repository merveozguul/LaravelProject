<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ürün Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
    <h2>Yeni Ürün Ekle</h2>
    <a href="{{ route('admin.product.index') }}" class="btn btn-secondary mb-3">⬅ Listeye Dön</a>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.product.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Kategori Seçin</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Kategori Seçiniz --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Ürün Adı</label>
                    <input type="text" name="name" class="form-control" required placeholder="Örn: Kablosuz Kulaklık">
                </div>

                <div class="mb-3">
                    <label class="form-label">Açıklama</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Ürün özellikleri..."></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Fiyat (TL)</label>
                        <input type="number" step="0.01" name="price" class="form-control" required placeholder="Örn: 1250.50">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok Adedi</label>
                        <input type="number" name="stock" class="form-control" required placeholder="Örn: 50">
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100">Ürünü Kaydet</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
