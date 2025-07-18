<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Package;

class QuickTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating quick test data...');
        
        // Create Admin
        $admin = User::create([
            'name' => 'أحمد محمد',
            'email' => 'admin@test.com',
            'mobile' => '0501234567',
            'role' => 'admin',
            'login_id' => 'ADMIN001',
            'user_name' => 'admin',
            'gender' => 'male',
            'password' => Hash::make('admin123'),
            'plain_password' => 'admin123',
            'is_active' => true,
            'address' => 'عنوان افتراضي',
            'notes' => 'ملاحظات افتراضية'
        ]);
        
        // Create Teacher
        $teacher = User::create([
            'name' => 'د. سارة أحمد',
            'email' => 'teacher@test.com',
            'mobile' => '0501234570',
            'role' => 'teacher',
            'login_id' => 'TCH001',
            'user_name' => 'teacher',
            'gender' => 'female',
            'password' => Hash::make('teacher123'),
            'plain_password' => 'teacher123',
            'is_active' => true,
            'address' => 'عنوان افتراضي',
            'notes' => 'ملاحظات افتراضية'
        ]);
        
        // Create Student
        $student = User::create([
            'name' => 'عبدالله أحمد',
            'email' => 'student@test.com',
            'mobile' => '0501234575',
            'role' => 'student',
            'login_id' => 'STU001',
            'user_name' => 'student',
            'gender' => 'male',
            'password' => Hash::make('student123'),
            'plain_password' => 'student123',
            'is_active' => true,
            'address' => 'عنوان افتراضي',
            'notes' => 'ملاحظات افتراضية'
        ]);
        
        // Create Category
        $category = Category::create([
            'name' => 'البرمجة',
            'description' => 'دورات في لغات البرمجة المختلفة',
            'status' => 'active'
        ]);
        
        // Create Course
        $course = Course::create([
            'title' => 'مقدمة في البرمجة بلغة Python',
            'description' => 'دورة شاملة لتعلم أساسيات البرمجة',
            'category_id' => $category->id,
            'credit_hours' => 40,
            'price' => 299,
            'currency' => 'SAR',
            'discount_percentage' => 10,
            'is_free' => false,
            'status' => 'active'
        ]);
        
        // Create Package
        $package = Package::create([
            'name' => 'باقة البرمجة الشاملة',
            'description' => 'تشمل جميع دورات البرمجة الأساسية والمتقدمة.',
            'category_id' => $category->id,
            'price' => 500,
            'currency' => 'SAR',
            'discount_percentage' => 10,
            'status' => 'active',
            'image' => null
        ]);
        
        $this->command->info('Quick test data created successfully!');
        $this->command->info('================================');
        $this->command->info('Admin - Username: admin, Password: admin123');
        $this->command->info('Teacher - Username: teacher, Password: teacher123');
        $this->command->info('Student - Username: student, Password: student123');
        $this->command->info('================================');
    }
} 