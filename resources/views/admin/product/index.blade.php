<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ürün Listesi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Ürünler</h2>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">🏠 Dashboard</a>
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">+ Yeni Ürün Ekle</a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Ürün Adı</th>
                    <th>Kategori</th>
                    <th>Fiyat</th>
                    <th>Stok</th>
                    <th>İşlemler</th> </tr>
                </thead>
                <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td><span class="badge bg-info text-dark">{{ $product->category->name }}</span></td>
                        <td>{{ number_format($product->price, 2) }} TL</td>
                        <td>{{ $product->stock }} Adet</td>
                        <td>
                            <a href="{{ route('admin.product.edit', $product->id) }}" class="btn btn-sm btn-warning">Düzenle</a>

                            <form action="{{ route('admin.product.destroy', $product->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu ürünü silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Henüz hiç ürün eklenmemiş.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
