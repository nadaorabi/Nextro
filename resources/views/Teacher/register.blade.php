@extends('layouts.app_tech')

@section('title', 'إنشاء حساب مدرس')

@section('content')
<style>
.teacher-register-main {
  min-height: 100vh;
  display: flex;
  align-items: stretch;
  background: #f8f9fb;
}
.teacher-register-left {
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
.teacher-register-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 32px;
}
.teacher-register-logo img {
  width: 48px;
  height: 48px;
}
.teacher-register-title {
  font-size: 2rem;
  font-weight: 700;
  color: #22223b;
  margin-bottom: 8px;
}
.teacher-register-welcome {
  font-size: 1.1rem;
  color: #22223b;
  margin-bottom: 4px;
}
.teacher-register-desc {
  color: #6c757d;
  margin-bottom: 32px;
}
.teacher-register-form label {
  font-weight: 500;
  color: #22223b;
}
.teacher-register-form .form-control {
  border-radius: 8px;
  border: 1px solid #e0e0e0;
  margin-bottom: 16px;
  padding: 0.75rem 1rem;
  font-size: 1rem;
}
.teacher-register-form .form-check-label {
  color: #22223b;
}
.teacher-register-form .btn-success {
  background: #28a745;
  border: none;
  border-radius: 8px;
  font-weight: 600;
  font-size: 1.1rem;
  padding: 0.75rem 0;
  margin-top: 8px;
  transition: background 0.2s;
}
.teacher-register-form .btn-success:hover {
  background: #218838;
}
.teacher-register-form .form-check-input:checked {
  background-color: #28a745;
  border-color: #28a745;
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
.teacher-register-right {
  flex: 2 1 0%;
  background: url('https://images.unsplash.com/photo-1513258496099-48168024aec0?auto=format&fit=crop&w=900&q=80') center center/cover no-repeat;
  display: flex;
  flex-direction: column;
  justify-content: flex-end;
  align-items: flex-start;
  position: relative;
}
.teacher-register-right::before {
  content: '';
  position: absolute;
  inset: 0;
  background: rgba(34,34,59,0.45);
  z-index: 1;
}
.teacher-register-right-content {
  position: relative;
  z-index: 2;
  color: #fff;
  padding: 48px 64px;
  max-width: 600px;
}
.teacher-register-right-content h1 {
  font-size: 2.5rem;
  font-weight: 700;
  margin-bottom: 12px;
}
.teacher-register-right-content p {
  font-size: 1.2rem;
  margin-bottom: 0;
  color: #e0e0e0;
}
@media (max-width: 991px) {
  .teacher-register-main { flex-direction: column; }
  .teacher-register-left, .teacher-register-right { max-width: 100%; }
  .teacher-register-right-content { padding: 32px; }
}
</style>
<div class="teacher-register-main">
  <div class="teacher-register-left">
    <div class="teacher-register-logo">
      <img src="https://cdn-icons-png.flaticon.com/512/3135/3135755.png" alt="Teacher Logo">
      <span class="teacher-register-title">Nextro.</span>
    </div>
    <div class="teacher-register-welcome">انضم إلى فريق المدرسين</div>
    <div class="teacher-register-desc">أنشئ حسابك لإدارة فصولك الدراسية بسهولة واحترافية!</div>
    <form class="teacher-register-form w-100" action="{{ route('teacher.register.post') }}" method="POST">
      @csrf
      <label for="name">الاسم الكامل</label>
      <input type="text" id="name" name="name" class="form-control" placeholder="الاسم الكامل" required value="{{ old('name') }}">
      @error('name') <div class="text-danger mb-2">{{ $message }}</div> @enderror
      <label for="email">البريد الإلكتروني</label>
      <input type="email" id="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required value="{{ old('email') }}">
      @error('email') <div class="text-danger mb-2">{{ $message }}</div> @enderror
      <label for="password">كلمة المرور</label>
      <input type="password" id="password" name="password" class="form-control" placeholder="كلمة المرور" required>
      @error('password') <div class="text-danger mb-2">{{ $message }}</div> @enderror
      <label for="password_confirmation">تأكيد كلمة المرور</label>
      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور" required>
      <div class="form-check mb-3">
        <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
        <label for="terms" class="form-check-label">أوافق على الشروط والأحكام</label>
        @error('terms') <div class="text-danger mb-2">{{ $message }}</div> @enderror
      </div>
      <button type="submit" class="btn btn-success w-100">إنشاء حساب</button>
      <div class="text-center mt-3">
        <span>لديك حساب بالفعل؟ <a href="{{ route('teacher.login') }}" class="register-link">تسجيل الدخول</a></span>
      </div>
    </form>
    <div class="social-separator mb-3 w-100">
      <span>أو يمكنك التسجيل بواسطة</span>
    </div>
    <!-- Social Register Buttons -->
    <div class="mb-3 w-100">
      <a href="#" class="btn-social-login btn-google w-100 mb-2">
        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/google/google-original.svg" alt="Google" class="icon-social"> التسجيل بواسطة Google
      </a>
      <a href="#" class="btn-social-login btn-facebook w-100 mb-2">
        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/facebook/facebook-original.svg" alt="Facebook" class="icon-social"> التسجيل بواسطة Facebook
      </a>
      <!-- يمكنك إضافة المزيد من مزودي الخدمة هنا -->
    </div>
  </div>
  <div class="teacher-register-right">
    <div class="teacher-register-right-content">
      <h1>انضم إلى Nextro كمدرس</h1>
      <p>سجّل الآن وابدأ بإدارة فصولك وطلابك وموادك بكل سهولة واحترافية.</p>
    </div>
  </div>
</div>
@endsection 