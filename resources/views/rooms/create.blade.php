@extends('layouts.app')
@section('title', 'Tambah Ruangan')
@section('page_title', 'Form Tambah Ruangan')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/rooms" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Ruangan (Contoh: Kamar Melati 01)</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Tipe Ruangan</label>
                <select name="type" class="form-control" required>
                    <option value="Rawat Inap">Rawat Inap</option>
                    <option value="Poli">Poli</option>
                    <option value="UGD">UGD</option>
                    <option value="Laboratorium">Laboratorium</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Kapasitas (Jumlah Bed)</label>
                <input type="number" name="capacity" class="form-control" value="1" min="1" required>
            </div>
            <div class="mb-4">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Terisi">Terisi</option>
                    <option value="Perawatan">Perawatan (Maintenance)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Ruangan</button>
        </form>
    </div>
</div>
@endsection