@extends('layouts.app')
@section('title', 'Edit Karyawan')
@section('page_title', 'Form Edit Karyawan')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/admin/employees/{{ $employee->id }}" method="POST">
            @csrf
            @method('PUT') <!-- Wajib untuk mengubah data -->
            
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ $employee->name }}" required>
            </div>
            <div class="mb-3">
                <label>Jabatan</label>
                <select name="position" class="form-control" required>
                    <option value="Perawat" {{ $employee->position == 'Perawat' ? 'selected' : '' }}>Perawat</option>
                    <option value="Apoteker" {{ $employee->position == 'Apoteker' ? 'selected' : '' }}>Apoteker</option>
                    <option value="Cleaning Service" {{ $employee->position == 'Cleaning Service' ? 'selected' : '' }}>Cleaning Service</option>
                </select>
            </div>
            <div class="mb-3">
                <label>No. HP</label>
                <input type="text" name="phone" class="form-control" value="{{ $employee->phone }}">
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="address" class="form-control" rows="3">{{ $employee->address }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Update Karyawan</button>
        </form>
    </div>
</div>
@endsection