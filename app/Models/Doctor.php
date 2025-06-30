<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_name',
        'gender',
        'specialty_id',
        'subspecialty_id',
        'qualification_degree',
        'bio',
        'average_rating',
        'total_reviews',
        'governorate_id',
        'district_id',
    ];




    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function specialty()
    {
        return $this->belongsTo(Specialty::class);
    }

    public function subspecialty()
    {
        return $this->belongsTo(Subspecialty::class);
    }
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function absences()
{
    return $this->hasMany(\App\Models\DoctorAbsence::class);
}


}
