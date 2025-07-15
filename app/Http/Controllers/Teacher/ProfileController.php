<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        return view('Teacher.profile');
    }

    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            // If it's just an image upload, handle it separately
            if ($request->hasFile('image') && !$request->filled('name') && !$request->filled('email')) {
                $request->validate([
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
                ]);

                // Delete old image if exists
                if ($user->image && \Storage::disk('public')->exists($user->image)) {
                    \Storage::disk('public')->delete($user->image);
                }

                // Store new image
                $imagePath = $request->file('image')->store('teacher-profiles', 'public');
                $user->image = $imagePath;
                $user->save();

                // Log for debugging
                \Log::info('Image uploaded successfully', [
                    'user_id' => $user->id,
                    'image_path' => $imagePath,
                    'stored_path' => $user->image
                ]);

                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => true, 
                        'message' => 'Profile image updated successfully',
                        'image_path' => asset('storage/' . $imagePath)
                    ]);
                }

                return redirect()->back()->with('success', 'Profile image updated successfully');
            }

            // Handle profile information update
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
                'mobile' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:500',
                'note' => 'nullable|string|max:1000',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            // Update user information
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->note = $request->note;

            // Handle image upload if provided
            if ($request->hasFile('image')) {
                if ($user->image && \Storage::disk('public')->exists($user->image)) {
                    \Storage::disk('public')->delete($user->image);
                }
                $imagePath = $request->file('image')->store('teacher-profiles', 'public');
                $user->image = $imagePath;
            }

            $user->save();

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'message' => 'Information updated successfully']);
            }

            return redirect()->back()->with('success', 'Information updated successfully');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Error updating information: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Error updating information');
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|string|min:8|confirmed',
            ], [
                'current_password.required' => 'Current password is required',
                'password.required' => 'New password is required',
                'password.min' => 'Password must be at least 8 characters',
                'password.confirmed' => 'Password confirmation does not match',
            ]);

            $user = Auth::user();

            // Verify current password
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Current password is incorrect'
                ], 422);
            }

            // Update password
            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json([
                'success' => true,
                'message' => 'Password changed successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error changing password: ' . $e->getMessage()
            ], 500);
        }
    }
} 