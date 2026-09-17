<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        // Fitur Pencarian
        $query = Room::query();
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('type', 'like', '%' . $request->search . '%');
        }
        $rooms = $query->get();
        
        return view('rooms.index', compact('rooms'));
    }

    // Fitur Export CSV
    public function export()
    {
        $rooms = Room::all();
        $filename = "data_ruangan_" . date('Ymd') . ".csv";
        
        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        $handle = fopen('php://output', 'w');
        // Header Kolom Excel
        fputcsv($handle, ['Nama Ruangan', 'Tipe', 'Kapasitas', 'Status']);
        
        foreach ($rooms as $r) {
            fputcsv($handle, [$r->name, $r->type, $r->capacity, $r->status]);
        }
        
        fclose($handle);
        exit;
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'capacity' => 'required|integer',
            'status' => 'required'
        ]);

        Room::create($request->all());
        return redirect('/rooms');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required', 'type' => 'required', 'capacity' => 'required|integer', 'status' => 'required']);
        
        $room = Room::findOrFail($id);
        $room->update($request->all());
        
        return redirect('/rooms');
    }

    public function destroy($id)
    {
        Room::findOrFail($id)->delete();
        return redirect('/rooms');
    }
}
