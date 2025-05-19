<div class="tab-pane" id="course-registration">
  <h6 class="mb-4">Registered Courses</h6>

  <!-- Filter Buttons -->
 <div class="mb-3 text-center">
  <div class="d-flex flex-row justify-content-center gap-2 flex-wrap">
    <button class="btn btn-outline-primary filter-btn active" data-filter="all">All</button>
    <button class="btn btn-outline-primary filter-btn" data-filter="Skills">Skills</button>
    <button class="btn btn-outline-primary filter-btn" data-filter="Academics">Academics</button>
    <button class="btn btn-outline-primary filter-btn" data-filter="Bachelor">Bachelor</button>
  </div>
</div>

<style>
  @media (max-width: 576px) {
    .filter-btn {
      font-size: 12px;
      padding: 4px 6px;
    }
  }
</style>


  <!-- Search Box -->
  <div class="form-group mb-4">
    <input type="text" class="form-control" id="courseSearch" placeholder="Search courses...">
  </div>

  <div class="row" id="courseList">

    <!-- Course Card 1 -->
    <div class="col-md-4 col-sm-6 mb-4 course-card" data-category="Skills">
      <div class="card shadow-sm border-0" style="font-size: 14px;">
        <div class="position-relative">
          <img src="{{ asset('images/img_3.jpg') }}" class="card-img-top" alt="Course Image" style="height: 150px; object-fit: cover;">
          <span class="badge badge-primary position-absolute" style="top: 10px; left: 10px;">Skills</span>
        </div>
        <div class="card-body p-3">
          <h6 class="card-title mb-1 font-weight-bold">Skill Development Courses</h6>
          <p class="card-text text-muted small mb-2">
            Programming, management, creative thinking, and hands-on skills to boost your career opportunities.
          </p>
          <div class="d-flex justify-content-between text-muted small mb-3">
            <span><i class="fas fa-users"></i> 25 Students</span>
            <span><i class="fas fa-clock"></i> 3 Months</span>
            <span><i class="fas fa-star"></i> 4.8</span>
          </div>
          <a href="#" class="btn btn-primary btn-sm btn-block">View Details</a>
        </div>
      </div>
    </div>

    <!-- Course Card 2 -->
    <div class="col-md-4 col-sm-6 mb-4 course-card" data-category="Academics">
      <div class="card shadow-sm border-0" style="font-size: 14px;">
        <div class="position-relative">
          <img src="{{ asset('images/img_4.jpg') }}" class="card-img-top" alt="Course Image" style="height: 150px; object-fit: cover;">
          <span class="badge badge-primary position-absolute" style="top: 10px; left: 10px;">Academics</span>
        </div>
        <div class="card-body p-3">
          <h6 class="card-title mb-1 font-weight-bold">Basic Education Certificate (Grade 9)</h6>
          <p class="card-text text-muted small mb-2">
            Comprehensive preparation for 9th grade with assessments and modern teaching strategies.
          </p>
          <div class="d-flex justify-content-between text-muted small mb-3">
            <span><i class="fas fa-users"></i> 30 Students</span>
            <span><i class="fas fa-clock"></i> 4 Months</span>
            <span><i class="fas fa-star"></i> 4.7</span>
          </div>
          <a href="#" class="btn btn-primary btn-sm btn-block">View Details</a>
        </div>
      </div>
    </div>

    <!-- Course Card 3 -->
    <div class="col-md-4 col-sm-6 mb-4 course-card" data-category="Bachelor">
      <div class="card shadow-sm border-0" style="font-size: 14px;">
        <div class="position-relative">
          <img src="{{ asset('images/img_5.jpg') }}" class="card-img-top" alt="Course Image" style="height: 150px; object-fit: cover;">
          <span class="badge badge-primary position-absolute" style="top: 10px; left: 10px;">Bachelor</span>
        </div>
        <div class="card-body p-3">
          <h6 class="card-title mb-1 font-weight-bold">General Secondary (Bachelor) Preparation</h6>
          <p class="card-text text-muted small mb-2">
            Focused training and exam readiness for high school students aiming for university admission.
          </p>
          <div class="d-flex justify-content-between text-muted small mb-3">
            <span><i class="fas fa-users"></i> 20 Students</span>
            <span><i class="fas fa-clock"></i> 6 Months</span>
            <span><i class="fas fa-star"></i> 4.9</span>
          </div>
          <a href="#" class="btn btn-primary btn-sm btn-block">View Details</a>
        </div>
      </div>
    </div>

  </div>
</div>

<!-- JavaScript for filter and search -->
<script>
  window.addEventListener("DOMContentLoaded", function () {
    // عناصر الفلترة
    const filterButtons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.course-card');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        // إزالة active من جميع الأزرار
        filterButtons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const filter = button.getAttribute('data-filter');

        cards.forEach(card => {
          const category = card.getAttribute('data-category');
          card.style.display = (filter === 'all' || category === filter) ? 'block' : 'none';
        });
      });
    });

    // البحث
    document.getElementById('courseSearch').addEventListener('input', function () {
      const keyword = this.value.toLowerCase();
      cards.forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(keyword) ? 'block' : 'none';
      });
    });
  });
</script>

