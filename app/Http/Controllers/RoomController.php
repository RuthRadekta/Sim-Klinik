<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Bed;
use App\Models\Patient;
use Carbon\Carbon;
use App\Models\Appointment;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        // Cari berdasarkan nama ruangan ATAU nama pasien yang sedang dirawat (relasi bertingkat)
        $rooms = Room::with(['beds.patient'])
            ->when($search, function($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('beds.patient', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })->get();

        return view('rooms.index', compact('rooms', 'search'));
    }

    public function show($id)
    {
        $room = Room::with(['beds.patient'])->findOrFail($id);
        $patients = Patient::all();
        return view('rooms.show', compact('room', 'patients'));
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

    // --- KHUSUS ADMIN ---
    public function create()
    {
        return view('rooms.create');
    }
    
    public function store(Request $request)
    {
        $request->validate(['name'=>'required', 'type'=>'required', 'capacity'=>'required', 'price'=>'required']);
        
        $room = Room::create($request->all());
        
        // Generate Kasur (Bed) otomatis sesuai kapasitas
        for ($i = 1; $i <= $request->capacity; $i++) {
            Bed::create([
                'room_id' => $room->id,
                'name' => 'Bed ' . $i
            ]);
        }
        return redirect('/rooms')->with('success', 'Ruangan & Kasur berhasil dibuat otomatis!');
    }

    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required', 'type' => 'required', 'capacity' => 'required|integer', 'status' => 'required']);
        
        $room = Room::with('beds')->findOrFail($id);
        $oldCapacity = $room->capacity;
        $newCapacity = $request->capacity;

        // Update data master ruangan
        $room->update($request->all());

        // Logika penyesuaian Bed
        if ($newCapacity > $oldCapacity) {
            // Jika kapasitas ditambah, buat Bed baru
            $diff = $newCapacity - $oldCapacity;
            $currentBedsCount = $room->beds->count();
            for ($i = 1; $i <= $diff; $i++) {
                Bed::create(['room_id' => $room->id, 'name' => 'Bed ' . ($currentBedsCount + $i)]);
            }
        } elseif ($newCapacity < $oldCapacity) {
            // Jika kapasitas dikurangi, hapus Bed kosong
            $diff = $oldCapacity - $newCapacity;
            $availableBeds = $room->beds()->where('status', 'Tersedia')->orderBy('id', 'desc')->take($diff)->get();
            
            if ($availableBeds->count() < $diff) {
                return back()->with('error', 'Gagal: Kapasitas tidak bisa dikurangi karena ada pasien yang sedang menempati kasur!');
            }
            foreach($availableBeds as $bed) {
                $bed->delete();
            }
        }

        return redirect('/rooms')->with('success', 'Data ruangan dan jumlah bed berhasil diperbarui!');
    }

    public function destroyBed($id)
    {
        $bed = Bed::findOrFail($id);
        if ($bed->status == 'Terisi') {
            return back()->with('error', 'Bed masih terisi pasien, tidak dapat dihapus!');
        }
        $room = $bed->room;
        $bed->delete();
        $room->decrement('capacity'); // Kurangi kapasitas ruangan
        return back()->with('success', 'Bed berhasil dihapus dari ruangan.');
    }

    // --- LOGIKA RESEPSIONIS (BOOKING & CHECKOUT) ---
    public function bookBed(Request $request, $id)
    {
        $bed = Bed::findOrFail($id);
        $bed->update([
            'patient_id' => $request->patient_id,
            'status' => 'Terisi',
            'check_in_time' => Carbon::now()
        ]);
        return back()->with('success', 'Pasien berhasil dimasukkan ke ' . $bed->name);
    }

    public function checkoutBed($id)
    {
        $bed = Bed::with('patient', 'room')->findOrFail($id);
        
        // Hitung hari min.1
        $checkIn = Carbon::parse($bed->check_in_time);
        $days = $checkIn->diffInDays(Carbon::now());
        if ($days == 0) $days = 1;

        $totalRoomFee = $days * $bed->room->price;

        $appointment = Appointment::where('patient_id', $bed->patient_id)
                                ->whereIn('status', ['pending', 'completed'])
                                ->whereDoesntHave('transaction')
                                ->latest()->first();
        
        if ($appointment) {
            $appointment->update(['room_fee' => $appointment->room_fee + $totalRoomFee]);
        }

        $bed->update(['patient_id' => null, 'status' => 'Tersedia', 'check_in_time' => null]);

        return back()->with('success', "Checkout berhasil. Biaya kamar Rp " . number_format($totalRoomFee, 0, ',', '.') . " telah dimasukkan ke tagihan kasir.");
    }
}
