<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient; // Panggil model Patient

class PatientController extends Controller
{
    public function index(Request $request)
    {
        // Fitur Pencarian
        $query = Patient::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('nik', 'like', '%' . $request->search . '%');
        }
        $patients = $query->get();
        
        return view('patients.index', compact('patients'));
    }

    // Fitur Export CSV
    public function export()
    {
        $patients = Patient::all();
        $filename = "data_pasien_" . date('Ymd') . ".csv";
        
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        $handle = fopen('php://output', 'w');
        // Header Kolom Excel
        fputcsv($handle, ['NIK', 'Nama Lengkap', 'Tgl Lahir', 'Riwayat Alergi', 'Alamat']);
        
        foreach ($patients as $p) {
            fputcsv($handle, [$p->nik, $p->name, $p->dob, $p->allergy_history, $p->address]);
        }
        
        fclose($handle);
        exit;
    }

    // 1. Menampilkan form tambah pasien
    public function create()
    {
        return view('patients.create');
    }

    // 2. Menyimpan pasien baru
    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:patients,nik',
            'name' => 'required',
            'dob' => 'required|date',
        ]);

        Patient::create($request->all());
        return redirect('/patients')->with('success', 'Data Pasien berhasil ditambahkan!');
    }

    // 3. Menampilkan halaman detail pasien
    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.show', compact('patient'));
    }

    // 4. Menampilkan form edit pasien
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        return view('patients.edit', compact('patient'));
    }

    // 5. Menyimpan perubahan data pasien
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'dob' => 'required|date',
        ]);
        
        $patient = Patient::findOrFail($id);
        $patient->update($request->all());
        
        return redirect('/patients');
    }

    // 6. Menghapus data pasien
    public function destroy($id)
    {
        Patient::findOrFail($id)->delete();
        return redirect('/patients')->with('success', 'Data Pasien telah dihapus permanen.');
    }
}