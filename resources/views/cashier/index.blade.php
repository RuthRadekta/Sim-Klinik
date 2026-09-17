@extends('layouts.app')
@section('title', 'Antrean Kasir')
@section('page_title', 'Antrean Pembayaran Kasir')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-header bg-white">
        <h6 class="mb-0">Daftar Pasien Menunggu Pembayaran</h6>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <thead class="table-light">
                <tr>
                    <th>No. Antrean</th>
                    <th>Nama Pasien</th>
                    <th>Tgl Berobat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $app)
                <tr>
                    <td><span class="badge bg-secondary fs-6">{{ $app->queue_number }}</span></td>
                    <td class="fw-bold">{{ $app->patient->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($app->date)->format('d F Y') }}</td>
                    <td><span class="badge bg-danger">Belum Bayar</span></td>
                    <td>
                        <a href="/cashier/invoice/{{ $app->id }}" class="btn btn-sm btn-primary">
                            <i class="bi bi-receipt"></i> Proses Tagihan
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        <i class="bi bi-emoji-smile fs-2 d-block mb-2"></i>
                        Tidak ada antrean pembayaran saat ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection