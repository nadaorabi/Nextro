<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🚀 إنشاء حساب المدير الجديد...');
        
        // بيانات المدير - يمكنك تغييرها حسب الحاجة
        $adminData = [
            'name' => 'مدير النظام',
            'email' => 'admin@nextro.com',
            'mobile' => '0500000000',
            'role' => 'admin',
            'login_id' => 'ADMIN_' . strtoupper(uniqid()),
            'user_name' => 'admin',
            'gender' => 'male',
            'password' => Hash::make('admin123'),
            'plain_password' => 'admin123',
            'is_active' => true,
            'address' => 'عنوان المدير',
            'notes' => 'حساب المدير الرئيسي'
        ];
        
        // التحقق من وجود المدير مسبقاً
        $existingAdmin = User::where('email', $adminData['email'])->first();
        
        if ($existingAdmin) {
            $this->command->warn('⚠️  حساب المدير موجود بالفعل!');
            $this->command->info('📋 معلومات تسجيل الدخول الحالية:');
        } else {
            // إنشاء المدير
            $admin = User::create($adminData);
            $this->command->info('✅ تم إنشاء حساب المدير بنجاح!');
            $this->command->info('📋 معلومات تسجيل الدخول:');
        }
        
        // عرض معلومات تسجيل الدخول
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('👤 اسم المستخدم: ' . $adminData['user_name']);
        $this->command->info('🔑 كلمة المرور: ' . $adminData['plain_password']);
        $this->command->info('📧 البريد الإلكتروني: ' . $adminData['email']);
        $this->command->info('🆔 معرف تسجيل الدخول: ' . $adminData['login_id']);
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('💡 يمكنك استخدام هذه البيانات لتسجيل الدخول كمدير');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    }
} 