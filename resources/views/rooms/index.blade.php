@extends('layouts.app')
@section('title', 'Daftar Ruangan')
@section('page_title', 'Manajemen Ruangan Klinik')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-bold">Data Ruangan</h6>
        <div class="d-flex gap-2">
            <!-- Search Bar -->
            <form action="/rooms" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari nama..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-secondary"><i class="bi bi-search"></i></button>
            </form>
            
            <!-- Tombol Export & Tambah -->
            <a href="/rooms/export" class="btn btn-sm btn-success"><i class="bi bi-file-earmark-excel"></i> Export</a>
            <a href="/rooms/create" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama Ruangan</th>
                    <th>Tipe</th>
                    <th>Kapasitas</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                <tr>
                    <td class="fw-bold">{{ $room->name }}</td>
                    <td>{{ $room->type }}</td>
                    <td>{{ $room->capacity }} Bed</td>
                    <td>
                        @if($room->status == 'Tersedia')
                            <span class="badge bg-success">{{ $room->status }}</span>
                        @elseif($room->status == 'Terisi')
                            <span class="badge bg-warning text-dark">{{ $room->status }}</span>
                        @else
                            <span class="badge bg-danger">{{ $room->status }}</span>
                        @endif
                    </td>
                    <td>
                        <a href="/rooms/{{ $room->id }}/edit" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="/rooms/{{ $room->id }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus ruangan ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada data ruangan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection