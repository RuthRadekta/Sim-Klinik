@extends('layouts.app')
@section('title', 'Tambah Karyawan')
@section('page_title', 'Form Tambah Karyawan')

@section('content')
<div class="card shadow-sm border-0" style="max-width: 600px;">
    <div class="card-body">
        <form action="/admin/employees" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <!-- Ganti <select> Jabatan yang lama dengan kode ini -->
            <div class="mb-3">
                <label>Jabatan</label>
                <select name="position" class="form-select" id="positionSelect" required>
                    <option value="Perawat">Perawat</option>
                    <option value="Apoteker">Apoteker</option>
                    <option value="Resepsionis">Resepsionis</option> <!-- Tambahan opsi Resepsionis -->
                    <option value="Cleaning Service">Cleaning Service</option>
                </select>
            </div>
            <!-- Kotak Input Login (Sembunyi secara default) -->
            <div class="alert alert-info mt-3" id="akunResepsionis" style="display:none;">
                <h6><i class="bi bi-person-plus"></i> Buat Akun Login Resepsionis</h6>
                <div class="mb-2">
                    <label>Email Login</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="mb-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            // Info lainnya
            <div class="mb-3">
                <label>No. HP</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label>Alamat</label>
                <textarea name="address" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Simpan Karyawan</button>
        </form>
    </div>
</div>
<script>
    // Memunculkan kotak email/password otomatis jika memilih Resepsionis
    document.getElementById('positionSelect').addEventListener('change', function() {
        if(this.value === 'Resepsionis') {
            document.getElementById('akunResepsionis').style.display = 'block';
        } else {
            document.getElementById('akunResepsionis').style.display = 'none';
        }
    });
</script>
@endsection