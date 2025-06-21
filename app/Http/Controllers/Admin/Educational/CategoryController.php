<?php

namespace App\Http\Controllers\Admin\Educational;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('courses')->paginate(10);

        $totalCategories = Category::count();
        $activeCategories = Category::where('status', 'active')->count();
        $linkedCourses = Category::has('courses')->withCount('courses')->get()->sum('courses_count');
        $latestCategory = Category::latest()->first();

        return view('admin.educational-categories.index', compact(
            'categories',
            'totalCategories',
            'activeCategories',
            'linkedCourses',
            'latestCategory'
        ));
    }

    public function show(Category $category)
    {
        $category->load(['courses', 'packages']);

        return view('admin.educational-categories.show', compact('category'));
    }


    public function create()
    {
        return view('admin.educational-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:active,inactive',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        Category::create($data);

        return redirect()->route('admin.educational-categories.index')->with('success', 'Category created successfully.');
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'status']);

        if ($request->hasFile('image')) {
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }


            $data['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($data);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }


        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
}
