<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>Teacher Materials</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
  <style>
    .page-header {
      background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%);
      color: rgb(123, 105, 172);
      border-radius: 15px;
      padding: 1.2rem;
      margin-bottom: 1rem;
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .schedule-card {
      background: white;
      border-radius: 15px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.08);
      border: none;
      transition: all 0.3s ease;
    }
    .schedule-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 25px rgba(0,0,0,0.12);
    }
    .table-header {
      background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%) !important;
      color: rgb(123, 105, 172) !important;
      border-bottom: 2px solid #e9ecef;
    }
    .table-header th {
      color: rgb(123, 105, 172) !important;
      font-weight: 600 !important;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
    }
    .table-row {
      transition: all 0.2s ease;
      border-bottom: 1px solid #f8f9fa;
    }
    .table-row:hover {
      background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 86, 179, 0.05) 100%) !important;
      transform: scale(1.01);
    }
    .subject-badge {
      background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
    }
    .category-badge {
      background: linear-gradient(135deg, #20c997 0%, #1ea085 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(32, 201, 151, 0.3);
    }
    .type-badge {
      background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(108, 117, 125, 0.3);
    }
    .file-badge {
      background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
      color: white;
      padding: 0.4rem 0.8rem;
      border-radius: 20px;
      font-size: 0.8rem;
      display: inline-block;
      box-shadow: 0 2px 8px rgba(0, 123, 255, 0.3);
    }
    .action-btn {
      border-radius: 10px;
      font-size: 0.9rem;
      margin: 0 2px;
    }
    .empty-state {
      background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 86, 179, 0.05) 100%);
      border-radius: 15px;
      padding: 3rem 2rem;
    }
    .empty-state i {
      color: rgb(123, 105, 172);
      opacity: 0.8;
    }
  </style>
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('teacher.parts.sidebar-teacher')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container-fluid py-4">
      <!-- Page Header -->
      <div class="row mb-2">
        <div class="col-12">
          <div class="page-header d-flex align-items-center justify-content-between flex-wrap">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <i class="fas fa-book-open fa-2x"></i>
              </div>
              <div>
                <h2 class="mb-1">Teacher Materials</h2>
                <p class="mb-0 opacity-75">View all your study materials and lessons</p>
              </div>
            </div>
            <div class="mt-3 mt-md-0">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                <i class="fas fa-plus"></i> Add New Material
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Filters -->
      <div class="row mb-4">
        <div class="col-md-6 mb-2">
          <form method="GET" action="" class="w-100">
            <select name="course_id" class="form-select" style="border-radius: 10px; border: 1.5px solid #b3d4fc; color: #7b69ac; font-weight: 600;" onchange="this.form.submit()">
              <option value="">All Courses</option>
                  @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                      {{ $course->title ?? $course->name }}
                    </option>
                  @endforeach
                </select>
              </form>
                </div>
        <div class="col-md-6 mb-2">
          <form method="GET" action="" class="w-100">
            <div class="input-group">
              <span class="input-group-text bg-white border-end-0" style="color: #7b69ac;"><i class="fas fa-search"></i></span>
              <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search for a material or lesson...">
            </div>
          </form>
        </div>
      </div>
      <!-- Materials Table -->
      <div class="row">
        <div class="col-12">
          <div class="schedule-card card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <i class="fas fa-table text-muted me-2"></i>
                <h5 class="mb-0">Study Materials</h5>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead class="table-header">
                <tr>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Course</th>
                  <th>Date</th>
                  <th>File</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($materials as $material)
                    <tr class="table-row">
                  <td>{{ $material->title }}</td>
                      <td>
                        <span class="type-badge">
                          @if($material->file_type == 'pdf')<i class="fas fa-file-pdf me-1"></i>@endif
                          @if($material->file_type == 'image')<i class="fas fa-image me-1"></i>@endif
                          @if($material->file_type == 'video')<i class="fas fa-video me-1"></i>@endif
                          {{ ucfirst($material->type) }}
                        </span>
                      </td>
                      <td>
                        <span class="subject-badge">
                          <i class="fas fa-book me-1"></i>
                          {{ $material->course->title ?? $material->course->name ?? '-' }}
                        </span>
                      </td>
                      <td>
                        <span class="category-badge">
                          <i class="fas fa-calendar-day me-1"></i>
                          {{ $material->upload_date ? date('Y-m-d', strtotime($material->upload_date)) : '-' }}
                        </span>
                      </td>
                  <td>
                    @php $fileUrl = asset('storage/' . $material->file_url); @endphp
                    @if($material->file_type == 'pdf')
                          <a href="{{ $fileUrl }}" target="_blank" class="file-badge"><i class="fas fa-eye me-1"></i>View</a>
                          <button onclick="printFile('{{ $fileUrl }}', 'pdf')" class="file-badge border-0"><i class="fas fa-print me-1"></i>Print</button>
                    @elseif($material->file_type == 'image')
                          <a href="{{ $fileUrl }}" target="_blank" class="file-badge"><i class="fas fa-eye me-1"></i>View</a>
                          <button onclick="printFile('{{ $fileUrl }}', 'image')" class="file-badge border-0"><i class="fas fa-print me-1"></i>Print</button>
                    @elseif($material->file_type == 'video')
                          <a href="{{ $fileUrl }}" target="_blank" class="file-badge"><i class="fas fa-eye me-1"></i>View</a>
                    @else
                          <a href="{{ $fileUrl }}" target="_blank" class="file-badge"><i class="fas fa-eye me-1"></i>View</a>
                    @endif
                  </td>
                  <td>
                        <button class="btn btn-outline-warning btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#editMaterialModal{{ $material->id }}"><i class="fas fa-edit"></i></button>
                    <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this material?');">
                      @csrf
                          <button type="submit" class="btn btn-outline-danger btn-sm action-btn"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                <!-- Edit Modal -->
                <div class="modal fade" id="editMaterialModal{{ $material->id }}" tabindex="-1" aria-labelledby="editMaterialModalLabel{{ $material->id }}" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <form action="{{ route('teacher.materials.update', $material->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                          <h5 class="modal-title" id="editMaterialModalLabel{{ $material->id }}">Edit Material</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="{{ $material->title }}" required>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-select" required>
                              <option value="lecture" @if($material->type=='lecture') selected @endif>Lecture</option>
                              <option value="assignment" @if($material->type=='assignment') selected @endif>Assignment</option>
                              <option value="exam" @if($material->type=='exam') selected @endif>Exam</option>
                              <option value="notes" @if($material->type=='notes') selected @endif>Notes</option>
                            </select>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Course</label>
                            <select name="course_id" class="form-select" required>
                              @foreach($courses as $course)
                                <option value="{{ $course->id }}" @if($material->course_id==$course->id) selected @endif>{{ $course->title }}</option>
                              @endforeach
                            </select>
                          </div>
                          <div class="mb-3">
                            <label class="form-label">Replace File (optional)</label>
                            <input type="file" name="file" class="form-control">
                            <small class="text-muted">Leave empty to keep current file.</small>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                @empty
                    <tr>
                      <td colspan="6" class="text-center text-muted py-4 empty-state">
                        <i class="fas fa-calendar-times fa-2x mb-3 d-block"></i>
                        <p class="mb-0">No study materials found</p>
                      </td>
                    </tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
      </div>
  <!-- Add Material Modal -->
  <div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="addMaterialModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('teacher.materials.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="modal-header">
            <h5 class="modal-title" id="addMaterialModalLabel">Add New Material</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Type</label>
              <select name="type" class="form-select" required>
                <option value="lecture">Lecture</option>
                <option value="assignment">Assignment</option>
                <option value="exam">Exam</option>
                <option value="notes">Notes</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Course</label>
              <select name="course_id" class="form-select" required>
                @foreach($courses as $course)
                  <option value="{{ $course->id }}">{{ $course->title }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">File</label>
              <input type="file" name="file" class="form-control" required>
              <small class="text-muted">Allowed: PDF, Video, Image, Word, ... (max 20MB)</small>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div>
    </div>
  </main>
  <script>
    function printFile(url, type) {
        var win = window.open(url, '_blank');
        if(type === 'pdf') {
            win.onload = function() { win.print(); };
        } else if(type === 'image') {
            win.onload = function() {
                win.document.body.innerHTML = '<img src="'+url+'" style="max-width:100vw;max-height:100vh;">';
                win.print();
            };
        }
    }
  </script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
</body>
</html> 