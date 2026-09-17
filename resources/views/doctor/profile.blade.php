@extends('layouts.app')
@section('title', 'Profil Dokter')
@section('page_title', 'Profil & Statistik Anda')

@section('content')
<div class="row">
    <!-- Kolom Kiri: Avatar & Statistik -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 text-center h-100">
            <div class="card-body d-flex flex-column justify-content-center">
                <div class="mb-3">
                    <i class="bi bi-person-circle text-primary" style="font-size: 6rem;"></i>
                </div>
                <h5 class="fw-bold mb-1">{{ $doctor->user->name }}</h5>
                <p class="text-muted mb-2">{{ $doctor->specialization }}</p>
                <span class="badge bg-light text-dark border mb-4"><i class="bi bi-envelope"></i> {{ $doctor->user->email }}</span>
                
                <hr class="w-75 mx-auto">
                
                <h2 class="fw-bold text-success mb-0">{{ $totalPatients }}</h2>
                <p class="text-muted mb-0">Total Pasien Diperiksa</p>
            </div>
        </div>
    </div>
    
    <!-- Kolom Kanan: Detail Informasi Medis -->
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Detail Informasi Medis</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless mt-2">
                    <tr>
                        <th width="35%" class="text-secondary">Nama Lengkap & Gelar</th>
                        <td class="fw-bold">: {{ $doctor->user->name }}</td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Spesialisasi</th>
                        <td>: <span class="badge bg-info text-dark">{{ $doctor->specialization }}</span></td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Tarif Konsultasi</th>
                        <td>: Rp {{ number_format($doctor->fee, 0, ',', '.') }}</td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Email Login Akun</th>
                        <td>: {{ $doctor->user->email }}</td>
                    </tr>
                    <tr>
                        <th class="text-secondary">Bergabung Sejak</th>
                        <td>: {{ $doctor->created_at->format('d F Y') }}</td>
                    </tr>
                </table>

                <div class="alert alert-info mt-4 border-0">
                    <i class="bi bi-info-circle-fill me-2"></i> Jika Anda ingin mengubah data tarif konsultasi, spesialisasi, atau password login, silakan hubungi <strong>Admin Klinik</strong>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection