<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'type', 'capacity', 'price', 'status'];

    public function beds() {
        return $this->hasMany(Bed::class);
    }
}
