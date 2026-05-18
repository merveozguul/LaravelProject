<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kategori Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
    <h2>Kategoriyi Düzenle</h2>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mb-3">⬅ Listeye Dön</a>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT') <div class="mb-3">
                    <label>Kategori Adı</label>
                    <input type="text" name="name" class="form-control" required value="{{ $category->name }}">
                </div>
                <div class="mb-3">
                    <label>Açıklama</label>
                    <textarea name="description" class="form-control" rows="3">{{ $category->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100">Değişiklikleri Kaydet</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
