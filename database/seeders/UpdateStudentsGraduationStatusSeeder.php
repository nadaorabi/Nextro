<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateStudentsGraduationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('🔄 تحديث حالة التخرج للطلاب الموجودين...');
        
        // تحديث جميع الطلاب الموجودين ليكونوا غير متخرجين افتراضياً
        $students = User::where('role', 'student')->get();
        
        foreach ($students as $student) {
            // إذا لم يكن لديه حقل is_graduated، اضبطه على false
            if (!isset($student->is_graduated)) {
                $student->is_graduated = false;
                $student->save();
            }
        }
        
        $this->command->info('✅ تم تحديث حالة التخرج لجميع الطلاب بنجاح!');
        $this->command->info('📊 إحصائيات:');
        $this->command->info('   - إجمالي الطلاب: ' . $students->count());
        $this->command->info('   - الطلاب المتخرجون: ' . $students->where('is_graduated', true)->count());
        $this->command->info('   - الطلاب غير المتخرجين: ' . $students->where('is_graduated', false)->count());
    }
} 