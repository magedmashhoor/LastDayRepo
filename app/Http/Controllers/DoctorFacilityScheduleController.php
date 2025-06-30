<?php

namespace App\Http\Controllers;
use App\Models\Doctor;
use App\Models\Day;
use App\Models\HealthFacility;
use App\Models\DoctorFacilitySchedule;
use App\Http\Requests\StoreDoctorFacilityScheduleRequest;
use Illuminate\Http\Request;

class DoctorFacilityScheduleController
{
    public function create()
{
    $doctors    = \App\Models\Doctor::all();
    $facilities = \App\Models\HealthFacility::all();
    $days       = \App\Models\Day::all();
    $schedules  = \App\Models\DoctorFacilitySchedule::with(['doctor', 'facility', 'day'])->get();

    return view('admin.addingdoctorfacilityschedule', compact(
        'doctors',
        'facilities',
        'days',
        'schedules'
    ));
}
    public function index()
    {
        $schedules = DoctorFacilitySchedule::with(['doctor', 'facility', 'day'])->get();
        $doctors = Doctor::all();
        $facilities = HealthFacility::all();
        $days = Day::all();

        return view('admin.schedule.index', compact('schedules', 'doctors', 'facilities', 'days'));
    }

    public function store(StoreDoctorFacilityScheduleRequest $request)
    {
        DoctorFacilitySchedule::create($request->validated());

        return back()->with('success', 'تمت إضافة الجدول بنجاح.');
    }

    public function destroy(DoctorFacilitySchedule $schedule)
    {
        $schedule->delete();

        return back()->with('success', 'تم حذف الجدول بنجاح.');
    }
}



