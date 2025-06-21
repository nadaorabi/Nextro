<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourseMaterialController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'course_id' => 'required|exists:courses,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'type' => 'required|in:pdf,video,document,presentation,link',
                'file' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,mp4,avi,mov|max:10240',
                'url' => 'nullable|url|max:500',
                'status' => 'required|in:active,draft,archived',
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $data = [
                'course_id' => $request->course_id,
                'title' => $request->title,
                'description' => $request->description,
                'type' => $request->type,
                'status' => $request->status,
                'uploaded_by' => auth()->id(),
            ];

            // Handle file upload
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('materials', 'public');
                $data['file_path'] = $filePath;
            }

            // Handle URL
            if ($request->filled('url')) {
                $data['url'] = $request->url;
            }

            Material::create($data);

            return redirect()->back()
                ->with('success', 'Material added to course successfully!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error adding material: ' . $e->getMessage());
        }
    }

    public function destroy(Material $material)
    {
        try {
            // Delete file if exists
            if ($material->file_path && Storage::disk('public')->exists($material->file_path)) {
                Storage::disk('public')->delete($material->file_path);
            }

            $material->delete();
            return redirect()->back()
                ->with('success', 'Material removed successfully!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error removing material: ' . $e->getMessage());
        }
    }
} 