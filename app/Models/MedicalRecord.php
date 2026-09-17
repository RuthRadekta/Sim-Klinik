<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_id', 'diagnosis', 'notes'];

    // Relasi kembali ke pendaftaran
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    // TAMBAHKAN FUNGSI INI: 
    // 1 Rekam Medis memiliki Banyak Resep (hasMany)
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}