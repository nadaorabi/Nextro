<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
   
    public function showRegisterForm()
    {
        return view('User/register');
    }
    public function register(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,teacher,admin',
            'terms' => 'required|accepted',
        ], [
            'email.unique' => 'البريد الإلكتروني المدخل موجود مسبقًا.',
            'password.confirmed' => 'كلمة المرور المدخلة غير متطابقة.',
            'terms.accepted' => 'يجب قبول الشروط والأحكام.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('login')->with('success', 'تم التسجيل بنجاح');
    }

    
    public function showLoginForm()
    {
        return view('User/login');
    }

    /**
     * معالجة تسجيل الدخول
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            session()->regenerate(); 
            return redirect()->route('home_page')->with('success', 'تم تسجيل الدخول بنجاح!');
        }

        // العودة مع رسالة خطأ في حال كانت بيانات الاعتماد غير صحيحة
        return back()->withErrors(['email' => 'بيانات الاعتماد غير صحيحة.']);
    }

    public function logout(Request $request)
    {
        // تسجيل الخروج
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // إعادة التوجيه إلى الصفحة الرئيسية بعد الخروج
        return redirect()->route('home_page')->with('success', 'تم تسجيل الخروج بنجاح!');
    }
}