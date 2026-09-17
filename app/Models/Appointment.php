<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'doctor_id', 'date', 'status', 'queue_number'
    ];

    // Relasi: Pendaftaran ini milik 1 Pasien
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relasi: Pendaftaran ini ditangani oleh 1 Dokter
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}