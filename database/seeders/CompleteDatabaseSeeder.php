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
use App\Models\Material;
use App\Models\Exam;
use App\Models\Schedule;
use App\Models\Complaint;
use App\Models\Message;
use App\Models\Grade;
use App\Models\Attendance;
use App\Models\Payment;
use App\Models\StudentPackage;
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
        
        // Seed Materials
        $this->command->info('Seeding Materials...');
        $this->seedMaterials();
        
        // Seed Exams
        $this->command->info('Seeding Exams...');
        $this->seedExams();
        
        // Seed Schedules
        $this->command->info('Seeding Schedules...');
        $this->seedSchedules();
        
        // Seed Complaints
        $this->command->info('Seeding Complaints...');
        $this->seedComplaints();
        
        // Seed Messages
        $this->command->info('Seeding Messages...');
        $this->seedMessages();
        
        // Seed Grades
        $this->command->info('Seeding Grades...');
        $this->seedGrades();
        
        // Seed Attendances
        $this->command->info('Seeding Attendances...');
        $this->seedAttendances();
        
        // Seed Payments
        $this->command->info('Seeding Payments...');
        $this->seedPayments();
        
        // Seed Package Courses
        $this->command->info('Seeding Package Courses...');
        $this->seedPackageCourses();
        
        // Seed Student Packages
        $this->command->info('Seeding Student Packages...');
        $this->seedStudentPackages();
        
        $this->command->info('Database seeding completed successfully!');
    }
    
    private function truncateTables()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate all tables
        $tables = [
            'student_packages', 'package_courses', 'payments', 'attendances', 
            'grades', 'messages', 'complaints', 'schedules', 'exams', 
            'materials', 'enrollments', 'course_instructors', 'packages', 
            'courses', 'categories', 'users'
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
            // Admins
            ['name' => 'أحمد محمد', 'email' => 'ahmed@admin.com', 'mobile' => '0501234567', 'role' => 'admin', 'login_id' => '20240001', 'gender' => 'male'],
            ['name' => 'فاطمة علي', 'email' => 'fatima@admin.com', 'mobile' => '0501234568', 'role' => 'admin', 'login_id' => '20240002', 'gender' => 'female'],
            ['name' => 'محمد حسن', 'email' => 'mohammed@admin.com', 'mobile' => '0501234569', 'role' => 'admin', 'login_id' => '20240003', 'gender' => 'male'],
            
            // Teachers
            ['name' => 'د. سارة أحمد', 'email' => 'sara@teacher.com', 'mobile' => '0501234570', 'role' => 'teacher', 'login_id' => 'TCH20240001', 'gender' => 'female'],
            ['name' => 'د. خالد محمد', 'email' => 'khalid@teacher.com', 'mobile' => '0501234571', 'role' => 'teacher', 'login_id' => 'TCH20240002', 'gender' => 'male'],
            ['name' => 'د. نورا سعد', 'email' => 'nora@teacher.com', 'mobile' => '0501234572', 'role' => 'teacher', 'login_id' => 'TCH20240003', 'gender' => 'female'],
            ['name' => 'د. عمر عبدالله', 'email' => 'omar@teacher.com', 'mobile' => '0501234573', 'role' => 'teacher', 'login_id' => 'TCH20240004', 'gender' => 'male'],
            ['name' => 'د. ليلى محمد', 'email' => 'layla@teacher.com', 'mobile' => '0501234574', 'role' => 'teacher', 'login_id' => 'TCH20240005', 'gender' => 'female'],
            
            // Students
            ['name' => 'عبدالله أحمد', 'email' => 'abdullah@student.com', 'mobile' => '0501234575', 'role' => 'student', 'login_id' => '20240004', 'gender' => 'male'],
            ['name' => 'مريم علي', 'email' => 'maryam@student.com', 'mobile' => '0501234576', 'role' => 'student', 'login_id' => '20240005', 'gender' => 'female'],
            ['name' => 'يوسف محمد', 'email' => 'youssef@student.com', 'mobile' => '0501234577', 'role' => 'student', 'login_id' => '20240006', 'gender' => 'male'],
            ['name' => 'زينب أحمد', 'email' => 'zainab@student.com', 'mobile' => '0501234578', 'role' => 'student', 'login_id' => '20240007', 'gender' => 'female'],
            ['name' => 'علي حسن', 'email' => 'ali@student.com', 'mobile' => '0501234579', 'role' => 'student', 'login_id' => '20240008', 'gender' => 'male'],
            ['name' => 'فاطمة محمد', 'email' => 'fatima2@student.com', 'mobile' => '0501234580', 'role' => 'student', 'login_id' => '20240009', 'gender' => 'female'],
            ['name' => 'حسن علي', 'email' => 'hassan@student.com', 'mobile' => '0501234581', 'role' => 'student', 'login_id' => '20240010', 'gender' => 'male'],
            ['name' => 'نورا أحمد', 'email' => 'nora2@student.com', 'mobile' => '0501234582', 'role' => 'student', 'login_id' => '20240011', 'gender' => 'female'],
            ['name' => 'محمد سعد', 'email' => 'mohammed2@student.com', 'mobile' => '0501234583', 'role' => 'student', 'login_id' => '20240012', 'gender' => 'male'],
            ['name' => 'آمنة علي', 'email' => 'amna@student.com', 'mobile' => '0501234584', 'role' => 'student', 'login_id' => '20240013', 'gender' => 'female'],
            ['name' => 'عبدالرحمن محمد', 'email' => 'abdulrahman@student.com', 'mobile' => '0501234585', 'role' => 'student', 'login_id' => '20240014', 'gender' => 'male'],
        ];
        
        foreach ($users as $userData) {
            $plainPassword = '12345678';
            User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'gender' => $userData['gender'],
                'mobile' => $userData['mobile'],
                'role' => $userData['role'],
                'login_id' => $userData['login_id'],
                'password' => Hash::make($plainPassword),
                'plain_password' => $plainPassword,
                'is_active' => true,
                'address' => 'عنوان افتراضي',
                'notes' => 'ملاحظات افتراضية'
            ]);
        }
    }
    
    private function seedCategories()
    {
        $categories = [
            ['name' => 'البرمجة', 'description' => 'دورات في لغات البرمجة المختلفة'],
            ['name' => 'التصميم', 'description' => 'دورات في التصميم الجرافيكي والويب'],
            ['name' => 'التسويق', 'description' => 'دورات في التسويق الرقمي والتقليدي'],
            ['name' => 'اللغات', 'description' => 'دورات في تعلم اللغات الأجنبية'],
            ['name' => 'الأعمال', 'description' => 'دورات في إدارة الأعمال والاقتصاد'],
            ['name' => 'التكنولوجيا', 'description' => 'دورات في التكنولوجيا الحديثة'],
            ['name' => 'الصحة', 'description' => 'دورات في الصحة واللياقة البدنية'],
            ['name' => 'الفنون', 'description' => 'دورات في الفنون والثقافة'],
            ['name' => 'العلوم', 'description' => 'دورات في العلوم والرياضيات'],
            ['name' => 'التعليم', 'description' => 'دورات في طرق التدريس والتعليم'],
        ];
        
        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'status' => 'active',
                'image' => null
            ]);
        }
    }
    
    private function seedCourses()
    {
        $courses = [
            ['title' => 'مقدمة في البرمجة بلغة Python', 'description' => 'دورة شاملة لتعلم أساسيات البرمجة', 'credit_hours' => 40, 'price' => 299, 'currency' => 'SAR'],
            ['title' => 'تصميم المواقع الإلكترونية', 'description' => 'تعلم HTML, CSS, JavaScript', 'credit_hours' => 60, 'price' => 399, 'currency' => 'SAR'],
            ['title' => 'التسويق الرقمي', 'description' => 'استراتيجيات التسويق عبر الإنترنت', 'credit_hours' => 50, 'price' => 350, 'currency' => 'SAR'],
            ['title' => 'تعلم اللغة الإنجليزية', 'description' => 'دورة متكاملة في اللغة الإنجليزية', 'credit_hours' => 80, 'price' => 450, 'currency' => 'SAR'],
            ['title' => 'إدارة المشاريع', 'description' => 'مبادئ وأساليب إدارة المشاريع', 'credit_hours' => 45, 'price' => 320, 'currency' => 'SAR'],
            ['title' => 'الذكاء الاصطناعي', 'description' => 'مقدمة في الذكاء الاصطناعي والتعلم الآلي', 'credit_hours' => 70, 'price' => 500, 'currency' => 'SAR'],
            ['title' => 'اللياقة البدنية', 'description' => 'برامج تدريبية للصحة واللياقة', 'credit_hours' => 30, 'price' => 200, 'currency' => 'SAR'],
            ['title' => 'الرسم الرقمي', 'description' => 'تعلم الرسم باستخدام البرامج الرقمية', 'credit_hours' => 55, 'price' => 380, 'currency' => 'SAR'],
            ['title' => 'الرياضيات المتقدمة', 'description' => 'دورة في الجبر والتفاضل والتكامل', 'credit_hours' => 90, 'price' => 550, 'currency' => 'SAR'],
            ['title' => 'طرق التدريس الحديثة', 'description' => 'استراتيجيات التدريس الفعال', 'credit_hours' => 40, 'price' => 280, 'currency' => 'SAR'],
        ];
        
        $categories = Category::all();
        
        foreach ($courses as $index => $course) {
            Course::create([
                'title' => $course['title'],
                'description' => $course['description'],
                'category_id' => $categories[$index % $categories->count()]->id,
                'credit_hours' => $course['credit_hours'],
                'price' => $course['price'],
                'currency' => $course['currency'],
                'discount_percentage' => rand(0, 20),
                'is_free' => false,
                'status' => 'active'
            ]);
        }
    }
    
    private function seedPackages()
    {
        $packages = [
            ['name' => 'الباقة الأساسية', 'description' => 'باقة مناسبة للمبتدئين', 'price' => 500, 'currency' => 'SAR'],
            ['name' => 'الباقة المتقدمة', 'description' => 'باقة شاملة للمتقدمين', 'price' => 800, 'currency' => 'SAR'],
            ['name' => 'الباقة الاحترافية', 'description' => 'باقة احترافية للمحترفين', 'price' => 1200, 'currency' => 'SAR'],
            ['name' => 'باقة البرمجة', 'description' => 'دورات متخصصة في البرمجة', 'price' => 600, 'currency' => 'SAR'],
            ['name' => 'باقة التصميم', 'description' => 'دورات متخصصة في التصميم', 'price' => 550, 'currency' => 'SAR'],
            ['name' => 'باقة التسويق', 'description' => 'دورات متخصصة في التسويق', 'price' => 450, 'currency' => 'SAR'],
            ['name' => 'باقة اللغات', 'description' => 'دورات متخصصة في اللغات', 'price' => 400, 'currency' => 'SAR'],
            ['name' => 'باقة الأعمال', 'description' => 'دورات متخصصة في الأعمال', 'price' => 700, 'currency' => 'SAR'],
            ['name' => 'باقة التكنولوجيا', 'description' => 'دورات متخصصة في التكنولوجيا', 'price' => 900, 'currency' => 'SAR'],
            ['name' => 'الباقة الشاملة', 'description' => 'جميع الدورات بأسعار مخفضة', 'price' => 1500, 'currency' => 'SAR'],
        ];
        
        $categories = Category::all();
        
        foreach ($packages as $index => $package) {
            Package::create([
                'name' => $package['name'],
                'description' => $package['description'],
                'price' => $package['price'],
                'currency' => $package['currency'],
                'category_id' => $categories[$index % $categories->count()]->id,
                'status' => 'active',
                'image' => null
            ]);
        }
    }
    
    private function seedCourseInstructors()
    {
        $teachers = User::where('role', 'teacher')->get();
        $courses = Course::all();
        
        for ($i = 0; $i < 10; $i++) {
            CourseInstructor::create([
                'course_id' => $courses[$i % $courses->count()]->id,
                'instructor_id' => $teachers[$i % $teachers->count()]->id,
                'role' => ['primary', 'assistant', 'guest'][rand(0, 2)],
                'notes' => 'ملاحظات حول تعيين المدرس'
            ]);
        }
    }
    
    private function seedEnrollments()
    {
        $students = User::where('role', 'student')->get();
        $courses = Course::all();
        
        for ($i = 0; $i < 10; $i++) {
            Enrollment::create([
                'student_id' => $students[$i % $students->count()]->id,
                'course_id' => $courses[$i % $courses->count()]->id,
                'enrollment_date' => now()->subDays(rand(1, 30)),
                'status' => ['active', 'pending', 'completed', 'dropped'][rand(0, 3)],
                'notes' => 'ملاحظات حول التسجيل'
            ]);
        }
    }
    
    private function seedMaterials()
    {
        $courses = Course::all();
        $teachers = User::where('role', 'teacher')->get();
        
        $materials = [
            ['title' => 'ملخص الدرس الأول', 'type' => 'lecture'],
            ['title' => 'فيديو تعليمي', 'type' => 'lecture'],
            ['title' => 'ملف Word للواجب', 'type' => 'assignment'],
            ['title' => 'عرض تقديمي', 'type' => 'notes'],
            ['title' => 'رابط خارجي', 'type' => 'lecture'],
            ['title' => 'ملخص الدرس الثاني', 'type' => 'notes'],
            ['title' => 'فيديو عملي', 'type' => 'lecture'],
            ['title' => 'ملف PDF للقراءة', 'type' => 'notes'],
            ['title' => 'عرض تقديمي متقدم', 'type' => 'notes'],
            ['title' => 'رابط فيديو تعليمي', 'type' => 'lecture'],
        ];
        
        for ($i = 0; $i < 10; $i++) {
            Material::create([
                'course_id' => $courses[$i % $courses->count()]->id,
                'uploaded_by' => $teachers[$i % $teachers->count()]->id,
                'title' => $materials[$i]['title'],
                'file_url' => 'https://example.com/material-' . ($i + 1) . '.pdf',
                'type' => $materials[$i]['type']
            ]);
        }
    }
    
    private function seedExams()
    {
        $courses = Course::all();
        
        for ($i = 0; $i < 10; $i++) {
            Exam::create([
                'course_id' => $courses[$i % $courses->count()]->id,
                'created_by' => User::where('role', 'teacher')->first()->id,
                'title' => 'امتحان ' . ($i + 1),
                'exam_date' => now()->addDays(rand(1, 30)),
                'duration' => rand(60, 180)
            ]);
        }
    }
    
    private function seedSchedules()
    {
        $courses = Course::all();
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        
        for ($i = 0; $i < 10; $i++) {
            Schedule::create([
                'course_id' => $courses[$i % $courses->count()]->id,
                'day_of_week' => $days[rand(0, 6)],
                'start_time' => '09:00:00',
                'end_time' => '11:00:00',
                'room' => 'قاعة ' . ($i + 1)
            ]);
        }
    }
    
    private function seedComplaints()
    {
        $students = User::where('role', 'student')->get();
        $teachers = User::where('role', 'teacher')->get();
        $courses = Course::all();
        
        for ($i = 0; $i < 10; $i++) {
            Complaint::create([
                'student_id' => $students[$i % $students->count()]->id,
                'course_id' => $courses[$i % $courses->count()]->id,
                'message' => 'شكوى ' . ($i + 1) . ': وصف الشكوى هنا',
                'status' => ['new', 'in_review', 'resolved'][rand(0, 2)],
                'assigned_to' => $teachers[$i % $teachers->count()]->id
            ]);
        }
    }
    
    private function seedMessages()
    {
        $users = User::all();
        $courses = Course::all();
        
        for ($i = 0; $i < 10; $i++) {
            Message::create([
                'sender_id' => $users[$i % $users->count()]->id,
                'receiver_id' => $users[($i + 1) % $users->count()]->id,
                'course_id' => $courses[$i % $courses->count()]->id,
                'subject' => 'رسالة ' . ($i + 1),
                'message_body' => 'محتوى الرسالة رقم ' . ($i + 1),
                'is_public' => rand(0, 1)
            ]);
        }
    }
    
    private function seedGrades()
    {
        $enrollments = Enrollment::all();
        $assessmentTypes = ['exam', 'assignment', 'quiz', 'project', 'participation'];
        
        for ($i = 0; $i < 10; $i++) {
            if ($enrollments->count() > 0) {
                Grade::create([
                    'enrollment_id' => $enrollments[$i % $enrollments->count()]->id,
                    'assessment_type' => $assessmentTypes[rand(0, 4)],
                    'score' => rand(50, 100),
                    'comments' => 'ملاحظات على الدرجة'
                ]);
            }
        }
    }
    
    private function seedAttendances()
    {
        $enrollments = Enrollment::all();
        
        for ($i = 0; $i < 10; $i++) {
            if ($enrollments->count() > 0) {
                Attendance::create([
                    'enrollment_id' => $enrollments[$i % $enrollments->count()]->id,
                    'date' => now()->subDays(rand(1, 30)),
                    'status' => ['present', 'absent', 'late'][rand(0, 2)],
                    'method' => ['QR', 'manual'][rand(0, 1)]
                ]);
            }
        }
    }
    
    private function seedPayments()
    {
        $students = User::where('role', 'student')->get();
        
        for ($i = 0; $i < 10; $i++) {
            Payment::create([
                'user_id' => $students[$i % $students->count()]->id,
                'amount' => rand(100, 500),
                'type' => ['student_fee', 'instructor_payment'][rand(0, 1)],
                'notes' => 'ملاحظات على الدفع رقم ' . ($i + 1)
            ]);
        }
    }
    
    private function seedPackageCourses()
    {
        $packages = Package::all();
        $courses = Course::all();
        
        for ($i = 0; $i < 10; $i++) {
            PackageCourse::create([
                'package_id' => $packages[$i % $packages->count()]->id,
                'course_id' => $courses[$i % $courses->count()]->id
            ]);
        }
    }
    
    private function seedStudentPackages()
    {
        $students = User::where('role', 'student')->get();
        $packages = Package::all();
        
        for ($i = 0; $i < 10; $i++) {
            StudentPackage::create([
                'student_id' => $students[$i % $students->count()]->id,
                'package_id' => $packages[$i % $packages->count()]->id,
                'amount_paid' => rand(100, 1000)
            ]);
        }
    }
}
