@extends('layouts.app')
@section('title', 'Data Dokter')
@section('page_title', 'Manajemen Dokter Klinik')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-bold">Data Dokter</h6>
        <div class="d-flex gap-2">
            <!-- Search Bar -->
            <form action="/doctors" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari nama/spesialisasi..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-secondary"><i class="bi bi-search"></i></button>
            </form>
            
            <!-- Tombol Export & Tambah -->
            <a href="/doctors/export" class="btn btn-sm btn-success"><i class="bi bi-file-earmark-excel"></i> Export</a>
            <a href="/admin/doctors/create" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama Dokter</th>
                    <th>Email Login</th>
                    <th>Spesialisasi</th>
                    <th>Tarif Pemeriksaan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($doctors as $doctor)
                <tr>
                    <td class="fw-bold">{{ $doctor->user->name }}</td>
                    <td>{{ $doctor->user->email }}</td>
                    <td><span class="badge bg-success">{{ $doctor->specialization }}</span></td>
                    <td>Rp {{ number_format($doctor->fee, 0, ',', '.') }}</td>
                    <td>
                        <a href="/admin/doctors/{{ $doctor->id }}/edit" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        
                        <form action="/admin/doctors/{{ $doctor->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus dokter ini beserta akunnya?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection