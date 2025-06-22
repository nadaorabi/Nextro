@extends('layouts.app_tech') {{-- Assuming you have a teacher layout --}}

@section('content')
<style>
    .password-change-card {
        box-shadow: 0 8px 32px 0 rgba(58,116,254,0.10), 0 1.5px 6px 0 rgba(58,116,254,0.08);
        border-radius: 1rem;
        border: none;
        background: #fff;
    }
    .password-change-header {
        background: linear-gradient(90deg, #3a74fe 80%, #9cc8f7 100%);
        border-radius: 1rem 1rem 0 0;
        color: #fff;
        text-align: center;
        padding: 2rem 1rem 1rem 1rem;
        position: relative;
    }
    .password-change-header .icon {
        font-size: 2.5rem;
        margin-bottom: 0.5rem;
        color: #fff;
        background: rgba(255,255,255,0.12);
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem auto;
        box-shadow: 0 2px 8px 0 rgba(58,116,254,0.10);
    }
    .password-change-header h5 {
        font-weight: bold;
        letter-spacing: 1px;
        margin-bottom: 0.5rem;
    }
    .password-change-header p {
        font-size: 1rem;
        margin-bottom: 0;
        color: #e9ecef;
    }
    .password-change-card .card-body {
        padding: 2rem 2rem 1rem 2rem;
    }
    .password-change-card .form-label {
        color: #3a74fe;
        font-weight: 500;
    }
    .password-change-card .form-control:focus {
        border-color: #3a74fe;
        box-shadow: 0 0 0 2px #3a74fe33;
    }
    .password-change-card .btn-primary {
        background: linear-gradient(90deg, #3a74fe 80%, #9cc8f7 100%);
        border: none;
        font-weight: bold;
        letter-spacing: 1px;
        box-shadow: 0 2px 8px 0 rgba(58,116,254,0.10);
        transition: background 0.2s;
    }
    .password-change-card .btn-primary:hover {
        background: #3a74fe;
    }
    .password-change-card .alert-success {
        background: #e6f4ff;
        color: #2563eb;
        border: none;
    }
    .password-change-card .alert-danger {
        background: #fff0f0;
        color: #d32f2f;
        border: none;
    }
    .password-change-card .card-footer {
        background: transparent;
        border: none;
    }
</style>
<div class="container-fluid py-4" style="min-height: 100vh; display: flex; align-items: center; justify-content: center;">
    <div class="row w-100 justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-lg-5 col-md-7">
            <div class="card password-change-card">
                <div class="password-change-header">
                    <div class="icon">
                        <i class="fas fa-lock"></i>
                    </div>
                    <h5>Change Your Password</h5>
                    <p>Welcome! For your security, please change your password before using your account.</p>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('teacher.password.update') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary w-100 mt-3">Update Password</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                    <p class="mb-3 text-sm mx-auto" style="color:#67748e;">
                        Want to log out?
                        <a href="{{ route('admin.logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                           class="text-primary text-gradient font-weight-bold">Logout</a>
                    </p>
                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 