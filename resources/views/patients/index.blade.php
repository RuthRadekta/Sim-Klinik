@extends('layouts.app')

@section('title', 'Daftar Pasien')
@section('page_title', 'Daftar Pasien')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Data Pasien Terdaftar</h6>
        <button class="btn btn-sm btn-primary">+ Tambah Pasien</button>
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
                        <button class="btn btn-sm btn-info text-white"><i class="bi bi-eye"></i> Detail</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection