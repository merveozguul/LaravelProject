<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <title>Merve Shop | Contact Us</title>
    <style>
        .btn-orange { background-color: #f27a1a; color: white; fw: bold; }
        .btn-orange:hover { background-color: #d96914; color: white; }
        .text-orange { color: #f27a1a; }
    </style>
</head>
<body class="bg-light">
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm p-4 rounded-4">
                <h2 class="fw-bold mb-1 text-dark">Get in Touch with <span class="text-orange">merve</span>shop</h2>
                <p class="text-muted small mb-4">Have a question or feedback? Drop us a message below.</p>

                @if(session('success'))
                    <div class="alert alert-success border-0 rounded-3 small mb-4">{{ session('success') }}</div>
                @endif

                <form action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Your Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="John Doe">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control" required placeholder="john@example.com">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+90 555...">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-semibold">Subject</label>
                            <input type="text" name="subject" class="form-control" placeholder="Order issue, feedback...">
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-semibold">Your Message</label>
                            <textarea name="message" class="form-control" rows="5" required placeholder="Type your message here..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-orange w-100 py-3 mt-4 rounded-3 shadow-sm fw-bold">
                        <i class="fa-regular fa-paper-plane me-1"></i> Transmit Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
