@extends('layouts.app')
@section('title', 'Detail Pasien')
@section('page_title', 'Informasi Detail Pasien')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 700px;">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-bold">Data Demografi Pasien</h6>
        <div>
            <!-- Tombol Edit -->
            <a href="/patients/{{ $patient->id }}/edit" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            
            <!-- Tombol Delete -->
            <form action="/patients/{{ $patient->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data pasien ini secara permanen?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
            </form>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tr>
                <th width="30%" class="text-secondary">NIK</th>
                <td class="fw-bold">: {{ $patient->nik }}</td>
            </tr>
            <tr>
                <th class="text-secondary">Nama Lengkap</th>
                <td class="fw-bold">: {{ $patient->name }}</td>
            </tr>
            <tr>
                <th class="text-secondary">Tanggal Lahir</th>
                <td>: {{ \Carbon\Carbon::parse($patient->dob)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th class="text-secondary">Alamat</th>
                <td>: {{ $patient->address ?? '-' }}</td>
            </tr>
            <tr>
                <th class="text-secondary">Riwayat Alergi</th>
                <td>: 
                    @if($patient->allergy_history)
                        <span class="text-danger fw-bold">{{ $patient->allergy_history }}</span>
                    @else
                        <span class="badge bg-success">Tidak Ada Alergi</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th class="text-secondary">Terdaftar Sejak</th>
                <td>: {{ $patient->created_at->format('d/m/Y') }}</td>
            </tr>
        </table>
        
        <hr>
        <a href="/patients" class="btn btn-outline-secondary w-100">Kembali ke Daftar Pasien</a>
    </div>
</div>
@endsection