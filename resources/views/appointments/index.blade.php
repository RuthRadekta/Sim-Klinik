@extends('layouts.app')
@section('title', 'Daftar Appointment')
@section('page_title', 'Daftar Antrean Aktif')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Antrean</th>
                    <th>Nama Pasien</th>
                    <th>Dokter Tujuan</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $app)
                <tr>
                    <td><span class="badge bg-secondary">{{ $app->queue_number }}</span></td>
                    <td class="fw-bold">{{ $app->patient->name }}</td>
                    <td>{{ $app->doctor->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($app->date)->format('d F Y') }}</td>
                    <td>
                        <a href="/appointments/{{ $app->id }}/edit" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i> Ubah Jadwal</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">Belum ada pasien yang mendaftar (antrean kosong).</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection