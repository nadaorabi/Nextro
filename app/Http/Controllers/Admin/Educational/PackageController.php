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
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    // عرض جميع الباقات
    public function index()
    {
        $packages = Package::withCount('courses', 'students')
                          ->with('category')
                          ->latest()
                          ->get()
                          ->map(function ($package) {
                              // التأكد من أن السعر الأصلي محسوب بشكل صحيح
                              if (!$package->original_price || $package->original_price == 0) {
                                  $package->original_price = $this->calculateOriginalPrice($package);
                                  $package->save();
                              }
                              
                              // إذا لم يكن هناك سعر مخصوم، استخدم السعر الأصلي
                              if (!$package->discounted_price) {
                                  $package->discounted_price = $package->original_price;
                                  $package->save();
                              }
                              
                              // تحديث نسبة الخصم إذا لم تكن محسوبة أو غير صحيحة
                              $calculatedDiscount = $this->calculateDiscountPercentage($package->original_price, $package->discounted_price);
                              if ($package->discount_percentage != $calculatedDiscount) {
                                  $package->discount_percentage = $calculatedDiscount;
                                  $package->save();
                              }
                              
                              return $package;
                          });
        
        $packages = new \Illuminate\Pagination\LengthAwarePaginator(
            $packages->forPage(request()->get('page', 1), 10),
            $packages->count(),
            10,
            request()->get('page', 1),
            ['path' => request()->url()]
        );
        
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
            'currency'    => 'nullable|string|max:10',
            'status'      => 'required|in:active,inactive',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'courses'     => 'nullable|array',
            'courses.*'   => 'exists:courses,id',
            'original_price' => 'sometimes|numeric|min:0',
            'discounted_price' => 'sometimes|numeric|min:0',
            'package_discount_percentage' => 'nullable|numeric|min:0|max:100',
            'package_discounted_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:percent,price,none',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name', 'description', 'category_id', 'currency', 'status']);
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('packages', 'public');
        }
        
        // إعداد الأسعار
        if ($request->filled('original_price')) {
            $data['original_price'] = floatval($request->input('original_price'));
        }
        
        $package = Package::create($data);

        if ($request->has('courses')) {
            $package->courses()->sync($request->courses);
            
            // إذا لم يتم تحديد السعر الأصلي، احسبه من الكورسات
            if (!$request->filled('original_price')) {
                $package->original_price = $this->calculateOriginalPrice($package);
            }
        }

        // تحديث السعر المخصوم بناءً على نوع الخصم المختار
        $discountType = $request->input('discount_type', 'none');
        
        if ($discountType === 'percent') {
            // خصم نسبة مئوية
            $discountPercentage = $request->filled('package_discount_percentage') ? floatval($request->input('package_discount_percentage')) : 0;
            if ($discountPercentage > 0) {
                $package->discounted_price = $this->calculateDiscountedPrice(
                    $package->original_price, 
                    $discountPercentage, 
                    null
                );
            } else {
                $package->discounted_price = $package->original_price;
            }
        } elseif ($discountType === 'price') {
            // سعر نهائي يدوي
            $discountedPrice = $request->filled('package_discounted_price') ? floatval($request->input('package_discounted_price')) : null;
            if ($discountedPrice !== null && $discountedPrice > 0) {
                $package->discounted_price = $discountedPrice;
            } else {
                $package->discounted_price = $package->original_price;
            }
        } else {
            // بدون خصم - استخدم السعر الأصلي
            $package->discounted_price = $package->original_price;
        }

        // تحديث نسبة الخصم تلقائياً
        $this->updateDiscountPercentage($package);
        $package->save();

        return redirect()->route('admin.educational-packages.index')->with('success', 'Package created successfully!');
    }

    // صفحة تفاصيل الباقة
    public function show(Package $package)
    {
        $package->load(['courses.category', 'students', 'category']);
        $allCourses = \App\Models\Course::where('status', 'active')->get();
        return view('admin.educational-packages.show', compact('package', 'allCourses'));
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
            'currency'    => 'nullable|string|max:10',
            'status'      => 'required|in:active,inactive',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'courses'     => 'nullable|array',
            'courses.*'   => 'exists:courses,id',
            'package_discount_percentage' => 'nullable|numeric|min:0|max:100',
            'package_discounted_price' => 'nullable|numeric|min:0',
            'discount_type' => 'nullable|in:percent,price,none',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->only(['name', 'description', 'category_id', 'currency', 'status']);
        if ($request->hasFile('image')) {
            if ($package->image) Storage::disk('public')->delete($package->image);
            $data['image'] = $request->file('image')->store('packages', 'public');
        }
        $package->update($data);

        // تحديث الكورسات
        if ($request->has('courses')) {
            $package->courses()->sync($request->courses);
        } else {
            $package->courses()->detach();
        }

        // إعادة حساب السعر الأصلي إذا تم تغيير الكورسات
        if ($request->has('courses')) {
            $package->original_price = $this->calculateOriginalPrice($package);
        }
        
        // تحديث السعر المخصوم بناءً على نوع الخصم المختار
        $discountType = $request->input('discount_type', 'none');
        
        if ($discountType === 'percent') {
            // خصم نسبة مئوية
            $discountPercentage = $request->filled('package_discount_percentage') ? floatval($request->input('package_discount_percentage')) : 0;
            if ($discountPercentage > 0) {
                $package->discounted_price = $this->calculateDiscountedPrice(
                    $package->original_price, 
                    $discountPercentage, 
                    null
                );
            } else {
                $package->discounted_price = $package->original_price;
            }
        } elseif ($discountType === 'price') {
            // سعر نهائي يدوي
            $discountedPrice = $request->filled('package_discounted_price') ? floatval($request->input('package_discounted_price')) : null;
            if ($discountedPrice !== null && $discountedPrice > 0) {
                $package->discounted_price = $discountedPrice;
            } else {
                $package->discounted_price = $package->original_price;
            }
        } else {
            // بدون خصم - استخدم السعر الأصلي
            $package->discounted_price = $package->original_price;
        }
        
        // تحديث نسبة الخصم تلقائياً
        $this->updateDiscountPercentage($package);
        $package->save();

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
        
        // إعادة حساب الأسعار للباقة الجديدة
        $newPackage->original_price = null;
        $newPackage->discounted_price = null;
        
        $newPackage->save();

        // نسخ الدورات المرتبطة
        $newPackage->courses()->sync($package->courses->pluck('id'));
        
        // إعادة حساب السعر الأصلي من الكورسات المنسوخة
        if ($newPackage->courses()->count() > 0) {
            $newPackage->original_price = $this->calculateOriginalPrice($newPackage);
            $newPackage->discounted_price = $newPackage->original_price; // السعر المخصوم يساوي السعر الأصلي في البداية
            $this->updateDiscountPercentage($newPackage);
            $newPackage->save();
        }

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

    // إضافة كورسات للباقة مع خصم
    public function addCourses(Request $request, Package $package)
    {
        // Validation rules بناءً على نوع الخصم
        $discountType = $request->input('discount_type', 'none');
        
        $rules = [
            'discount_type' => 'required|in:percent,price,none',
            'courses' => 'required|array',
        ];
        
        if ($discountType === 'percent') {
            $rules['package_discount_percentage'] = 'required|numeric|min:0|max:100';
        } elseif ($discountType === 'price') {
            $rules['package_discounted_price'] = 'required|numeric|min:0';
        }
        // لا توجد قواعد validation إضافية لحالة "بدون خصم"
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $data = $request->input('courses', []);
        $syncData = [];
        
        foreach ($data as $courseId => $info) {
            if (isset($info['selected'])) {
                // إضافة الكورس بدون خصم فردي
                $syncData[$courseId] = ['discount_percentage' => 0];
            }
        }
        
        if ($syncData) {
            $package->courses()->attach($syncData);
            
            // إعادة حساب السعر الأصلي باستخدام الدالة المساعدة
            $package->original_price = $this->calculateOriginalPrice($package);
            
            // تحديث السعر المخصوم بناءً على نوع الخصم المختار
            if ($discountType === 'percent') {
                // خصم نسبة مئوية
                $discountPercentage = $request->filled('package_discount_percentage') ? floatval($request->input('package_discount_percentage')) : 0;
                if ($discountPercentage > 0) {
                    $package->discounted_price = $this->calculateDiscountedPrice(
                        $package->original_price, 
                        $discountPercentage, 
                        null
                    );
                } else {
                    $package->discounted_price = $package->original_price;
                }
            } elseif ($discountType === 'price') {
                // سعر نهائي يدوي
                $discountedPrice = $request->filled('package_discounted_price') ? floatval($request->input('package_discounted_price')) : null;
                if ($discountedPrice !== null && $discountedPrice > 0) {
                    $package->discounted_price = $discountedPrice;
                } else {
                    $package->discounted_price = $package->original_price;
                }
            } else {
                // بدون خصم - استخدم السعر الأصلي
                $package->discounted_price = $package->original_price;
            }
            
            // تحديث نسبة الخصم تلقائياً
            $this->updateDiscountPercentage($package);
            $package->save();
        }
        
        return redirect()->route('admin.educational-packages.show', $package)->with('success', 'Courses added successfully!');
    }

    // إرجاع السعر الأصلي الجديد بعد حذف كورس (AJAX)
    public function getPriceAfterRemove(Package $package, Course $course)
    {
        $courses = $package->courses()->where('courses.id', '!=', $course->id)->get();
        $originalPrice = 0;
        foreach ($courses as $c) {
            $pivot = $c->pivot;
            $final = $c->price - ($c->price * ($pivot->discount_percentage ?? 0) / 100);
            $originalPrice += $final;
        }
        
        // حساب السعر المخصوم بناءً على الخصم الحالي للباقة
        $discountedPrice = $originalPrice;
        $discountPercentage = 0;
        
        if ($package->discounted_price && $package->original_price && $package->original_price > 0) {
            $currentDiscountPercentage = (($package->original_price - $package->discounted_price) / $package->original_price) * 100;
            $discountedPrice = $originalPrice - ($originalPrice * $currentDiscountPercentage / 100);
            $discountPercentage = $currentDiscountPercentage;
        }
        
        return response()->json([
            'original_price' => $originalPrice,
            'discounted_price' => $discountedPrice,
            'discount_percentage' => $discountPercentage,
            'currency' => $package->currency ?? 'USD'
        ]);
    }

    // حذف كورس من الباقة وتحديث الأسعار
    public function removeCourse(Request $request, Package $package, Course $course)
    {
        // Validation rules بناءً على نوع الخصم
        $discountType = $request->input('discount_type', 'none');
        
        $rules = [
            'discount_type' => 'required|in:percent,price,none',
        ];
        
        if ($discountType === 'percent') {
            $rules['package_discount_percentage'] = 'required|numeric|min:0|max:100';
        } elseif ($discountType === 'price') {
            $rules['package_discounted_price'] = 'required|numeric|min:0';
        }
        // لا توجد قواعد validation إضافية لحالة "بدون خصم"
        
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $package->courses()->detach($course->id);
        
        // إعادة حساب السعر الأصلي باستخدام الدالة المساعدة
        $package->original_price = $this->calculateOriginalPrice($package);
        
        // تحديث السعر المخصوم بناءً على نوع الخصم المختار
        if ($discountType === 'percent') {
            // خصم نسبة مئوية
            $discountPercentage = $request->filled('package_discount_percentage') ? floatval($request->input('package_discount_percentage')) : 0;
            if ($discountPercentage > 0) {
                $package->discounted_price = $this->calculateDiscountedPrice(
                    $package->original_price, 
                    $discountPercentage, 
                    null
                );
            } else {
                $package->discounted_price = $package->original_price;
            }
        } elseif ($discountType === 'price') {
            // سعر نهائي يدوي
            $discountedPrice = $request->filled('package_discounted_price') ? floatval($request->input('package_discounted_price')) : null;
            if ($discountedPrice !== null && $discountedPrice > 0) {
                $package->discounted_price = $discountedPrice;
            } else {
                $package->discounted_price = $package->original_price;
            }
        } else {
            // بدون خصم - استخدم السعر الأصلي
            $package->discounted_price = $package->original_price;
        }
        
        // تحديث نسبة الخصم تلقائياً
        $this->updateDiscountPercentage($package);
        $package->save();
        
        return redirect()->route('admin.educational-packages.show', $package)->with('success', 'Course removed and prices updated!');
    }

    /**
     * حساب السعر الأصلي للباقة من الكورسات
     */
    private function calculateOriginalPrice(Package $package)
    {
        return $package->courses()->sum(\DB::raw('price - (price * package_courses.discount_percentage / 100)'));
    }

    /**
     * حساب السعر المخصوم بناءً على الخصم المئوي أو السعر المحدد
     */
    private function calculateDiscountedPrice($originalPrice, $discountPercentage = null, $discountedPrice = null)
    {
        if ($discountPercentage !== null && $discountPercentage > 0) {
            return $originalPrice - ($originalPrice * $discountPercentage / 100);
        } elseif ($discountedPrice !== null) {
            return $discountedPrice;
        } else {
            return $originalPrice;
        }
    }

    /**
     * حساب نسبة الخصم بناءً على السعر الأصلي والسعر المخصوم
     */
    private function calculateDiscountPercentage($originalPrice, $discountedPrice)
    {
        if ($originalPrice > 0 && $discountedPrice < $originalPrice) {
            return round((($originalPrice - $discountedPrice) / $originalPrice) * 100, 2);
        }
        return 0;
    }

    /**
     * تحديث نسبة الخصم تلقائياً
     */
    private function updateDiscountPercentage(Package $package)
    {
        if ($package->original_price > 0) {
            $package->discount_percentage = $this->calculateDiscountPercentage(
                $package->original_price, 
                $package->discounted_price ?? $package->original_price
            );
        } else {
            $package->discount_percentage = 0;
        }
    }

    /**
     * تنظيف البيانات وتحديث نسب الخصم لجميع الباقات
     */
    public function cleanupDiscountPercentages()
    {
        $packages = Package::all();
        $updatedCount = 0;
        
        foreach ($packages as $package) {
            $originalDiscountPercentage = $package->discount_percentage;
            
            // تحديث نسبة الخصم
            $this->updateDiscountPercentage($package);
            
            // حفظ إذا تغيرت النسبة
            if ($originalDiscountPercentage != $package->discount_percentage) {
                $package->save();
                $updatedCount++;
            }
        }
        
        return response()->json([
            'success' => true,
            'message' => "Updated discount percentages for {$updatedCount} packages",
            'updated_count' => $updatedCount
        ]);
    }
}