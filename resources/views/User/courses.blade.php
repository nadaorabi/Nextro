@extends('layouts.app')

@section('title', 'الدورات التعليمية')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/hero-courses.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12 text-center">
        <h1 class="mb-4 heading text-white" data-aos="fade-up">دوراتنا التعليمية</h1>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')

{{-- أزرار الفلترة --}}
<div class="container my-5">
  <div class="d-flex flex-wrap justify-content-center mb-4">
    <button class="filter-btn active" data-filter="all">الكل</button>
    <button class="filter-btn" data-filter="تاسع">تاسع</button>
    <button class="filter-btn" data-filter="بكالوريا">بكالوريا</button>
    <button class="filter-btn" data-filter="ثانوي">ثانوي</button>
    <button class="filter-btn" data-filter="لغات">لغات</button>
  </div>

  {{-- بطاقات الكورسات --}}
  <div class="row" id="courses-list">
    @foreach([
      ['title' => 'الرياضيات - تاسع', 'type' => 'تاسع', 'price' => '$30', 'image' => 'images/course1.jpg'],
      ['title' => 'الفيزياء - بكالوريا', 'type' => 'بكالوريا', 'price' => '$50', 'image' => 'images/course2.jpg'],
      ['title' => 'اللغة الإنجليزية - لغات', 'type' => 'لغات', 'price' => '$25', 'image' => 'images/course3.jpg'],
      ['title' => 'الكيمياء - ثانوي', 'type' => 'ثانوي', 'price' => '$40', 'image' => 'images/course4.jpg'],
      ['title' => 'العربية - تاسع', 'type' => 'تاسع', 'price' => '$20', 'image' => 'images/course5.jpg'],
    ] as $course)
    <div class="col-md-6 col-lg-4 mb-4 course-card" data-type="{{ $course['type'] }}">
      <div class="card shadow-sm h-100">
        <img src="{{ asset($course['image']) }}" class="card-img-top" alt="Course Image" style="height:200px;object-fit:cover;">
        <div class="card-body d-flex flex-column">
          <h5 class="card-title">{{ $course['title'] }}</h5>
          <p class="text-muted mb-2">النوع: {{ $course['type'] }}</p>
          <p class="text-primary fw-bold">{{ $course['price'] }}</p>
          <a href="#" class="btn btn-outline-primary mt-auto">تفاصيل</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection

{{-- ستايلات خاصة --}}
@push('styles')
<style>
  .filter-btn {
    border-radius: 30px;
    padding: 8px 20px;
    margin: 5px;
    border: 1px solid #0d6efd;
    background: white;
    color: #0d6efd;
    transition: 0.3s;
  }
  .filter-btn.active, .filter-btn:hover {
    background: #0d6efd;
    color: white;
  }
  .course-card {
    transition: all 0.3s ease-in-out;
  }
  .course-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
  }
</style>
@endpush


{{-- سكربتات خاصة --}}
@push('scripts')
<script>
  AOS.init();
  // malik
  const filterButtons = document.querySelectorAll('.filter-btn');
  const courseCards = document.querySelectorAll('.course-card');

  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      filterButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');

      const filter = button.getAttribute('data-filter');

      courseCards.forEach(card => {
        if (filter === 'all' || card.dataset.type === filter) {
          card.style.display = 'block';
          setTimeout(() => {
            card.style.opacity = 1;
          }, 10);
        } else {
          card.style.display = 'none';
          card.style.opacity = 0;
        }
      });
    });
  });
</script>
@endpush
