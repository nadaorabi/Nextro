@extends('layouts.app')

@section('title', 'الدورات التعليمية')

{{-- إزالة ربط ملف CSS الخارجي --}}
{{-- @section('styles')
<link rel="stylesheet" href="{{ asset('css/courses.css') }}">
@endsection --}}

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img_7.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12 text-center">
        <h1 class="mb-4 heading text-white" data-aos="fade-up">دوراتنا التعليمية</h1>
        <a href="#courses-container" class="btn btn-secondary btn-lg mt-3" data-aos="fade-up" data-aos-delay="200">استكشف الدورات</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
<div class="container py-5">

  <!-- مربع البحث -->
  <div class="row mb-5">
    <div class="col-md-6 mx-auto">
      <div class="search-box">
        <input type="text" id="course-search" class="form-control" placeholder="ابحث عن دورة...">
        <i class="uil uil-search search-icon"></i>
      </div>
    </div>
  </div>

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
          <img src="{{ asset('images/img_3.jpg') }}" class="card-img-top course-card-img" alt="دورة تاسع سوريا">
          <div class="course-badge">تاسع</div>
        </div>
        <div class="card-body course-card-body">
          <h5 class="card-title">دورة شهادة التعليم الأساسي (تاسع)</h5>
          <p class="card-text course-card-text">تحضير شامل لكافة مواد التاسع مع اختبارات دورية وأساليب حديثة بالتدريس.</p>
          <div class="course-meta">
            <span><i class="uil uil-clock"></i> 3 أشهر</span>
            <span><i class="uil uil-users-alt"></i> 25 طالب</span>
            <span><i class="uil uil-star"></i> 4.8</span>
          </div>
          <a href="#" class="btn btn-primary course-card-btn">عرض التفاصيل</a>
        </div>
      </div>
    </div>

    <!-- دورة 2: بكالوريا -->
    <div class="col-md-4 mb-4 course-item" data-category="bakaloria">
      <div class="card course-card shadow-sm">
        <div class="course-card-img-wrapper">
          <img src="{{ asset('images/img_3.jpg') }}" class="card-img-top course-card-img" alt="دورة بكالوريا سوريا">
          <div class="course-badge">بكالوريا</div>
        </div>
        <div class="card-body course-card-body">
          <h5 class="card-title">دورة الشهادة الثانوية العامة (بكالوريا)</h5>
          <p class="card-text course-card-text">مناهج علمي وأدبي مع أفضل الكوادر التعليمية، وتركيز على حل النماذج الوزارية.</p>
          <div class="course-meta">
            <span><i class="uil uil-clock"></i> 6 أشهر</span>
            <span><i class="uil uil-users-alt"></i> 40 طالب</span>
            <span><i class="uil uil-star"></i> 4.9</span>
          </div>
          <a href="#" class="btn btn-primary course-card-btn">عرض التفاصيل</a>
        </div>
      </div>
    </div>

    <!-- دورة 3: لغات -->
    <div class="col-md-4 mb-4 course-item" data-category="languages">
      <div class="card course-card shadow-sm">
        <div class="course-card-img-wrapper">
          <img src="{{ asset('images/img_3.jpg') }}" class="card-img-top course-card-img" alt="دورة لغات سوريا">
          <div class="course-badge">لغات</div>
        </div>
        <div class="card-body course-card-body">
          <h5 class="card-title">دورات لغات أجنبية</h5>
          <p class="card-text course-card-text">تعلم اللغة الإنكليزية والفرنسية بطريقة تفاعلية مع مدربين معتمدين.</p>
          <div class="course-meta">
            <span><i class="uil uil-clock"></i> 4 أشهر</span>
            <span><i class="uil uil-users-alt"></i> 30 طالب</span>
            <span><i class="uil uil-star"></i> 4.7</span>
          </div>
          <a href="#" class="btn btn-primary course-card-btn">عرض التفاصيل</a>
        </div>
      </div>
    </div>

    <!-- دورة 4: تطوير -->
    <div class="col-md-4 mb-4 course-item" data-category="development">
      <div class="card course-card shadow-sm">
        <div class="course-card-img-wrapper">
          <img src="{{ asset('images/img_3.jpg') }}" class="card-img-top course-card-img" alt="دورة تطوير مهارات">
          <div class="course-badge">تطوير</div>
        </div>
        <div class="card-body course-card-body">
          <h5 class="card-title">دورات تطوير المهارات</h5>
          <p class="card-text course-card-text">برمجة، إدارة، تفكير إبداعي، ومهارات عملية ترفع من كفاءتك في سوق العمل.</p>
          <div class="course-meta">
            <span><i class="uil uil-clock"></i> 3 أشهر</span>
            <span><i class="uil uil-users-alt"></i> 20 طالب</span>
            <span><i class="uil uil-star"></i> 4.6</span>
          </div>
          <a href="#" class="btn btn-primary course-card-btn">عرض التفاصيل</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ستايل خاص بالصفحة -->
