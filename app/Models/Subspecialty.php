<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subspecialty extends Model
{
    use HasFactory;

    protected $fillable = ['subspecialty_name', 'specialty_id'];

    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

}
