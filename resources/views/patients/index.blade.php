@extends('layouts.app')

@section('title', 'Daftar Pasien')
@section('page_title', 'Daftar Pasien')

@section('content')
<div class="card shadow-sm border-0">
    <!-- 1. HEADER RESPONSIF: Gunakan flex-column di HP, dan flex-md-row di Desktop -->
    <div class="card-header bg-white d-flex flex-column flex-md-row justify-content-between align-items-md-center py-3 gap-3">
        <h6 class="mb-0 fw-bold">Data Pasien Terdaftar</h6>
        
        <!-- 2. KONTROL RESPONSIF: flex-wrap agar tombol turun jika sempit -->
        <div class="d-flex flex-wrap gap-2">
            <!-- Search Bar -->
            <form action="/patients" method="GET" class="d-flex flex-grow-1">
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari nama/NIK..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-secondary"><i class="bi bi-search"></i></button>
            </form>
            
            <!-- Tombol Export & Tambah (text-nowrap agar teks tidak terlipat aneh) -->
            <a href="/patients/export" class="btn btn-sm btn-success text-nowrap"><i class="bi bi-file-earmark-excel"></i> Export</a>
            <a href="/patients/create" class="btn btn-sm btn-primary text-nowrap"><i class="bi bi-plus-lg"></i> Tambah</a>
        </div>
    </div>
    
    <div class="card-body p-0">
        <!-- 3. TABEL RESPONSIF: Bungkus tabel dengan div class="table-responsive" -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="table-light">
                    <tr class="text-nowrap"> <!-- Mencegah header tabel terpotong -->
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tgl Lahir</th>
                        <th>Riwayat Alergi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Saya ubah pakai forelse agar ada pesan jika data kosong -->
                    @forelse ($patients as $patient)
                    <tr>
                        <td>{{ $patient->nik }}</td>
                        <td class="text-nowrap">{{ $patient->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($patient->dob)->format('d/m/Y') }}</td>
                        <td>
                            @if($patient->allergy_history)
                                <span class="text-danger fw-bold">{{ $patient->allergy_history }}</span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="/patients/{{ $patient->id }}" class="btn btn-sm btn-info text-white text-nowrap"><i class="bi bi-eye"></i> Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada data pasien terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection