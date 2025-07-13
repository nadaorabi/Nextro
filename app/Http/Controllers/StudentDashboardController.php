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
            'mobile' => 'required|string|unique:users,mobile,' . Auth::id(),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        
        $user = Auth::user();
        
        // تحديث البيانات الأساسية
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        
        // معالجة الصورة
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا وجدت
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }
            
            // حفظ الصورة الجديدة
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
        
        // التحقق من كلمة السر الحالية
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect!'
            ], 422);
        }
        
        // تحديث كلمة السر
        $user->password = Hash::make($request->new_password);
        $user->plain_password = $request->new_password; // حفظ كلمة السر النصية للعرض
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
