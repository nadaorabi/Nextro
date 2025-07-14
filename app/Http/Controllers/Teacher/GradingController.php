<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use App\Models\Exam;
use App\Models\AssignmentSubmission;
use App\Models\ExamSubmission;
use App\Models\SubmissionComment;
use Illuminate\Support\Facades\Storage;

class GradingController extends Controller
{
    /**
     * Display the grading interface for an assignment submission
     */
    public function gradeAssignment(Assignment $assignment, AssignmentSubmission $submission)
    {
        // Check if teacher owns this assignment
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        // Check if submission belongs to this assignment
        if ($submission->assignment_id !== $assignment->id) {
            abort(404);
        }

        $submission->load(['student', 'assignment.questions.choices']);
        
        // جلب التعليقات على هذا الواجب للطالب المحدد
        $comments = SubmissionComment::where('submission_type', 'assignment')
            ->where('submission_id', $assignment->id)
            ->where('student_id', $submission->student_id)
            ->with(['teacher'])
            ->orderBy('commented_at', 'desc')
            ->get();
        
        return view('Teacher.grading.assignment', compact('assignment', 'submission', 'comments'));
    }

    /**
     * Display the grading interface for an exam submission
     */
    public function gradeExam(Exam $exam, ExamSubmission $submission)
    {
        // Check if teacher owns this exam
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        // Check if submission belongs to this exam
        if ($submission->exam_id !== $exam->id) {
            abort(404);
        }

        $submission->load(['student', 'exam.questions.choices']);
        
        // جلب التعليقات على هذا الاختبار للطالب المحدد
        $comments = SubmissionComment::where('submission_type', 'exam')
            ->where('submission_id', $exam->id)
            ->where('student_id', $submission->student_id)
            ->with(['teacher'])
            ->orderBy('commented_at', 'desc')
            ->get();
        
        return view('Teacher.grading.exam', compact('exam', 'submission', 'comments'));
    }

