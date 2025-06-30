<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\DoctorAbsence;

use App\Http\Requests\StoreDoctorAbsenceRequest;

class DoctorAbsenceController
{

    public function create()
    {
        $doctors = Doctor::all();
        $absences = DoctorAbsence::with('doctor')->get();

        return view('admin.adddoctorabsence', compact('doctors', 'absences'));
    }

    public function store(StoreDoctorAbsenceRequest $request)
    {
        DoctorAbsence::create($request->validated());

        return redirect()->route('absences.create')->with('success', 'تم تسجيل الغياب بنجاح.');
    }

    public function update(StoreDoctorAbsenceRequest $request, DoctorAbsence $absence)
    {
        $absence->update($request->validated());

        return redirect()->route('absences.create')->with('success', 'تم تحديث بيانات الغياب.');
    }

    public function destroy(DoctorAbsence $absence)
    {
        $absence->delete();

        return redirect()->route('absences.create')->with('success', 'تم حذف سجل الغياب.');
    }
}






