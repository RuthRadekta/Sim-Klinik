<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Resepsionis/Admin
        User::create([
            'name' => 'Admin Klinik',
            'email' => 'admin@klinik.com',
            'password' => Hash::make('password123'),
            // 'role' => 'admin' // Hapus tanda komentar jika Anda membuat kolom role di tabel users
        ]);

        // 2. Buat Akun Dokter
        $userDokter = User::create([
            'name' => 'Dr. Andi (Umum)',
            'email' => 'dokter@klinik.com',
            'password' => Hash::make('password123'),
            // 'role' => 'doctor' // Hapus tanda komentar jika Anda membuat kolom role
        ]);

        // 3. Masukkan profil spesifik dokter yang terhubung ke akun di atas
        Doctor::create([
            'user_id' => $userDokter->id,
            'specialization' => 'Dokter Umum',
            'fee' => 100000,
        ]);

        // 4. Buat Data Pasien
        Patient::create([
            'nik' => '3372010101010001',
            'name' => 'Budi Santoso',
            'dob' => '1990-05-20',
            'address' => 'Jl. Slamet Riyadi, Surakarta',
            'allergy_history' => 'Amoxicillin, Kacang'
        ]);
    }
}