<style>
/* مربع البحث */
.search-box {
  position: relative;
  margin-bottom: 30px;
}

.search-box input {
  padding-right: 40px;
  border-radius: 50px;
  border: 2px solid #e9ecef;
  height: 50px;
  transition: all 0.3s ease;
}

.search-box input:focus {
  border-color: #0d6efd;
  box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

.search-icon {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #6c757d;
}

/* أزرار الفلترة */
.filter-buttons {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 10px;
  margin-bottom: 30px;
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
.course-item {
  margin-bottom: 30px;
}

.course-card {
  height: 100%;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: none;
  border-radius: 15px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
}

.course-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.course-card-img-wrapper {
  height: 180px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #f8f9fa;
  position: relative;
  overflow: hidden;
}

.course-card-img {
  max-width: 100%;
  max-height: 100%;
  object-fit: contain;
}

.course-card:hover .course-card-img {
  transform: scale(1.05);
}

.course-badge {
  position: absolute;
  top: 15px;
  right: 15px;
  background: #0d6efd;
  color: white;
  padding: 5px 15px;
  border-radius: 50px;
  font-size: 0.8rem;
}

.course-card-body {
  padding: 20px;
  display: flex;
  flex-direction: column;
  flex: 1 1 auto;
}

.card-title, .course-card-title {
  font-size: 1.1rem;
  font-weight: bold;
  margin-bottom: 8px;
  color: #222;
  word-break: break-word;
}

.course-card-text {
  color: #6c757d;
  margin-bottom: 15px;
  flex-grow: 1;
}

.course-meta {
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;
  color: #6c757d;
  font-size: 0.9rem;
}

.course-meta span {
  display: flex;
  align-items: center;
  gap: 5px;
}

.course-card-btn {
  width: 100%;
  border-radius: 50px;
  padding: 10px;
  font-weight: 500;
  transition: all 0.3s ease;
}

.course-card-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
}
</style>

<!-- جافاسكريبت للفلترة والبحث -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('.filter-button');
    const items = document.querySelectorAll('.course-item');
    const searchInput = document.getElementById('course-search');

    // فلترة حسب الفئة
    buttons.forEach(button => {
      button.addEventListener('click', function () {
        const filter = this.getAttribute('data-filter');
        filterCourses(filter);
        
        // تغيير الزر النشط
        buttons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
      });
    });

    // البحث
    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      filterCourses('all', searchTerm);
    });

    function filterCourses(category, searchTerm = '') {
      items.forEach(item => {
        const itemCategory = item.getAttribute('data-category');
        const title = item.querySelector('.card-title').textContent.toLowerCase();
        const description = item.querySelector('.card-text').textContent.toLowerCase();
        
        const matchesCategory = category === 'all' || itemCategory === category;
        const matchesSearch = !searchTerm || 
                            title.includes(searchTerm) || 
                            description.includes(searchTerm);
        
        if (matchesCategory && matchesSearch) {
          item.style.display = 'block';
        } else {
          item.style.display = 'none';
        }
      });
    }
  });
</script>
@endsection
