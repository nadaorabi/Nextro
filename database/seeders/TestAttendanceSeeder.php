<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\Attendance;
use App\Models\User;

class TestAttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get a student user
        $student = User::where('role', 'student')->first();
        if (!$student) {
            $this->command->info('No student found. Please create a student first.');
            return;
        }

        // Get all enrollments for this student
        $enrollments = Enrollment::where('student_id', $student->id)->get();
        
        foreach ($enrollments as $enrollment) {
            // Get all schedules for this course
            $schedules = Schedule::where('course_id', $enrollment->course_id)->get();
            
            foreach ($schedules as $schedule) {
                // Check if attendance record already exists
                $existingAttendance = Attendance::where('enrollment_id', $enrollment->id)
                    ->where('schedule_id', $schedule->id)
                    ->where('date', $schedule->session_date)
                    ->first();
                
                if (!$existingAttendance) {
                    // Randomly assign attendance status for demonstration
                    $statuses = ['present', 'absent', 'late', 'pending'];
                    $randomStatus = $statuses[array_rand($statuses)];
                    
                    Attendance::create([
                        'enrollment_id' => $enrollment->id,
                        'schedule_id' => $schedule->id,
                        'date' => $schedule->session_date,
                        'status' => $randomStatus,
                        'method' => $randomStatus === 'pending' ? 'auto' : (rand(0, 1) ? 'QR' : 'manual'),
                    ]);
                    
                    $this->command->info("Created attendance record for course {$enrollment->course->title} on {$schedule->session_date} with status: {$randomStatus}");
                }
            }
        }
        
        $this->command->info('Test attendance records created successfully!');
    }
} 