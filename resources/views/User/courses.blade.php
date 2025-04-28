@extends('layouts.app')

@section('title', 'الدورات التعليمية')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img_7.jpg') }}');">
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
  <div class="text-center mb-4 filter-buttons">
    <button class="btn filter-button active" data-filter="all">الكل</button>
    <button class="btn filter-button" data-filter="tasea">تاسع</button>
    <button class="btn filter-button" data-filter="bakaloria">بكالوريا</button>
    <button class="btn filter-button" data-filter="languages">لغات</button>
    <button class="btn filter-button" data-filter="development">تطوير</button>
  </div>

  <!-- عرض الكورسات -->
  <div class="row" id="courses-container">

   
    <!-- دورة 1: تاسع -->
    <div class="col-md-4 mb-4 course-item" data-category="tasea">
      <div class="card course-card shadow-sm">
        <div class="course-card-img-wrapper">
          <img src="{{ asset('images/tasea.jpg') }}" class="card-img-top course-card-img" alt="دورة تاسع سوريا">
        </div>
        <div class="card-body course-card-body">
          <h5 class="card-title">دورة شهادة التعليم الأساسي (تاسع)</h5>
          <p class="card-text course-card-text">تحضير شامل لكافة مواد التاسع مع اختبارات دورية وأساليب حديثة بالتدريس.</p>
          <a href="#" class="btn btn-primary course-card-btn">عرض التفاصيل</a>
        </div>
      </div>
    </div>

    <!-- دورة 2: بكالوريا -->
    <div class="col-md-4 mb-4 course-item" data-category="bakaloria">
      <div class="card course-card shadow-sm">
        <div class="course-card-img-wrapper">
          <img src="{{ asset('images/bakaloria.jpg') }}" class="card-img-top course-card-img" alt="دورة بكالوريا سوريا">
        </div>
        <div class="card-body course-card-body">
          <h5 class="card-title">دورة الشهادة الثانوية العامة (بكالوريا)</h5>
          <p class="card-text course-card-text">مناهج علمي وأدبي مع أفضل الكوادر التعليمية، وتركيز على حل النماذج الوزارية.</p>
          <a href="#" class="btn btn-primary course-card-btn">عرض التفاصيل</a>
        </div>
      </div>
    </div>

    <!-- دورة 3: لغات -->
    <div class="col-md-4 mb-4 course-item" data-category="languages">
      <div class="card course-card shadow-sm">
        <div class="course-card-img-wrapper">
          <img src="{{ asset('images/languages.jpg') }}" class="card-img-top course-card-img" alt="دورة لغات سوريا">
        </div>
        <div class="card-body course-card-body">
          <h5 class="card-title">دورات لغات أجنبية</h5>
          <p class="card-text course-card-text">تعلم اللغة الإنكليزية والفرنسية بطريقة تفاعلية مع مدربين معتمدين.</p>
          <a href="#" class="btn btn-primary course-card-btn">عرض التفاصيل</a>
        </div>
      </div>
    </div>

    <!-- دورة 4: تطوير -->
    <div class="col-md-4 mb-4 course-item" data-category="development">
      <div class="card course-card shadow-sm">
        <div class="course-card-img-wrapper">
          <img src="{{ asset('images/development.jpg') }}" class="card-img-top course-card-img" alt="دورة تطوير مهارات">
        </div>
        <div class="card-body course-card-body">
          <h5 class="card-title">دورات تطوير المهارات</h5>
          <p class="card-text course-card-text">برمجة، إدارة، تفكير إبداعي، ومهارات عملية ترفع من كفاءتك في سوق العمل.</p>
          <a href="#" class="btn btn-primary course-card-btn">عرض التفاصيل</a>
        </div>
      </div>
    </div>

  </div>

  </div>

</div>

<!-- ستايل جديد مطور -->
<style>
  /* أزرار الفلترة */
  .filter-buttons {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 10px;
  }

  .filter-button {
    border-radius: 50px;
    padding: 10px 20px;
    border: 2px solid #0d6efd;
    background: transparent;
    color: #0d6efd;
    font-weight: 500;
    transition: all 0.3s ease;
  }

  .filter-button:hover {
    background-color: #0d6efd;
    color: white;
  }

  .filter-button.active {
    background-color: #0d6efd;
    color: white;
  }

  /* كارد الكورسات */
  .course-card {
    height: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .course-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
  }

  .course-card-img-wrapper {
    height: 250px;
    overflow: hidden;
  }

  .course-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }

  .course-card:hover .course-card-img {
    transform: scale(1.05);
  }

  .course-card-body {
    display: flex;
    flex-direction: column;
  }

  .course-card-text {
    flex-grow: 1;
  }

  .course-card-btn {
    margin-top: auto;
  }
</style>

<!-- جافاسكريبت للفلترة مع تأثير زر نشط -->
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

        // تغيير الزر النشط
        buttons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
      });
    });
  });
</script>
@endsection
