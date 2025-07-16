<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Enrollment;
use App\Models\Schedule;
use App\Models\Attendance;

echo "Testing attendance data...\n";

$student = User::where('role', 'student')->first();
if ($student) {
    echo "Student found: " . $student->name . "\n";
    
    $enrollments = Enrollment::where('student_id', $student->id)->get();
    echo "Enrollments count: " . $enrollments->count() . "\n";
    
    foreach ($enrollments as $enrollment) {
        echo "\nCourse: " . $enrollment->course->title . "\n";
        
        $schedules = Schedule::where('course_id', $enrollment->course_id)->get();
        echo "Schedules count: " . $schedules->count() . "\n";
        
        foreach ($schedules as $schedule) {
            $attendance = Attendance::where('enrollment_id', $enrollment->id)
                ->where('schedule_id', $schedule->id)
                ->where('date', $schedule->session_date)
                ->first();
                
            if ($attendance) {
                echo "  Date: " . $schedule->session_date . " - Status: " . $attendance->status . "\n";
            } else {
                echo "  Date: " . $schedule->session_date . " - No attendance record\n";
            }
        }
    }
} else {
    echo "No student found\n";
} 