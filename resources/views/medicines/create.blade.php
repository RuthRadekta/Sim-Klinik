@extends('layouts.app')
@section('title', 'Tambah Obat')
@section('page_title', 'Form Tambah Obat Baru')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/medicines" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Obat (Beserta Dosis/Ukuran)</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Paracetamol 500mg" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi (Opsional)</label>
                <textarea name="description" class="form-control" rows="2" placeholder="Obat penurun panas..."></textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label>Harga Satuan (Rp)</label>
                    <input type="number" name="price" class="form-control" placeholder="5000" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label>Stok Awal</label>
                    <input type="number" name="stock" class="form-control" value="0" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan ke Katalog</button>
        </form>
    </div>
</div>
@endsection