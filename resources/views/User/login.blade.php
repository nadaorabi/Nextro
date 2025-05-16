@extends('layouts.app')

@section('title', 'تسجيل الدخول')

@section('hero')
<div class="untree_co-hero inner-page overlay" style="background-image: url('{{ asset('images/img-school-5-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">تسجيل الدخول</h1>
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
        <form action="{{ route('login.post') }}" method="POST" class="p-4 border rounded shadow-sm bg-white">
          @csrf
          <div class="row">
            {{-- البريد الإلكتروني --}}
            <div class="col-12 mb-3">
              <label for="email" class="form-label">البريد الإلكتروني</label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
              @error('email')
                <div class="text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>

            {{-- كلمة المرور --}}
            <div class="col-12 mb-3">
              <label for="password" class="form-label">كلمة المرور</label>
              <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
              @error('password')
                <div class="text-danger mt-1">{{ $message }}</div>
              @enderror
            </div>

            {{-- تذكرني --}}
            <div class="col-12 mb-3 form-check">
              <input type="checkbox" id="remember" name="remember" class="form-check-input">
              <label for="remember" class="form-check-label">تذكرني</label>
            </div>

            {{-- زر تسجيل الدخول --}}
            <div class="col-12 text-center">
              <button type="submit" class="btn btn-primary w-100">تسجيل الدخول</button>
            </div>
          </div>
        </form>

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

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success mt-3">
          {{ session('success') }}
        </div>
        @endif

      </div>
    </div>
  </div>
</div>

@endsection
