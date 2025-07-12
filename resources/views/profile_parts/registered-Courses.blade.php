<div class="tab-pane" id="course-registration">
  <h6 class="mb-4">Registered Courses</h6>

  <!-- Filter Buttons -->
 <div class="mb-3 text-center">
  <div class="d-flex flex-row justify-content-center gap-2 flex-wrap">
    <button class="btn btn-outline-primary filter-btn active" data-filter="all">All</button>
    <button class="btn btn-outline-primary filter-btn" data-filter="course">Courses</button>
    <button class="btn btn-outline-primary filter-btn" data-filter="package">Packages</button>
  </div>
</div>

<style>
  .course-card .card {
    border-radius: 18px;
    box-shadow: 0 2px 12px rgba(59,130,246,0.09);
    transition: box-shadow 0.2s;
    min-height: 420px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .course-card .card:hover {
    box-shadow: 0 6px 24px rgba(59,130,246,0.18);
  }
  .course-card .card-img-top {
    border-top-left-radius: 18px;
    border-top-right-radius: 18px;
    height: 160px;
    object-fit: cover;
  }
  .course-card .badge {
    font-size: 0.85rem;
    padding: 0.35em 0.7em;
    border-radius: 8px;
  }
  .course-card .card-title {
    font-size: 1.1rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
    text-align: center;
  }
  .course-card .card-body {
    padding-bottom: 1.2rem;
  }
  .course-card .btn {
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
  }
  .course-card .info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 0.95rem;
    margin-bottom: 0.5rem;
  }
  .course-card .info-row span {
    display: flex;
    align-items: center;
    gap: 3px;
  }
  @media (max-width: 576px) {
    .filter-btn {
      font-size: 12px;
      padding: 4px 6px;
    }
    .course-card .card {
      min-height: 370px;
    }
    .course-card .card-img-top {
      height: 110px;
    }
  }
