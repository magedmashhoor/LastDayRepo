<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorAbsence extends Model
{
   use HasFactory;

    protected $fillable = [
        'doctor_id',
        'start_date',
        'end_date',
        'reason',
    ];

    public function doctor()
    {
        return $this->belongsTo(\App\Models\Doctor::class);
    }

 
}
