<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    use HasFactory;

    protected $fillable = ['specialty_name'];

    //  relate specialties with subspecialties or doctors
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function subspecialties()
    {
        return $this->hasMany(Subspecialty::class);
    }
}

