@extends('layouts.app')

@section('title', 'التسجيل')

@section('hero')
<div class="untree_co-hero inner-page overlay" style="background-image: url('{{ asset('images/img-school-5-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">التسجيل</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')

<div class="untree_co-section">
  <div class="container">
    <div class="row mb-5 justify-content-center">
      <div class="col-lg-5 mx-auto order-1" data-aos="fade-up" data-aos-delay="200">
        {{-- Form --}}
        <form action="{{ route('register.post') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
          @csrf
          <div class="row">
            {{-- Full Name --}}
            <div class="col-12 mb-3">
              <input type="text" id="name" name="name" class="form-control" placeholder="الاسم الكامل" required value="{{ old('name') }}">
              @error('name') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Email --}}
            <div class="col-12 mb-3">
              <input type="email" id="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required value="{{ old('email') }}">
              @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Password --}}
            <div class="col-12 mb-3">
              <input type="password" id="password" name="password" class="form-control" placeholder="كلمة المرور" required>
              @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="col-12 mb-3">
              <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="تأكيد كلمة المرور" required>
            </div>

            {{-- حقل الدور (role) --}}
            <div class="col-12 mb-3">
              <input type="hidden" name="role" value="student">
            </div>

            {{-- Terms and Conditions --}}
            <div class="col-12 mb-3 form-check">
              <input type="checkbox" id="terms" name="terms" class="form-check-input" required>
              <label for="terms" class="form-check-label">أوافق على الشروط والأحكام</label>
              @error('terms') <div class="text-danger mt-1">{{ $message }}</div> @enderror
            </div>

            {{-- Submit Button --}}
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary w-100">إنشاء حساب</button>
            </div>
          </div>
        </form>

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success mt-3">
          {{ session('success') }}
        </div>
        @endif

        {{-- Errors --}}
        @if($errors->any())
        <div class="alert alert-danger mt-3">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

      </div>
    </div>
  </div>
</div>

@endsection
