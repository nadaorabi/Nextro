<?php

namespace App\Http\Controllers\Admin\Educational;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Category;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    public function index()
    {
        try {
            $courses = Course::with('category')
                ->latest()
                ->paginate(10);
            
            $totalCourses = Course::count();
            $activeCourses = Course::where('status', 'active')->count();
            $linkedCategories = Category::has('courses')->count();
            $latestCourse = Course::latest()->first();
            $categoriesList = Category::all();

            return view('admin.educational-courses.index', compact(
                'courses',
                'totalCourses',
                'activeCourses',
                'linkedCategories',
                'latestCourse',
                'categoriesList'
            ));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading courses: ' . $e->getMessage());
        }
    }

    public function create()
    {
        try {
            $categories = Category::where('status', 'active')->get();
           
            
            return view('admin.educational-courses.create', compact('categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error loading create form: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255|unique:courses,title',
                'description' => 'nullable|string|max:1000',
                'category_id' => 'required|exists:categories,id',
                'credit_hours' => 'required|integer|min:1|max:999',
                'price' => 'nullable|numeric|min:0|max:999999.99',
                'currency' => 'nullable|string|max:10',
                'discount_percentage' => 'nullable|numeric|min:0|max:100',
                'is_free' => 'nullable|boolean',
                'status' => 'required|in:active,archived',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'title.required' => 'Course title is required.',
                'title.unique' => 'This course title already exists.',
                'category_id.required' => 'Please select a category.',
                'credit_hours.required' => 'Credit hours are required.',
                'credit_hours.min' => 'Credit hours must be at least 1.',
                'credit_hours.max' => 'Credit hours cannot exceed 999.',
                'price.numeric' => 'Price must be a valid number.',
                'price.min' => 'Price cannot be negative.',
                'price.max' => 'Price cannot exceed 999,999.99.',
                'discount_percentage.numeric' => 'Discount percentage must be a valid number.',
                'discount_percentage.min' => 'Discount percentage cannot be negative.',
                'discount_percentage.max' => 'Discount percentage cannot exceed 100%.',
                'image.image' => 'The file must be an image.',
                'image.max' => 'Image size cannot exceed 2MB.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $request->only([
                'title', 
                'description', 
                'category_id', 
                'credit_hours', 
                'price',
                'currency',
                'discount_percentage',
                'is_free',
                'status'
            ]);
            
            // Set default values for price fields
            if ($request->has('is_free') && $request->is_free) {
                $data['price'] = 0;
                $data['discount_percentage'] = 0;
            }
            
            if (!isset($data['currency'])) {
                $data['currency'] = 'USD';
            }
            
            if (!isset($data['discount_percentage'])) {
                $data['discount_percentage'] = 0;
            }
            
            // Handle image upload
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('courses', 'public');
                $data['image'] = $imagePath;
            }

            $course = Course::create($data);

            // Handle packages if any
            if ($request->has('packages') && is_array($request->packages)) {
                $course->packages()->sync($request->packages);
            }

            return redirect()->route('admin.educational-courses.index')
                ->with('success', 'Course created successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error creating course: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Course $course)
    {
        try {
            $course->load([
                'category',
                'course_instructors.user',
                'enrollments.student',
                'schedules',
                'materials',
                'exams',
                'messages.sender',
                'complaints',
                'packages'
            ]);

            // Get data for modals
            $categories = Category::where('status', 'active')->get();
            $teachers = User::where('role', 'teacher')->where('is_active', true)->get();
            $students = User::where('role', 'student')->where('is_active', true)->get();

            return view('admin.educational-courses.show', compact('course', 'categories', 'teachers', 'students'));
        } catch (\Exception $e) {
            return redirect()->route('admin.educational-courses.index')
                ->with('error', 'Error loading course details: ' . $e->getMessage());
        }
    }

    public function edit(Course $course)
    {
        try {
            $categories = Category::where('status', 'active')->get();
            $packages = Package::where('status', 'active')->get();
            
            return view('admin.educational-courses.edit', compact('course', 'categories', 'packages'));
        } catch (\Exception $e) {
            return redirect()->route('admin.educational-courses.index')
                ->with('error', 'Error loading edit form: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Course $course)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255|unique:courses,title,' . $course->id,
                'description' => 'nullable|string|max:1000',
                'category_id' => 'required|exists:categories,id',
                'credit_hours' => 'required|integer|min:1|max:999',
                'price' => 'nullable|numeric|min:0|max:999999.99',
                'currency' => 'nullable|string|max:10',
                'discount_percentage' => 'nullable|numeric|min:0|max:100',
                'is_free' => 'nullable|boolean',
                'status' => 'required|in:active,archived',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'title.required' => 'Course title is required.',
                'title.unique' => 'This course title already exists.',
                'category_id.required' => 'Please select a category.',
                'credit_hours.required' => 'Credit hours are required.',
                'credit_hours.min' => 'Credit hours must be at least 1.',
                'credit_hours.max' => 'Credit hours cannot exceed 999.',
                'price.numeric' => 'Price must be a valid number.',
                'price.min' => 'Price cannot be negative.',
                'price.max' => 'Price cannot exceed 999,999.99.',
                'discount_percentage.numeric' => 'Discount percentage must be a valid number.',
                'discount_percentage.min' => 'Discount percentage cannot be negative.',
                'discount_percentage.max' => 'Discount percentage cannot exceed 100%.',
                'image.image' => 'The file must be an image.',
                'image.max' => 'Image size cannot exceed 2MB.',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = $request->only([
                'title', 
                'description', 
                'category_id', 
                'credit_hours', 
                'price',
                'currency',
                'discount_percentage',
                'is_free',
                'status'
            ]);
            
            // Set default values for price fields
            if ($request->has('is_free') && $request->is_free) {
                $data['price'] = 0;
                $data['discount_percentage'] = 0;
            }
            
            if (!isset($data['currency'])) {
                $data['currency'] = 'USD';
            }
            
            if (!isset($data['discount_percentage'])) {
                $data['discount_percentage'] = 0;
            }
            
            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($course->image) {
                    Storage::disk('public')->delete($course->image);
                }
                
                $imagePath = $request->file('image')->store('courses', 'public');
                $data['image'] = $imagePath;
            }

            $course->update($data);

            // Handle packages if any
            if ($request->has('packages') && is_array($request->packages)) {
                $course->packages()->sync($request->packages);
            }

            return redirect()->route('admin.educational-courses.index')
                ->with('success', 'Course updated successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error updating course: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy(Course $course)
    {
        try {
            // Check if course has enrollments
            if ($course->enrollments()->count() > 0) {
                return redirect()->back()->with('error', 'Cannot delete course with active enrollments.');
            }

            // Delete course image if exists
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }

            // Delete related data
            $course->materials()->delete();
            $course->schedules()->delete();
            $course->exams()->delete();
            $course->messages()->delete();
            $course->complaints()->delete();
            $course->packages()->detach();
            $course->course_instructors()->delete();

            $course->delete();

            return redirect()->route('admin.educational-courses.index')
                ->with('success', 'Course deleted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error deleting course: ' . $e->getMessage());
        }
    }

    // Additional methods for course management
    public function toggleStatus(Course $course)
    {
        try {
            $course->update([
                'status' => $course->status === 'active' ? 'archived' : 'active'
            ]);

            $status = $course->status === 'active' ? 'activated' : 'archived';
            return redirect()->back()->with('success', "Course {$status} successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating course status: ' . $e->getMessage());
        }
    }

    public function duplicate(Course $course)
    {
        try {
            $newCourse = $course->replicate();
            $newCourse->title = $course->title . ' (Copy)';
            $newCourse->status = 'archived';
            $newCourse->save();

            // Duplicate related data if needed
            if ($course->packages()->count() > 0) {
                $newCourse->packages()->sync($course->packages->pluck('id'));
            }

            return redirect()->route('admin.educational-courses.index')
                ->with('success', 'Course duplicated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error duplicating course: ' . $e->getMessage());
        }
    }

    public function bulkAction(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'action' => 'required|in:delete,activate,archive',
                'course_ids' => 'required|array|min:1',
                'course_ids.*' => 'exists:courses,id'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('error', 'Invalid bulk action request.');
            }

            $courseIds = $request->course_ids;
            $action = $request->action;

            switch ($action) {
                case 'delete':
                    Course::whereIn('id', $courseIds)->delete();
                    $message = 'Selected courses deleted successfully!';
                    break;
                case 'activate':
                    Course::whereIn('id', $courseIds)->update(['status' => 'active']);
                    $message = 'Selected courses activated successfully!';
                    break;
                case 'archive':
                    Course::whereIn('id', $courseIds)->update(['status' => 'archived']);
                    $message = 'Selected courses archived successfully!';
                    break;
            }

            return redirect()->back()->with('success', $message);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error performing bulk action: ' . $e->getMessage());
        }
    }

    public function export(Request $request)
    {
        try {
            $courses = Course::with('category')->get();
            
            $filename = 'courses_' . date('Y-m-d_H-i-s') . '.csv';
            
            $headers = [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ];

            $callback = function() use ($courses) {
                $file = fopen('php://output', 'w');
                
                // Add headers
                fputcsv($file, ['ID', 'Title', 'Description', 'Category', 'Credit Hours', 'Status', 'Created At']);
                
                // Add data
                foreach ($courses as $course) {
                    fputcsv($file, [
                        $course->id,
                        $course->title,
                        $course->description,
                        $course->category->name ?? 'N/A',
                        $course->credit_hours,
                        $course->status,
                        $course->created_at->format('Y-m-d H:i:s')
                    ]);
                }
                
                fclose($file);
            };

            return response()->stream($callback, 200, $headers);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error exporting courses: ' . $e->getMessage());
        }
    }
}
