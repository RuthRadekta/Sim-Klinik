<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\MedicalRecord;
use App\Models\Medicine;
use App\Models\Prescription;

class MedicalRecordController extends Controller
{
    // 1. Menampilkan form periksa berdasarkan ID antrean
    public function create($id)
    {
        $appointment = Appointment::with('patient')->findOrFail($id);
        // Ambil obat yang stoknya lebih dari 0
        $medicines = Medicine::where('stock', '>', 0)->get();
        return view('doctor.examine', compact('appointment', 'medicines'));
    }

    // 2. Menyimpan diagnosa ke database
    public function store(Request $request, $id)
    {
        $request->validate(['diagnosis' => 'required']);
    
        // 1. Simpan Diagnosa ke Rekam Medis
        $medicalRecord = MedicalRecord::create([
            'appointment_id' => $id,
            'diagnosis' => $request->diagnosis,
            'notes' => $request->notes,
        ]);
    
        // 2. Cek apakah dokter memilih obat
        if ($request->has('medicine_id')) {
            foreach ($request->medicine_id as $key => $med_id) {
                // Jika dropdown obat dipilih (tidak kosong)
                if ($med_id != null) {
                    $qty = $request->quantity[$key];
                    
                    // A. Simpan data resep
                    Prescription::create([
                        'medical_record_id' => $medicalRecord->id,
                        'medicine_id' => $med_id,
                        'quantity' => $qty,
                        'dosage' => $request->dosage[$key],
                    ]);
    
                    // B. Potong stok obat di tabel Medicines otomatis
                    $medicine = Medicine::find($med_id);
                    $medicine->decrement('stock', $qty);
                }
            }
        }
    
        // 3. Ubah status pasien menjadi completed
        Appointment::where('id', $id)->update(['status' => 'completed']);
    
        return redirect('/doctor/dashboard');
    }
}