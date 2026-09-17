<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\Transaction;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Hitung total pasien terdaftar
        $totalPatients = Patient::count();
        
        // 2. Hitung total dokter
        $totalDoctors = Doctor::count();
        
        // 3. Hitung jumlah antrean/pendaftaran HARI INI
        $appointmentsToday = Appointment::whereDate('date', Carbon::today())->count();
        
        // 4. Hitung total pendapatan HARI INI dari transaksi yang 'paid'
        $incomeToday = Transaction::whereDate('created_at', Carbon::today())
                                  ->where('status', 'paid')
                                  ->sum('total_amount');

        return view('admin.dashboard', compact('totalPatients', 'totalDoctors', 'appointmentsToday', 'incomeToday'));
    }
}