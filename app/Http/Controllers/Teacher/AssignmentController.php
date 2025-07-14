<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Course;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assignments = Assignment::where('teacher_id', Auth::id())
            ->with(['course'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('Teacher.assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::whereIn('id', 
            \App\Models\CourseInstructor::where('instructor_id', Auth::id())->pluck('course_id')
        )->get();
        
        return view('Teacher.assignments.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:manual,auto',
            'delivery_type' => 'required|in:online,file',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after:start_at',
            'total_grade' => 'required|numeric|min:0',
            'assignment_file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240' // 10MB max
        ], [
            'delivery_type.required' => __('assignments.validation.delivery_type_required'),
            'assignment_file.required' => __('assignments.validation.file_required_for_file_type'),
            'assignment_file.max' => __('assignments.validation.file_size'),
            'assignment_file.mimes' => __('assignments.validation.file_type'),
        ]);

        // Additional validation for file upload
        if ($request->delivery_type === 'file' && !$request->hasFile('assignment_file')) {
            return back()->withErrors(['assignment_file' => __('assignments.validation.file_required_for_file_type')]);
        }

        $data = [
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'course_id' => $request->course_id,
            'type' => $request->type,
            'delivery_type' => $request->delivery_type,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'total_grade' => $request->total_grade
        ];

        // Handle file upload if delivery type is file
        if ($request->delivery_type === 'file' && $request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('assignments', $fileName, 'public');
            $data['file_path'] = $filePath;
        }

        $assignment = Assignment::create($data);

        return redirect()->route('teacher.assignments.index')
            ->with('success', __('assignments.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment)
    {
        // Check if teacher owns this assignment
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $assignment->load(['course', 'questions.choices', 'submissions.student']);
        
        // Get students enrolled in this course
        $enrolledStudents = \App\Models\Enrollment::where('course_id', $assignment->course_id)
            ->with('student')
            ->get()
            ->pluck('student');
        
        // Get submission statistics
        $totalStudents = $enrolledStudents->count();
        $submittedCount = $assignment->submissions->where('status', 'submitted')->count();
        $gradedCount = $assignment->submissions->where('status', 'graded')->count();
        $lateCount = $assignment->submissions->where('status', 'late')->count();
        $averageScore = $assignment->submissions->where('status', 'graded')->avg('score') ?? 0;
        
        return view('Teacher.assignments.show', compact(
            'assignment', 
            'enrolledStudents', 
            'totalStudents', 
            'submittedCount', 
            'gradedCount', 
            'lateCount', 
            'averageScore'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        // Check if teacher owns this assignment
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $courses = Course::whereHas('courseInstructors', function($query) {
            $query->where('instructor_id', Auth::id());
        })->get();
        
        return view('Teacher.assignments.edit', compact('assignment', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        // Check if teacher owns this assignment
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:manual,auto',
            'delivery_type' => 'required|in:online,file',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after:start_at',
            'total_grade' => 'required|numeric|min:0',
            'assignment_file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240' // 10MB max
        ], [
            'delivery_type.required' => __('assignments.validation.delivery_type_required'),
            'assignment_file.max' => __('assignments.validation.file_size'),
            'assignment_file.mimes' => __('assignments.validation.file_type'),
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'course_id' => $request->course_id,
            'type' => $request->type,
            'delivery_type' => $request->delivery_type,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'total_grade' => $request->total_grade
        ];

        // Handle file upload if delivery type is file and new file is uploaded
        if ($request->delivery_type === 'file' && $request->hasFile('assignment_file')) {
            $file = $request->file('assignment_file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('assignments', $fileName, 'public');
            $data['file_path'] = $filePath;
        } elseif ($request->delivery_type === 'online') {
            // If changing to online, remove file path
            $data['file_path'] = null;
        }

        $assignment->update($data);

        return redirect()->route('teacher.assignments.index')
            ->with('success', __('assignments.updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {
        // Check if teacher owns this assignment
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $assignment->delete();

        return redirect()->route('teacher.assignments.index')
            ->with('success', __('assignments.deleted'));
    }

    /**
     * Add a question to the assignment
     */
    public function addQuestion(Request $request, Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:mcq,short_answer,long_answer',
            'grade' => 'required|numeric|min:0'
        ]);

        $question = $assignment->questions()->create([
            'question_text' => $request->question_text,
            'type' => $request->type,
            'grade' => $request->grade
        ]);

        return response()->json(['success' => true, 'question' => $question]);
    }

    /**
     * Update a question
     */
    public function updateQuestion(Request $request, Assignment $assignment, Question $question)
    {
        if ($assignment->teacher_id !== Auth::id() || $question->assignment_id !== $assignment->id) {
            abort(403);
        }

        $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:mcq,short_answer,long_answer',
            'grade' => 'required|numeric|min:0'
        ]);

        $question->update([
            'question_text' => $request->question_text,
            'type' => $request->type,
            'grade' => $request->grade
        ]);

        // تحديث الخيارات إذا كان السؤال MCQ
        if ($request->type === 'mcq' && $request->has('choices')) {
            $choices = $request->input('choices');
            $correctIndex = $request->input('correct_choice');
            // حذف الخيارات القديمة
            $question->choices()->delete();
            // إضافة الخيارات الجديدة
            foreach ($choices as $index => $choiceData) {
                $question->choices()->create([
                    'choice_text' => $choiceData['text'],
                    'is_correct' => ($correctIndex == $index) ? 1 : 0,
                ]);
            }
        } else {
            // إذا لم يكن MCQ، احذف كل الخيارات
            $question->choices()->delete();
        }

        // إذا كان الطلب AJAX أعد JSON، وإلا أعد redirect
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json(['success' => true, 'question' => $question]);
        }
        return redirect()->route('teacher.assignments.questions.list', $assignment)
            ->with('success', 'Question updated successfully');
    }

    /**
     * Delete a question
     */
    public function deleteQuestion(Assignment $assignment, Question $question)
    {
        if ($assignment->teacher_id !== Auth::id() || $question->assignment_id !== $assignment->id) {
            abort(403);
        }

        $question->delete();

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('teacher.assignments.questions.list', $assignment)
            ->with('success', 'Question deleted successfully');
    }

    /**
     * Add a choice to a question
     */
    public function addChoice(Request $request, Question $question)
    {
        if ($question->assignment && $question->assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'choice_text' => 'required|string',
            'is_correct' => 'boolean'
        ]);

        $choice = $question->choices()->create([
            'choice_text' => $request->choice_text,
            'is_correct' => $request->is_correct ?? false
        ]);

        return response()->json(['success' => true, 'choice' => $choice]);
    }

    /**
     * Update a choice
     */
    public function updateChoice(Request $request, Question $question, Choice $choice)
    {
        if ($question->assignment && $question->assignment->teacher_id !== Auth::id() || $choice->question_id !== $question->id) {
            abort(403);
        }

        $request->validate([
            'choice_text' => 'required|string',
            'is_correct' => 'boolean'
        ]);

        $choice->update([
            'choice_text' => $request->choice_text,
            'is_correct' => $request->is_correct ?? false
        ]);

        return response()->json(['success' => true, 'choice' => $choice]);
    }

    /**
     * Delete a choice
     */
    public function deleteChoice(Question $question, Choice $choice)
    {
        if ($question->assignment && $question->assignment->teacher_id !== Auth::id() || $choice->question_id !== $question->id) {
            abort(403);
        }

        $choice->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for bulk creating questions for an assignment.
     */
    public function bulkCreateQuestions(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }
        return view('Teacher.assignments.bulk-create-questions', compact('assignment'));
    }

    /**
     * Store bulk questions for an assignment.
     */
    public function bulkStoreQuestions(Request $request, Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }
        $request->validate([
            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.type' => 'required|in:mcq,short_answer,long_answer',
            'questions.*.grade' => 'required|numeric|min:0',
            'questions.*.choices' => 'array',
            'questions.*.choices.*.choice_text' => 'required_if:questions.*.type,mcq|string|nullable',
        ]);
        foreach ($request->questions as $q) {
            $question = $assignment->questions()->create([
                'question_text' => $q['question_text'],
                'type' => $q['type'],
                'grade' => $q['grade'],
            ]);
            if ($q['type'] === 'mcq' && !empty($q['choices'])) {
                $correctIndex = isset($q['correct_choice']) ? $q['correct_choice'] : null;
                foreach ($q['choices'] as $idx => $choice) {
                    $question->choices()->create([
                        'choice_text' => $choice['choice_text'],
                        'is_correct' => ($correctIndex !== null && $correctIndex == $idx) ? 1 : 0,
                    ]);
                }
            }
        }
        return redirect()->route('teacher.assignments.questions.list', $assignment)->with('success', 'Questions added successfully');
    }

    /**
     * Show only the questions for an assignment.
     */
    public function questionsList(Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }
        $assignment->load('questions.choices');
        return view('Teacher.assignments.questions-list', compact('assignment'));
    }
}
