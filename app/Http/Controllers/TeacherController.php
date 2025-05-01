<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class TeacherController extends Controller
{
    /**
     * عرض نموذج تسجيل الدخول للمدرسين
     */
    public function showLoginForm()
    {
        return view('Teacher.login');
    }

    /**
     * معالجة تسجيل الدخول للمدرسين
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            if ($user->isTeacher()) {
                $request->session()->regenerate();
                return redirect()->intended(route('teacher.dashboard'));
            }
            
            Auth::logout();
            return back()->withErrors([
                'email' => 'هذا الحساب ليس حساب مدرس.',
            ]);
        }

        return back()->withErrors([
            'email' => 'بيانات الاعتماد المقدمة غير متطابقة مع سجلاتنا.',
        ]);
    }

    /**
     * عرض نموذج إنشاء حساب للمدرسين
     */
    public function showRegisterForm()
    {
        return view('Teacher.register');
    }

    /**
     * معالجة إنشاء حساب للمدرسين
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'terms' => ['required', 'accepted'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher',
        ]);

        Auth::login($user);

        return redirect()->route('teacher.dashboard');
    }

    /**
     * عرض لوحة تحكم المدرسين
     */
    public function dashboard()
    {
        return view('Teacher.dashboard');
    }

    /**
     * تسجيل الخروج
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
} 