<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Question;
use App\Models\Choice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::where('teacher_id', Auth::id())
            ->with(['course'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('Teacher.exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::whereIn('id', 
            \App\Models\CourseInstructor::where('instructor_id', Auth::id())->pluck('course_id')
        )->get();
        
        return view('Teacher.exams.create', compact('courses'));
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
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after:start_at',
            'total_grade' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
        ]);

        $exam = Exam::create([
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'course_id' => $request->course_id,
            'type' => $request->type,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'total_grade' => $request->total_grade,
            'created_by' => Auth::id(),
            'exam_date' => $request->start_at ?? now(),
            'duration' => $request->duration,
        ]);

        return redirect()->route('teacher.exams.index')
            ->with('success', 'تم إنشاء الامتحان بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        // Check if teacher owns this exam
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        $exam->load(['course', 'questions.choices']);
        
        return view('Teacher.exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        // Check if teacher owns this exam
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        $courses = Course::whereHas('courseInstructors', function($query) {
            $query->where('instructor_id', Auth::id());
        })->get();
        
        return view('Teacher.exams.edit', compact('exam', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Exam $exam)
    {
        // Check if teacher owns this exam
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'course_id' => 'required|exists:courses,id',
            'type' => 'required|in:manual,auto',
            'start_at' => 'nullable|date',
            'end_at' => 'nullable|date|after:start_at',
            'total_grade' => 'required|numeric|min:0'
        ]);

        $exam->update([
            'title' => $request->title,
            'description' => $request->description,
            'course_id' => $request->course_id,
            'type' => $request->type,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
            'total_grade' => $request->total_grade
        ]);

        return redirect()->route('teacher.exams.index')
            ->with('success', 'تم تحديث الامتحان بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        // Check if teacher owns this exam
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        $exam->delete();

        return redirect()->route('teacher.exams.index')
            ->with('success', 'تم حذف الامتحان بنجاح');
    }

    /**
     * Add a question to the exam
     */
    public function addQuestion(Request $request, Exam $exam)
    {
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:mcq,short_answer,long_answer',
            'grade' => 'required|numeric|min:0'
        ]);

        $question = $exam->questions()->create([
            'question_text' => $request->question_text,
            'type' => $request->type,
            'grade' => $request->grade
        ]);

        return response()->json(['success' => true, 'question' => $question]);
    }

    /**
     * Update a question
     */
    public function updateQuestion(Request $request, Exam $exam, Question $question)
    {
        if ($exam->teacher_id !== Auth::id() || $question->exam_id !== $exam->id) {
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
        return redirect()->route('teacher.exams.questions.list', $exam)
            ->with('success', 'تم تحديث السؤال بنجاح');
    }

    /**
     * Delete a question
     */
    public function deleteQuestion(Exam $exam, Question $question)
    {
        if ($exam->teacher_id !== Auth::id() || $question->exam_id !== $exam->id) {
            abort(403);
        }

        $question->delete();

        if (request()->expectsJson() || request()->ajax()) {
            return response()->json(['success' => true]);
        }
        return redirect()->route('teacher.exams.questions.list', $exam)
            ->with('success', 'تم حذف السؤال بنجاح');
    }

    /**
     * Add a choice to a question
     */
    public function addChoice(Request $request, Question $question)
    {
        if ($question->exam && $question->exam->teacher_id !== Auth::id()) {
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
        if ($question->exam && $question->exam->teacher_id !== Auth::id() || $choice->question_id !== $question->id) {
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
        if ($question->exam && $question->exam->teacher_id !== Auth::id() || $choice->question_id !== $question->id) {
            abort(403);
        }

        $choice->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Show the form for bulk creating questions for an exam.
     */
    public function bulkCreateQuestions(Exam $exam)
    {
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }
        return view('Teacher.exams.bulk-create-questions', compact('exam'));
    }

    /**
     * Store bulk questions for an exam.
     */
    public function bulkStoreQuestions(Request $request, Exam $exam)
    {
        if ($exam->teacher_id !== Auth::id()) {
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
            $question = $exam->questions()->create([
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
        return redirect()->route('teacher.exams.questions.list', $exam)->with('success', 'تم إضافة الأسئلة بنجاح');
    }

    /**
     * Show only the questions for an exam.
     */
    public function questionsList(Exam $exam)
    {
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }
        $exam->load('questions.choices');
        return view('Teacher.exams.questions-list', compact('exam'));
    }
}
