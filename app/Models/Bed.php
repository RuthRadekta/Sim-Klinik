<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    protected $fillable = ['room_id', 'patient_id', 'name', 'status', 'check_in_time'];

    public function room() { return $this->belongsTo(Room::class); }
    public function patient() { return $this->belongsTo(Patient::class); }
}
