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
        $this->command->info('🚀 إنشاء حساب المدير...');
        
        // بيانات المدير
        $adminData = [
            'name' => 'أحمد محمد',
            'email' => 'admin@admin.com',
            'mobile' => '0501234567',
            'role' => 'admin',
            'login_id' => 'ADMIN001',
            'user_name' => 'admin',
            'gender' => 'male',
            'password' => Hash::make('admin123'),
            'plain_password' => 'admin123',
            'is_active' => true,
            'address' => 'عنوان افتراضي',
            'notes' => 'حساب المدير الافتراضي'
        ];
        
        // التحقق من وجود المدير مسبقاً
        $existingAdmin = User::where('email', $adminData['email'])->first();
        
        if ($existingAdmin) {
            $this->command->warn('⚠️  حساب المدير موجود بالفعل!');
            $this->command->info('📋 معلومات تسجيل الدخول:');
        } else {
            // إنشاء المدير
            $admin = User::create($adminData);
            $this->command->info('✅ تم إنشاء حساب المدير بنجاح!');
            $this->command->info('📋 معلومات تسجيل الدخول:');
        }
        
        // عرض معلومات تسجيل الدخول
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('👤 اسم المستخدم: admin');
        $this->command->info('🔑 كلمة المرور: admin123');
        $this->command->info('📧 البريد الإلكتروني: admin@admin.com');
        $this->command->info('🆔 معرف تسجيل الدخول: ADMIN001');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
        $this->command->info('💡 يمكنك استخدام هذه البيانات لتسجيل الدخول كمدير');
        $this->command->info('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
    }
} 