</style>

  <!-- Search Box -->
  <div class="form-group mb-4">
    <input type="text" class="form-control" id="courseSearch" placeholder="Search courses...">
  </div>

  <div class="row" id="courseList">

    <!-- Individual Courses -->
    @forelse($enrollments ?? [] as $enrollment)
      @if($enrollment->course)
        <div class="col-md-4 col-sm-6 mb-4 course-card" data-category="course" data-type="course">
          <div class="card shadow-sm border-0">
            <div class="position-relative">
              @php
                $courseImage = $enrollment->course->image ?? ($enrollment->course->category->image ?? 'images/img_3.jpg');
              @endphp
              <img src="{{ asset($courseImage) }}" class="card-img-top" alt="Course Image" onerror="this.src='{{ asset('images/img_3.jpg') }}'">
              <span class="badge bg-primary position-absolute" style="top: 10px; left: 10px;">Course</span>
              @if($enrollment->status)
                <span class="badge bg-success position-absolute" style="top: 10px; right: 10px;">
                  {{ ucfirst($enrollment->status) }}
                </span>
              @endif
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
              <h6 class="card-title">{{ $enrollment->course->title }}</h6>
              <p class="card-text text-muted small mb-2" style="min-height: 38px;">
                {{ $enrollment->course->description ?? 'No description available' }}
              </p>
              <div class="info-row mb-2">
                <span><i class="fas fa-tag text-secondary"></i> {{ $enrollment->course->category->name ?? 'No Category' }}</span>
                <span><i class="fas fa-calendar text-secondary"></i> {{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('M d, Y') }}</span>
              </div>
              <div class="info-row mb-3">
                <span><i class="fas fa-user text-secondary"></i> {{ $enrollment->course->courseInstructors->first()->instructor->name ?? 'No Instructor' }}</span>
                <span class="text-primary font-weight-bold">
                  @if($enrollment->course->is_free)
                    Free
                  @else
                    ${{ number_format($enrollment->course->final_price, 2) }}
                  @endif
                </span>
              </div>
              <a href="#" class="btn btn-primary btn-block mt-auto">VIEW DETAILS</a>
            </div>
          </div>
        </div>
      @endif
    @empty
      <!-- No courses message will be shown at the end -->
    @endforelse

    <!-- Packages -->
    @forelse($studentPackages ?? [] as $studentPackage)
      @if($studentPackage->package)
        <div class="col-md-4 col-sm-6 mb-4 course-card" data-category="package" data-type="package">
          <div class="card shadow-sm border-0">
            <div class="position-relative">
              @php
                $packageImage = $studentPackage->package->image ?? ($studentPackage->package->category->image ?? 'images/img_4.jpg');
              @endphp
              <img src="{{ asset($packageImage) }}" class="card-img-top" alt="Package Image" onerror="this.src='{{ asset('images/img_4.jpg') }}'">
              <span class="badge bg-success position-absolute" style="top: 10px; left: 10px;">Package</span>
              <span class="badge bg-info position-absolute" style="top: 10px; right: 10px;">
                {{ $studentPackage->package->packageCourses->count() }} Courses
              </span>
            </div>
            <div class="card-body d-flex flex-column justify-content-between">
              <h6 class="card-title">{{ $studentPackage->package->name }}</h6>
              <p class="card-text text-muted small mb-2" style="min-height: 38px;">
                {{ $studentPackage->package->description ?? 'Package containing multiple courses' }}
              </p>
              <div class="info-row mb-2">
                <span><i class="fas fa-tag text-secondary"></i> {{ $studentPackage->package->category->name ?? 'No Category' }}</span>
                <span><i class="fas fa-calendar text-secondary"></i> {{ \Carbon\Carbon::parse($studentPackage->purchase_date)->format('M d, Y') }}</span>
              </div>
              <div class="mb-2">
                <small class="text-muted">Courses in this package:</small>
                <div class="mt-1">
                  @foreach($studentPackage->package->packageCourses->take(3) as $packageCourse)
                    <span class="badge bg-light text-dark mr-1">{{ $packageCourse->course->title ?? 'Unknown Course' }}</span>
                  @endforeach
                  @if($studentPackage->package->packageCourses->count() > 3)
                    <span class="badge bg-secondary">+{{ $studentPackage->package->packageCourses->count() - 3 }} more</span>
                  @endif
                </div>
              </div>
              <div class="info-row mb-3">
                <span class="text-primary font-weight-bold">
                  ${{ number_format($studentPackage->amount_paid, 2) }}
                </span>
                <a href="#" class="btn btn-success btn-sm">View Package Details</a>
              </div>
            </div>
          </div>
        </div>
      @endif
    @empty
      <!-- No packages message will be shown at the end -->
    @endforelse

    @if(($enrollments ?? collect())->count() == 0 && ($studentPackages ?? collect())->count() == 0)
      <div class="col-12 text-center">
        <div class="card shadow-sm border-0">
          <div class="card-body p-5">
            <i class="fas fa-graduation-cap text-muted" style="font-size: 3rem;"></i>
            <h5 class="mt-3 text-muted">No Courses Registered</h5>
            <p class="text-muted">You haven't registered for any courses yet.</p>
            <a href="#" class="btn btn-primary">Browse Available Courses</a>
          </div>
        </div>
      </div>
    @endif

  </div>
</div>

<!-- JavaScript for filter and search -->
<script>
  window.addEventListener("DOMContentLoaded", function () {
    // Filter elements
    const filterButtons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.course-card');
    const searchInput = document.getElementById('courseSearch');

    // Filter functionality
    filterButtons.forEach(button => {
      button.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');
        
        // Update active button
        filterButtons.forEach(btn => btn.classList.remove('active'));
        this.classList.add('active');
        
        // Filter cards
        cards.forEach(card => {
          if (filter === 'all' || card.getAttribute('data-category') === filter) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });

    // Search functionality
    searchInput.addEventListener('input', function() {
      const searchTerm = this.value.toLowerCase();
      
      cards.forEach(card => {
        const title = card.querySelector('.card-title').textContent.toLowerCase();
        const description = card.querySelector('.card-text').textContent.toLowerCase();
        
        if (title.includes(searchTerm) || description.includes(searchTerm)) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
</script>

