<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGovernorateRequest;
use App\Models\Governorate;

class GovernorateController
{
    /**
     * Show the form for creating a new governorate.
     */
    public function create()
    {
       // return view('admin.addinggov');
        $governorates = Governorate::all(); // Fetch all governorates from DB
        return view('admin.addinggov', compact('governorates'));
    }

    /**
     * Store a newly created governorate in the database.
     */
    public function store(StoreGovernorateRequest $request)
    {
        // Validate the request data
        $validated = $request->validated();

        // Create the governorate record
        Governorate::create([
            'governorate_name' => $validated['governorate_name'],
        ]);

        // Redirect back with a success message
        return redirect()->route('governorates.create')->with('success', 'تمت إضافة المحافظة بنجاح.');
    }
    public function update(StoreGovernorateRequest $request, $id)
    {
        $gov = Governorate::findOrFail($id);
        $gov->update([
            
            
            'governorate_name' => $request->governorate_name,
            
        ]);

        return redirect()->route('governorates.create')->with('success', 'تم تحديث اسم المحافظة بنجاح.');
    }
    public function destroy($id)
{
    $governorate = Governorate::findOrFail($id);
    $governorate->delete();

    return redirect()->route('governorates.create')->with('success', 'تم حذف المحافظة بنجاح.');
}
}
