<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GovernorateSeeder::class,
            DistrictSeeder::class,
            SpecialtySeeder::class,
            SubspecialtySeeder::class,
            ServiceSeeder::class,
            DaySeeder::class,
            HealthFacilitySeeder::class,
            UserSeeder::class,
            DoctorSeeder::class,
            DoctorFacilityScheduleSeeder::class,
            DoctorAbsenceSeeder::class,

        ]);

        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
