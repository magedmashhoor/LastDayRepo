<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;

class ServiceController
{
       public function create()
    {
        $services = Service::all();
        return view('admin.addingservice', compact('services'));
    }

    public function store(StoreServiceRequest $request)
    {
        Service::create($request->validated());
        return redirect()->route('services.create')->with('success', 'تمت إضافة الخدمة.');
    }

    public function update(StoreServiceRequest $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->validated());
        return redirect()->route('services.create')->with('success', 'تم تعديل الخدمة.');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('services.create')->with('success', 'تم حذف الخدمة.');
    }
}


