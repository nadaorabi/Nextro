<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// use App\Models\User;
// use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
   
    public function showLoginForm()
    {
        return view('teacher.sign-in');
    }

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
            'email' => 'بيانات الاعتماد غير صحيحة.',
        ]);
    }

    // ========== التسجيل ==========
    public function showRegisterForm()
    {
        return view('teacher.sign-up');
    }

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

    // ========== تسجيل الخروج ==========
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
  
    public function dashboard()         { return view('teacher.dashboard'); }
    public function billing()           { return view('teacher.billing'); }
    public function profile()           { return view('teacher.profile'); }
    public function rtl()               { return view('teacher.rtl'); }
    public function tables()            { return view('teacher.tables'); }
    public function virtualReality()    { return view('teacher.virtual-reality'); }
    public function students()          { return view('teacher.students'); }
    public function materials()         { return view('teacher.materials'); }
    public function complaints()        { return view('teacher.complaints'); }
    public function finance()           { return view('teacher.finance'); }
}
