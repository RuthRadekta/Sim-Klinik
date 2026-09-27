<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;

class AppointmentController extends Controller
{
    // Menampilkan HANYA pasien yang BELUM diperiksa
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor'])
                                   ->where('status', 'pending')
                                   ->orderBy('date', 'asc')
                                   ->get();
        return view('appointments.index', compact('appointments'));
    }
    
    public function create()
    {
        $patients = Patient::all();
        $doctors = Doctor::with('user')->get();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    // Proses Simpan dengan Validasi Ganda
    public function store(Request $request)
    {
        // CEK: Apakah pasien sudah antre di dokter yang sama dan belum diperiksa?
        $isDuplicate = Appointment::where('patient_id', $request->patient_id)
                                  ->where('doctor_id', $request->doctor_id)
                                  ->where('status', 'pending')
                                  ->exists();

        if ($isDuplicate) {
            return back()->with('error', 'Pasien ini sudah terdaftar di dokter tersebut dan saat ini masih dalam antrean (Belum diperiksa).');
        }

        Appointment::create([
            'patient_id' => $request->patient_id,
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
            'status' => 'pending',
            'queue_number' => Appointment::whereDate('date', $request->date)->where('doctor_id', $request->doctor_id)->count() + 1
        ]);

        return redirect('/appointments')->with('success', 'Appointment berhasil dibuat!');
    }

    // Form Edit Appointment
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $doctors = Doctor::with('user')->get();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    // Proses Update Appointment
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Cek duplikasi HANYA JIKA dokter diubah ke dokter lain
        if ($appointment->doctor_id != $request->doctor_id) {
            $isDuplicate = Appointment::where('patient_id', $request->patient_id)
                                      ->where('doctor_id', $request->doctor_id)
                                      ->where('status', 'pending')
                                      ->exists();
            if ($isDuplicate) {
                return back()->with('error', 'Pasien ini sudah memiliki antrean aktif di dokter yang baru dipilih.');
            }
        }

        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'date' => $request->date,
        ]);

        return redirect('/appointments')->with('success', 'Jadwal dan Dokter berhasil diubah!');
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        
        return redirect('/appointments');
    }
}