<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating Admin User...');
        
        // Create Admin User
        $admin = User::create([
            'name' => 'أحمد محمد',
            'email' => 'admin@admin.com',
            'mobile' => '0501234567',
            'role' => 'admin',
            'login_id' => 'ADMIN001',
            'gender' => 'male',
            'password' => Hash::make('admin123'),
            'plain_password' => 'admin123',
            'is_active' => true,
            'address' => 'عنوان افتراضي',
            'notes' => 'ملاحظات افتراضية'
        ]);
        
        $this->command->info('Admin User Created Successfully!');
        $this->command->info('================================');
        $this->command->info('Login ID: ADMIN001');
        $this->command->info('Password: admin123');
        $this->command->info('Email: admin@admin.com');
        $this->command->info('================================');
    }
} 