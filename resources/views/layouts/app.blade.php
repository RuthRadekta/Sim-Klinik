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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <style>
        /* CSS Sidebar & Content Responsif */
        .sidebar { background-color: #2c3e50 !important; color: white; transition: all 0.3s ease; }
        .sidebar a { color: #ecf0f1; text-decoration: none; padding: 10px 15px; display: block; border-radius: 5px; margin-bottom: 2px;}
        .sidebar a:hover { background-color: #34495e; }
        .content { padding: 20px; background-color: #f8f9fa; min-height: 100vh; width: 100%; overflow-x: hidden; }
        .text-muted { color: #bdc3c7 !important; }
        
        /* Agar Offcanvas di HP mengikuti warna tema */
        .offcanvas-md { background-color: #2c3e50; }
    </style>
</head>
<body>
    <!-- Gunakan flex-md-row agar sejajar di Desktop, menurun di Mobile -->
    <div class="d-flex flex-column flex-md-row">
        
        <!-- Sidebar (Otomatis jadi Offcanvas geser di layar HP) -->
        <div class="sidebar p-3 flex-shrink-0 offcanvas-md offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel" style="width: 250px; min-width: 250px; min-height: 100vh;">
            <!-- Header Offcanvas Khusus Mobile -->
            <div class="offcanvas-header d-md-none border-bottom border-secondary mb-3">
                <h5 class="offcanvas-title text-white" id="sidebarMenuLabel"><i class="bi bi-hospital"></i> SIM Klinik</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
            </div>
            
            <div class="offcanvas-body d-flex flex-column p-0">
                <h4 class="text-center mb-4 d-none d-md-block mt-3"><i class="bi bi-hospital"></i> SIM Klinik</h4>
                
                @if(Auth::check())
                    <div class="w-100 px-2">
                        <!-- MENU KHUSUS ADMIN -->
                        @if(Auth::user()->role == 'admin')
                            <small class="text-muted text-uppercase d-block mb-2 ms-2">Admin</small>
                            <a href="/admin/dashboard"><i class="bi bi-speedometer2 me-2"></i> Monitoring</a>
                            <a href="/admin/employees"><i class="bi bi-people me-2"></i> Data Karyawan</a>
                            <a href="/admin/doctors"><i class="bi bi-heart-pulse me-2"></i> Data Dokter</a>
                            <a href="/rooms"><i class="bi bi-door-open me-2"></i> Manajemen Ruangan</a>
                        
                        <!-- MENU KHUSUS DOKTER -->
                        @elseif(Auth::user()->role == 'doctor' || Auth::user()->role == 'dokter')
                            <small class="text-muted text-uppercase d-block mb-2 ms-2">Dokter</small>
                            <a href="/doctor/dashboard"><i class="bi bi-person-lines-fill me-2"></i> Antrean Saya</a>
                            <a href="/doctor/history"><i class="bi bi-clock-history me-2"></i> Riwayat Pasien</a>
                            <a href="/doctor/profile"><i class="bi bi-person-badge me-2"></i> Profil</a>
                        
                        <!-- MENU KHUSUS RESEPSIONIS -->
                        @else
                            <small class="text-muted text-uppercase d-block mb-2 ms-2">Resepsionis</small>
                            <a href="/resepsionis/dashboard"><i class="bi bi-house-door me-2"></i> Dashboard Utama</a>
                            <a href="/appointments/create"><i class="bi bi-calendar-plus me-2"></i> Buat Appointment</a>
                            <a href="/appointments"><i class="bi bi-list-check me-2"></i> Daftar Appointment</a>
                            <a href="/patients"><i class="bi bi-file-person me-2"></i> Daftar Pasien</a>
                            <a href="/medicines"><i class="bi bi-capsule me-2"></i> Daftar Obat</a>
                            <a href="/rooms"><i class="bi bi-door-open me-2"></i> Daftar Ruangan</a>
                            <a href="/cashier"><i class="bi bi-cash-coin me-2"></i> Kasir & Antrean</a>
                        @endif
                        
                        <hr class="border-secondary my-3">
                        <a href="/logout" class="text-danger fw-bold"><i class="bi bi-box-arrow-left me-2"></i> Logout</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Konten Utama -->
        <div class="content flex-grow-1">
            
            <!-- Tombol Hamburger Mobile (Hanya tampil di layar kecil/HP) -->
            <div class="d-md-none mb-3">
                <button class="btn btn-primary shadow-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                    <i class="bi bi-list"></i> Menu Navigasi
                </button>
            </div>

            <!-- Header Konten (Dibuat flex-wrap agar tidak terpotong di layar sempit) -->
            <div class="bg-white p-3 mb-4 shadow-sm rounded d-flex justify-content-between align-items-center flex-wrap gap-2">
                <h5 class="mb-0 fw-bold">@yield('page_title')</h5>
                @if(Auth::check())
                    <span class="badge bg-light text-dark border px-3 py-2"><i class="bi bi-person-circle"></i> {{ Auth::user()->name }}</span>
                @endif
            </div>
            
            <!-- FLASH MESSAGE -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- ERROR VALIDASI -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i> <strong>Terdapat Kesalahan:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <!-- ==================================== -->
            
            @yield('content')
            
        </div>
    </div> <!-- End of d-flex -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // 1. Inisialisasi Select2 standar
            $('.select2').select2({
                theme: 'bootstrap-5',
                width: '100%'
            });

            // 2. Fix Select2 di dalam Pop-up (Modal)
            $('.modal').on('shown.bs.modal', function () {
                $(this).find('.select2-modal').select2({
                    theme: 'bootstrap-5',
                    dropdownParent: $(this), 
                    width: '100%'
                });
            });
        });
    </script>
</body>
</html>