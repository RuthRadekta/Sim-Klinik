@extends('layouts.app')
@section('title', 'Edit Pasien')
@section('page_title', 'Form Update Data Pasien')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/patients/{{ $patient->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Nomor Induk Kependudukan (NIK)</label>
                <input type="text" name="nik" class="form-control" value="{{ $patient->nik }}" readonly>
                <small class="text-muted">NIK tidak dapat diubah setelah didaftarkan.</small>
            </div>
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ $patient->name }}" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="dob" class="form-control" value="{{ $patient->dob }}" required>
            </div>
            <div class="mb-3">
                <label>Alamat Tempat Tinggal</label>
                <textarea name="address" class="form-control" rows="2">{{ $patient->address }}</textarea>
            </div>
            <div class="mb-4">
                <label>Riwayat Alergi</label>
                <input type="text" name="allergy_history" class="form-control" value="{{ $patient->allergy_history }}">
            </div>
            <button type="submit" class="btn btn-warning w-100 fw-bold">Update Data Pasien</button>
        </form>
    </div>
</div>
@endsection