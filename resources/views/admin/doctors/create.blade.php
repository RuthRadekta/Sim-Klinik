@extends('layouts.app')
@section('title', 'Tambah Dokter')
@section('page_title', 'Form Pendaftaran Dokter')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <div class="alert alert-warning">
            <i class="bi bi-info-circle"></i> Sistem akan otomatis membuatkan akun login (User) untuk dokter baru.
        </div>
        
        <form action="/admin/doctors" method="POST">
            @csrf
            <h6 class="text-primary mt-2">Informasi Akun (Untuk Login)</h6>
            <div class="mb-3"><label>Nama Lengkap (Serta Gelar)</label><input type="text" name="name" class="form-control" required></div>
            <div class="mb-3"><label>Email Login</label><input type="email" name="email" class="form-control" required></div>
            <div class="mb-3"><label>Password (Buat sementara)</label><input type="password" name="password" class="form-control" required></div>
            
            <hr>
            <h6 class="text-primary mt-3">Informasi Medis</h6>
            <div class="mb-3"><label>Spesialisasi (Contoh: Dokter Umum, Spesialis Anak)</label><input type="text" name="specialization" class="form-control" required></div>
            <div class="mb-4"><label>Tarif Pemeriksaan (Rp)</label><input type="number" name="fee" class="form-control" required placeholder="100000"></div>
            
            <button type="submit" class="btn btn-primary w-100">Simpan & Buat Akun Dokter</button>
        </form>
    </div>
</div>
@endsection