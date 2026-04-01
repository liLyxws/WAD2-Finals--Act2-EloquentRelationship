<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
