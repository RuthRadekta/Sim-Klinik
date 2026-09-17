@extends('layouts.app')
@section('title', 'Edit Obat')
@section('page_title', 'Form Update Stok/Harga Obat')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/medicines/{{ $medicine->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Obat</label>
                <input type="text" name="name" class="form-control" value="{{ $medicine->name }}" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control" rows="2">{{ $medicine->description }}</textarea>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label>Harga Satuan (Rp)</label>
                    <input type="number" name="price" class="form-control" value="{{ $medicine->price }}" required>
                </div>
                <div class="col-md-6 mb-4">
                    <label>Stok Tersedia</label>
                    <input type="number" name="stock" class="form-control" value="{{ $medicine->stock }}" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Obat</button>
        </form>
    </div>
</div>
@endsection