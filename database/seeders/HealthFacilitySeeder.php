<?php

namespace Database\Seeders;

use App\Models\HealthFacility;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HealthFacilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facilities = [
        ['name' => 'مستشفى الجمهورية',     'type' => 'مستشفى', 'governorate_id' => 1, 'district_id' => 1],
        ['name' => 'مركز عدن الصحي',       'type' => 'مركز صحي', 'governorate_id' => 1, 'district_id' => 2],
        ['name' => 'مستشفى ابن خلدون',     'type' => 'مستشفى', 'governorate_id' => 2, 'district_id' => 4],
        ['name' => 'وحدة صحية جعار',       'type' => 'وحدة صحية', 'governorate_id' => 3, 'district_id' => 7],
    ];

    foreach ($facilities as $f) {
        HealthFacility::create([
            'facility_name'    => $f['name'],
            'facility_type'    => $f['type'],
            'governorate_id'   => $f['governorate_id'],
            'district_id'      => $f['district_id'],
        ]);


    }
}
}
