<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Room;
use Carbon\Carbon;

class ResepsionisController extends Controller
{
    public function dashboard()
    {
        $todayAppointments = Appointment::whereDate('date', Carbon::today())
                                        ->where('status', 'pending')
                                        ->count();

        $pendingPayments = Appointment::where('status', 'completed')->whereDoesntHave('transaction')->count();
        $availableRooms = Room::where('status', 'Tersedia')->count();

        return view('resepsionis.dashboard', compact('todayAppointments', 'pendingPayments', 'availableRooms'));
    }
}
