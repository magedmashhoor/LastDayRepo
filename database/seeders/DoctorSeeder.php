<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $doctors = [
        [
            'doctor_name'          => 'د. محمد الجفري',
            'gender'               => 'ذكر',
            'specialty_id'         => 1,
            'subspecialty_id'      => 2,
            'qualification_degree' => 'دكتوراه في أمراض القلب',
            'bio'                  => 'متخصص في علاج أمراض القلب والشرايين.',
            'average_rating'       => 4.8,
            'total_reviews'        => 42,
            'governorate_id'       => 1,
            'district_id'          => 1,
        ],
        [
            'doctor_name'          => 'د. هدى باحمدين',
            'gender'               => 'أنثى',
            'specialty_id'         => 3,
            'subspecialty_id'      => null,
            'qualification_degree' => 'ماجستير طب الأطفال',
            'bio'                  => 'خبرة واسعة في علاج الأطفال حديثي الولادة.',
            'average_rating'       => 4.5,
            'total_reviews'        => 31,
            'governorate_id'       => 2,
            'district_id'          => 4,
        ],
        [
            'doctor_name'          => 'د. طارق النمر',
            'gender'               => 'ذكر',
            'specialty_id'         => 2,
            'subspecialty_id'      => 3,
            'qualification_degree' => 'بورد جراحة العظام',
            'bio'                  => 'جراح خبير في الكسور والمفاصل.',
            'average_rating'       => 4.2,
            'total_reviews'        => 17,
            'governorate_id'       => 3,
            'district_id'          => 7,
        ],
    ];

    foreach ($doctors as $data) {
        Doctor::create($data);
    }
    }
}
