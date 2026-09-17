<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient; // Panggil model Patient

class PatientController extends Controller
{
    public function index()
    {
        // Ambil semua data pasien
        $patients = Patient::all();
        
        // Kirim data ke file view bernama 'index' di dalam folder 'patients'
        return view('patients.index', compact('patients'));
    }
}