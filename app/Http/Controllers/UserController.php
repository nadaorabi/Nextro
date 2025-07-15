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
        // Validate data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'user_name' => 'required|string|max:255|unique:users,user_name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,teacher,admin',
            'terms' => 'required|accepted',
        ], [
            'user_name.unique' => 'The username already exists.',
            'email.unique' => 'The entered email already exists.',
            'password.confirmed' => 'The entered password does not match.',
            'terms.accepted' => 'You must accept the terms and conditions.',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();
        return redirect()->route('login')->with('success', 'Registration completed successfully');
    }

    
    public function showLoginForm()
    {
        return view('User/login');
    }

    /**
     * Handle login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'user_name' => 'required|string',
            'password' => 'required',
        ]);

        // Search for user using user_name
        $user = User::where('user_name', $credentials['user_name'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            if ($user->role == 'user' || $user->role == 'student') {
                Auth::login($user, $request->filled('remember'));
                $request->session()->regenerate(); 
                return redirect()->route('home_page')->with('success', 'Login successful!');
            } else {
                return back()->withErrors([
                    'user_name' => 'This account belongs to a staff member (teacher or admin). Please use the staff login page to access your account.'
                ]);
            }
        }

        // Return with error message if credentials are invalid
        return back()->withErrors(['user_name' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        // احفظ نوع المستخدم قبل تسجيل الخروج
        $role = Auth::check() ? Auth::user()->role : null;

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // التوجيه حسب نوع المستخدم
        if ($role === 'teacher' || $role === 'admin') {
            return redirect()->route('staff.login')->with('success', 'Logout successful!');
        } else {
            return redirect()->route('login')->with('success', 'Logout successful!');
        }
    }
}