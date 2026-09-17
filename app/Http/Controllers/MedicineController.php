<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medicine;

class MedicineController extends Controller
{
    public function index(Request $request)
    {
        // Fitur Pencarian
        $query = Medicine::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $medicines = $query->get();
        
        return view('medicines.index', compact('medicines'));
    }

    // Fitur Export CSV
    public function export()
    {
        $medicines = Medicine::all();
        $filename = "data_obat_" . date('Ymd') . ".csv";
        
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        $handle = fopen('php://output', 'w');
        // Header Kolom Excel
        fputcsv($handle, ['Nama Obat', 'Harga', 'Stok']);
        
        foreach ($medicines as $m) {
            fputcsv($handle, [$m->name, $m->price, $m->stock]);
        }
        
        fclose($handle);
        exit;
    }

    public function create()
    {
        return view('medicines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer'
        ]);

        Medicine::create($request->all());
        return redirect('/medicines');
    }

    public function edit($id)
    {
        $medicine = Medicine::findOrFail($id);
        return view('medicines.edit', compact('medicine'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|integer',
            'stock' => 'required|integer'
        ]);
        
        $medicine = Medicine::findOrFail($id);
        $medicine->update($request->all());
        
        return redirect('/medicines');
    }

    public function destroy($id)
    {
        Medicine::findOrFail($id)->delete();
        return redirect('/medicines');
    }
}
