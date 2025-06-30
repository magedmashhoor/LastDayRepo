<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $users = [
        [
            'username'        => 'admin1',
            'first_name'      => 'أحمد',
            'last_name'       => 'الشميري',
            'email'           => 'ahmed@example.com',
            'password_hash'   => Hash::make('password123'),
            'phone_number'    => '777123456',
            'user_type'       => 'admin',
            'governorate_id'  => 1,
            'district_id'     => 1,
        ],
        [
            'username'        => 'doctor1',
            'first_name'      => 'سعاد',
            'last_name'       => 'علي',
            'email'           => 'suad@example.com',
            'password_hash'   => Hash::make('password123'),
            'phone_number'    => '777987654',
            'user_type'       => 'doctor',
            'governorate_id'  => 2,
            'district_id'     => 4,
        ],
        [
            'username'        => 'user1',
            'first_name'      => 'فهد',
            'last_name'       => 'المحمدي',
            'email'           => 'fahd@example.com',
            'password_hash'   => Hash::make('password123'),
            'phone_number'    => null,
            'user_type'       => 'user',
            'governorate_id'  => 3,
            'district_id'     => 7,
        ],
    ];

    foreach ($users as $data) {
        User::create($data);
    }
    }
}

