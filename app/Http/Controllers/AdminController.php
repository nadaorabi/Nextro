<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->role == 'admin') {
            session()->flash('welcome', 'أهلاً وسهلاً بك مسؤول النظام');
        }
        return view('Admin.dashboard');
    }

    public function billing() { return view('admin.billing'); }
    public function tables() { return view('admin.tables'); }
    public function students() { return view('admin.students'); }
    public function QR_scan() { return view('admin.QR-scan'); }
    public function materials() { return view('admin.materials'); }
    public function complaints() { return view('admin.complaints'); }
    public function finance() { return view('admin.finance'); }
    public function profile() { return view('admin.profile'); }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('staff.login');
    }
} 