<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDayRequest;
use App\Models\Day;


class DayController
{
    public function create()
    {
        $days = Day::all();
        return view('admin.addingday', compact('days'));
        
    }

    public function store(StoreDayRequest $request)
    {
        Day::create($request->validated());
        return redirect()->route('days.create')->with('success', 'تمت إضافة اليوم.');
    }

    public function update(StoreDayRequest $request, $id)
    {
        $day = Day::findOrFail($id);
        $day->update($request->validated());
        return redirect()->route('days.create')->with('success', 'تم تعديل اسم اليوم.');
    }

    public function destroy($id)
    {
        $day = Day::findOrFail($id);
        $day->delete();
        return redirect()->route('days.create')->with('success', 'تم حذف اليوم.');
    }

    //check update on 1-7-2025
    //Second update on 1-7-2025
   
}
