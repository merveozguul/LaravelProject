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
            <form action="{{ route('admin.product.update', $product) }}" method="POST" enctype="multipart/form-data">
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
                    <div class="mb-3">
                        <label for="discount_rate" class="form-label fw-bold">İndirim Oranı (%)</label>
                        <input type="number" class="form-control" id="discount_rate" name="discount_rate" min="0" max="100" value="{{ $product->discount_rate ?? 0 }}">
                        <small class="text-muted">İndirim uygulamak istemiyorsanız 0 bırakın.</small>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Stok Adedi</label>
                        <input type="number" name="stock" class="form-control" required value="{{ $product->stock }}">
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label fw-bold">Ürün Fotoğrafı</label>

                        <!-- Eğer ürünün halihazırda bir resmi varsa burada küçük bir önizleme gösteriyoruz -->
                        @if($product->image && file_exists(public_path($product->image)))
                            <div class="mb-2">
                                <img src="{{ asset($product->image) }}" alt="Mevcut Resim" class="img-thumbnail" style="max-height: 100px;">
                                <p class="text-muted small">Mevcut Ürün Fotoğrafı</p>
                            </div>
                        @endif

                        <!-- Yeni resim seçme alanı -->
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">
                        <small class="text-muted">Fotoğrafı değiştirmek istemiyorsanız boş bırakabilirsiniz.</small>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Değişiklikleri Kaydet</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
