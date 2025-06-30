<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GovernorateController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\DayController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\SubspecialtyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HealthFacilityController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DoctorFacilityScheduleController;
use App\Http\Controllers\DoctorAbsenceController;
use App\Http\Controllers\HomeController;

//Route of Governorate
Route::get('/admin/governorates/create', [GovernorateController::class, 'create'])->name('governorates.create');//http://127.0.0.1:8000/admin/governorates/create
Route::post('/admin/governorates', [GovernorateController::class, 'store'])->name('governorates.store');
Route::patch('/admin/governorates/{id}', [GovernorateController::class, 'update'])->name('governorates.update');
Route::delete('/admin/governorates/{id}', [GovernorateController::class, 'destroy'])->name('governorates.destroy');
//


//Route of Districts
Route::get('/admin/districts/create', [DistrictController::class, 'create'])->name('districts.create');//http://127.0.0.1:8000/admin/districts/create
Route::post('/admin/districts', [DistrictController::class, 'store'])->name('districts.store');
Route::patch('/admin/districts/{id}', [DistrictController::class, 'update'])->name('districts.update');
Route::delete('/admin/districts/{id}', [DistrictController::class, 'destroy'])->name('districts.destroy');
//
//Route of Days

Route::get('/admin/days/create', [DayController::class, 'create'])->name('days.create');//http://127.0.0.1:8000/admin/days/create
Route::post('/admin/days', [DayController::class, 'store'])->name('days.store');
Route::patch('/admin/days/{id}', [DayController::class, 'update'])->name('days.update');
Route::delete('/admin/days/{id}', [DayController::class, 'destroy'])->name('days.destroy');
//


//oute of specialties
Route::get('/admin/specialties/create', [SpecialtyController::class, 'create'])->name('specialties.create');//http://127.0.0.1:8000/admin/specialties/create
Route::post('/admin/specialties', [SpecialtyController::class, 'store'])->name('specialties.store');
Route::patch('/admin/specialties/{id}', [SpecialtyController::class, 'update'])->name('specialties.update');
Route::delete('/admin/specialties/{id}', [SpecialtyController::class, 'destroy'])->name('specialties.destroy');
//

////Route of specialties



Route::get('/admin/subspecialties/create', [SubspecialtyController::class, 'create'])->name('subspecialties.create');//http://127.0.0.1:8000/admin/subspecialties/create
Route::post('/admin/subspecialties', [SubspecialtyController::class, 'store'])->name('subspecialties.store');
Route::patch('/admin/subspecialties/{id}', [SubspecialtyController::class, 'update'])->name('subspecialties.update');
Route::delete('/admin/subspecialties/{id}', [SubspecialtyController::class, 'destroy'])->name('subspecialties.destroy');



////Route of services
Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('services.create');
Route::post('/admin/services', [ServiceController::class, 'store'])->name('services.store');
Route::patch('/admin/services/{id}', [ServiceController::class, 'update'])->name('services.update');
Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])->name('services.destroy');//http://127.0.0.1:8000/admin/services/create


//

////Route of Users
Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
Route::patch('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');//http://127.0.0.1:8000/admin/users/create


//

////Route of HealthFacility


Route::get('/admin/HealthFacility/create', [HealthFacilityController::class, 'create'])->name('health_facilities.create');//http://127.0.0.1:8000/admin/HealthFacility/create
Route::post('/admin/HealthFacility', [HealthFacilityController::class, 'store'])->name('health_facilities.store');
Route::patch('/admin/HealthFacility/{healthFacility}', [HealthFacilityController::class, 'update'])->name('health_facilities.update');
Route::delete('/admin/HealthFacility/{healthFacility}', [HealthFacilityController::class, 'destroy'])->name('health_facilities.destroy');


////Route of Doctor


Route::get('/admin/doctors/create', [DoctorController::class, 'create'])->name('doctors.create');//http://127.0.0.1:8000/admin/doctors/create
Route::post('/admin/doctors', [DoctorController::class, 'store'])->name('doctors.store');
Route::patch('/admin/doctors/{doctor}', [DoctorController::class, 'update'])->name('doctors.update');
Route::delete('/admin/doctors/{doctor}', [DoctorController::class, 'destroy'])->name('doctors.destroy');

//Rout of Doctor Schedules


Route::get('/admin/schedules/create', [DoctorFacilityScheduleController::class, 'create'])->name('schedules.create'); // http://127.0.0.1:8000/admin/schedules/create
Route::post('/admin/schedules', [DoctorFacilityScheduleController::class, 'store'])->name('schedules.store');
Route::patch('/admin/schedules/{schedule}', [DoctorFacilityScheduleController::class, 'update'])->name('schedules.update');
Route::delete('/admin/schedules/{schedule}', [DoctorFacilityScheduleController::class, 'destroy'])->name('schedules.destroy');

//Route Of Doctor Absence


Route::get('/admin/absences/create', [DoctorAbsenceController::class, 'create'])->name('absences.create');// http://127.0.0.1:8000/admin/absences/create
Route::post('/admin/absences', [DoctorAbsenceController::class, 'store'])->name('absences.store');
Route::patch('/admin/absences/{absence}', [DoctorAbsenceController::class, 'update'])->name('absences.update');
Route::delete('/admin/absences/{absence}', [DoctorAbsenceController::class, 'destroy'])->name('absences.destroy');
// Route::prefix('admin')->group(function () {
//     Route::resource('health_facilities', HealthFacilityController::class)->only([
//         'create', 'store', 'update', 'destroy'
//     ]);
// });

//home page 
//Route::get('/admin/homepage/index', [HomeController::class, 'index'])->name('homepage.index');// http://127.0.0.1:8000/admin/homepage/index
//Route::get('/admin/homepage', [HomeController::class, 'index'])->name('homepage.index');
Route::get('/admin/homepage/index', [HomeController::class, 'index'])->name('homepage.index');