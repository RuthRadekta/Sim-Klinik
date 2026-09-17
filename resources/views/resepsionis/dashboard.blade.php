@extends('layouts.app')
@section('title', 'Dashboard Resepsionis')
@section('page_title', 'Area Resepsionis & Pelayanan')

@section('content')
<div class="alert alert-success border-0 shadow-sm">
    <i class="bi bi-emoji-smile-fill me-2"></i> Selamat bertugas! Pastikan selalu ramah saat melayani pasien.
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="card bg-primary text-white border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-uppercase">Total Antrean Hari Ini</h6>
                <h1 class="display-5 fw-bold">{{ $todayAppointments }}</h1>
                <a href="/appointments/create" class="text-white text-decoration-none small">Lihat form pendaftaran &rarr;</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-danger text-white border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-uppercase">Menunggu Pembayaran</h6>
                <h1 class="display-5 fw-bold">{{ $pendingPayments }}</h1>
                <a href="/cashier" class="text-white text-decoration-none small">Proses di kasir &rarr;</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-dark border-0 shadow-sm h-100">
            <div class="card-body">
                <h6 class="text-uppercase">Kamar/Ruang Tersedia</h6>
                <h1 class="display-5 fw-bold">{{ $availableRooms }}</h1>
                <a href="/rooms" class="text-dark text-decoration-none small">Cek ketersediaan &rarr;</a>
            </div>
        </div>
    </div>
</div>
@endsection