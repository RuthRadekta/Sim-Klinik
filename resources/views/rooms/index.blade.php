@extends('layouts.app')
@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-bold">Daftar Ruangan & Kamar</h6>
        <div class="d-flex gap-2">
            <!-- Form Pencarian -->
            <form action="/rooms" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control form-control-sm me-2" placeholder="Cari ruang / pasien..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-sm btn-secondary"><i class="bi bi-search"></i></button>
            </form>
            
            @if(Auth::user()->role == 'admin')
                <a href="/rooms/create" class="btn btn-sm btn-primary"><i class="bi bi-plus-lg"></i> Tambah Ruangan</a>
            @endif
        </div>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Nama Ruangan</th><th>Tipe</th><th>Kapasitas</th><th>Harga / Hari</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                <tr>
                    <td class="fw-bold">{{ $room->name }}</td>
                    <td>{{ $room->type }}</td>
                    <td>
                        {{ $room->capacity }} Bed
                        <!-- Jika sedang mencari, tampilkan info pasien yang nyangkut di kamar ini -->
                        @if(request('search'))
                            <br>
                            @foreach($room->beds as $bed)
                                @if($bed->patient && stripos($bed->patient->name, request('search')) !== false)
                                    <span class="badge bg-danger mt-1 text-wrap text-start">
                                        <i class="bi bi-person-fill"></i> {{ $bed->patient->name }}<br>
                                        <small>(di {{ $bed->name }})</small>
                                    </span>
                                @endif
                            @endforeach
                        @endif
                    </td>
                    <td>Rp {{ number_format($room->price, 0, ',', '.') }}</td>
                    <td>
                        <!-- Semua Role bisa klik tombol CEK BED -->
                        <a href="/rooms/{{ $room->id }}" class="btn btn-sm btn-info text-white"><i class="bi bi-grid"></i> Cek Ketersediaan Kamar</a>
                        
                        @if(Auth::user()->role == 'admin')
                            <a href="/rooms/{{ $room->id }}/edit" class="btn btn-sm btn-outline-secondary ms-1"><i class="bi bi-pencil"></i></a>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection