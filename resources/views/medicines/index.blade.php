@extends('layouts.app')
@section('title', 'Daftar Obat')
@section('page_title', 'Manajemen Farmasi (Stok Obat)')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-bold">Data Obat</h6>
        <div class="d-flex gap-2">
            <!-- Search Bar -->
            <form action="/medicines" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari nama obat..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-secondary"><i class="bi bi-search"></i></button>
            </form>
            
            <!-- Tombol Export & Tambah -->
            <a href="/medicines/export" class="btn btn-sm btn-success"><i class="bi bi-file-earmark-excel"></i> Export</a>
            <a href="/medicines/create" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah</a>
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama Obat</th>
                    <th>Keterangan</th>
                    <th>Harga</th>
                    <th>Stok Tersedia</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($medicines as $med)
                <tr>
                    <td class="fw-bold">{{ $med->name }}</td>
                    <td>{{ $med->description ?? '-' }}</td>
                    <td>Rp {{ number_format($med->price, 0, ',', '.') }}</td>
                    <td>
                        @if($med->stock > 20)
                            <span class="badge bg-success">{{ $med->stock }} Pcs</span>
                        @elseif($med->stock > 0)
                            <span class="badge bg-warning text-dark">{{ $med->stock }} Pcs (Menipis)</span>
                        @else
                            <span class="badge bg-danger">Habis</span>
                        @endif
                    </td>
                    <td>
                        <a href="/medicines/{{ $med->id }}/edit" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil"></i></a>
                        <form action="/medicines/{{ $med->id }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus obat ini dari katalog?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Katalog obat masih kosong.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection