@extends('layouts.app_tech')
@section('title', '404 Not Found')
@section('content')
<style>
    .error-page {
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
    }
    .error-card {
        background: #fff;
        border-radius: 1.5rem;
        box-shadow: 0 8px 32px 0 rgba(58,116,254,0.10), 0 1.5px 6px 0 rgba(58,116,254,0.08);
        padding: 3rem 2.5rem;
        text-align: center;
        max-width: 400px;
    }
    .error-card .logo {
        font-size: 2rem;
        font-weight: bold;
        letter-spacing: 2px;
        color: #3a74fe;
        margin-bottom: 1rem;
    }
    .error-card .icon {
        font-size: 4rem;
        color: #3a74fe;
        margin-bottom: 1rem;
    }
    .error-card h1 {
        font-size: 3rem;
        font-weight: bold;
        color: #3a74fe;
        margin-bottom: 0.5rem;
    }
    .error-card p {
        color: #67748e;
        margin-bottom: 2rem;
    }
    .error-card .btn-home {
        background: linear-gradient(90deg, #3a74fe 80%, #9cc8f7 100%);
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        padding: 0.75rem 2rem;
        font-weight: bold;
        font-size: 1.1rem;
        box-shadow: 0 2px 8px 0 rgba(58,116,254,0.10);
        transition: background 0.2s;
        text-decoration: none;
    }
    .error-card .btn-home:hover {
        background: #3a74fe;
        color: #fff;
    }
</style>
<div class="error-page">
    <div class="error-card">
        <div class="logo mb-2" style="font-size:2rem; font-weight:bold; letter-spacing:2px; color:#3a74fe;">
            Nextro<span class="text-primary">.</span>
        </div>
        <div class="icon">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <h1>404</h1>
        <p>Sorry, the page you are looking for could not be found.<br>
        ربما تم حذف الصفحة أو لم تعد متوفرة.</p>

        @php
            $user = auth()->user();
            $isLoggedIn = auth()->check();
            
            // Debug information (remove this in production)
            // dd($user, $isLoggedIn, $user ? $user->role : 'no user');
            
            if (!$isLoggedIn || !$user) {
                $btnUrl = route('home_page');
                $btnText = 'العودة للصفحة الرئيسية';
            } elseif ($user->role === 'admin') {
                $btnUrl = route('admin.dashboard');
                $btnText = 'العودة للوحة التحكم';
            } elseif ($user->role === 'teacher') {
                $btnUrl = route('teacher.dashboard');
                $btnText = 'العودة للوحة التحكم';
            } else {
                $btnUrl = route('home_page');
                $btnText = 'العودة للصفحة الرئيسية';
            }
        @endphp
        <a href="{{ $btnUrl }}" class="btn btn-home">{{ $btnText }}</a>
    </div>
</div>
@endsection 