<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SIM Klinik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="height: 100vh;">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4 text-primary">SIM Klinik</h3>
            <!-- Tambahkan notifikasi error jika gagal login -->
            @if($errors->any())
                <div class="alert alert-danger">{{ $errors->first() }}</div>
            @endif

            <form action="/login-proses" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <!-- Tambahkan attribute name="email" -->
                    <input type="email" name="email" class="form-control" placeholder="dokter@klinik.com" required>
                </div>
                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <!-- Tambahkan attribute name="password" -->
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
        </div>
    </div>
</body>
</html>