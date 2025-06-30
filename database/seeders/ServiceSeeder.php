<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'فحص عام',
            'استشارة طبية',
            'تحاليل مخبرية',
            'تصوير أشعة',
            'تخطيط القلب',
            'العلاج الطبيعي',
            'جراحة بسيطة',
            'متابعة حمل',
        ];

        foreach ($services as $name) {
            Service::create([
                'service_name' => $name,
            ]);
        }
    }
}
