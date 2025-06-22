<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class District extends Model
{
    use HasFactory;

    protected $fillable = ['district_name', 'governorate_id'];

    // Relationship: each district belongs to a governorate
    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }


}
