<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Enrollment;
use App\Models\Attendance;

class CreateDefaultAttendanceRecordsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all schedules
        $schedules = Schedule::all();
        
        foreach ($schedules as $schedule) {
            // Get all enrollments for this course
            $enrollments = Enrollment::where('course_id', $schedule->course_id)->get();
            
            foreach ($enrollments as $enrollment) {
                // Check if attendance record already exists for this student and schedule
                $existingAttendance = Attendance::where('enrollment_id', $enrollment->id)
                    ->where('schedule_id', $schedule->id)
                    ->where('date', $schedule->session_date)
                    ->first();
                
                // If no attendance record exists, create a pending one
                if (!$existingAttendance) {
                    Attendance::create([
                        'enrollment_id' => $enrollment->id,
                        'schedule_id' => $schedule->id,
                        'date' => $schedule->session_date,
                        'status' => 'pending',
                        'method' => 'auto',
                    ]);
                }
            }
        }
        
        $this->command->info('Default attendance records created successfully!');
    }
}
