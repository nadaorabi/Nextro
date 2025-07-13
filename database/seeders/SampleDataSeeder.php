<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Assignment;
use App\Models\Exam;
use App\Models\AssignmentSubmission;
use App\Models\ExamSubmission;
use Carbon\Carbon;

class SampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->command->info('Creating sample students...');

        // Create sample students
        $students = [
            [
                'name' => 'أحمد محمد علي',
                'email' => 'ahmed@example.com',
                'mobile' => '01012345678',
                'role' => 'student',
                'password' => bcrypt('password'),
                'login_id' => 'STU001'
            ],
            [
                'name' => 'فاطمة أحمد حسن',
                'email' => 'fatima@example.com',
                'mobile' => '01012345679',
                'role' => 'student',
                'password' => bcrypt('password'),
                'login_id' => 'STU002'
            ],
            [
                'name' => 'محمد علي أحمد',
                'email' => 'mohamed@example.com',
                'mobile' => '01012345680',
                'role' => 'student',
                'password' => bcrypt('password'),
                'login_id' => 'STU003'
            ],
            [
                'name' => 'سارة محمود محمد',
                'email' => 'sara@example.com',
                'mobile' => '01012345681',
                'role' => 'student',
                'password' => bcrypt('password'),
                'login_id' => 'STU004'
            ],
            [
                'name' => 'علي حسن محمد',
                'email' => 'ali@example.com',
                'mobile' => '01012345682',
                'role' => 'student',
                'password' => bcrypt('password'),
                'login_id' => 'STU005'
            ]
        ];

        $createdStudents = [];
        foreach ($students as $studentData) {
            $student = User::create($studentData);
            $createdStudents[] = $student;
            $this->command->info("Created student: {$student->name}");
        }

        $this->command->info('Creating enrollments...');

        // Get existing courses
        $courses = Course::all();
        if ($courses->isEmpty()) {
            $this->command->info('No courses found. Please create courses first.');
            return;
        }

        // Create enrollments for each student in each course
        foreach ($createdStudents as $student) {
            foreach ($courses as $course) {
                Enrollment::create([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'enrollment_date' => now()->subDays(rand(30, 90)),
                    'status' => 'active'
                ]);
                $this->command->info("Enrolled student {$student->name} in course {$course->title}");
            }
        }

        $this->command->info('Creating sample submissions...');

        // Get assignments and exams
        $assignments = Assignment::all();
        $exams = Exam::all();

        // Create assignment submissions
        foreach ($assignments as $assignment) {
            $this->createAssignmentSubmissions($assignment, $createdStudents);
        }

        // Create exam submissions
        foreach ($exams as $exam) {
            $this->createExamSubmissions($exam, $createdStudents);
        }

        $this->command->info('Sample data created successfully!');
    }

    private function createAssignmentSubmissions($assignment, $students)
    {
        $submissionStatuses = ['submitted', 'graded', 'late'];
        $scores = [85, 92, 78, 95, 88, 76, 90, 82, 87, 93];

        foreach ($students as $index => $student) {
            $status = $submissionStatuses[array_rand($submissionStatuses)];
            $score = null;
            $feedback = null;
            $submittedAt = null;
            $gradedAt = null;

            // Determine submission time based on assignment dates
            if ($assignment->end_at) {
                $submittedAt = $status === 'late' 
                    ? $assignment->end_at->addDays(rand(1, 3))
                    : $assignment->end_at->subDays(rand(0, 2));
            } else {
                $submittedAt = now()->subDays(rand(1, 10));
            }

            // If graded, add score and feedback
            if ($status === 'graded') {
                $score = $scores[array_rand($scores)];
                $feedback = $this->getRandomFeedback($score);
                $gradedAt = $submittedAt->addDays(rand(1, 3));
            }

            // Create submission file for file-based assignments
            $submissionFile = null;
            if ($assignment->delivery_type === 'file') {
                $submissionFile = "submissions/assignment_{$assignment->id}_student_{$student->id}.pdf";
            }

            AssignmentSubmission::create([
                'assignment_id' => $assignment->id,
                'student_id' => $student->id,
                'status' => $status,
                'score' => $score,
                'feedback' => $feedback,
                'submission_file' => $submissionFile,
                'submitted_at' => $submittedAt,
                'graded_at' => $gradedAt,
            ]);

            $this->command->info("Created submission for student {$student->name} - Assignment: {$assignment->title} - Status: {$status}");
        }
    }

    private function createExamSubmissions($exam, $students)
    {
        $submissionStatuses = ['started', 'submitted', 'graded', 'late'];
        $scores = [75, 88, 92, 65, 95, 82, 78, 90, 85, 70];

        foreach ($students as $index => $student) {
            $status = $submissionStatuses[array_rand($submissionStatuses)];
            $score = null;
            $feedback = null;
            $startedAt = null;
            $submittedAt = null;
            $gradedAt = null;
            $answers = null;

            // Determine timing based on exam dates
            if ($exam->start_at && $exam->end_at) {
                $startedAt = $exam->start_at->addMinutes(rand(0, 30));
                
                if ($status === 'late') {
                    $submittedAt = $exam->end_at->addMinutes(rand(1, 60));
                } else {
                    $submittedAt = $exam->end_at->subMinutes(rand(0, 120));
                }
            } else {
                $startedAt = now()->subDays(rand(1, 5));
                $submittedAt = $startedAt->addMinutes(rand(30, 120));
            }

            // If graded, add score and feedback
            if ($status === 'graded') {
                $score = $scores[array_rand($scores)];
                $feedback = $this->getRandomFeedback($score);
                $gradedAt = $submittedAt->addDays(rand(1, 2));
            }

            // Create answers for online exams
            if ($exam->delivery_type === 'online') {
                $answers = $this->generateRandomAnswers($exam);
            }

            // Create submission file for file-based exams
            $submissionFile = null;
            if ($exam->delivery_type === 'file') {
                $submissionFile = "submissions/exam_{$exam->id}_student_{$student->id}.pdf";
            }

            ExamSubmission::create([
                'exam_id' => $exam->id,
                'student_id' => $student->id,
                'status' => $status,
                'score' => $score,
                'feedback' => $feedback,
                'submission_file' => $submissionFile,
                'answers' => $answers,
                'started_at' => $startedAt,
                'submitted_at' => $submittedAt,
                'graded_at' => $gradedAt,
            ]);

            $this->command->info("Created submission for student {$student->name} - Exam: {$exam->title} - Status: {$status}");
        }
    }

    private function getRandomFeedback($score)
    {
        $feedbacks = [
            'Excellent work! Well done.',
            'Good effort, but could improve in some areas.',
            'Satisfactory work. Keep practicing.',
            'Great understanding of the material.',
            'Good work, but pay attention to details.',
            'Excellent analysis and presentation.',
            'Well-structured response.',
            'Good attempt, consider reviewing the concepts.',
            'Outstanding performance!',
            'Good work with room for improvement.'
        ];

        return $feedbacks[array_rand($feedbacks)];
    }

    private function generateRandomAnswers($exam)
    {
        $answers = [];
        
        foreach ($exam->questions as $question) {
            if ($question->type === 'mcq') {
                // For MCQ, select a random choice
                $choices = $question->choices;
                if ($choices->count() > 0) {
                    $selectedChoice = $choices->random();
                    $answers[$question->id] = [
                        'type' => 'mcq',
                        'selected_choice' => $selectedChoice->id,
                        'answer_text' => $selectedChoice->choice_text
                    ];
                }
            } else {
                // For text questions, generate a sample answer
                $sampleAnswers = [
                    'This is a comprehensive answer that demonstrates understanding of the topic.',
                    'Based on the material covered, the answer would be...',
                    'The key points to consider are...',
                    'This question requires analysis of multiple factors.',
                    'A detailed explanation would include...'
                ];
                
                $answers[$question->id] = [
                    'type' => 'text',
                    'answer_text' => $sampleAnswers[array_rand($sampleAnswers)]
                ];
            }
        }
        
        return $answers;
    }
}
