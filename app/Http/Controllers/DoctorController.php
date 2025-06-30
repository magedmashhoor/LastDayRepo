<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialty;
use App\Models\Subspecialty;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDoctorRequest;
use App\Models\Governorate;
use App\Models\District;

class DoctorController
{


    public function create()
    {
        $specialties    = Specialty::all();
        $subspecialties = Subspecialty::all();
        $governorates   = Governorate::all();
        $districts      = District::all();
        $doctors        = Doctor::with(['specialty', 'subspecialty', 'governorate', 'district'])->get();

        return view('admin.addingdoctor', compact(
            'specialties',
            'subspecialties',
            'governorates',
            'districts',
            'doctors'
        ));
    }



    public function store(StoreDoctorRequest $request)
    {
        Doctor::create($request->validated());

        return redirect()->route('doctors.create')->with('success', 'تمت إضافة الطبيب بنجاح.');
    }

    public function update(StoreDoctorRequest $request, Doctor $doctor)
    {
        $doctor->update($request->validated());

        return redirect()->route('doctors.create')->with('success', 'تم تحديث بيانات الطبيب.');
    }

    public function destroy(Doctor $doctor)
    {
        $doctor->delete();

        return redirect()->route('doctors.create')->with('success', 'تم حذف الطبيب.');
    }
}
