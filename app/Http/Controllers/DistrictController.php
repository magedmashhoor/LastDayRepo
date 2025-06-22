<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Governorate;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDistrictRequest;

class DistrictController
{
     /**
     * Show the form for creating and managing districts.
     */
    public function create()
    {
        $governorates = Governorate::all();
        $districts = District::with('governorate')->get();

        return view('admin.addingdistrict', compact('governorates', 'districts'));
    }

    /**
     * Store a new district.
     */
    public function store(StoreDistrictRequest $request)
    {
        District::create($request->validated());

        return redirect()->route('districts.create')->with('success', 'تمت إضافة المديرية بنجاح.');
    }

    /**
     * Update a district.
     */
    public function update(StoreDistrictRequest $request, $id)
    {
        $district = District::findOrFail($id);
        $district->update($request->validated());

        return redirect()->route('districts.create')->with('success', 'تم تعديل بيانات المديرية.');
    }

    /**
     * Delete a district.
     */
    public function destroy($id)
    {
        $district = District::findOrFail($id);
        $district->delete();

        return redirect()->route('districts.create')->with('success', 'تم حذف المديرية.');

    }
}



