@extends('layouts.app_tech')

@section('title', 'تسجيل دخول المدرسين')

@section('content')
<style>
.teacher-login-main {
  min-height: 100vh;
  display: flex;
  align-items: stretch;
  background: #f8f9fb;
}
.teacher-login-left {
  flex: 1 1 0%;
  background: #fff;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 48px 32px;
  max-width: 480px;
  box-shadow: 2px 0 24px 0 rgba(0,0,0,0.04);
  z-index: 2;
}
.teacher-login-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 32px;
}
.teacher-login-logo img {
  width: 48px;
  height: 48px;
}
.teacher-login-title {
  font-size: 2rem;
  font-weight: 700;
  color: #22223b;
  margin-bottom: 8px;
}
.teacher-login-welcome {
  font-size: 1.1rem;
  color: #22223b;
  margin-bottom: 4px;
}
.teacher-login-desc {
  color: #6c757d;
  margin-bottom: 32px;
}
.teacher-login-form label {
  font-weight: 500;
  color: #22223b;
}
.teacher-login-form .form-control {
  border-radius: 8px;
  border: 1px solid #e0e0e0;
  margin-bottom: 16px;
  padding: 0.75rem 1rem;
  font-size: 1rem;
}
.teacher-login-form .form-check-label {
  color: #22223b;
}
.teacher-login-form .btn-primary {
  background: #2563eb;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  font-size: 1.1rem;
  padding: 0.75rem 0;
  margin-top: 8px;
  transition: background 0.2s;
}
.teacher-login-form .btn-primary:hover {
  background: #1d4ed8;
}
.teacher-login-form .form-check-input:checked {
  background-color: #2563eb;
  border-color: #2563eb;
}
.teacher-login-form .forgot-link {
  color: #2563eb;
  font-size: 0.95rem;
  text-decoration: underline;
}
.teacher-login-form .register-link {
  color: #2563eb;
  font-size: 0.95rem;
}
.teacher-login-right {
  flex: 2 1 0%;
  background: url('https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=900&q=80') center center/cover no-repeat;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  align-items: flex-start;
  position: relative;
}
.teacher-login-right::before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(34,34,59,0.45);
  z-index: 1;
}
.teacher-login-right-content {
  position: relative;
  z-index: 2;
  color: #fff;
  padding: 48px 64px;
  max-width: 600px;
}
.teacher-login-right-content h1 {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 12px;
}
.teacher-login-right-content p {
  font-size: 1.2rem;
  margin-bottom: 0;
  color: #e0e0e0;
}
@media (max-width: 991px) {
  .teacher-login-main { flex-direction: column; }
  .teacher-login-left, .teacher-login-right { max-width: 100%; }
  .teacher-login-right-content { padding: 32px; }
}
.btn-social-login {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  border-radius: 8px;
  font-weight: 600;
  font-size: 1.05rem;
  padding: 0.7rem 0;
  border: none;
  outline: none;
  transition: background 0.2s, box-shadow 0.2s;
  box-shadow: 0 2px 8px rgba(0,0,0,0.04);
  cursor: pointer;
  text-decoration: none;
}
.btn-google {
  background: #fff;
  color: #222;
  border: 1px solid #e0e0e0;
}
.btn-google:hover {
  background: #f1f1f1;
}
.btn-facebook {
  background: #1877f3;
  color: #fff;
}
.btn-facebook:hover {
  background: #145db2;
}
.icon-social {
  width: 22px;
  height: 22px;
  margin-left: 8px;
}
.social-separator {
  display: flex;
  align-items: center;
  text-align: center;
  color: #aaa;
  font-size: 0.98rem;
  margin: 18px 0 10px 0;
}
.social-separator span {
  flex: 1;
  position: relative;
}
.social-separator span:before,
.social-separator span:after {
  content: '';
  position: absolute;
  top: 50%;
  width: 40%;
  height: 1px;
  background: #e0e0e0;
}
.social-separator span:before {
  right: 105%;
}
.social-separator span:after {
  left: 105%;
}
</style>
<div class="teacher-login-main">
  <div class="teacher-login-left">
    <div class="teacher-login-logo">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Teacher Logo">
      <span class="teacher-login-title">Nextro.</span>
    </div>
    <div class="teacher-login-welcome">مرحباً بك من جديد</div>
    <div class="teacher-login-desc">يرجى تسجيل الدخول للتحكم وإدارة كل شيء!</div>
    <!-- Social Login Buttons -->
   
    <form class="teacher-login-form w-100" action="{{ route('teacher.login.post') }}" method="POST">
      @csrf
      <label for="email">البريد الإلكتروني</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required>
      @error('email')
        <div class="text-danger mb-2">{{ $message }}</div>
      @enderror
      <label for="password">كلمة المرور</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="كلمة المرور" required>
      @error('password')
        <div class="text-danger mb-2">{{ $message }}</div>
      @enderror
      <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="form-check">
          <input type="checkbox" id="remember" name="remember" class="form-check-input">
          <label for="remember" class="form-check-label">تذكرني</label>
        </div>
        <a href="#" class="forgot-link">هل نسيت كلمة المرور؟</a>
      </div>
      <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>
      <div class="text-center mt-3">
        <span>ليس لديك حساب؟ <a href="{{ route('teacher.register') }}" class="register-link">إنشاء حساب جديد</a></span>
      </div>
    </form>
    <div class="social-separator mb-3 w-100">
      <span>أو سجل دخول بالطريقة التقليدية</span>
    </div>
    <div class="mb-3 w-100">
      <a href="#" class="btn-social-login btn-google w-100 mb-2">
        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" alt="Google" class="icon-social"> تسجيل الدخول بواسطة Google
      </a>
      <a href="#" class="btn-social-login btn-facebook w-100 mb-2">
        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/facebook/facebook-original.svg" alt="Facebook" class="icon-social"> تسجيل الدخول بواسطة Facebook
      </a>
      <!-- يمكنك إضافة المزيد من مزودي الخدمة هنا -->
    </div>
   
  </div>
  <div class="teacher-login-right">
    <div class="teacher-login-right-content">
      <h1>مرحباً بكم في بوابة الأساتذة</h1>
      <p>نظام متكامل لإدارة الفصول والطلاب والمواد بكل سهولة واحترافية.</p>
    </div>
  </div>
</div>
@endsection 