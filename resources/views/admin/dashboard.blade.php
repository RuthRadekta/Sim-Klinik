@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page_title', 'Monitoring Klinik')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <div class="alert alert-info border-0 shadow-sm">
            <i class="bi bi-info-circle-fill me-2"></i> Selamat datang di panel Admin SIM Klinik. Berikut adalah ringkasan operasional hari ini ({{ \Carbon\Carbon::today()->format('d F Y') }}).
        </div>
    </div>
</div>

<!-- Baris untuk Kotak Statistik -->
<div class="row">
    <!-- Kotak Total Pasien -->
    <div class="col-md-3 mb-4">
        <div class="card bg-primary text-white border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase mb-0">Total Pasien</h6>
                    <i class="bi bi-people fs-2 text-white-50"></i>
                </div>
                <h2 class="display-6 fw-bold mb-0">{{ $totalPatients }}</h2>
            </div>
        </div>
    </div>

    <!-- Kotak Total Dokter -->
    <div class="col-md-3 mb-4">
        <div class="card bg-success text-white border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase mb-0">Total Dokter</h6>
                    <i class="bi bi-heart-pulse fs-2 text-white-50"></i>
                </div>
                <h2 class="display-6 fw-bold mb-0">{{ $totalDoctors }}</h2>
            </div>
        </div>
    </div>

    <!-- Kotak Antrean Hari Ini -->
    <div class="col-md-3 mb-4">
        <div class="card bg-warning text-dark border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase mb-0">Antrean Hari Ini</h6>
                    <i class="bi bi-list-ol fs-2 text-dark-50"></i>
                </div>
                <h2 class="display-6 fw-bold mb-0">{{ $appointmentsToday }}</h2>
            </div>
        </div>
    </div>

    <!-- Kotak Pendapatan Hari Ini -->
    <div class="col-md-3 mb-4">
        <div class="card bg-danger text-white border-0 shadow-sm h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div class="d-flex justify-content-between align-items-center">
                    <h6 class="text-uppercase mb-0">Pendapatan (Hari Ini)</h6>
                    <i class="bi bi-cash-coin fs-2 text-white-50"></i>
                </div>
                <!-- Menggunakan number_format agar tampil dengan format mata uang rupiah -->
                <h3 class="fw-bold mb-0 mt-3">Rp {{ number_format($incomeToday, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>
@endsection