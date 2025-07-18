<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Course;
use App\Models\Package;
use App\Models\CourseInstructor;
use App\Models\Enrollment;
use App\Models\PackageCourse;

class CompleteDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        $this->command->info('Clearing existing data...');
        $this->truncateTables();
        
        // Seed Users (Admins, Teachers, Students)
        $this->command->info('Seeding Users...');
        $this->seedUsers();
        
        // Seed Categories
        $this->command->info('Seeding Categories...');
        $this->seedCategories();
        
        // Seed Courses
        $this->command->info('Seeding Courses...');
        $this->seedCourses();
        
        // Seed Packages
        $this->command->info('Seeding Packages...');
        $this->seedPackages();
        
        // Seed Course Instructors
        $this->command->info('Seeding Course Instructors...');
        $this->seedCourseInstructors();
        
        // Seed Enrollments
        $this->command->info('Seeding Enrollments...');
        $this->seedEnrollments();
        
        // Seed Package Courses
        $this->command->info('Seeding Package Courses...');
        $this->seedPackageCourses();
        
        $this->command->info('Database seeding completed successfully!');
    }
    
    private function truncateTables()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate all tables
        $tables = [
            'enrollments', 'course_instructors', 'packages', 
            'courses', 'categories', 'users', 'package_courses'
        ];
        
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        
        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
    
    private function seedUsers()
    {
        $users = [
            // Admin
            [
                'name' => 'أحمد محمد',
                'email' => 'ahmed@admin.com',
                'mobile' => '0501234567',
                'role' => 'admin',
                'login_id' => '20240001',
                'user_name' => 'ahmed_admin',
                'gender' => 'male',
                'is_active' => true
            ],
            // Teachers
            [
                'name' => 'د. سارة أحمد',
                'email' => 'sara@teacher.com',
                'mobile' => '0501234570',
                'role' => 'teacher',
                'login_id' => 'TCH20240001',
                'user_name' => 'sara_teacher',
                'gender' => 'female',
                'is_active' => true
            ],
            [
                'name' => 'أ. محمد علي',
                'email' => 'mohamed@teacher.com',
                'mobile' => '0501234571',
                'role' => 'teacher',
                'login_id' => 'TCH20240002',
                'user_name' => 'mohamed_teacher',
                'gender' => 'male',
                'is_active' => true
            ],
            [
                'name' => 'أ. فاطمة حسن',
                'email' => 'fatima@teacher.com',
                'mobile' => '0501234572',
                'role' => 'teacher',
                'login_id' => 'TCH20240003',
                'user_name' => 'fatima_teacher',
                'gender' => 'female',
                'is_active' => true
            ],
            // Students
            [
                'name' => 'عبدالله أحمد',
                'email' => 'abdullah@student.com',
                'mobile' => '0501234575',
                'role' => 'student',
                'login_id' => '20240004',
                'user_name' => 'abdullah_student',
                'gender' => 'male',
                'is_active' => true
            ],
            [
                'name' => 'فاطمة محمد',
                'email' => 'fatima_student@student.com',
                'mobile' => '0501234576',
                'role' => 'student',
                'login_id' => '20240005',
                'user_name' => 'fatima_student',
                'gender' => 'female',
                'is_active' => true
            ],
            [
                'name' => 'علي حسن',
                'email' => 'ali@student.com',
                'mobile' => '0501234577',
                'role' => 'student',
                'login_id' => '20240006',
                'user_name' => 'ali_student',
                'gender' => 'male',
                'is_active' => true
            ],
            [
                'name' => 'مريم أحمد',
                'email' => 'maryam@student.com',
                'mobile' => '0501234578',
                'role' => 'student',
                'login_id' => '20240007',
                'user_name' => 'maryam_student',
                'gender' => 'female',
                'is_active' => true
            ],
            [
                'name' => 'يوسف محمد',
                'email' => 'youssef@student.com',
                'mobile' => '0501234579',
                'role' => 'student',
                'login_id' => '20240008',
                'user_name' => 'youssef_student',
                'gender' => 'male',
                'is_active' => true
            ]
        ];
        
        foreach ($users as $userData) {
            $plainPassword = '12345678';
            \App\Models\User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'gender' => $userData['gender'],
                'mobile' => $userData['mobile'],
                'role' => $userData['role'],
                'login_id' => $userData['login_id'],
                'user_name' => $userData['user_name'],
                'password' => \Illuminate\Support\Facades\Hash::make($plainPassword),
                'plain_password' => $plainPassword,
                'is_active' => $userData['is_active'],
                'address' => 'عنوان افتراضي',
                'notes' => 'ملاحظات افتراضية'
            ]);
        }
    }
    
    private function seedCategories()
    {
        $categories = [
            ['name' => 'البرمجة', 'description' => 'دورات في لغات البرمجة المختلفة'],
            ['name' => 'بكالوريا', 'description' => 'فئة البكالوريا', 'status' => 'active'],
            ['name' => 'تاسع', 'description' => 'فئة الصف التاسع', 'status' => 'active'],
            ['name' => 'عاشر', 'description' => 'فئة الصف العاشر', 'status' => 'active'],
        ];
        foreach ($categories as $category) {
            \App\Models\Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'status' => $category['status'] ?? 'active',
                'image' => null
            ]);
        }
    }
    
    private function seedCourses()
    {
        $courses = [
            ['title' => 'مقدمة في البرمجة بلغة Python', 'description' => 'دورة شاملة لتعلم أساسيات البرمجة', 'credit_hours' => 40, 'price' => 299, 'currency' => 'SAR'],
            ['title' => 'رياضيات', 'description' => 'كورس الرياضيات للبكالوريا', 'category_id' => 2, 'price' => 200, 'currency' => 'USD', 'status' => 'active'],
            ['title' => 'عربي', 'description' => 'كورس اللغة العربية للبكالوريا', 'category_id' => 2, 'price' => 100, 'currency' => 'USD', 'status' => 'active'],
            ['title' => 'علوم', 'description' => 'كورس العلوم للبكالوريا', 'category_id' => 2, 'price' => 200, 'currency' => 'USD', 'status' => 'active'],
            ['title' => 'رياضيات تاسع', 'description' => 'كورس الرياضيات للصف التاسع', 'category_id' => 3, 'price' => 150, 'currency' => 'USD', 'status' => 'active'],
            ['title' => 'عربي تاسع', 'description' => 'كورس اللغة العربية للصف التاسع', 'category_id' => 3, 'price' => 120, 'currency' => 'USD', 'status' => 'active'],
            ['title' => 'انجليزي تاسع', 'description' => 'كورس اللغة الإنجليزية للصف التاسع', 'category_id' => 3, 'price' => 130, 'currency' => 'USD', 'status' => 'active'],
        ];
        $categories = \App\Models\Category::all();
        foreach ($courses as $index => $course) {
            \App\Models\Course::create([
                'title' => $course['title'],
                'description' => $course['description'],
                'category_id' => $course['category_id'] ?? $categories[0]->id,
                'credit_hours' => $course['credit_hours'] ?? 0,
                'price' => $course['price'] ?? 0,
                'currency' => $course['currency'] ?? 'SAR',
                'discount_percentage' => 10,
                'is_free' => false,
                'status' => $course['status'] ?? 'active'
            ]);
        }
    }
    
    private function seedPackages()
    {
        $packages = [
            [
                'name' => 'باقة البرمجة الشاملة',
                'description' => 'تشمل جميع دورات البرمجة الأساسية والمتقدمة.',
                'category_id' => 1,
                'price' => 500,
                'currency' => 'SAR',
                'discount_percentage' => 10,
                'status' => 'active',
                'image' => null,
                'courses' => [1],
            ],
            [
                'name' => 'مسار تعليمي تاسع',
                'description' => 'باقة شاملة للصف التاسع',
                'category_id' => 3,
                'price' => 400,
                'currency' => 'USD',
                'status' => 'active'
            ],
        ];
        foreach ($packages as $data) {
            $courses = $data['courses'] ?? [];
            unset($data['courses']);
            $package = \App\Models\Package::create($data);
            if ($courses) {
                $syncData = [];
                $originalPrice = 0;
                foreach ($courses as $courseId) {
                    $course = \App\Models\Course::find($courseId);
                    $discount = 0;
                    $final = $course ? $course->price - ($course->price * $discount / 100) : 0;
                    $syncData[$courseId] = ['discount_percentage' => $discount];
                    $originalPrice += $final;
                }
                $package->courses()->attach($syncData);
                $package->original_price = $originalPrice;
                $package->discounted_price = $originalPrice - ($originalPrice * ($data['discount_percentage'] ?? 0) / 100);
                $package->save();
            }
        }
    }
    
    private function seedCourseInstructors()
    {
        $teacher = \App\Models\User::where('role', 'teacher')->first();
        $course = \App\Models\Course::first();
        if ($teacher && $course) {
            \App\Models\CourseInstructor::create([
                'course_id' => $course->id,
                'instructor_id' => $teacher->id,
                'role' => 'primary',
                'notes' => 'ملاحظات حول تعيين المدرس'
            ]);
        }
    }
    
    private function seedEnrollments()
    {
        $student = \App\Models\User::where('role', 'student')->first();
        $course = \App\Models\Course::first();
        if ($student && $course) {
            \App\Models\Enrollment::create([
                'student_id' => $student->id,
                'course_id' => $course->id,
                'enrollment_date' => now(),
                'status' => 'active',
                'notes' => 'ملاحظات حول التسجيل'
            ]);
        }
    }
    
    private function seedPackageCourses()
    {
        $packageCourses = [
            ['package_id' => 1, 'course_id' => 4],
            ['package_id' => 1, 'course_id' => 5],
            ['package_id' => 1, 'course_id' => 6],
        ];
        foreach ($packageCourses as $pcData) {
            \App\Models\PackageCourse::create($pcData);
        }
    }
} 