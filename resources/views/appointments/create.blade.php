@extends('layouts.app')
@section('title', 'Buat Jadwal Berobat')
@section('page_title', 'Form Pendaftaran Antrean')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold text-primary"><i class="bi bi-calendar-plus me-2"></i>Informasi Pendaftaran Pasien</h6>
            </div>
            <div class="card-body p-4">
                <form action="/appointments" method="POST">
                    @csrf
                    
                    <!-- Pilihan Pasien -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">1. Pilih Pasien Terdaftar</label>
                        <select name="patient_id" class="form-select form-select-lg" required>
                            <option value="">-- Pilih Pasien --</option>
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->nik }} - {{ $patient->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text"><i class="bi bi-info-circle"></i> Jika nama pasien belum ada, silakan tambahkan dulu melalui menu <strong>Daftar Pasien</strong>.</div>
                    </div>

                    <!-- Pilihan Dokter -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">2. Pilih Dokter & Spesialisasi</label>
                        <select name="doctor_id" class="form-select form-select-lg" required>
                            <option value="">-- Pilih Dokter --</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->user->name }} ({{ $doctor->specialization }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pemilihan Tanggal -->
                    <div class="mb-4">
                        <label class="form-label fw-bold">3. Tanggal Pemeriksaan</label>
                        <!-- Secara default kita isi dengan tanggal hari ini menggunakan fungsi Carbon -->
                        <input type="date" name="date" class="form-control form-control-lg" required value="{{ \Carbon\Carbon::today()->format('Y-m-d') }}">
                        <div class="form-text">Otomatis terisi tanggal hari ini. Ubah jika ingin membuat janji temu untuk hari lain.</div>
                    </div>

                    <hr class="text-secondary mt-5 mb-4">
                    
                    <!-- Tombol Submit -->
                    <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm fw-bold">
                        <i class="bi bi-ticket-detailed me-2"></i> Ambil Nomor Antrean
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection