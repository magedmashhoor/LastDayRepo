<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subspecialty;
use App\Models\Specialty;
use App\Http\Requests\StoreSubspecialtyRequest;

class SubspecialtyController
{
    public function create()
    {
        $specialties = Specialty::all();
        $subspecialties = Subspecialty::with('specialty')->get();
        return view('admin.addingsubspecialty', compact('specialties', 'subspecialties'));
    }

    public function store(StoreSubspecialtyRequest $request)
    {
        Subspecialty::create($request->validated());
        return redirect()->route('subspecialties.create')->with('success', 'تمت إضافة التخصص الفرعي.');
    }

    public function update(StoreSubspecialtyRequest $request, $id)
    {
        $sub = Subspecialty::findOrFail($id);
        $sub->update($request->validated());
        return redirect()->route('subspecialties.create')->with('success', 'تم تحديث التخصص الفرعي.');
    }

    public function destroy($id)
    {
        $sub = Subspecialty::findOrFail($id);
        $sub->delete();
        return redirect()->route('subspecialties.create')->with('success', 'تم حذف التخصص الفرعي.');
    }
}

namespace App\Http\Controllers;
