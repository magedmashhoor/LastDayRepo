<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['عدن', 'لحج', 'أبين'];

    foreach ($names as $name) {
        Governorate::create(['governorate_name' => $name]);
    }


    }
}
