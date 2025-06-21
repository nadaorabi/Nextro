<?php

namespace App\Http\Controllers\Admin\Educational;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Course;
use App\Models\Student;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PackageController extends Controller
{
    // عرض جميع الباقات
    public function index()
    {
        $packages = Package::withCount('courses', 'students')->with('category')->latest()->paginate(10);
        $categories = Category::where('status', 'active')->get();
        return view('admin.educational-packages.index', compact('packages', 'categories'));
    }

    // صفحة إضافة باقة جديدة
    public function create()
    {
        $courses = Course::where('status', 'active')->get();
        $categories = Category::where('status', 'active')->get();
        return view('admin.educational-packages.create', compact('courses', 'categories'));
    }

    // حفظ باقة جديدة
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255|unique:packages,name',
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'currency'    => 'nullable|string|max:10',
            'status'      => 'required|in:active,inactive',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'courses'     => 'nullable|array',
            'courses.*'   => 'exists:courses,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name', 'description', 'category_id', 'price', 'currency', 'status']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }
        $package = Package::create($data);

        if ($request->has('courses')) {
            $package->courses()->sync($request->courses);
        }

        return redirect()->route('admin.educational-packages.index')->with('success', 'Package created successfully!');
    }

    // صفحة تفاصيل الباقة
    public function show(Package $package)
    {
        $package->load(['courses.category', 'students', 'category']);
        return view('admin.educational-packages.show', compact('package'));
    }

    // صفحة تعديل الباقة
    public function edit(Package $package)
    {
        $courses = Course::where('status', 'active')->get();
        $categories = Category::where('status', 'active')->get();
        $package->load('courses');
        return view('admin.educational-packages.edit', compact('package', 'courses', 'categories'));
    }

    // تحديث بيانات الباقة
    public function update(Request $request, Package $package)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255|unique:packages,name,' . $package->id,
            'description' => 'nullable|string|max:1000',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'currency'    => 'nullable|string|max:10',
            'status'      => 'required|in:active,inactive',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'courses'     => 'nullable|array',
            'courses.*'   => 'exists:courses,id',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name', 'description', 'category_id', 'price', 'currency', 'status']);
        if ($request->hasFile('image')) {
            if ($package->image) Storage::disk('public')->delete($package->image);
            $data['image'] = $request->file('image')->store('packages', 'public');
        }
        $package->update($data);

        if ($request->has('courses')) {
            $package->courses()->sync($request->courses);
        } else {
            $package->courses()->detach();
        }

        return redirect()->route('admin.educational-packages.index')->with('success', 'Package updated successfully!');
    }

    // حذف الباقة
    public function destroy(Package $package)
    {
        if ($package->image) Storage::disk('public')->delete($package->image);
        $package->courses()->detach();
        $package->students()->detach();
        $package->delete();

        return redirect()->route('admin.educational-packages.index')->with('success', 'Package deleted successfully!');
    }

    // تبديل حالة الباقة
    public function toggleStatus(Package $package)
    {
        $package->update([
            'status' => $package->status === 'active' ? 'inactive' : 'active'
        ]);

        return redirect()->back()->with('success', 'Package status updated successfully!');
    }

    // نسخ الباقة
    public function duplicate(Package $package)
    {
        $newPackage = $package->replicate();
        $newPackage->name = $package->name . ' (Copy)';
        $newPackage->status = 'inactive';
        $newPackage->save();

        // نسخ الدورات المرتبطة
        $newPackage->courses()->sync($package->courses->pluck('id'));

        return redirect()->route('admin.educational-packages.edit', $newPackage)
            ->with('success', 'Package duplicated successfully!');
    }

    // إجراءات جماعية
    public function bulkAction(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => 'required|in:delete,activate,deactivate',
            'packages' => 'required|array',
            'packages.*' => 'exists:packages,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $packages = Package::whereIn('id', $request->packages);

        switch ($request->action) {
            case 'delete':
                $packages->each(function ($package) {
                    if ($package->image) Storage::disk('public')->delete($package->image);
                    $package->courses()->detach();
                    $package->students()->detach();
                    $package->delete();
                });
                $message = 'Selected packages deleted successfully!';
                break;

            case 'activate':
                $packages->update(['status' => 'active']);
                $message = 'Selected packages activated successfully!';
                break;

            case 'deactivate':
                $packages->update(['status' => 'inactive']);
                $message = 'Selected packages deactivated successfully!';
                break;
        }

        return redirect()->back()->with('success', $message);
    }

    // تصدير الباقات
    public function export()
    {
        $packages = Package::withCount('courses', 'students')->with('category')->get();

        $filename = 'packages_' . date('Y-m-d_H-i-s') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($packages) {
            $file = fopen('php://output', 'w');
            
            // Headers
            fputcsv($file, [
                'ID', 'Name', 'Description', 'Category', 'Price', 'Currency', 'Status', 
                'Courses Count', 'Students Count', 'Created At', 'Updated At'
            ]);

            // Data
            foreach ($packages as $package) {
                fputcsv($file, [
                    $package->id,
                    $package->name,
                    $package->description,
                    $package->category->name ?? 'No Category',
                    $package->price,
                    $package->currency,
                    $package->status,
                    $package->courses_count,
                    $package->students_count,
                    $package->created_at,
                    $package->updated_at
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}