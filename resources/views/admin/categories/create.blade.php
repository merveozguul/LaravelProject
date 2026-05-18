<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kategori Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light p-5">
<div class="container">
    <h2>Yeni Kategori Ekle</h2>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary mb-3">⬅ Listeye Dön</a>

    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Kategori Adı</label>
                    <input type="text" name="name" class="form-control" required placeholder="Örn: Elektronik">
                </div>
                <div class="mb-3">
                    <label>Açıklama (İsteğe Bağlı)</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Kategori detayı..."></textarea>
                </div>
                <button type="submit" class="btn btn-success w-100">Kaydet</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
