<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use App\Models\HealthFacility;
use App\Models\Governorate;
use App\Models\District;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHealthFacilityRequest;

class HealthFacilityController
{
    public function create()
    {
        $governorates = Governorate::all();
        $districts = District::all();
        $users = User::all();
        $facilities = HealthFacility::with(['governorate', 'district', 'responsibleUser'])->get();

        // Load this Blade file: resources/views/admin/addinghealthfacility.blade.php
        return view('admin.addinghealthfacility', compact('governorates', 'districts', 'users', 'facilities'));
    }

    public function store(StoreHealthFacilityRequest $request)
    {
        HealthFacility::create($request->validated());

        // return redirect()->route('addinghealthfacility.create')->with('success', 'تمت إضافة المرفق الصحي بنجاح.');
        return redirect()->route('health_facilities.create')->with('success', 'تمت إضافة المرفق الصحي بنجاح.');
    }

    public function update(StoreHealthFacilityRequest $request, HealthFacility $healthFacility)
    {
        $healthFacility->update($request->validated());

        // return redirect()->route('addinghealthfacility.create')->with('success', 'تم تحديث المرفق الصحي.');
        return redirect()->route('health_facilities.create')->with('success', 'تم تحديث المرفق الصحي.');
    }

    public function destroy(HealthFacility $healthFacility)
    {
        $healthFacility->delete();

       // return redirect()->route('addinghealthfacility.create')->with('success', 'تم حذف المرفق الصحي.');
       return redirect()->route('health_facilities.create')->with('success', 'تم حذف المرفق الصحي.');
    }
}
