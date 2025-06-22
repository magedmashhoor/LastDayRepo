<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\District;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController
{
    public function create()
{
    $users = User::with(['governorate', 'district'])->get();
    $governorates = Governorate::all();
    $districts = District::all();

    

    return view('admin.addinguser', compact('users', 'governorates', 'districts'));
}

public function store(StoreUserRequest $request)
{
     $data = $request->validated();

    $data['password_hash'] = Hash::make($data['password_hash']);
    User::create($data);
    //User::create($request->validated());
    return redirect()->route('users.create')->with('success', 'تمت إضافة المستخدم.');
}

public function update(StoreUserRequest $request, $id)
{
    $user = User::findOrFail($id);
    $user->update($request->validated());
    return redirect()->route('users.create')->with('success', 'تم تحديث المستخدم.');
}

public function destroy($id)
{
    User::findOrFail($id)->delete();
    return redirect()->route('users.create')->with('success', 'تم حذف المستخدم.');
}
}
