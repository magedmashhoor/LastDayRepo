<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Specialty;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $specialties = [
        'الطب الباطني',
        'جراحة العظام',
        'طب الأطفال',
        'النساء والتوليد',
        'العيون',
        'الأنف والأذن والحنجرة',
        'الجلدية',
        'الأسنان',
    ];

    foreach ($specialties as $name) {
        Specialty::create([
            'specialty_name' => $name,
        ]);
    }
}
}



