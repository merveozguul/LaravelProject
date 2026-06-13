<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merve Shop | Users Ledger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f5f7; font-family: 'Segoe UI', sans-serif; }
        .bg-orange { background-color: #f27a1a !important; }
        .text-orange { color: #f27a1a !important; }
        .sidebar { background-color: #1e293b; min-height: 100vh; color: #cbd5e1; }
        .sidebar .nav-link { color: #94a3b8; font-weight: 500; padding: 12px 20px; border-radius: 8px; }
        .sidebar .nav-link.active { background-color: rgba(242, 122, 26, 0.1); color: #f27a1a; }
        .table-card { background: #ffffff; border: none; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 px-0 sidebar p-3">
            <h3 class="text-white fw-bold mb-4 px-2">merve<span class="text-orange">shop</span></h3>
            <ul class="nav flex-column gap-2 flex-grow-1">
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-chart-pie me-2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.product.index') }}"><i class="fa-solid fa-box-open me-2"></i> Products Management</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories.index') }}"><i class="fa-solid fa-tags me-2"></i> Categories Management</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.orders') }}"><i class="fa-solid fa-receipt me-2"></i> Orders & Sales</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.comments.index') }}"><i class="fa-solid fa-comments me-2"></i> Product Reviews</a></li>
                <li class="nav-item"><a class="nav-link active" href="{{ route('admin.users.index') }}"><i class="fa-solid fa-users me-2"></i> Users Management</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.messages.index') }}"><i class="fa-solid fa-envelope me-2"></i> Contact Messages</a></li>
            </ul>
        </div>
        <div class="col-md-9 col-lg-10 p-4">
            <h2 class="fw-bold mb-4">Users Management</h2>
            <div class="card table-card">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>User Name</th>
                        <th>Email Address</th>
                        <th>Assigned Roles</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="fw-bold">#USR-{{ $user->id }}</td>
                            <td class="fw-semibold">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @forelse($user->roles as $role)
                                    <span class="badge bg-orange text-white me-1 rounded-pill small px-2.5 py-1.5">{{ $role->name }}</span>
                                @empty
                                    <span class="badge bg-secondary rounded-pill small px-2.5 py-1.5">No Roles</span>
                                @endforelse
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-outline-dark rounded-3 fw-semibold">
                                    <i class="fa-solid fa-user-gear text-orange me-1"></i> Manage Roles
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
