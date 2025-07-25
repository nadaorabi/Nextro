@extends('layouts.app')

@section('title', 'Courses & Programs')

@push('styles')
<style>
  .category-card {
    transition: all 0.3s ease;
    border-radius: 10px;
    border: 1px solid #e9ecef;
  }
  
  .category-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  }
  
  .card-body {
    padding: 20px;
  }
  
  .category-icon {
    margin-bottom: 15px;
  }
  
  .icon-circle {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 15px;
  }
  
  .icon-circle i {
    font-size: 1.2rem;
    color: white;
  }
  
  .card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #333;
  }
  
  .card-text {
    font-size: 0.9rem;
    color: #6c757d;
    margin-bottom: 15px;
  }
  
  .category-stats .badge {
    font-size: 0.8rem;
    padding: 0.5rem 1rem;
  }
</style>
@endpush

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-3-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Explore Our Courses & Programs</h1>
            <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
              <p>Discover our comprehensive range of educational courses and programs designed to enhance your skills and knowledge.</p>
            </div>
            <p class="mb-0" data-aos="fade-up" data-aos-delay="300">
              <a href="#courses-section" class="btn btn-secondary">Browse Courses</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')

{{-- Search and Filter Section --}}
<div class="untree_co-section bg-light" id="courses-section">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center" data-aos="fade-up">
        <h2 class="line-bottom text-center mb-4">Find Your Perfect Course</h2>
        <p>Browse through our extensive collection of courses and educational packages</p>
      </div>
    </div>

    {{-- Search and Filter Form --}}
    <div class="row justify-content-center mb-5">
      <div class="col-lg-10">
        <form action="{{ route('courses_page') }}" method="GET" class="bg-white p-4 rounded shadow-sm">
          <div class="row">
            <div class="col-md-4 mb-3">
              <input type="text" name="search" class="form-control" placeholder="Search courses..." value="{{ $searchTerm ?? '' }}">
            </div>
            <div class="col-md-3 mb-3">
              <select name="category" class="form-control">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                  <option value="{{ $category->id }}" {{ ($selectedCategory ?? '') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 mb-3">
              <select name="type" class="form-control">
                <option value="">All Types</option>
                <option value="courses" {{ request('type') == 'courses' ? 'selected' : '' }}>Individual Courses</option>
                <option value="packages" {{ request('type') == 'packages' ? 'selected' : '' }}>Educational Packages</option>
              </select>
            </div>
            <div class="col-md-2 mb-3">
              <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- Categories Overview --}}
    <div class="row mb-5">
      <div class="col-12">
        <h3 class="text-center mb-4">Browse by Category</h3>
        <div class="row">
          @foreach($categories as $category)
                      <div class="col-lg-3 col-md-4 col-sm-6 mb-3" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <a href="{{ route('courses_page', ['category' => $category->id]) }}" class="text-decoration-none">
              <div class="card h-100 category-card">
                <div class="card-body text-center">
                  <div class="category-icon">
                    @php
                      $categoryIcons = [
                        '9th Grade Scientific' => 'fas fa-flask',
                        'Secondary Literary' => 'fas fa-book-open',
                        'Business Administration' => 'fas fa-briefcase',
                        'Programming' => 'fas fa-code',
                        'Chess' => 'fas fa-chess',
                        'Conversation' => 'fas fa-comments',
                        'Languages' => 'fas fa-language',
                      ];
                      $iconClass = $categoryIcons[$category->name] ?? 'fas fa-graduation-cap';
                    @endphp
                    <div class="icon-circle">
                      <i class="{{ $iconClass }}"></i>
                    </div>
                  </div>
                  <h5 class="card-title">{{ $category->name }}</h5>
                  <p class="card-text text-muted">{{ $category->description ?? 'Explore courses in this category' }}</p>
                  <div class="category-stats">
                    <span class="badge bg-primary rounded-pill">{{ $courses->where('category_id', $category->id)->count() }} courses</span>
                  </div>
                </div>
              </div>
            </a>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Individual Courses Section --}}
