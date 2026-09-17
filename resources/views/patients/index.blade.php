@extends('layouts.app')

@section('title', 'Daftar Pasien')
@section('page_title', 'Daftar Pasien')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-bold">Data Pasien Terdaftar</h6>
        <div class="d-flex gap-2">
            <!-- Search Bar -->
            <form action="/patients" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari nama/NIK..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-secondary"><i class="bi bi-search"></i></button>
            </form>
            
            <!-- Tombol Export & Tambah -->
            <a href="/patients/export" class="btn btn-sm btn-success"><i class="bi bi-file-earmark-excel"></i> Export</a>
            <a href="/patients/create" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <!-- Tambahkan class 'table' dari Bootstrap -->
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Tgl Lahir</th>
                    <th>Riwayat Alergi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patients as $patient)
                <tr>
                    <td>{{ $patient->nik }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->dob }}</td>
                    <td class="text-danger">{{ $patient->allergy_history }}</td>
                    <td>
                        <a href="/patients/{{ $patient->id }}" class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i> Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection