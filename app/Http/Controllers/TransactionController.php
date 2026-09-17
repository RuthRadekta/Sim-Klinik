<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Transaction;

class TransactionController extends Controller
{
    // 1. Menampilkan daftar pasien yang sudah diperiksa TAPI belum bayar
    public function index()
    {
        $appointments = Appointment::where('status', 'completed')
            ->whereDoesntHave('transaction') // Cari yang belum ada di tabel transaksi
            ->get();

        return view('cashier.index', compact('appointments'));
    }

    // 2. Menampilkan detail tagihan (Invoice)
    public function invoice($id)
    {
        // Ambil data berlapis: Pendaftaran -> Pasien -> Dokter -> Rekam Medis -> Resep -> Obat
        $appointment = Appointment::with(['patient', 'doctor', 'medicalRecord.prescriptions.medicine'])->findOrFail($id);
        
        // Hitung Biaya Dokter
        $doctorFee = $appointment->doctor->fee;
        
        // Hitung Total Biaya Obat
        $medicineTotal = 0;
        if ($appointment->medicalRecord) {
            foreach ($appointment->medicalRecord->prescriptions as $resep) {
                $medicineTotal += ($resep->quantity * $resep->medicine->price);
            }
        }

        $grandTotal = $doctorFee + $medicineTotal;

        return view('cashier.invoice', compact('appointment', 'doctorFee', 'medicineTotal', 'grandTotal'));
    }

    // 3. Simpan pembayaran
    public function pay(Request $request, $id)
    {
        Transaction::create([
            'appointment_id' => $id,
            'total_amount' => $request->grand_total,
            'status' => 'paid',
        ]);

        return redirect('/cashier');
    }
}