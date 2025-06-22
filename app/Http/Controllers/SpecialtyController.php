<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSpecialtyRequest;
use App\Models\Specialty;

class SpecialtyController
{
     public function create()
    {
        $specialties = Specialty::all();
        return view('admin.addingspecialty', compact('specialties'));
    }

    public function store(StoreSpecialtyRequest $request)
    {
        Specialty::create($request->validated());
        return redirect()->route('specialties.create')->with('success', 'تمت إضافة التخصص.');
    }

    public function update(StoreSpecialtyRequest $request, $id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->update($request->validated());
        return redirect()->route('specialties.create')->with('success', 'تم تعديل اسم التخصص.');
    }

    public function destroy($id)
    {
        $specialty = Specialty::findOrFail($id);
        $specialty->delete();
        return redirect()->route('specialties.create')->with('success', 'تم حذف التخصص.');
    }
}

