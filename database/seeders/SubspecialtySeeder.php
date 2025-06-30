<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subspecialty;

class SubspecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    $subspecialties = [
        // specialty_id => [ list of subspecialties ]
        1 => ['أمراض القلب', 'أمراض الكلى', 'أمراض الجهاز الهضمي'],
        2 => ['جراحة العظام للأطفال', 'جراحة العمود الفقري'],
        3 => ['أمراض الأطفال حديثي الولادة', 'أمراض الدم للأطفال'],
        4 => ['العقم', 'الولادة القيصرية'],
        5 => ['جراحة الشبكية', 'أمراض القرنية'],
        6 => ['جراحة الأنف', 'أمراض السمع'],
        7 => ['الأمراض الجلدية التجميلية', 'الصدفية'],
        8 => ['تقويم الأسنان', 'جراحة الفكين'],
    ];

    foreach ($subspecialties as $specialtyId => $list) {
        foreach ($list as $name) {
            Subspecialty::create([
                'subspecialty_name' => $name,
                'specialty_id'      => $specialtyId,
            ]);
        }
    }
}
}



