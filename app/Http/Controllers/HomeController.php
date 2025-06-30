<?php

namespace App\Http\Controllers;

use App\Models\DoctorFacilitySchedule;

class HomeController 
{
    public function index()
    {
        $schedules = DoctorFacilitySchedule::with(['doctor', 'facility', 'day'])->take(5)

                      ->where('is_active', true)
                      ->get();

        return view('admin.homepage', compact('schedules'));
    }
}