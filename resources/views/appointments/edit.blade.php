@extends('layouts.app')
@section('title', 'Ubah Jadwal Appointment')
@section('page_title', 'Form Perubahan Jadwal Pasien')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/appointments/{{ $appointment->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label fw-bold">Pasien</label>
                <input type="text" class="form-control bg-light" value="{{ $appointment->patient->nik }} - {{ $appointment->patient->name }}" readonly>
                <input type="hidden" name="patient_id" value="{{ $appointment->patient_id }}">
                <small class="text-muted">Nama pasien tidak dapat diubah. Buat appointment baru jika salah pasien.</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Pindah Dokter Tujuan</label>
                <select name="doctor_id" class="form-select select2" required>
                    @foreach($doctors as $doctor)
                        <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                            {{ $doctor->user->name }} ({{ $doctor->specialization }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold">Ubah Tanggal</label>
                <input type="date" name="date" class="form-control" value="{{ $appointment->date }}" required>
            </div>

            <button type="submit" class="btn btn-sm btn-primary fw-bold"><i class="bi bi-save"></i>Update Data Pasien</button>
        </form>
            
        <form action="/appointments/{{ $appointment->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data appointment ini secara permanen?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i> Hapus</button>
        </form>
    </div>
</div>
@endsection