<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'specialization', 'fee'
    ];

    // Relasi: 1 Dokter dimiliki 1 User (Akun)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi: 1 Dokter -> Banyak Pendaftaran
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}