    /**
     * Update assignment submission grade and feedback
     */
    public function updateAssignmentGrade(Request $request, Assignment $assignment, AssignmentSubmission $submission)
    {
        // Check if teacher owns this assignment
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'score' => 'required|numeric|min:0|max:' . $assignment->total_grade,
            'feedback' => 'nullable|string|max:1000',
            'status' => 'required|in:submitted,graded,late'
        ]);

        $submission->update([
            'score' => $request->score,
            'feedback' => $request->feedback,
            'status' => $request->status,
            'graded_at' => now()
        ]);

        return redirect()->route('teacher.assignments.show', $assignment)
            ->with('success', __('grading.assignment_graded'));
    }

    /**
     * Update exam submission grade and feedback
     */
    public function updateExamGrade(Request $request, Exam $exam, ExamSubmission $submission)
    {
        // Check if teacher owns this exam
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'score' => 'required|numeric|min:0|max:' . $exam->total_grade,
            'feedback' => 'nullable|string|max:1000',
            'status' => 'required|in:started,submitted,graded,late'
        ]);

        $submission->update([
            'score' => $request->score,
            'feedback' => $request->feedback,
            'status' => $request->status,
            'graded_at' => now()
        ]);

        return redirect()->route('teacher.exams.show', $exam)
            ->with('success', __('grading.exam_graded'));
    }

    /**
     * Download submission file
     */
    public function downloadSubmissionFile($type, $id, $submissionId)
    {
        if ($type === 'assignment') {
            $assignment = Assignment::findOrFail($id);
            $submission = AssignmentSubmission::findOrFail($submissionId);
            
            if ($assignment->teacher_id !== Auth::id()) {
                abort(403);
            }
        } elseif ($type === 'exam') {
            $exam = Exam::findOrFail($id);
            $submission = ExamSubmission::findOrFail($submissionId);
            
            if ($exam->teacher_id !== Auth::id()) {
                abort(403);
            }
        } else {
            abort(404);
        }

        if (!$submission->submission_file) {
            abort(404, __('grading.no_file_found'));
        }

        $filePath = storage_path('app/public/' . $submission->submission_file);
        
        if (!file_exists($filePath)) {
            abort(404, __('grading.file_not_found'));
        }

        return response()->download($filePath);
    }

    /**
     * View submission details (for online submissions)
     */
    public function viewSubmission($type, $id, $submissionId)
    {
        if ($type === 'assignment') {
            $assignment = Assignment::findOrFail($id);
            $submission = AssignmentSubmission::findOrFail($submissionId);
            
            if ($assignment->teacher_id !== Auth::id()) {
                abort(403);
            }
        } elseif ($type === 'exam') {
            $exam = Exam::findOrFail($id);
            $submission = ExamSubmission::findOrFail($submissionId);
            
            if ($exam->teacher_id !== Auth::id()) {
                abort(403);
            }
        } else {
            abort(404);
        }

        $submission->load(['student']);
        
        return view('Teacher.grading.view-submission', compact('submission', 'type', 'id'));
    }

    /**
     * Bulk grade assignments
     */
    public function bulkGradeAssignments(Request $request, Assignment $assignment)
    {
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'grades' => 'required|array',
            'grades.*.submission_id' => 'required|exists:assignment_submissions,id',
            'grades.*.score' => 'required|numeric|min:0|max:' . $assignment->total_grade,
            'grades.*.feedback' => 'nullable|string|max:1000',
            'grades.*.status' => 'required|in:submitted,graded,late'
        ]);

        foreach ($request->grades as $gradeData) {
            $submission = AssignmentSubmission::find($gradeData['submission_id']);
            if ($submission && $submission->assignment_id === $assignment->id) {
                $submission->update([
                    'score' => $gradeData['score'],
                    'feedback' => $gradeData['feedback'],
                    'status' => $gradeData['status'],
                    'graded_at' => now()
                ]);
            }
        }

        return redirect()->route('teacher.assignments.show', $assignment)
            ->with('success', __('grading.bulk_grading_completed'));
    }

    /**
     * Bulk grade exams
     */
    public function bulkGradeExams(Request $request, Exam $exam)
    {
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'grades' => 'required|array',
            'grades.*.submission_id' => 'required|exists:exam_submissions,id',
            'grades.*.score' => 'required|numeric|min:0|max:' . $exam->total_grade,
            'grades.*.feedback' => 'nullable|string|max:1000',
            'grades.*.status' => 'required|in:started,submitted,graded,late'
        ]);

        foreach ($request->grades as $gradeData) {
            $submission = ExamSubmission::find($gradeData['submission_id']);
            if ($submission && $submission->exam_id === $exam->id) {
                $submission->update([
                    'score' => $gradeData['score'],
                    'feedback' => $gradeData['feedback'],
                    'status' => $gradeData['status'],
                    'graded_at' => now()
                ]);
            }
        }

        return redirect()->route('teacher.exams.show', $exam)
            ->with('success', __('grading.bulk_grading_completed'));
    }

    /**
     * إضافة تعليق على واجب
     */
    public function addAssignmentComment(Request $request, Assignment $assignment, AssignmentSubmission $submission)
    {
        // التحقق من أن المدرس يملك هذا الواجب
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        // التحقق من أن التقديم ينتمي لهذا الواجب
        if ($submission->assignment_id !== $assignment->id) {
            abort(404);
        }

        $request->validate([
            'comment' => 'required|string|max:2000',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240' // 10MB max
        ]);

        $commentData = [
            'submission_type' => 'assignment',
            'submission_id' => $assignment->id,
            'student_id' => $submission->student_id,
            'teacher_id' => Auth::id(),
            'comment' => $request->comment,
            'commented_at' => now()
        ];

        // رفع الملف المرفق إذا وجد
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = 'comments/assignment_' . $assignment->id . '_student_' . $submission->student_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // حفظ الملف
            $file->storeAs('public', $fileName);
            
            $commentData['attachment_file'] = $fileName;
            $commentData['attachment_type'] = $file->getClientMimeType();
            $commentData['attachment_size'] = $file->getSize();
        }

        SubmissionComment::create($commentData);

        return redirect()->back()->with('success', __('grading.comment_added'));
    }

    /**
     * إضافة تعليق على اختبار
     */
    public function addExamComment(Request $request, Exam $exam, ExamSubmission $submission)
    {
        // التحقق من أن المدرس يملك هذا الاختبار
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        // التحقق من أن التقديم ينتمي لهذا الاختبار
        if ($submission->exam_id !== $exam->id) {
            abort(404);
        }

        $request->validate([
            'comment' => 'required|string|max:2000',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240' // 10MB max
        ]);

        $commentData = [
            'submission_type' => 'exam',
            'submission_id' => $exam->id,
            'student_id' => $submission->student_id,
            'teacher_id' => Auth::id(),
            'comment' => $request->comment,
            'commented_at' => now()
        ];

        // رفع الملف المرفق إذا وجد
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = 'comments/exam_' . $exam->id . '_student_' . $submission->student_id . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            // حفظ الملف
            $file->storeAs('public', $fileName);
            
            $commentData['attachment_file'] = $fileName;
            $commentData['attachment_type'] = $file->getClientMimeType();
            $commentData['attachment_size'] = $file->getSize();
        }

        SubmissionComment::create($commentData);

        return redirect()->back()->with('success', __('grading.comment_added'));
    }

    /**
     * تحميل الملف المرفق بالتعليق
     */
    public function downloadCommentAttachment($commentId)
    {
        $comment = SubmissionComment::findOrFail($commentId);
        
        // التحقق من أن المدرس يملك هذا التعليق
        if ($comment->teacher_id !== Auth::id()) {
            abort(403);
        }

        if (!$comment->attachment_file) {
            abort(404, __('grading.no_attachment_found'));
        }

        $filePath = storage_path('app/public/' . $comment->attachment_file);
        
        if (!file_exists($filePath)) {
            abort(404, __('grading.attachment_not_found'));
        }

        return response()->download($filePath);
    }

    /**
     * حذف تعليق
     */
    public function deleteComment($commentId)
    {
        $comment = SubmissionComment::findOrFail($commentId);
        
        // التحقق من أن المدرس يملك هذا التعليق
        if ($comment->teacher_id !== Auth::id()) {
            abort(403);
        }

        // حذف الملف المرفق إذا وجد
        if ($comment->attachment_file) {
            Storage::disk('public')->delete($comment->attachment_file);
        }

        $comment->delete();

        return redirect()->back()->with('success', __('grading.comment_deleted'));
    }

    /**
     * إضافة تعليق عام على واجب
     */
    public function addAssignmentGeneralComment(Request $request, Assignment $assignment)
    {
        // التحقق من أن المدرس يملك هذا الواجب
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'general_comment' => 'required|string|max:2000',
            'comment_attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240' // 10MB max
        ]);

        $data = [
            'teacher_id' => Auth::id(),
            'commentable_type' => Assignment::class,
            'commentable_id' => $assignment->id,
            'comment' => $request->general_comment,
        ];

        // رفع الملف المرفق إذا وجد
        if ($request->hasFile('comment_attachment') && $request->file('comment_attachment')->isValid()) {
            $file = $request->file('comment_attachment');
            $fileName = 'general-comments/assignment_' . $assignment->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $fileName);
            $data['attachment_file'] = $fileName;
            $data['attachment_type'] = $file->getClientMimeType();
            $data['attachment_size'] = $file->getSize();
        }

        \App\Models\GeneralComment::create($data);

        return redirect()->back()->with('success', __('grading.general_comment_added'));
    }

    /**
     * إضافة تعليق عام على اختبار
     */
    public function addExamGeneralComment(Request $request, Exam $exam)
    {
        // التحقق من أن المدرس يملك هذا الاختبار
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'general_comment' => 'required|string|max:2000',
            'comment_attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:10240' // 10MB max
        ]);

        $data = [
            'teacher_id' => Auth::id(),
            'commentable_type' => Exam::class,
            'commentable_id' => $exam->id,
            'comment' => $request->general_comment,
        ];

        // رفع الملف المرفق إذا وجد
        if ($request->hasFile('comment_attachment') && $request->file('comment_attachment')->isValid()) {
            $file = $request->file('comment_attachment');
            $fileName = 'general-comments/exam_' . $exam->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public', $fileName);
            $data['attachment_file'] = $fileName;
            $data['attachment_type'] = $file->getClientMimeType();
            $data['attachment_size'] = $file->getSize();
        }

        \App\Models\GeneralComment::create($data);

        return redirect()->back()->with('success', __('grading.general_comment_added'));
    }

    /**
     * تحميل المرفق العام للواجب
     */
    public function downloadAssignmentGeneralAttachment(Assignment $assignment)
    {
        // التحقق من أن المدرس يملك هذا الواجب
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        if (!$assignment->comment_attachment) {
            abort(404, __('grading.no_general_attachment_found'));
        }

        $filePath = storage_path('app/public/' . $assignment->comment_attachment);
        
        if (!file_exists($filePath)) {
            abort(404, __('grading.general_attachment_not_found'));
        }

        return response()->download($filePath);
    }

    /**
     * تحميل المرفق العام للاختبار
     */
    public function downloadExamGeneralAttachment(Exam $exam)
    {
        // التحقق من أن المدرس يملك هذا الاختبار
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        if (!$exam->comment_attachment) {
            abort(404, __('grading.no_general_attachment_found'));
        }

        $filePath = storage_path('app/public/' . $exam->comment_attachment);
        
        if (!file_exists($filePath)) {
            abort(404, __('grading.general_attachment_not_found'));
        }

        return response()->download($filePath);
    }

    /**
     * حذف التعليق العام للواجب
     */
    public function deleteAssignmentGeneralComment(Assignment $assignment)
    {
        // التحقق من أن المدرس يملك هذا الواجب
        if ($assignment->teacher_id !== Auth::id()) {
            abort(403);
        }

        // حذف الملف المرفق إذا وجد
        if ($assignment->comment_attachment) {
            Storage::disk('public')->delete($assignment->comment_attachment);
        }

        $assignment->update([
            'general_comment' => null,
            'comment_attachment' => null,
            'comment_attachment_type' => null,
            'comment_attachment_size' => null,
            'commented_at' => null
        ]);

        return redirect()->back()->with('success', __('grading.general_comment_deleted'));
    }

    /**
     * حذف التعليق العام للاختبار
     */
    public function deleteExamGeneralComment(Exam $exam)
    {
        // التحقق من أن المدرس يملك هذا الاختبار
        if ($exam->teacher_id !== Auth::id()) {
            abort(403);
        }

        // حذف الملف المرفق إذا وجد
        if ($exam->comment_attachment) {
            Storage::disk('public')->delete($exam->comment_attachment);
        }

        $exam->update([
            'general_comment' => null,
            'comment_attachment' => null,
            'comment_attachment_type' => null,
            'comment_attachment_size' => null,
            'commented_at' => null
        ]);

        return redirect()->back()->with('success', __('grading.general_comment_deleted'));
    }

    /**
     * تحميل مرفق التعليق العام (جديد)
     */
    public function downloadGeneralCommentAttachment($commentId)
    {
        $comment = \App\Models\GeneralComment::findOrFail($commentId);
        if ($comment->teacher_id !== Auth::id()) {
            abort(403);
        }
        if (!$comment->attachment_file) {
            abort(404, __('grading.no_general_attachment_found'));
        }
        $filePath = storage_path('app/public/' . $comment->attachment_file);
        if (!file_exists($filePath)) {
            abort(404, __('grading.general_attachment_not_found'));
        }
        return response()->download($filePath);
    }

    /**
     * حذف تعليق عام (جديد)
     */
    public function deleteGeneralComment($commentId)
    {
        $comment = \App\Models\GeneralComment::findOrFail($commentId);
        if ($comment->teacher_id !== Auth::id()) {
            abort(403);
        }
        if ($comment->attachment_file) {
            \Storage::disk('public')->delete($comment->attachment_file);
        }
        $comment->delete();
        return redirect()->back()->with('success', __('grading.general_comment_deleted'));
    }
} 