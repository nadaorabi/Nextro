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

    // إدارة حسابات: طلاب
    public function studentsCreate() { return view('admin.accounts.students-create'); }
    public function studentsList() { return view('admin.accounts.students-list'); }
    // إدارة حسابات: أساتذة
    public function teachersCreate() { return view('admin.accounts.teachers-create'); }
    public function teachersList() { return view('admin.accounts.teachers-list'); }
    // إدارة حسابات: مسؤولين
    public function adminsCreate() { return view('admin.accounts.admins-create'); }
    public function adminsList() { return view('admin.accounts.admins-list'); }

    // Educational Materials Management
    public function materialsCreate() { return view('admin.educational-materials.create'); }
    public function materialsEdit() { return view('admin.educational-materials.edit'); }
    public function materialsLink() { return view('admin.educational-materials.link'); }
    public function materialsList() { return view('admin.educational-materials.list'); }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('staff.login');
    }
} 