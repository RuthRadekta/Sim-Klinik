@extends('layouts.app')

@section('title', 'Riwayat Pasien')
@section('page_title', 'Riwayat Pemeriksaan Pasien')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body p-0">
        <table class="table table-striped mb-0">
            <thead class="table-dark">
                <tr>
                    <th>Tgl Periksa</th>
                    <th>Pasien</th>
                    <th>Diagnosa</th>
                    <th>Catatan Dokter</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $app)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($app->date)->format('d/m/Y') }}</td>
                    <td class="fw-bold">{{ $app->patient->name }}</td>
                    <td>
                        <!-- Mengecek apakah rekam medisnya ada agar tidak error -->
                        {{ $app->medicalRecord ? $app->medicalRecord->diagnosis : 'Belum diisi' }}
                    </td>
                    <td>{{ $app->medicalRecord ? $app->medicalRecord->notes : '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">Belum ada riwayat pemeriksaan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection