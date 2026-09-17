@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('page_title', 'Manajemen Karyawan Klinik')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Daftar Karyawan</h6>
        <a href="/admin/employees/create" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah Karyawan</a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>No. Telp</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($employees as $employee)
                <tr>
                    <td class="fw-bold">{{ $employee->name }}</td>
                    <td><span class="badge bg-info text-dark">{{ $employee->position }}</span></td>
                    <td>{{ $employee->phone }}</td>
                    <td>{{ $employee->address }}</td>
                    <td>
                        <a href="/admin/employees/{{ $employee->id }}/edit" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        
                        <form action="/admin/employees/{{ $employee->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus karyawan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada data karyawan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection