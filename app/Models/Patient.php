<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    // Kolom yang diizinkan untuk diisi secara massal
    protected $fillable = [
        'nik', 'name', 'dob', 'address', 'allergy_history'
    ];

    // Relasi: 1 Pasien -> Banyak Pendaftaran (One to Many)
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}