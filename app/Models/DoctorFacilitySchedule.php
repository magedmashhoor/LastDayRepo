<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorFacilitySchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'facility_id',
        'day_id',
        'shift_type',
        'start_time',
        'end_time',
        'is_active',
    ];



    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function facility()
{
    return $this->belongsTo(\App\Models\HealthFacility::class);
}

    // public function healthFacility()
    // {
    //     return $this->belongsTo(HealthFacility::class);
    // }
    public function day()
    {
        return $this->belongsTo(Day::class);
    }


}
