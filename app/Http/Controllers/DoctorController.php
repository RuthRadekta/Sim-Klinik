<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function dashboard()
    {
        // Ambil data dokter berdasarkan user yang sedang login
        $doctor = Doctor::with('user')->where('user_id', Auth::id())->first();
        
        $appointments = Appointment::with('patient')
                        ->where('doctor_id', $doctor->id)
                        ->whereDate('date', today())
                        ->where('status', 'pending')
                        ->orderBy('queue_number', 'asc')
                        ->get();

        return view('doctor.dashboard', compact('appointments', 'doctor'));
    }

    public function history()
    {
        $doctor = Doctor::with('user')->where('user_id', Auth::id())->first();

        // Ambil data pasien yang sudah diperiksa (status: completed) beserta data rekam medisnya
        $appointments = Appointment::with(['patient', 'medicalRecord'])
                        ->where('doctor_id', $doctor->id)
                        ->where('status', 'completed')
                        ->orderBy('date', 'desc') // Urutkan dari yang terbaru
                        ->get();

        return view('doctor.history', compact('appointments', 'doctor'));
    }

    public function profile()
    {
        // 1. Ambil data dokter berdasarkan user yang sedang login
        $doctor = Doctor::with('user')->where('user_id', Auth::id())->first();
        
        // 2. Hitung total pasien yang sudah selesai diperiksa oleh dokter ini
        $totalPatients = Appointment::where('doctor_id', $doctor->id)
                                    ->where('status', 'completed')
                                    ->count();
                                    
        return view('doctor.profile', compact('doctor', 'totalPatients'));
    }
}