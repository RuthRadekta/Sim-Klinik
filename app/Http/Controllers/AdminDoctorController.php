<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminDoctorController extends Controller
{
    public function index(Request $request)
    {
        // Fitur Pencarian
        $query = Doctor::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('specialization', 'like', '%' . $request->search . '%');
        }
        $doctors = $query->get();
        
        return view('admin.doctors.index', compact('doctors'));
    }

    // Fitur Export CSV
    public function export()
    {
        $doctors = Doctor::all();
        $filename = "data_dokter_" . date('Ymd') . ".csv";
        
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        $handle = fopen('php://output', 'w');
        // Header Kolom Excel
        fputcsv($handle, ['Nama Lengkap', 'Email', 'Spesialisasi', 'Fee']);
        
        foreach ($doctors as $p) {
            fputcsv($handle, [$p->user->name, $p->user->email, $p->specialization, $p->fee]);
        }
        
        fclose($handle);
        exit;
    }

    public function create()
    {
        return view('admin.doctors.create');
    }

    public function store(Request $request)
    {
        // 1. Buat Akun User Dulu (untuk login)
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Enkripsi password
            'role' => 'doctor', // Paksa role menjadi dokter
        ]);

        // 2. Hubungkan User tersebut dengan Profil Dokter
        Doctor::create([
            'user_id' => $user->id,
            'specialization' => $request->specialization,
            'fee' => $request->fee,
        ]);

        return redirect('/admin/doctors');
    }

    public function edit($id)
    {
        $doctor = Doctor::with('user')->findOrFail($id);
        return view('admin.doctors.edit', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = Doctor::findOrFail($id);
        
        // 1. Update data akun (User)
        $user = $doctor->user;
        $user->name = $request->name;
        $user->email = $request->email;
        // Jika admin mengisi password baru, update passwordnya
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        // 2. Update data medis (Doctor)
        $doctor->update([
            'specialization' => $request->specialization,
            'fee' => $request->fee,
        ]);
        
        return redirect('/admin/doctors');
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        // Menghapus User otomatis akan menghapus Doctor karena ada relasi Cascade di tabel
        $doctor->user->delete(); 
        
        return redirect('/admin/doctors');
    }
}