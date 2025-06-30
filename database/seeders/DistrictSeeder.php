<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Example mapping of governorate ID ➜ districts
    $districts = [
        1 => ['صيرة', 'المعلا', 'الشيخ عثمان'],
        2 => ['الحوطة', 'تبن', 'طور الباحة'],
        3 => ['زنجبار', 'جعار', 'خنفر'],
    ];

    foreach ($districts as $governorateId => $names) {
        foreach ($names as $name) {
            District::create([
                'district_name'    => $name,
                'governorate_id'   => $governorateId,
            ]);
        }
    }
}
}



