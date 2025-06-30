<?php

namespace Database\Seeders;

use App\Models\DoctorFacilitySchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorFacilityScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $schedules = [
            ['doctor_id' => 1, 'facility_id' => 1, 'day_id' => 1, 'shift_type' => 'صباح', 'start_time' => '08:00', 'end_time' => '12:00'],
            ['doctor_id' => 1, 'facility_id' => 2, 'day_id' => 2, 'shift_type' => 'مساء', 'start_time' => '15:00', 'end_time' => '19:00'],
            ['doctor_id' => 2, 'facility_id' => 1, 'day_id' => 3, 'shift_type' => 'صباح', 'start_time' => '08:00', 'end_time' => '11:00'],
            ['doctor_id' => 2, 'facility_id' => 3, 'day_id' => 4, 'shift_type' => 'مساء', 'start_time' => '20:00', 'end_time' => '23:00'],
            ['doctor_id' => 3, 'facility_id' => 1, 'day_id' => 5, 'shift_type' => 'صباح', 'start_time' => '07:30', 'end_time' => '10:30'],
            ['doctor_id' => 3, 'facility_id' => 2, 'day_id' => 6, 'shift_type' => 'مساء', 'start_time' => '14:00', 'end_time' => '18:00'],
            ['doctor_id' => 2, 'facility_id' => 3, 'day_id' => 7, 'shift_type' => 'صباح', 'start_time' => '09:00', 'end_time' => '12:00'],
            ['doctor_id' => 1, 'facility_id' => 2, 'day_id' => 1, 'shift_type' => 'مساء', 'start_time' => '13:00', 'end_time' => '17:00'],
            ['doctor_id' => 2, 'facility_id' => 1, 'day_id' => 3, 'shift_type' => 'صباح', 'start_time' => '21:00', 'end_time' => '00:00'],
            ['doctor_id' => 3, 'facility_id' => 1, 'day_id' => 2, 'shift_type' => 'صباح', 'start_time' => '08:00', 'end_time' => '12:00'],
        ];

        foreach ($schedules as $data) {
            DoctorFacilitySchedule::create(array_merge($data, ['is_active' => true]));
        }


    }
}
