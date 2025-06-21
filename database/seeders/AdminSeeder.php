<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // حساب أدمن
        User::updateOrCreate(
            ['login_id' => '20201020'],
            [
                'email' => 'admin@demo.com',
                'name' => 'Admin',
                'mobile' => '0965121663',
                'password' => bcrypt('12345678'),
                'role' => 'admin'
            ]
        );

        // حساب مدرس
        User::updateOrCreate(
            ['login_id' => '20201010'],
            [
                'name' => 'Teacher',
                'mobile' => '0965121662',
                'password' => bcrypt('password'),
                'role' => 'teacher'
            ]
        );

    }
} 