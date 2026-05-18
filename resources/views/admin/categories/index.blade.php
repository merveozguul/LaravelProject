<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kategoriler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Kategoriler</h2>
        <div>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">🏠 Dashboard</a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Yeni Kategori Ekle</a>
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
                    <th>Kategori Adı</th>
                    <th>Açıklama</th>
                    <th>İşlemler</th> </tr>
                </thead>
                <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Düzenle</a>

                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bu kategoriyi silmek istediğinize emin misiniz?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Sil</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Henüz hiç kategori eklenmemiş.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
