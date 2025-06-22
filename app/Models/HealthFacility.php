<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthFacility extends Model
{
    use HasFactory;

    protected $fillable = [
        'facility_name',
        'facility_type',
        'address',
        'governorate_id',
        'district_id',
        'phone_number_1',
        'phone_number_2',
        'whatsapp_number',
        'responsible_user_id',
    ];
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function responsibleUser()
    {
        return $this->belongsTo(User::class, 'responsible_user_id');
    }
}
