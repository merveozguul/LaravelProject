<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message Details | Merve Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f5f7; font-family: 'Segoe UI', sans-serif; }
        .msg-card { background: white; border: none; border-radius: 16px; box-shadow: 0 4px 12px rgba(0,0,0,0.02); }
        .btn-orange { background-color: #f27a1a !important; color: white !important; }
    </style>
</head>
<body>
<div class="container py-5">
    <div class="mb-4">
        <a href="{{ route('admin.messages.index') }}" class="btn btn-sm btn-outline-secondary rounded-3">Back to Pipeline Log</a>
    </div>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card msg-card p-4">
                <span class="badge bg-dark align-self-start mb-3">IP Logged: {{ $message->ip }}</span>
                <h4 class="fw-bold text-dark mb-1">{{ $message->subject ?? 'No Subject Provided' }}</h4>
                <p class="text-muted small mb-4">From: <strong>{{ $message->name }}</strong> ({{ $message->email }}) <br> Phone: {{ $message->phone ?? '—' }}</p>

                <h6 class="text-uppercase text-secondary small fw-bold mb-2">Message Content</h6>
                <div class="p-3 bg-light rounded-3 border text-secondary small" style="white-space: pre-line;">
                    {{ $message->message }}
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card msg-card p-4">
                <h5 class="fw-bold mb-4">Administrative Action</h5>
                <form action="{{ route('admin.messages.update', $message->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Fulfillment State</label>
                        <select name="status" class="form-select">
                            <option value="Read" {{ $message->status == 'Read' ? 'selected' : '' }}>Read (Acknowledged)</option>
                            <option value="Replied" {{ $message->status == 'Replied' ? 'selected' : '' }}>Replied (Archived)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Internal Corporate Note</label>
                        <textarea name="note" class="form-control" rows="4" placeholder="Add administrative details or actions taken...">{{ $message->note }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-orange w-100 py-2.5 fw-bold rounded-3">
                        Update Administrative Ledger
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
