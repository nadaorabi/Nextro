<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StudentDashboardController extends Controller
{
    public function generateQRCode()
    {
        $user = Auth::user();
        
        // إنشاء بيانات QR Code للطالب
        $qrData = [
            'student_id' => $user->id,
            'login_id' => $user->login_id,
            'name' => $user->name,
            'timestamp' => now()->timestamp
        ];
        
        $qrCodeData = json_encode($qrData);
        
        return response()->json([
            'success' => true,
            'qr_data' => $qrCodeData,
            'student_info' => [
                'name' => $user->name,
                'login_id' => $user->login_id,
                'student_id' => $user->id
            ]
        ]);
    }
    
    public function downloadQRCode()
    {
        $user = Auth::user();
        
        // إنشاء بيانات QR Code للطالب
        $qrData = [
            'student_id' => $user->id,
            'login_id' => $user->login_id,
            'name' => $user->name,
            'timestamp' => now()->timestamp
        ];
        
        $qrCodeData = json_encode($qrData);
        
        return response()->json([
            'success' => true,
            'qr_data' => $qrCodeData,
            'filename' => 'qr_code_' . $user->login_id . '_' . now()->format('Y-m-d_H-i-s') . '.png'
        ]);
    }
    
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . Auth::id(),
            'mobile' => 'nullable|string|unique:users,mobile,' . Auth::id(),
            'address' => 'nullable|string|max:500',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'nationality' => 'nullable|string|max:100',
            'emergency_contact' => 'nullable|string|max:100',
            'parent_name' => 'nullable|string|max:255',
            'parent_mobile' => 'nullable|string|max:100',
            'medical_conditions' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $user = Auth::user();
        // الاسم ورقم الطالب وlogin_id لا يتم تعديلهم
        // باقي الحقول يتم تحديثها دومًا
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->birth_date = $request->birth_date;
        $user->gender = $request->gender;
        $user->nationality = $request->nationality;
        $user->emergency_contact = $request->emergency_contact;
        $user->parent_name = $request->parent_name;
        $user->parent_mobile = $request->parent_mobile;
        $user->medical_conditions = $request->medical_conditions;
        // معالجة الصورة
        if ($request->hasFile('image')) {
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            $image = $request->file('image');
            $filename = 'profile_images/' . time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            Storage::disk('public')->put($filename, file_get_contents($image));
            $user->image = $filename;
        }
        $user->save();
        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
            'user' => $user
        ]);
    }
    
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
            'new_password_confirmation' => 'required'
        ]);
        
        $user = Auth::user();
        
        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect!'
            ], 422);
        }
        
        // Update password
        $user->password = Hash::make($request->new_password);
        $user->plain_password = $request->new_password; // Save plain password for display
        $user->save();
        
        return response()->json([
            'success' => true,
            'message' => 'Password changed successfully!'
        ]);
    }
    
    public function contactSupport()
    {
        $user = Auth::user();
        
        // إنشاء رابط واتساب مع رسالة مخصصة
        $message = "Hello! I'm {$user->name} (Student ID: {$user->login_id}). I need support.";
        $whatsappUrl = "https://wa.me/1234567890?text=" . urlencode($message);
        
        return response()->json([
            'success' => true,
            'whatsapp_url' => $whatsappUrl
        ]);
    }
}
