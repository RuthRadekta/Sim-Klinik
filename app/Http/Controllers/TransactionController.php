<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Appointment;
use App\Models\Transaction;
use App\Models\Bed; // <-- Tambahan Model Bed
use Carbon\Carbon;  // <-- Tambahan Carbon untuk hitung hari

class TransactionController extends Controller
{
    // 1. Menampilkan daftar antrean kasir
    public function index()
    {
        $appointments = Appointment::where('status', 'completed')
            ->whereDoesntHave('transaction')
            ->get();

        return view('cashier.index', compact('appointments'));
    }

    // 2. Menampilkan detail tagihan (Invoice)
    public function invoice($id)
    {
        $appointment = Appointment::with(['patient', 'doctor', 'medicalRecord.prescriptions.medicine'])->findOrFail($id);
        
        $doctorFee = $appointment->doctor->fee;
        $roomFee = $appointment->room_fee; // Biaya dasar jika sebelumnya sudah ada
        
        // CEK OTOMATIS: Kamar yang sedang aktif
        $activeBed = Bed::with('room')->where('patient_id', $appointment->patient_id)->where('status', 'Terisi')->first();
        
        if ($activeBed) {
            // PERBAIKAN: Gunakan startOfDay() agar jam, menit, detik diabaikan secara total.
            $checkInDate = Carbon::parse($activeBed->check_in_time)->startOfDay();
            $todayDate = Carbon::now()->startOfDay();
            
            // Menghitung selisih hari kalender murni
            $days = $checkInDate->diffInDays($todayDate);
            
            // Jika pasien check-in dan bayar di hari yang sama (selisih 0), tetap dihitung 1 hari
            if ($days == 0) {
                $days = 1; 
            }
            
            // Kalikan dengan harga ruangan
            $roomFee += ($days * $activeBed->room->price);
        }
        
        // Hitung Total Biaya Obat
        $medicineTotal = 0;
        if ($appointment->medicalRecord) {
            foreach ($appointment->medicalRecord->prescriptions as $resep) {
                $medicineTotal += ($resep->quantity * $resep->medicine->price);
            }
        }

        $grandTotal = $doctorFee + $medicineTotal + $roomFee;

        return view('cashier.invoice', compact('appointment', 'doctorFee', 'medicineTotal', 'roomFee', 'grandTotal'));
    }

    // 3. Simpan pembayaran
    public function pay(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $activeBed = Bed::with('room')->where('patient_id', $appointment->patient_id)->where('status', 'Terisi')->first();
        $finalRoomFee = $appointment->room_fee;
        
        if ($activeBed) {
            // PERBAIKAN SAMA: Gunakan startOfDay()
            $checkInDate = Carbon::parse($activeBed->check_in_time)->startOfDay();
            $todayDate = Carbon::now()->startOfDay();
            $days = $checkInDate->diffInDays($todayDate);
            
            if ($days == 0) {
                $days = 1;
            }
            
            $finalRoomFee += ($days * $activeBed->room->price);

            // KOSONGKAN KAMAR
            $activeBed->update([
                'patient_id' => null,
                'status' => 'Tersedia',
                'check_in_time' => null
            ]);
        }

        $appointment->update(['room_fee' => $finalRoomFee]);

        Transaction::create([
            'appointment_id' => $id,
            'total_amount' => $request->grand_total,
            'status' => 'paid',
        ]);

        return redirect('/cashier')->with('success', 'Pembayaran Lunas! Kamar pasien telah otomatis dikosongkan.');
    }

    // 4. Download PDF
    public function downloadPdf($id)
    {
        $appointment = Appointment::with(['patient', 'doctor', 'medicalRecord.prescriptions.medicine'])->findOrFail($id);
        
        $doctorFee = $appointment->doctor->fee;
        $roomFee = $appointment->room_fee;
        
        $activeBed = Bed::with('room')->where('patient_id', $appointment->patient_id)->where('status', 'Terisi')->first();
        
        if ($activeBed) {
            // PERBAIKAN SAMA: Gunakan startOfDay()
            $checkInDate = Carbon::parse($activeBed->check_in_time)->startOfDay();
            $todayDate = Carbon::now()->startOfDay();
            $days = $checkInDate->diffInDays($todayDate);
            
            if ($days == 0) {
                $days = 1;
            }
            $roomFee += ($days * $activeBed->room->price);
        }

        $medicineTotal = 0;
        if ($appointment->medicalRecord) {
            foreach ($appointment->medicalRecord->prescriptions as $resep) {
                $medicineTotal += ($resep->quantity * $resep->medicine->price);
            }
        }
        
        $grandTotal = $doctorFee + $medicineTotal + $roomFee;

        $pdf = Pdf::loadView('cashier.invoice_pdf', compact('appointment', 'doctorFee', 'medicineTotal', 'roomFee', 'grandTotal'))
                ->setPaper('a4', 'portrait');
        
        return $pdf->download('Invoice_' . $appointment->patient->name . '.pdf');
    }
}