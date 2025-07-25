<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class QuickAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('');
        $this->command->info('🎯 إنشاء حساب المدير السريع...');
        $this->command->info('');
        
        // بيانات المدير
        $username = 'admin';
        $password = 'admin123';
        $email = 'admin@nextro.com';
        $loginId = 'ADMIN_' . date('Ymd') . '_' . rand(1000, 9999);
        
        $adminData = [
            'name' => 'مدير النظام',
            'email' => $email,
            'mobile' => '0500000000',
            'role' => 'admin',
            'login_id' => $loginId,
            'user_name' => $username,
            'gender' => 'male',
            'password' => Hash::make($password),
            'plain_password' => $password,
            'is_active' => true,
            'address' => 'عنوان المدير',
            'notes' => 'حساب المدير السريع'
        ];
        
        // التحقق من وجود المدير
        $existingAdmin = User::where('email', $email)->first();
        
        if ($existingAdmin) {
            $this->command->warn('⚠️  حساب المدير موجود بالفعل!');
            $this->command->info('📋 معلومات تسجيل الدخول الحالية:');
        } else {
            // إنشاء المدير
            $admin = User::create($adminData);
            $this->command->info('✅ تم إنشاء حساب المدير بنجاح!');
            $this->command->info('📋 معلومات تسجيل الدخول:');
        }
        
        // عرض معلومات تسجيل الدخول بشكل واضح
        $this->command->info('');
        $this->command->info('╔══════════════════════════════════════════════════════════════╗');
        $this->command->info('║                    بيانات تسجيل الدخول                        ║');
        $this->command->info('╠══════════════════════════════════════════════════════════════╣');
        $this->command->info('║ 👤 اسم المستخدم: ' . str_pad($username, 35) . ' ║');
        $this->command->info('║ 🔑 كلمة المرور: ' . str_pad($password, 35) . ' ║');
        $this->command->info('║ 📧 البريد الإلكتروني: ' . str_pad($email, 30) . ' ║');
        $this->command->info('║ 🆔 معرف تسجيل الدخول: ' . str_pad($loginId, 25) . ' ║');
        $this->command->info('╚══════════════════════════════════════════════════════════════╝');
        $this->command->info('');
        $this->command->info('💡 يمكنك استخدام هذه البيانات لتسجيل الدخول كمدير');
        $this->command->info('');
    }
} 