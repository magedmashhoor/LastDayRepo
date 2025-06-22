<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Governorate extends Model
{
    protected $fillable = ['governorate_name'];
    public function districts()
{
    return $this->hasMany(District::class);
}
}

