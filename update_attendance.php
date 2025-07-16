<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Enrollment;
use App\Models\Schedule;
use App\Models\Attendance;

echo "Updating attendance data...\n";

$student = User::where('role', 'student')->first();
if ($student) {
    echo "Student found: " . $student->name . "\n";
    
    $enrollments = Enrollment::where('student_id', $student->id)->get();
    
    foreach ($enrollments as $enrollment) {
        echo "\nCourse: " . $enrollment->course->title . "\n";
        
        $schedules = Schedule::where('course_id', $enrollment->course_id)->get();
        
        foreach ($schedules as $index => $schedule) {
            // Create varied attendance statuses for testing
            $statuses = ['present', 'absent', 'late', 'pending'];
            $randomStatus = $statuses[$index % count($statuses)]; // Cycle through statuses
            
            // Check if attendance record exists
            $attendance = Attendance::where('enrollment_id', $enrollment->id)
                ->where('schedule_id', $schedule->id)
                ->where('date', $schedule->session_date)
                ->first();
                
            if ($attendance) {
                // Update existing record
                $attendance->update([
                    'status' => $randomStatus,
                    'method' => $randomStatus === 'pending' ? 'auto' : (rand(0, 1) ? 'QR' : 'manual')
                ]);
                echo "  Updated: " . $schedule->session_date . " -> " . $randomStatus . "\n";
            } else {
                // Create new record
                Attendance::create([
                    'enrollment_id' => $enrollment->id,
                    'schedule_id' => $schedule->id,
                    'date' => $schedule->session_date,
                    'status' => $randomStatus,
                    'method' => $randomStatus === 'pending' ? 'auto' : (rand(0, 1) ? 'QR' : 'manual')
                ]);
                echo "  Created: " . $schedule->session_date . " -> " . $randomStatus . "\n";
            }
        }
    }
    
    echo "\nAttendance data updated successfully!\n";
} else {
    echo "No student found\n";
} 