<div class="untree_co-section">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center" data-aos="fade-up">
        <h2 class="line-bottom text-center mb-4">Individual Courses</h2>
        <p>Choose from our wide range of specialized courses designed to meet your educational needs</p>
      </div>
    </div>

    <div class="row">
      @forelse($courses as $course)
      <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
        <div class="card h-100 course-card shadow-sm">
          <img src="{{ asset('images/img-school-' . ($loop->index % 6 + 1) . '-min.jpg') }}" class="card-img-top" alt="{{ $course->title }}">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <span class="badge bg-primary">{{ $course->category->name ?? 'General' }}</span>
              <span class="badge bg-success">{{ $course->status }}</span>
            </div>
            <h5 class="card-title">{{ $course->title }}</h5>
            <p class="card-text">{{ Str::limit($course->description, 100) }}</p>
            
            <div class="course-details mb-3">
              <div class="row text-center">
                <div class="col-4">
                  <small class="text-muted">Duration</small>
                  <p class="mb-0"><strong>{{ $course->duration ?? 'N/A' }}</strong></p>
                </div>
                <div class="col-4">
                  <small class="text-muted">Level</small>
                  <p class="mb-0"><strong>{{ $course->level ?? 'All Levels' }}</strong></p>
                </div>
                <div class="col-4">
                  <small class="text-muted">Students</small>
                  <p class="mb-0"><strong>{{ $course->enrollments_count ?? 0 }}</strong></p>
                </div>
              </div>
            </div>

            <div class="instructor-info mb-3">
              <small class="text-muted">Instructor:</small>
              <p class="mb-0">
                @if($course->courseInstructors->count() > 0)
                  {{ $course->courseInstructors->first()->instructor->name ?? 'TBA' }}
                @else
                  To be announced
                @endif
              </p>
            </div>

            <div class="price-section mb-3">
              @if($course->discount_percentage > 0)
                <div class="d-flex justify-content-between align-items-center">
                  <span class="text-muted text-decoration-line-through">${{ number_format($course->price, 2) }}</span>
                  <span class="text-danger fw-bold">${{ number_format($course->final_price, 2) }}</span>
                </div>
                <small class="text-success">{{ $course->discount_percentage }}% OFF</small>
              @else
                <div class="text-end">
                  <span class="fw-bold fs-5">${{ number_format($course->final_price, 2) }}</span>
                </div>
              @endif
            </div>

            <div class="d-grid gap-2">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#courseModal{{ $course->id }}">
                View Details
              </button>
              <a href="{{ route('courses_page') }}?course={{ $course->id }}" class="btn btn-outline-secondary">
                Learn More
              </a>
            </div>
          </div>
        </div>
      </div>

      {{-- Course Detail Modal --}}
      <div class="modal fade" id="courseModal{{ $course->id }}" tabindex="-1" aria-labelledby="courseModalLabel{{ $course->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="courseModalLabel{{ $course->id }}">{{ $course->title }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <img src="{{ asset('images/img-school-' . ($loop->index % 6 + 1) . '-min.jpg') }}" class="img-fluid rounded" alt="{{ $course->title }}">
                </div>
                <div class="col-md-6">
                  <h6>Course Details</h6>
                  <ul class="list-unstyled">
                    <li><strong>Category:</strong> {{ $course->category->name ?? 'General' }}</li>
                    <li><strong>Duration:</strong> {{ $course->duration ?? 'N/A' }}</li>
                    <li><strong>Level:</strong> {{ $course->level ?? 'All Levels' }}</li>
                    <li><strong>Status:</strong> {{ $course->status }}</li>
                    <li><strong>Price:</strong> ${{ number_format($course->final_price, 2) }}</li>
                    @if($course->discount_percentage > 0)
                      <li><strong>Discount:</strong> {{ $course->discount_percentage }}%</li>
                    @endif
                  </ul>
                  
                  <h6>Instructor</h6>
                  <p>
                    @if($course->courseInstructors->count() > 0)
                      {{ $course->courseInstructors->first()->instructor->name ?? 'TBA' }}
                    @else
                      To be announced
                    @endif
                  </p>
                </div>
              </div>
              
              <div class="mt-4">
                <h6>Course Description</h6>
                <p>{{ $course->description }}</p>
              </div>

              @if($course->schedules->count() > 0)
              <div class="mt-4">
                <h6>Schedule</h6>
                <div class="table-responsive">
                  <table class="table table-sm">
                    <thead>
                      <tr>
                        <th>Day</th>
                        <th>Time</th>
                        <th>Room</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($course->schedules as $schedule)
                      <tr>
                        <td>{{ $schedule->day_of_week }}</td>
                        <td>{{ $schedule->start_time }} - {{ $schedule->end_time }}</td>
                        <td>{{ $schedule->room->name ?? 'TBA' }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
              @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <a href="{{ route('courses_page') }}?course={{ $course->id }}" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center">
        <div class="alert alert-info">
          <h4>No courses found</h4>
          <p>Try adjusting your search criteria or browse all categories.</p>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</div>

{{-- Educational Packages Section --}}
<div class="untree_co-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-8 text-center" data-aos="fade-up">
        <h2 class="line-bottom text-center mb-4">Educational Packages</h2>
        <p>Comprehensive learning packages that combine multiple courses for a complete educational experience</p>
      </div>
    </div>

    <div class="row">
      @forelse($packages as $package)
      <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
        <div class="card h-100 package-card shadow-sm">
          <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0">{{ $package->name }}</h5>
            <small>{{ $package->category->name ?? 'General Package' }}</small>
          </div>
          <div class="card-body">
            <p class="card-text">{{ Str::limit($package->description, 120) }}</p>
            
            <div class="package-details mb-3">
              <div class="row text-center">
                <div class="col-6">
                  <small class="text-muted">Courses</small>
                  <p class="mb-0"><strong>{{ $package->packageCourses->count() }}</strong></p>
                </div>
                <div class="col-6">
                  <small class="text-muted">Duration</small>
                  <p class="mb-0"><strong>{{ $package->duration ?? 'N/A' }}</strong></p>
                </div>
              </div>
            </div>

            <div class="courses-included mb-3">
              <small class="text-muted">Included Courses:</small>
              <ul class="list-unstyled">
                @foreach($package->packageCourses->take(3) as $packageCourse)
                  <li><small>• {{ $packageCourse->course->title }}</small></li>
                @endforeach
                @if($package->packageCourses->count() > 3)
                  <li><small class="text-muted">• And {{ $package->packageCourses->count() - 3 }} more...</small></li>
                @endif
              </ul>
            </div>

            <div class="price-section mb-3">
              @if($package->discount_percentage > 0)
                <div class="d-flex justify-content-between align-items-center">
                  <span class="text-muted text-decoration-line-through">${{ number_format($package->price, 2) }}</span>
                  <span class="text-danger fw-bold">${{ number_format($package->discounted_price, 2) }}</span>
                </div>
                <small class="text-success">{{ $package->discount_percentage }}% OFF</small>
              @else
                <div class="text-end">
                  <span class="fw-bold fs-5">${{ number_format($package->price, 2) }}</span>
                </div>
              @endif
            </div>

            <div class="d-grid gap-2">
              <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#packageModal{{ $package->id }}">
                View Details
              </button>
              <a href="{{ route('courses_page') }}?package={{ $package->id }}" class="btn btn-outline-secondary">
                Learn More
              </a>
            </div>
          </div>
        </div>
      </div>

      {{-- Package Detail Modal --}}
      <div class="modal fade" id="packageModal{{ $package->id }}" tabindex="-1" aria-labelledby="packageModalLabel{{ $package->id }}" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="packageModalLabel{{ $package->id }}">{{ $package->name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-6">
                  <h6>Package Details</h6>
                  <ul class="list-unstyled">
                    <li><strong>Category:</strong> {{ $package->category->name ?? 'General' }}</li>
                    <li><strong>Duration:</strong> {{ $package->duration ?? 'N/A' }}</li>
                    <li><strong>Status:</strong> {{ $package->status }}</li>
                    <li><strong>Price:</strong> ${{ number_format($package->discounted_price ?? $package->price, 2) }}</li>
                    @if($package->discount_percentage > 0)
                      <li><strong>Discount:</strong> {{ $package->discount_percentage }}%</li>
                    @endif
                  </ul>
                </div>
                <div class="col-md-6">
                  <h6>Package Description</h6>
                  <p>{{ $package->description }}</p>
                </div>
              </div>
              
              <div class="mt-4">
                <h6>Included Courses ({{ $package->packageCourses->count() }})</h6>
                <div class="row">
                  @foreach($package->packageCourses as $packageCourse)
                  <div class="col-md-6 mb-2">
                    <div class="card">
                      <div class="card-body p-3">
                        <h6 class="card-title">{{ $packageCourse->course->title }}</h6>
                        <p class="card-text small">{{ Str::limit($packageCourse->course->description, 80) }}</p>
                        <small class="text-muted">Duration: {{ $packageCourse->course->duration ?? 'N/A' }}</small>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <a href="{{ route('courses_page') }}?package={{ $package->id }}" class="btn btn-primary">Enroll Now</a>
            </div>
          </div>
        </div>
      </div>
      @empty
      <div class="col-12 text-center">
        <div class="alert alert-info">
          <h4>No packages found</h4>
          <p>Try adjusting your search criteria or browse all categories.</p>
        </div>
      </div>
      @endforelse
    </div>
  </div>
</div>

{{-- Call to Action --}}
<div class="untree_co-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center" data-aos="fade-up">
        <h3 class="mb-4">Ready to Start Your Learning Journey?</h3>
        <p class="mb-4">Join thousands of students who have already benefited from our educational programs.</p>
        <div class="d-flex justify-content-center gap-3">
          <a href="{{ route('Contact_page') }}" class="btn btn-primary">Contact Us</a>
          <a href="{{ route('about_page') }}" class="btn btn-outline-secondary">Learn More About Us</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
