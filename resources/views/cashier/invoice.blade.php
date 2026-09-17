@extends('layouts.app')
@section('title', 'Invoice Pembayaran')
@section('page_title', 'Rincian Tagihan Pasien')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-body p-4">
                <!-- Header Invoice -->
                <div class="text-center mb-4">
                    <h4 class="fw-bold">INVOICE PEMBAYARAN</h4>
                    <p class="text-muted mb-0">Sistem Informasi Manajemen Klinik</p>
                    <small>Tanggal: {{ \Carbon\Carbon::now()->format('d F Y, H:i') }}</small>
                </div>
                
                <hr class="mb-4">
                
                <!-- Informasi Pasien -->
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <h6 class="text-muted mb-1">Ditagihkan Kepada:</h6>
                        <h5 class="fw-bold mb-1">{{ $appointment->patient->name }}</h5>
                        <p class="mb-0 text-secondary">NIK: {{ $appointment->patient->nik }}</p>
                    </div>
                </div>

                <!-- Tabel Rincian -->
                <table class="table table-bordered mb-4">
                    <thead class="table-light">
                        <tr>
                            <th>Deskripsi Layanan & Obat</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- 1. Biaya Jasa Dokter -->
                        <tr>
                            <td>
                                <strong>Jasa Konsultasi Medis</strong><br>
                                <small class="text-muted">Oleh: {{ $appointment->doctor->user->name }} ({{ $appointment->doctor->specialization }})</small>
                            </td>
                            <td class="text-center">1</td>
                            <td class="text-end">Rp {{ number_format($doctorFee, 0, ',', '.') }}</td>
                        </tr>
                        
                        <!-- 2. Biaya Resep Obat -->
                        @if($appointment->medicalRecord && $appointment->medicalRecord->prescriptions->count() > 0)
                            <tr>
                                <td colspan="3" class="bg-light fw-bold text-secondary">Resep Obat:</td>
                            </tr>
                            @foreach($appointment->medicalRecord->prescriptions as $resep)
                            <tr>
                                <td>
                                    {{ $resep->medicine->name }} <br>
                                    <small class="text-muted">Dosis: {{ $resep->dosage }}</small>
                                </td>
                                <td class="text-center">x{{ $resep->quantity }}</td>
                                <td class="text-end">Rp {{ number_format($resep->quantity * $resep->medicine->price, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end text-muted">Total Biaya Obat:</th>
                            <th class="text-end text-muted">Rp {{ number_format($medicineTotal, 0, ',', '.') }}</th>
                        </tr>
                        <tr class="table-info fs-5">
                            <th colspan="2" class="text-end text-primary align-middle">GRAND TOTAL:</th>
                            <th class="text-end text-primary fw-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>

                <!-- Tombol Konfirmasi -->
                <div class="mt-4">
                    <form action="/cashier/pay/{{ $appointment->id }}" method="POST">
                        @csrf
                        <input type="hidden" name="grand_total" value="{{ $grandTotal }}">
                        <button type="submit" class="btn btn-success btn-lg w-100 fw-bold shadow-sm">
                            <i class="bi bi-check-circle-fill me-2"></i> Konfirmasi Pembayaran Lunas
                        </button>
                    </form>
                    <a href="/cashier" class="btn btn-link w-100 mt-2 text-muted text-decoration-none">Batal dan Kembali ke Antrean</a>
                </div>
                <a href="/cashier/invoice/{{ $appointment->id }}/pdf" class="btn btn-outline-danger btn-lg w-100 mt-2 shadow-sm fw-bold">
                    <i class="bi bi-file-earmark-pdf me-2"></i> Download Invoice (PDF)
                </a>
            </div>
        </div>
    </div>
</div>
@endsection