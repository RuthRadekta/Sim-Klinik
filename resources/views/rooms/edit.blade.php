@extends('layouts.app')
@section('title', 'Edit Ruangan')
@section('page_title', 'Form Edit Ruangan')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/rooms/{{ $room->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Nama Ruangan</label>
                <input type="text" name="name" class="form-control" value="{{ $room->name }}" required>
            </div>
            <div class="mb-3">
                <label>Tipe Ruangan</label>
                <select name="type" class="form-control" required>
                    <option value="Rawat Inap" {{ $room->type == 'Rawat Inap' ? 'selected' : '' }}>Rawat Inap</option>
                    <option value="Poli" {{ $room->type == 'Poli' ? 'selected' : '' }}>Poli</option>
                    <option value="UGD" {{ $room->type == 'UGD' ? 'selected' : '' }}>UGD</option>
                    <option value="Laboratorium" {{ $room->type == 'Laboratorium' ? 'selected' : '' }}>Laboratorium</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Kapasitas (Jumlah Bed)</label>
                <input type="number" name="capacity" class="form-control" value="{{ $room->capacity }}" min="1" required>
            </div>
            <div class="mb-4">
                <label>Status</label>
                <select name="status" class="form-control" required>
                    <option value="Tersedia" {{ $room->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                    <option value="Terisi" {{ $room->status == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                    <option value="Perawatan" {{ $room->status == 'Perawatan' ? 'selected' : '' }}>Perawatan (Maintenance)</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Ruangan</button>
        </form>
    </div>
</div>
@endsection