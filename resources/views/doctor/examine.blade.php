@extends('layouts.app')
@section('title', 'Periksa Pasien')
@section('page_title', 'Rekam Medis Elektronik (EHR)')

@section('content')
<div class="row">
    <!-- Kolom Kiri: Informasi Pasien -->
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm border-0 h-100">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Profil Pasien</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <i class="bi bi-person-bounding-box text-secondary" style="font-size: 4rem;"></i>
                    <h5 class="mt-2 fw-bold">{{ $appointment->patient->name }}</h5>
                    <p class="text-muted mb-0">NIK: {{ $appointment->patient->nik }}</p>
                </div>
                <hr>
                <p class="mb-1"><strong>Tanggal Lahir:</strong><br> {{ \Carbon\Carbon::parse($appointment->patient->dob)->format('d F Y') }}</p>
                <p class="mb-1 mt-3"><strong>Alamat:</strong><br> {{ $appointment->patient->address }}</p>
                
                <div class="mt-4">
                    <strong>Riwayat Alergi:</strong><br>
                    <!-- Peringatan Visual jika pasien punya riwayat alergi -->
                    @if($appointment->patient->allergy_history)
                        <div class="alert alert-danger mt-2 py-2 mb-0 shadow-sm border-0">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> 
                            <strong>{{ $appointment->patient->allergy_history }}</strong>
                        </div>
                    @else
                        <span class="badge bg-success mt-2"><i class="bi bi-check-circle me-1"></i> Tidak Ada Alergi</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Form Diagnosa & Resep -->
    <div class="col-md-8 mb-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h6 class="mb-0"><i class="bi bi-clipboard2-pulse me-2"></i>Formulir Pemeriksaan</h6>
            </div>
            <div class="card-body p-4">
                <form action="/doctor/examine/{{ $appointment->id }}" method="POST">
                    @csrf
                    
                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3">1. Hasil Diagnosa</h6>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Diagnosa Utama <span class="text-danger">*</span></label>
                        <textarea name="diagnosis" class="form-control" rows="3" required placeholder="Contoh: Faringitis Akut, observasi demam hari ke-3..."></textarea>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-bold">Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Tindakan medis atau anjuran istirahat..."></textarea>
                    </div>

                    <h6 class="fw-bold text-primary border-bottom pb-2 mb-3 mt-4">2. Pemberian Obat (Opsional)</h6>
                    
                    <div class="bg-light p-3 rounded mb-4 border">
                        <div class="row g-2 align-items-end">
                            <!-- Pilihan Obat -->
                            <div class="col-md-6">
                                <label class="form-label mb-1">Pilih Obat</label>
                                <select name="medicine_id[]" class="form-select">
                                    <option value="">-- Tidak Ada Resep --</option>
                                    @foreach($medicines as $med)
                                        <option value="{{ $med->id }}">{{ $med->name }} (Sisa Stok: {{ $med->stock }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- Input Dosis -->
                            <div class="col-md-3">
                                <label class="form-label mb-1">Aturan Pakai</label>
                                <input type="text" name="dosage[]" class="form-control" placeholder="Contoh: 3x1">
                            </div>
                            <!-- Input Jumlah -->
                            <div class="col-md-3">
                                <label class="form-label mb-1">Jumlah</label>
                                <input type="number" name="quantity[]" class="form-control" min="1" placeholder="Qty">
                            </div>
                        </div>
                        <small class="text-muted mt-2 d-block">
                            <i class="bi bi-info-circle"></i> Stok obat di farmasi akan otomatis dipotong saat resep ini disimpan.
                        </small>
                    </div>

                    <!-- Tombol Submit -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-success btn-lg shadow-sm fw-bold px-4">
                            <i class="bi bi-check2-all me-2"></i> Simpan Diagnosa & Selesai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection