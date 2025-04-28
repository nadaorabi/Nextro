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
<div class="container py-5">

  <!-- فلترة الكورسات -->
  <div class="text-center mb-4">
    <button class="btn btn-primary filter-button" data-filter="all">الكل</button>
    <button class="btn btn-outline-primary filter-button" data-filter="design">تصميم</button>
    <button class="btn btn-outline-primary filter-button" data-filter="programming">برمجة</button>
    <button class="btn btn-outline-primary filter-button" data-filter="marketing">تسويق</button>
  </div>

  <!-- عرض الكورسات -->
  <div class="row" id="courses-container">
    <!-- كورس 1 -->
    <div class="col-md-4 mb-4 course-item" data-category="design">
      <div class="card h-100">
        <img src="{{ asset('images/course1.jpg') }}" class="card-img-top" alt="تصميم جرافيكي">
        <div class="card-body">
          <h5 class="card-title">دورة التصميم الجرافيكي</h5>
          <p class="card-text">تعلم أساسيات التصميم باستخدام أدوات احترافية.</p>
          <a href="#" class="btn btn-primary">عرض الدورة</a>
        </div>
      </div>
    </div>

    <!-- كورس 2 -->
    <div class="col-md-4 mb-4 course-item" data-category="programming">
      <div class="card h-100">
        <img src="{{ asset('images/course2.jpg') }}" class="card-img-top" alt="برمجة الويب">
        <div class="card-body">
          <h5 class="card-title">دورة برمجة الويب</h5>
          <p class="card-text">تعلم تطوير مواقع الويب باستخدام HTML, CSS, JavaScript.</p>
          <a href="#" class="btn btn-primary">عرض الدورة</a>
        </div>
      </div>
    </div>

    <!-- كورس 3 -->
    <div class="col-md-4 mb-4 course-item" data-category="marketing">
      <div class="card h-100">
        <img src="{{ asset('images/course3.jpg') }}" class="card-img-top" alt="التسويق الرقمي">
        <div class="card-body">
          <h5 class="card-title">دورة التسويق الرقمي</h5>
          <p class="card-text">استراتيجيات التسويق عبر الإنترنت لزيادة المبيعات.</p>
          <a href="#" class="btn btn-primary">عرض الدورة</a>
        </div>
      </div>
    </div>

    <!-- يمكنك إضافة المزيد من الكورسات بنفس الطريقة -->
  </div>

</div>

<!-- كود جافاسكريبت للفلترة -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.filter-button');
    const items = document.querySelectorAll('.course-item');

    buttons.forEach(button => {
      button.addEventListener('click', function () {
        const filter = this.getAttribute('data-filter');

        items.forEach(item => {
          if (filter === 'all' || item.getAttribute('data-category') === filter) {
            item.style.display = 'block';
          } else {
            item.style.display = 'none';
          }
        });

        // تغيير لون الزر النشط
        buttons.forEach(btn => btn.classList.remove('btn-primary'));
        buttons.forEach(btn => btn.classList.add('btn-outline-primary'));
        this.classList.add('btn-primary');
        this.classList.remove('btn-outline-primary');
      });
    });
  });
</script>


@endsection
