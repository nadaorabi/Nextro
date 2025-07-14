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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:student,teacher,admin',
            'terms' => 'required|accepted',
        ], [
            'email.unique' => 'The entered email already exists.',
            'password.confirmed' => 'The entered password does not match.',
            'terms.accepted' => 'You must accept the terms and conditions.',
        ]);

        $user = new User();
        $user->name = $request->name;
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
            'login_id' => 'required|string',
            'password' => 'required',
        ]);

        // Search for user using login_id
        $user = User::where('login_id', $credentials['login_id'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            if ($user->role == 'user' || $user->role == 'student') {
                Auth::login($user);
                $request->session()->regenerate(); 
                return redirect()->route('home_page')->with('success', 'Login successful!');
            } else {
                return back()->withErrors([
                    'login_id' => 'This account belongs to a staff member (teacher or admin). Please use the staff login page to access your account.'
                ]);
            }
        }

        // Return with error message if credentials are invalid
        return back()->withErrors(['login_id' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        // Logout
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to home page after logout
        return redirect()->route('home_page')->with('success', 'Logout successful!');
    }
}