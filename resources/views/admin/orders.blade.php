<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipariş Yönetimi | Admin Paneli</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-4">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">👑 Merve Shop Admin</a>
        <a class="btn btn-outline-light btn-sm" href="{{ route('admin.dashboard') }}">⬅ Panele Dön</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-dark">📦 Sipariş Yönetimi</h2>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th class="ps-3">Sipariş ID</th>
                    <th>Müşteri Adı</th>
                    <th>E-posta</th>
                    <th>Toplam Tutar</th>
                    <th>Durum</th>
                    <th>Sipariş Tarihi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="ps-3"><strong>#{{ $order->id }}</strong></td>
                        <td>{{ $order->user->name ?? 'Bilinmeyen Müşteri' }}</td>
                        <td>{{ $order->user->email ?? '-' }}</td>
                        <td class="fw-bold text-primary">{{ number_format($order->total_amount, 2) }} TL</td>
                        <td>
                            <span class="badge bg-warning text-dark fs-6">{{ $order->status }}</span>
                        </td>
                        <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <h5 class="mb-0">Henüz sisteme düşen bir sipariş bulunmuyor.</h5>
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
