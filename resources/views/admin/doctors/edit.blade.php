@extends('layouts.app')
@section('title', 'Edit Dokter')
@section('page_title', 'Form Edit Dokter')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/admin/doctors/{{ $doctor->id }}" method="POST">
            @csrf
            @method('PUT')
            
            <h6 class="text-primary mt-2">Informasi Akun</h6>
            <div class="mb-3"><label>Nama Lengkap</label><input type="text" name="name" class="form-control" value="{{ $doctor->user->name }}" required></div>
            <div class="mb-3"><label>Email Login</label><input type="email" name="email" class="form-control" value="{{ $doctor->user->email }}" required></div>
            <div class="mb-3"><label>Password Baru (Kosongkan jika tidak ingin diubah)</label><input type="password" name="password" class="form-control"></div>
            
            <hr>
            <h6 class="text-primary mt-3">Informasi Medis</h6>
            <div class="mb-3"><label>Spesialisasi</label><input type="text" name="specialization" class="form-control" value="{{ $doctor->specialization }}" required></div>
            <div class="mb-4"><label>Tarif Pemeriksaan (Rp)</label><input type="number" name="fee" class="form-control" value="{{ $doctor->fee }}" required></div>
            
            <button type="submit" class="btn btn-primary w-100">Update Data Dokter</button>
        </form>
    </div>
</div>
@endsection