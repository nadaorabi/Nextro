<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MaterialController extends Controller
{
    // عرض جميع المواد الخاصة بالمعلم
    public function index(Request $request)
    {
        $teacherId = Auth::id();
        $courseId = $request->get('course_id');
        $materialsQuery = Material::with('course')
            ->where('uploaded_by', $teacherId)
            ->orderByDesc('upload_date');
        if ($courseId) {
            $materialsQuery->where('course_id', $courseId);
        }
        $materials = $materialsQuery->get();
        $courses = Course::whereHas('instructors', function($q) use ($teacherId) {
            $q->where('instructor_id', $teacherId);
        })->get();
        return view('Teacher.materials', compact('materials', 'courses', 'courseId'));
    }

    // إضافة مادة جديدة
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:lecture,assignment,exam,notes',
            'course_id' => 'required|exists:courses,id',
            'file' => 'required|mimes:pdf,jpeg,png,jpg,mp4,avi,mov|max:51200', // 50MB
        ]);
        $teacherId = Auth::id();
        $file = $request->file('file');
        $path = $file->store('materials', 'public');
        $mime = $file->getMimeType();
        if (str_contains($mime, 'image')) {
            $fileType = 'image';
        } elseif (str_contains($mime, 'video')) {
            $fileType = 'video';
        } elseif ($mime === 'application/pdf') {
            $fileType = 'pdf';
        } else {
            $fileType = 'other';
        }
        $material = Material::create([
            'title' => $request->title,
            'type' => $request->type,
            'course_id' => $request->course_id,
            'uploaded_by' => $teacherId,
            'file_url' => $path,
            'file_type' => $fileType,
            'upload_date' => now(),
        ]);
        return redirect()->back()->with('success', 'Material added successfully.');
    }

    // تعديل مادة
    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);
        $this->authorizeMaterial($material);
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:lecture,assignment,exam,notes',
            'course_id' => 'required|exists:courses,id',
            'file' => 'nullable|file|max:20480',
        ]);
        $material->title = $request->title;
        $material->type = $request->type;
        $material->course_id = $request->course_id;
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($material->file_url);
            $material->file_url = $request->file('file')->store('materials', 'public');
        }
        $material->save();
        return redirect()->back()->with('success', 'Material updated successfully.');
    }

    // حذف مادة
    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $this->authorizeMaterial($material);
        Storage::disk('public')->delete($material->file_url);
        $material->delete();
        return redirect()->back()->with('success', 'Material deleted successfully.');
    }

    // تحميل أو مشاهدة الملف
    public function download($id)
    {
        $material = Material::findOrFail($id);
        $this->authorizeMaterial($material);
        $filePath = storage_path('app/public/' . $material->file_url);
        $originalName = $material->title;
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        if (!str_ends_with($originalName, '.' . $extension)) {
            $originalName .= '.' . $extension;
        }
        return response()->download($filePath, $originalName);
    }
    public function view($id)
    {
        $material = Material::findOrFail($id);
        $this->authorizeMaterial($material);
        return response()->file(storage_path('app/public/' . $material->file_url));
    }

    // تحقق من أن المعلم هو صاحب المادة
    private function authorizeMaterial($material)
    {
        if ($material->uploaded_by != Auth::id()) {
            abort(403);
        }
    }
} 