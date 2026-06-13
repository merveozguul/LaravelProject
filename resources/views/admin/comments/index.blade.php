<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | Reviews & Comments Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { background-color: #f4f5f7; font-family: 'Segoe UI', sans-serif; }
        .bg-orange { background-color: #f27a1a !important; }
        .text-orange { color: #f27a1a !important; }

        /* Sidebar Styling */
        .sidebar { background-color: #1e293b; min-height: 100vh; color: #cbd5e1; p: 15px; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 12px 20px; border-radius: 8px; transition: all 0.2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background-color: rgba(242, 122, 26, 0.1); color: #f27a1a; }

        /* Modern Table Card */
        .table-card { background: #ffffff; border: none; border-radius: 16px; box-shadow: 0 4px 6px rgba(0,0,0,0.02); overflow: hidden; }
        .table th { background-color: #f8fafc; color: #64748b; font-weight: 700; font-size: 0.75rem; letter-spacing: 0.5px; padding: 16px; border-bottom: 2px solid #edf2f7; text-transform: uppercase; }
        .table td { padding: 16px; vertical-align: middle; color: #334155; font-size: 0.875rem; border-bottom: 1px solid #f1f5f9; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <div class="col-md-3 col-lg-2 px-0 sidebar d-flex flex-column p-3">
            <div class="py-3 px-2 mb-4">
                <a class="fs-3 fw-bolder text-white text-decoration-none" href="{{ route('home') }}">
                    merve<span class="text-orange">shop</span>
                </a>
                <div class="badge bg-orange text-white px-2 py-1 mt-1 rounded-3" style="font-size: 10px;">ADMIN PANEL</div>
            </div>

            <ul class="nav flex-column gap-2 flex-grow-1">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.product.index') }}"><i class="fa-solid fa-box-open me-2"></i> Products Management</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fa-solid fa-tags me-2"></i> Categories Management</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders') }}"><i class="fa-solid fa-receipt me-2"></i> Orders & Sales</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('admin.comments.index') }}"><i class="fa-solid fa-comments me-2"></i> Product Reviews</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users me-2"></i> Users Management</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope me-2"></i> Contact Messages</a></li>
            </ul>
        </div>

        <div class="col-md-9 col-lg-10 px-md-4 py-4">
            <div class="d-flex justify-content-between align-items-center pb-3 mb-4 border-bottom">
                <div>
                    <h1 class="h3 fw-bold text-dark mb-1">Product Reviews & Comments</h1>
                    <p class="text-muted small mb-0">Moderate customer ratings, feedback logs, and storefront testaments.</p>
                </div>
            </div>

            <div class="card table-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>User Details</th>
                            <th>Target Product</th>
                            <th>Subject & Feedback</th>
                            <th>Rating</th>
                            <th>Status Pipeline</th>
                            <th class="text-end" style="width: 180px;">Actions Pipeline</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($comments ?? [] as $comment)
                            <tr>
                                <td class="text-dark fw-bold">#CMT-{{ $comment->id }}</td>
                                <td>
                                    <div class="fw-semibold text-dark">{{ $comment->user->name ?? 'Guest User' }}</div>
                                    <div class="text-muted small" style="font-size: 11px;">IP: {{ $comment->ip ?? '—' }}</div>
                                </td>
                                <td class="fw-medium text-secondary">{{ $comment->product->name ?? 'Unknown Item' }}</td>
                                <td>
                                    <div class="fw-semibold text-dark mb-0.5">{{ $comment->subject ?? 'No Subject' }}</div>
                                    <div class="text-muted small text-truncate" style="max-width: 250px;">{{ $comment->review }}</div>
                                </td>
                                <td class="text-warning fw-bold">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fa-{{ $i <= $comment->rate ? 'solid' : 'regular' }} fa-star" style="font-size: 11px;"></i>
                                    @endfor
                                </td>
                                <td>
                                    @if($comment->status == 'True')
                                        <span class="badge bg-success-subtle text-success px-2 py-1.5 rounded-3 fw-semibold">
                                            <i class="fa-solid fa-circle-check me-1"></i>Approved
                                        </span>
                                    @else
                                        <span class="badge bg-warning-subtle text-warning px-2 py-1.5 rounded-3 fw-semibold">
                                            <i class="fa-solid fa-clock me-1"></i>Pending Review
                                        </span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('admin.comments.update', $comment->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="status" value="{{ $comment->status == 'True' ? 'False' : 'True' }}">
                                        <button type="submit" class="btn btn-sm {{ $comment->status == 'True' ? 'btn-outline-warning' : 'btn-outline-success' }} rounded-3 fw-semibold px-2.5 py-1.5" style="font-size: 11px;">
                                            {{ $comment->status == 'True' ? 'Reject' : 'Approve' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to purge this record?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-3 px-2 py-1.5">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-comments d-block fs-1 mb-3 text-secondary"></i>
                                    No user comments or feedback submitted to the storefront database yet.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // 🌟 SweetAlert Pop-up Bildirim Motoru
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Review System Updated!',
            text: '{{ session('success') }}',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            background: '#1e293b',
            color: '#ffffff',
            iconColor: '#f27a1a'
        });
        @endif
    });
</script>
</body>
</html>
