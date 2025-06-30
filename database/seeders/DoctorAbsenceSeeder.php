<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;
use App\Models\DoctorAbsence;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DoctorAbsenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('ar_SA');

        foreach (Doctor::all() as $doctor) {
            for ($i = 0; $i < 5; $i++) {
                $start = $faker->dateTimeBetween('-2 months', '+1 months');
                $end = (clone $start)->modify('+' . rand(1, 5) . ' days');

                DoctorAbsence::create([
                    'doctor_id' => $doctor->id,
                    'start_date' => $start->format('Y-m-d'),
                    'end_date' => $end->format('Y-m-d'),
                    'reason' => $faker->randomElement(['إجازة سنوية', 'عطلة طارئة', 'حالة طبية', 'سفر', 'أسباب شخصية']),
                ]);
            }
        }
    }
}



