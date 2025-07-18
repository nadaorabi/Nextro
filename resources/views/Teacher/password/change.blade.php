@extends('layouts.app_tech')

@section('content')
<style>
    .password-change-container {
        background: #f8f9fa;
        min-height: 100vh;
        padding: 1rem 0;
    }
    .password-change-card {
        background: #ffffff;
        border-radius: 0.75rem;
        box-shadow: 0 0 1.5rem 0 rgba(136, 152, 170, .15);
        border: none;
        overflow: hidden;
        max-width: 450px;
        margin: 0 auto;
    }
    .password-change-header {
        background: linear-gradient(90deg, #3B82F6 0%, #1D4ED8 100%);
        color: #fff;
        text-align: center;
        padding: 1.5rem 1.25rem 1.25rem 1.25rem;
        position: relative;
    }
    .password-change-header .icon {
        font-size: 2rem;
        margin-bottom: 0.75rem;
        color: #fff;
        background: rgba(255,255,255,0.15);
        border-radius: 50%;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem auto;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        overflow: hidden;
    }
    .password-change-header .icon img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    .password-change-header h5 {
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
        font-size: 1.25rem;
    }
    .password-change-header p {
        font-size: 0.9rem;
        margin-bottom: 0;
        color: rgba(255,255,255,0.9);
        opacity: 0.9;
    }
    .password-change-card .card-body {
        padding: 1.5rem 1.5rem 1.25rem 1.5rem;
    }
    .password-change-card .form-label {
        color: #1D4ED8;
        font-weight: 600;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }
    .password-change-card .form-control {
        border: 2px solid #e9ecef;
        border-radius: 0.5rem;
        padding: 0.6rem 0.75rem;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    .password-change-card .form-control:focus {
        border-color: #1D4ED8;
        box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.1);
        background: #fff;
    }
    .password-change-card .btn-primary {
        background: linear-gradient(90deg, #1D4ED8 0%, #3B82F6 100%);
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        padding: 0.6rem 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0 3px 10px rgba(29, 78, 216, 0.3);
        transition: all 0.3s ease;
        text-transform: uppercase;
        font-size: 0.85rem;
    }
    .password-change-card .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(29, 78, 216, 0.4);
    }
    .password-change-card .alert {
        border-radius: 0.5rem;
        border: none;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1.25rem;
        font-size: 0.85rem;
    }
    .password-change-card .alert-success {
        background: linear-gradient(90deg, #2dce89 0%, #2dcecc 100%);
        color: #fff;
    }
    .password-change-card .alert-danger {
        background: linear-gradient(90deg, #f5365c 0%, #f56036 100%);
        color: #fff;
    }
    .password-change-card .card-footer {
        background: transparent;
        border: none;
        padding: 0.75rem 1.5rem 1.5rem 1.5rem;
        text-align: center;
    }
    .logout-link {
        color: #1D4ED8;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
        font-size: 0.85rem;
    }
    .logout-link:hover {
        color: #1E40AF;
        text-decoration: none;
    }
    .form-group {
        margin-bottom: 1.25rem;
    }
    .password-strength {
        margin-top: 0.4rem;
        font-size: 0.75rem;
    }
    .strength-weak { color: #f5365c; }
    .strength-medium { color: #fb6340; }
    .strength-strong { color: #2dce89; }
    .input-group-text {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        border-left: none;
        color: #1D4ED8;
        cursor: pointer;
        padding: 0.6rem 0.75rem;
        font-size: 0.85rem;
    }
    .form-control.password-field {
        border-right: none;
    }
    .input-group .form-control:focus + .input-group-text {
        border-color: #1D4ED8;
        background: #fff;
    }
</style>

<div class="password-change-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-10">
                <div class="card password-change-card">
                    <div class="password-change-header">
                        <div class="icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5>Change Your Password</h5>
                        <p>Welcome! For your security, please change your password before using your account.</p>
                    </div>
                    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                <strong>Validation Error:</strong>
                                <ul class="mb-0 mt-2">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        
                        <form method="POST" action="{{ route('teacher.password.update') }}">
                            @csrf
                            
                            <div class="form-group">
                                <label for="current_password" class="form-label">
                                    <i class="fas fa-key me-2"></i>
                                    Current Password
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control password-field" 
                                           id="current_password" 
                                           name="current_password" 
                                           required 
                                           autofocus>
                                    <span class="input-group-text" onclick="togglePassword('current_password')">
                                        <i class="fas fa-eye" id="current_password_icon"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>
                                    New Password
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control password-field" 
                                           id="password" 
                                           name="password" 
                                           required
                                           onkeyup="checkPasswordStrength(this.value)">
                                    <span class="input-group-text" onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="password_icon"></i>
                                    </span>
                                </div>
                                <div class="password-strength" id="password_strength"></div>
                            </div>
                            
                            <div class="form-group">
                                <label for="password_confirmation" class="form-label">
                                    <i class="fas fa-check-circle me-2"></i>
                                    Confirm New Password
                                </label>
                                <div class="input-group">
                                    <input type="password" 
                                           class="form-control password-field" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           required>
                                    <span class="input-group-text" onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye" id="password_confirmation_icon"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="text-center mt-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-save me-2"></i>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                    
                    <div class="card-footer">
                        <p class="mb-0 text-muted" style="font-size: 0.85rem;">
                            Want to log out?
                            <a href="{{ route('admin.logout') }}" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                               class="logout-link">
                                <i class="fas fa-sign-out-alt me-1"></i>
                                Logout
                            </a>
                        </p>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = document.getElementById(fieldId + '_icon');
    
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

function checkPasswordStrength(password) {
    const strengthDiv = document.getElementById('password_strength');
    let strength = 0;
    let message = '';
    let className = '';
    
    // Check length
    if (password.length >= 8) strength++;
    if (password.length >= 12) strength++;
    
    // Check for numbers
    if (/\d/.test(password)) strength++;
    
    // Check for lowercase
    if (/[a-z]/.test(password)) strength++;
    
    // Check for uppercase
    if (/[A-Z]/.test(password)) strength++;
    
    // Check for special characters
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    
    if (strength < 3) {
        message = 'Weak - Please add more characters, numbers, and symbols';
        className = 'strength-weak';
    } else if (strength < 5) {
        message = 'Medium - Can be improved further';
        className = 'strength-medium';
    } else {
        message = 'Strong - Excellent password';
        className = 'strength-strong';
    }
    
    strengthDiv.innerHTML = `<i class="fas fa-shield-alt me-1"></i>${message}`;
    strengthDiv.className = `password-strength ${className}`;
}
</script>
@endsection 