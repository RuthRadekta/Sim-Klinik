@extends('layouts.app')

@section('title', 'Dashboard Dokter')
@section('page_title', 'Antrean Hari Ini')

@section('content')
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card bg-primary text-white shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-person-circle fs-1"></i>
                </div>
                <div>
                    <h4 class="mb-0">Selamat Bertugas, {{ $doctor->user->name }}</h4>
                    <small>Spesialisasi: {{ $doctor->specialization }} | Tanggal: {{ \Carbon\Carbon::today()->format('d M Y') }}</small>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-header bg-white"><h6 class="mb-0">Daftar Pasien Menunggu</h6></div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Antrean</th>
                    <th>Nama Pasien</th>
                    <th>Riwayat Alergi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $appointment)
                <tr>
                    <td><span class="badge bg-secondary fs-6">{{ $appointment->queue_number }}</span></td>
                    <td class="fw-bold">{{ $appointment->patient->name }}</td>
                    <td class="text-danger fw-bold">{{ $appointment->patient->allergy_history ?? 'Aman' }}</td>
                    <td><span class="badge bg-warning text-dark">Menunggu</span></td>
                    <td>
                        <a href="/doctor/examine/{{ $appointment->id }}" class="btn btn-sm btn-success">
                            <i class="bi bi-stethoscope"></i> Periksa
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        <i class="bi bi-check2-circle fs-2 d-block mb-2"></i>
                        Bagus! Tidak ada pasien dalam antrean.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection