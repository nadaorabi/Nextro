<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Category Details - {{ $category->name }}</title>

  <!-- Fonts and CSS -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}">
  <link rel="stylesheet" href="{{ asset('css/admin-show-pages.css') }}">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <style>
    .stats-card {
      min-height: 180px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      border-radius: 1.2rem;
      box-shadow: 0 2px 8px #e3eaf1;
      background: #fff;
      padding: 1.5rem;
    }
    .stats-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 0.5rem auto;
      font-size: 1.5rem;
      color: white !important;
    }
    .stats-title {
      font-size: 0.9rem;
      color: #888;
      margin-bottom: 0.3rem;
    }
    .stats-value {
      font-size: 1.6rem;
      font-weight: bold;
      margin-bottom: 0.2rem;
    }
    .category-image {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border-radius: 15px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .list-group-item {
      border: 1px solid #e9ecef;
      margin-bottom: 0.5rem;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
    }
    .list-group-item:hover {
      background-color: #f8f9fa;
      transform: translateY(-1px);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .item-info {
      display: flex;
      flex-direction: column;
    }
    .item-title {
      font-weight: 600;
      color: #495057;
      margin-bottom: 0.25rem;
    }
    .item-details {
      font-size: 0.875rem;
      color: #6c757d;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')

  <main class="main-content position-relative border-radius-lg ">
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-12" style="max-width:1000px;margin:auto;">
          
          <!-- Header Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center">
                <div>
                  <h4 class="mb-0">Category Information</h4>
                  <p class="text-muted mb-0">View category details and associated content</p>
                </div>
                <div>
                  <a href="{{ route('admin.educational-categories.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to List
                  </a>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                    <i class="fas fa-edit"></i> Edit Category
                  </button>
                </div>
              </div>
            </div>
          </div>

          @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <i class="fas fa-check-circle me-2"></i>
              {{ session('success') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <i class="fas fa-exclamation-circle me-2"></i>
              {{ session('error') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          @endif

          <!-- Category Profile Card -->
          <div class="card shadow-sm mb-4">
            <div class="card-body">
              <div class="row">
                <!-- Category Image -->
                <div class="col-md-3 text-center">
                  <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/theme/category-default.png') }}"
                      class="category-image mb-3" alt="Category Image">
                  
                  <!-- Status Badge -->
                  <div class="mb-3">
                    <span class="badge {{ $category->status === 'active' ? 'bg-success' : 'bg-warning' }}">
                      <i class="fas {{ $category->status === 'active' ? 'fa-check-circle' : 'fa-pause-circle' }} me-1"></i>
                      {{ ucfirst($category->status) }}
                    </span>
                  </div>
                  
                  <!-- Category ID -->
                  <div class="text-center">
                    <h6 class="text-muted mb-1">Category ID</h6>
                    <h5 class="font-weight-bold text-primary">CAT-{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</h5>
                  </div>
                </div>
                
                <!-- Category Information -->
                <div class="col-md-9">
                  <h4 class="mb-4">{{ $category->name }}</h4>
                  <div class="row">
                    <!-- Basic Information -->
                    <div class="col-md-6">
                      <h6 class="text-uppercase text-muted mb-3">Basic Information</h6>
                      <div class="mb-3">
                        <label class="form-label text-muted">Category Name</label>
                        <p class="font-weight-bold">{{ $category->name }}</p>
                      </div>
                      <div class="mb-3">
                        <label class="form-label text-muted">Status</label>
                        <p class="font-weight-bold">
                          <span class="badge {{ $category->status === 'active' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($category->status) }}
                          </span>
                        </p>
                      </div>
                      <div class="mb-3">
                        <label class="form-label text-muted">Description</label>
                        <p class="font-weight-bold">{{ $category->description ?: 'No description provided' }}</p>
                      </div>
                    </div>
                    
                    <!-- Date Information -->
                    <div class="col-md-6">
                      <h6 class="text-uppercase text-muted mb-3">Date Information</h6>
                      <div class="mb-3">
                        <label class="form-label text-muted">Created Date</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-calendar me-2 text-primary"></i>
                          {{ $category->created_at->format('F j, Y') }}
                        </p>
                      </div>
                      <div class="mb-3">
                        <label class="form-label text-muted">Created Time</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-clock me-2 text-primary"></i>
                          {{ $category->created_at->format('g:i A') }}
                        </p>
                      </div>
                      <div class="mb-3">
                        <label class="form-label text-muted">Last Updated</label>
                        <p class="font-weight-bold">
                          <i class="fas fa-sync me-2 text-primary"></i>
                          {{ $category->updated_at->diffForHumans() }}
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Statistics Cards -->
          <div class="row mb-4 g-4">
            <div class="col-12 col-md-4">
              <div class="stats-card text-center">
                <div class="stats-icon" style="background-color:#6c63ff;"><i class="fas fa-book"></i></div>
                <div class="stats-title">Total Courses</div>
                <div class="stats-value" style="color:#6c63ff;">{{ $category->courses->count() }}</div>
                <div class="small text-secondary">Associated Courses</div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="stats-card text-center">
                <div class="stats-icon" style="background-color:#3f51b5;"><i class="fas fa-box"></i></div>
                <div class="stats-title">Total Packages</div>
                <div class="stats-value" style="color:#3f51b5;">{{ $category->packages->count() }}</div>
                <div class="small text-secondary">Associated Packages</div>
              </div>
            </div>
            <div class="col-12 col-md-4">
              <div class="stats-card text-center">
                <div class="stats-icon" style="background-color:#2196f3;"><i class="fas fa-layer-group"></i></div>
                <div class="stats-title">Total Content</div>
                <div class="stats-value" style="color:#2196f3;">{{ $category->courses->count() + $category->packages->count() }}</div>
                <div class="small text-secondary">All Associated Items</div>
              </div>
            </div>
          </div>

          <!-- Associated Courses Section -->
          <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h6 class="mb-0">
                <i class="fas fa-book me-2"></i>Associated Courses
              </h6>
              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCourseModal">
                <i class="fas fa-plus me-1"></i>Add Course
              </button>
            </div>
            <div class="card-body">
              @if ($category->courses->count())
                <div class="list-group">
                  @foreach ($category->courses as $course)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="item-info">
                        <div class="item-title">{{ $course->title }}</div>
                        <div class="item-details">
                          <i class="fas fa-layer-group me-1"></i>Level: {{ $course->level ?? 'Not specified' }}
                          @if($course->duration)
                            <span class="ms-3">
                              <i class="fas fa-clock me-1"></i>{{ $course->duration }}
                            </span>
                          @endif
                        </div>
                      </div>
                      <form method="POST" action="#" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                            title="Remove from category"
                            onclick="return confirm('Are you sure you want to remove this course from the category?')">
                          <i class="fas fa-unlink"></i>
                        </button>
                      </form>
                    </div>
                  @endforeach
                </div>
              @else
                <div class="text-center py-4">
                  <i class="fas fa-book-open text-muted" style="font-size: 3rem;"></i>
                  <h6 class="text-muted mt-3">No Courses Assigned</h6>
                  <p class="text-muted mb-0">This category doesn't have any courses assigned yet.</p>
                </div>
              @endif
            </div>
          </div>

          <!-- Associated Packages Section -->
          <div class="card shadow-sm mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
              <h6 class="mb-0">
                <i class="fas fa-box me-2"></i>Associated Packages
              </h6>
              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPackageModal">
                <i class="fas fa-plus me-1"></i>Add Package
              </button>
            </div>
            <div class="card-body">
              @if ($category->packages->count())
                <div class="list-group">
                  @foreach ($category->packages as $package)
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                      <div class="item-info">
                        <div class="item-title">{{ $package->name }}</div>
                        <div class="item-details">
                          <i class="fas fa-dollar-sign me-1"></i>Price: {{ $package->price ? '$' . number_format($package->price, 2) : 'Free' }}
                          @if($package->duration)
                            <span class="ms-3">
                              <i class="fas fa-calendar me-1"></i>{{ $package->duration }}
                            </span>
                          @endif
                        </div>
                      </div>
                      <form method="POST" action="#" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-outline-danger btn-sm" 
                            title="Remove from category"
                            onclick="return confirm('Are you sure you want to remove this package from the category?')">
                          <i class="fas fa-unlink"></i>
                        </button>
                      </form>
                    </div>
                  @endforeach
                </div>
              @else
                <div class="text-center py-4">
                  <i class="fas fa-boxes text-muted" style="font-size: 3rem;"></i>
                  <h6 class="text-muted mt-3">No Packages Assigned</h6>
                  <p class="text-muted mb-0">This category doesn't have any packages assigned yet.</p>
                </div>
              @endif
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.educational-categories.add-course', $category) }}" class="modal-content">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addCourseModalLabel">
              <i class="fas fa-plus me-2"></i>Add Course to Category
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="course_id" class="form-label">Select Course</label>
              <select name="course_id" id="course_id" class="form-select" required>
                <option value="">-- Choose a course --</option>
                @foreach($otherCourses as $course)
                  <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
              </select>
              @if($otherCourses->isEmpty())
                <small class="text-muted">No available courses to add.</small>
              @endif
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-plus me-1"></i>Add Course
            </button>
          </div>
        </form>
      </div>
    </div>

    <!-- Add Package Modal -->
    <div class="modal fade" id="addPackageModal" tabindex="-1" aria-labelledby="addPackageModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.educational-categories.add-package', $category) }}" class="modal-content">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addPackageModalLabel">
              <i class="fas fa-plus me-2"></i>Add Package to Category
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label for="package_id" class="form-label">Select Package</label>
              <select name="package_id" id="package_id" class="form-select" required>
                <option value="">-- Choose a package --</option>
                @foreach($otherPackages as $package)
                  <option value="{{ $package->id }}">{{ $package->name }}</option>
                @endforeach
              </select>
              @if($otherPackages->isEmpty())
                <small class="text-muted">No available packages to add.</small>
              @endif
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-plus me-1"></i>Add Package
            </button>
          </div>
        </form>
      </div>
    </div>

  </main>

  <!-- Core JS Files -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>

  <script>
    // Auto-hide success messages
    document.addEventListener('DOMContentLoaded', function() {
      const alerts = document.querySelectorAll('.alert');
      alerts.forEach(function(alert) {
        setTimeout(function() {
          if (alert.classList.contains('alert-success')) {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
          }
        }, 5000);
      });
    });
  </script>

</body>
</html>
