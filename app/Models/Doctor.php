<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // 1. Import dapat ito
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory; 
    protected $fillable = ['name', 'specialization', 'license_number'];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}