@extends('layouts.app')
@section('title', 'Tambah Pasien')
@section('page_title', 'Form Pendaftaran Pasien Baru')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/patients" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nomor Induk Kependudukan (NIK)</label>
                <input type="text" name="nik" class="form-control" maxlength="16" required>
            </div>
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tanggal Lahir</label>
                <input type="date" name="dob" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Alamat Tempat Tinggal</label>
                <textarea name="address" class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-4">
                <label>Riwayat Alergi (Kosongkan jika tidak ada)</label>
                <input type="text" name="allergy_history" class="form-control" placeholder="Contoh: Amoxicillin, Kacang">
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Data Pasien</button>
        </form>
    </div>
</div>
@endsection