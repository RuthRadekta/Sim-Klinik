<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    // 1. Menampilkan halaman form pendaftaran
    public function create()
    {
        $patients = Patient::all();
        // Mengambil data dokter beserta relasi nama usernya (akun)
        $doctors = Doctor::with('user')->get(); 
        
        return view('appointments.create', compact('patients', 'doctors'));
    }

    // 2. Memproses data form saat tombol Simpan ditekan
    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'date' => 'required|date',
        ]);

        // Hitung nomor antrean sederhana (berdasarkan jumlah pasien di dokter dan tanggal yang sama)
        $queueCount = Appointment::where('doctor_id', $request->doctor_id)
                                 ->where('date', $request->date)
                                 ->count();

        // Simpan ke database
        Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'status' => 'pending', // Status awal selalu 'pending' (menunggu diperiksa)
            'queue_number' => $queueCount + 1,
        ]);

        // Kembali ke halaman daftar pasien (sementara)
        return redirect('/patients');
    }
}