<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sepetim | Merve Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm mb-5">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">🛒 Merve Shop</a>
        <a class="btn btn-outline-light btn-sm" href="{{ route('home') }}">⬅ Alışverişe Devam Et</a>
    </div>
</nav>

<div class="container">
    <h2 class="mb-4 fw-bold">🛒 Alışveriş Sepetim</h2>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            🎉 {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ❌ {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @if(count($cart) > 0)
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm border-0 p-3">
                    <table class="table align-middle table-hover">
                        <thead class="table-light">
                        <tr>
                            <th>Ürün</th>
                            <th>Kategori</th>
                            <th>Fiyat</th>
                            <th>Adet</th>
                            <th>Toplam</th>
                            <th>İşlem</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $totalPrice = 0; @endphp
                        @foreach($cart as $id => $details)
                            @php $subTotal = $details['price'] * $details['quantity']; @endphp
                            @php $totalPrice += $subTotal; @endphp
                            <tr>
                                <td><strong>{{ $details['name'] }}</strong></td>
                                <td><span class="badge bg-secondary">{{ $details['category'] }}</span></td>
                                <td>{{ number_format($details['price'], 2) }} TL</td>
                                <td>
                                    <span class="badge bg-dark fs-6">{{ $details['quantity'] }} Adet</span>
                                </td>
                                <td class="fw-bold text-primary">{{ number_format($subTotal, 2) }} TL</td>
                                <td>
                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger">❌ Kaldır</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0 border-top border-primary border-4">
                    <div class="card-body">
                        <h5 class="card-title fw-bold mb-4">Sipariş Özeti</h5>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Ara Toplam:</span>
                            <span class="fw-bold">{{ number_format($totalPrice, 2) }} TL</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-muted">Kargo:</span>
                            <span class="text-success fw-bold">Bedava</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4">
                            <span class="fs-5 fw-bold">Genel Toplam:</span>
                            <span class="fs-4 fw-bold text-primary">{{ number_format($totalPrice, 2) }} TL</span>
                        </div>

                        <form action="{{ route('cart.checkout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 btn-lg fw-bold shadow">🛒 Siparişi Tamamla</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="col-12 text-center py-5">
                <div class="card shadow-sm border-0 p-5">
                    <h3 class="text-muted mb-3">Sepetiniz şu an boş.</h3>
                    <p class="text-muted">Mağazamızdaki harika ürünlere göz atarak sepetinizi doldurabilirsiniz!</p>
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg mt-3 align-self-center shadow">Alışverişe Başla</a>
                </div>
            </div>
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
