<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIM Klinik')</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        .sidebar { min-height: 100vh; background-color: #2c3e50; color: white; }
        .sidebar a { color: #ecf0f1; text-decoration: none; padding: 10px 15px; display: block; }
        .sidebar a:hover { background-color: #34495e; border-radius: 5px; }
        .content { padding: 20px; background-color: #f8f9fa; min-height: 100vh; }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3" style="width: 250px;">
            <h4 class="text-center mb-4"><i class="bi bi-hospital"></i> SIM Klinik</h4>
            
            <!-- Menu Admin -->
            <small class="text-muted text-uppercase">Admin</small>
            <a href="/admin/dashboard"><i class="bi bi-speedometer2"></i> Monitoring</a>
            <a href="/admin/employees"><i class="bi bi-people"></i> Data Karyawan</a>
            <a href="/admin/doctors"><i class="bi bi-heart-pulse"></i> Data Dokter</a>
            <hr class="border-secondary">

            <!-- Menu Dokter -->
            <small class="text-muted text-uppercase">Dokter</small>
            <a href="/doctor/dashboard"><i class="bi bi-person-lines-fill"></i> Antrean Saya</a>
            <a href="/doctor/history"><i class="bi bi-clock-history"></i> Riwayat Pasien</a>
            <a href="/doctor/profile"><i class="bi bi-person-badge"></i> Profil</a>
            <hr class="border-secondary">

            <!-- Menu Resepsionis -->
            <small class="text-muted text-uppercase">Resepsionis</small>
            <a href="/appointments/create"><i class="bi bi-calendar-plus"></i> Buat Appointment</a>
            <a href="/patients"><i class="bi bi-file-person"></i> Daftar Pasien</a>
            <a href="/medicines"><i class="bi bi-capsule"></i> Daftar Obat</a>
            <a href="/rooms"><i class="bi bi-door-open"></i> Daftar Ruangan</a>
            <a href="/cashier"><i class="bi bi-cash-coin"></i> Kasir & Antrean</a>
            
            <hr class="border-secondary">
            <a href="/" class="text-danger"><i class="bi bi-box-arrow-left"></i> Logout</a>
        </div>

        <!-- Konten Utama -->
        <div class="content flex-grow-1">
            <div class="bg-white p-3 mb-4 shadow-sm rounded d-flex justify-content-between">
                <h5 class="mb-0">@yield('page_title')</h5>
                <span><i class="bi bi-person-circle"></i> User Aktif</span>
            </div>
            
            <!-- Di sinilah konten dari file view lain akan dimasukkan -->
            @yield('content') 
        </div>
    </div>
</body>
</html>