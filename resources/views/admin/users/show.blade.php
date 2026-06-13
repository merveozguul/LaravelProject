<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Roles | {{ $user->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f5f7; font-family: 'Segoe UI', sans-serif; }
        .text-orange { color: #f27a1a !important; }
        .btn-orange { background-color: #f27a1a !important; color: white !important; }
        .role-card { background: white; border: none; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.02); }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary rounded-3"><i class="fa-solid fa-arrow-left me-1"></i> Back to Ledger</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-6">
            <div class="card role-card p-4">
                <h4 class="fw-bold mb-1 text-dark">{{ $user->name }}</h4>
                <p class="text-muted small mb-4">{{ $user->email }}</p>

                <h6 class="fw-bold text-secondary text-uppercase small mb-3">Active Pipeline Roles</h6>
                <div class="d-flex flex-column gap-2">
                    @forelse($user->roles as $role)
                        <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded-3 border">
                            <span class="fw-bold text-dark"><i class="fa-solid fa-shield-halved text-orange me-2"></i>{{ $role->name }}</span>
                            <form action="{{ route('admin.users.removeRole', [$user->id, $role->id]) }}" method="POST" onsubmit="return confirm('Strip this role from user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-link text-danger p-0 text-decoration-none small">
                                    <i class="fa-regular fa-trash-can me-1"></i> Revoke Role
                                </button>
                            </form>
                        </div>
                    @empty
                        <div class="alert alert-light text-center border">This user has no security access roles defined yet.</div>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card role-card p-4">
                <h5 class="fw-bold mb-4"><i class="fa-solid fa-user-plus text-orange me-2"></i>Grant New Security Role</h5>

                <form action="{{ route('admin.users.addRole', $user->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold text-secondary">Select Target Pipeline Role</label>
                        <select name="role_id" class="form-select form-select-lg" style="border-radius: 10px;" required>
                            <option value="" disabled selected>Choose a role from registry...</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-orange w-100 py-3 fw-bold rounded-3 mt-2 shadow-sm">
                        <i class="fa-solid fa-check-double me-1"></i> Authorize & Attach Role
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
