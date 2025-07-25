<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>Teacher materials files</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script>
    // Fallback for FontAwesome if it fails to load
    window.addEventListener('load', function() {
      if (typeof FontAwesome === 'undefined') {
        console.log('FontAwesome failed to load, using fallback icons');
      }
    });
  </script>
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
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0,0,0,0.1);
      border: 1px solid #e9ecef;
      transition: all 0.2s ease;
    }
    .schedule-card:hover {
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }
    .table-header {
      background: #ffffff !important;
      color: #212529 !important;
      border-bottom: 2px solid #dee2e6;
    }
    .table-header th {
      color: #212529 !important;
      font-weight: 700 !important;
      text-transform: none;
      font-size: 0.875rem;
      letter-spacing: 0.025em;
      padding: 1rem 0.75rem;
      border: none;
      vertical-align: middle;
    }
    .table-row {
      transition: all 0.15s ease;
      border-bottom: 1px solid #f8f9fa;
    }
    .table-row:hover {
      background: #f8f9fa !important;
      transform: none;
    }
    .table-row td {
      padding: 1rem 0.75rem;
      vertical-align: middle;
      border: none;
      color: #495057;
    }
    .subject-badge {
      background: #e3f2fd;
      color: #1976d2;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 500;
      display: inline-block;
      border: none;
    }
    .category-badge {
      background: #f3e5f5;
      color: #7b1fa2;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 500;
      display: inline-block;
      border: none;
    }
    .type-badge {
      background: #fff3e0;
      color: #f57c00;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 500;
      display: inline-block;
      border: none;
    }
    .file-badge {
      background: #f8f9fa;
      color: #495057;
      padding: 0.5rem 1rem;
      border-radius: 4px;
      font-size: 0.8rem;
      font-weight: 500;
      display: inline-block;
      border: 1px solid #dee2e6;
      text-decoration: none;
      margin: 2px;
      transition: all 0.2s ease;
    }
    .file-badge:hover {
      background: #e9ecef;
      color: #495057;
      text-decoration: none;
      transform: translateY(-1px);
    }
    .file-badge:active {
      background: #dee2e6;
      transform: translateY(0);
    }

    .action-btn {
      border-radius: 4px;
      font-size: 0.875rem;
      margin: 0 2px;
      border: 1px solid #dee2e6;
      background: #ffffff;
      color: #495057;
      padding: 0.5rem 0.75rem;
      transition: all 0.2s ease;
    }
    .action-btn:hover {
      background: #f8f9fa;
      border-color: #adb5bd;
    }
    .btn-outline-warning:hover {
      background: #fff3cd;
      border-color: #ffc107;
      color: #856404;
    }
    .btn-outline-danger:hover {
      background: #f8d7da;
      border-color: #dc3545;
      color: #721c24;
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
    /* Fix modal shaking */
    .modal {
      overflow-y: auto !important;
    }
    .modal-dialog {
      margin: 1.75rem auto;
      max-width: 500px;
    }
    .modal-content {
      border: none;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    .modal-header {
      border-bottom: 1px solid #e9ecef;
      border-radius: 15px 15px 0 0;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    .modal-footer {
      border-top: 1px solid #e9ecef;
      border-radius: 0 0 15px 15px;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    /* File selection styles */
    .current-file-info {
      border: 1px solid #e9ecef;
      background-color: #f8f9fa !important;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    .current-file-info:hover {
      background-color: #e9ecef !important;
    }
    .current-file-name {
      font-weight: 500;
      color: #495057;
    }
    .selected-file-info {
      padding: 8px 12px;
      background-color: #d4edda;
      border: 1px solid #c3e6cb;
      border-radius: 6px;
      color: #155724;
      animation: fadeIn 0.3s ease;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    /* Search animations */
    .fade-out {
      opacity: 0;
      transform: translateY(-10px);
      transition: all 0.3s ease;
    }
    

    
    /* Search results highlighting */
    .search-highlight {
      background-color: #fff3cd;
      padding: 2px 4px;
      border-radius: 3px;
    }
    
    /* No results message styling */
    .no-results td {
      background: linear-gradient(135deg, rgba(108, 117, 125, 0.05) 0%, rgba(73, 80, 87, 0.05) 100%);
      border-radius: 15px;
      padding: 3rem 2rem !important;
    }
    .no-results i {
      color: #6c757d;
      opacity: 0.5;
    }
    
    /* Mobile responsiveness */
    @media (max-width: 768px) {
      .table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
      }
      
      .table {
        font-size: 0.875rem;
      }
      
      .table-row td {
        padding: 0.75rem 0.5rem;
        white-space: nowrap;
      }
      
      .subject-badge, .category-badge, .type-badge, .file-badge {
        padding: 0.4rem 0.6rem;
        font-size: 0.75rem;
      }
      
      .action-btn {
        padding: 0.4rem 0.6rem;
        font-size: 0.8rem;
      }
      
      .page-header {
        padding: 1rem;
        margin-bottom: 0.5rem;
      }
      
      .page-header h2 {
        font-size: 1.5rem;
      }
    }
    
    @media (max-width: 576px) {
      .table {
        font-size: 0.8rem;
      }
      
      .table-row td {
        padding: 0.5rem 0.25rem;
      }
      
      .subject-badge, .category-badge, .type-badge, .file-badge {
        padding: 0.3rem 0.5rem;
        font-size: 0.7rem;
      }
      
      .action-btn {
        padding: 0.3rem 0.5rem;
        font-size: 0.75rem;
      }
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
                <h2 class="mb-1"> Teacher materials files</h2>
                <p class="mb-0 opacity-75">View all your  materials files and lessons</p>
              </div>
            </div>
            <div class="mt-3 mt-md-0">
              <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                <i class="fas fa-plus"></i> Add New files
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
              <input type="text" name="search" id="searchInput" value="{{ request('search') }}" class="form-control border-start-0" placeholder="Search for a material or lesson..." autocomplete="off">
              <button type="submit" class="btn btn-outline-primary border-start-0" style="display: none;">
                <i class="fas fa-search"></i>
              </button>
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
                <h5 class="mb-0">files Materials</h5>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" style="border-collapse: separate; border-spacing: 0; min-width: 800px;">
                  <thead class="table-header">
                <tr>
                  <th style="min-width: 150px;">Title</th>
                  <th style="min-width: 120px;">Type</th>
                  <th style="min-width: 120px;">Course</th>
                  <th style="min-width: 100px;">Date</th>
                  <th style="min-width: 200px;">File</th>
                  <th style="min-width: 100px;">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($materials as $material)
                    <tr class="table-row">
                  <td style="min-width: 150px;">{{ $material->title }}</td>
                      <td style="min-width: 120px;">
                        <span class="type-badge">
                          @if($material->file_type == 'pdf')<i class="fas fa-file-pdf me-1"></i>@endif
                          @if($material->file_type == 'image')<i class="fas fa-image me-1"></i>@endif
                          @if($material->file_type == 'video')<i class="fas fa-video me-1"></i>@endif
                          {{ ucfirst($material->type) }}
                        </span>
                      </td>
                      <td style="min-width: 120px;">
                        <span class="subject-badge">
                          <i class="fas fa-book me-1"></i>
                          {{ $material->course->title ?? $material->course->name ?? '-' }}
                        </span>
                      </td>
                      <td style="min-width: 100px;">
                        <span class="category-badge">
                          <i class="fas fa-calendar-day me-1"></i>
                          {{ $material->upload_date ? date('Y-m-d', strtotime($material->upload_date)) : '-' }}
                        </span>
                      </td>
                  <td style="min-width: 200px;">
                    @php 
                      $fileUrl = asset('storage/' . $material->file_url);
                      $fileExists = \Storage::disk('public')->exists($material->file_url);
                      $filePath = storage_path('app/public/' . $material->file_url);
                      $fileExistsDirect = file_exists($filePath);
                      $publicPath = public_path('storage/' . $material->file_url);
                      $fileExistsPublic = file_exists($publicPath);
                    @endphp
                    @if($fileExists)
                      @if($material->file_type == 'pdf')
                            <a href="{{ asset('storage/' . $material->file_url) }}" target="_blank" class="file-badge" title="Open PDF"><i class="fas fa-eye me-1"></i>Open</a>
                            <a href="{{ route('teacher.materials.download', $material->id) }}" class="file-badge" title="Download File"><i class="fas fa-download me-1"></i>Download</a>
                      @elseif($material->file_type == 'image')
                            <a href="{{ asset('storage/' . $material->file_url) }}" target="_blank" class="file-badge" title="View Image"><i class="fas fa-eye me-1"></i>View</a>
                            <a href="{{ route('teacher.materials.download', $material->id) }}" class="file-badge" title="Download Image"><i class="fas fa-download me-1"></i>Download</a>
                      @elseif($material->file_type == 'video')
                            <a href="{{ asset('storage/' . $material->file_url) }}" target="_blank" class="file-badge" title="Play Video"><i class="fas fa-play me-1"></i>Play</a>
                            <a href="{{ route('teacher.materials.download', $material->id) }}" class="file-badge" title="Download Video"><i class="fas fa-download me-1"></i>Download</a>
                      @else
                            <a href="{{ asset('storage/' . $material->file_url) }}" target="_blank" class="file-badge" title="Open File"><i class="fas fa-eye me-1"></i>Open</a>
                            <a href="{{ route('teacher.materials.download', $material->id) }}" class="file-badge" title="Download File"><i class="fas fa-download me-1"></i>Download</a>
                      @endif
                    @else
                      <span class="text-danger">
                        <i class="fas fa-exclamation-triangle me-1"></i>File not found
                        <br><small>Path: {{ $material->file_url }}</small>
                        <br><small>Storage: {{ $fileExists ? 'Yes' : 'No' }}</small>
                        <br><small>Direct: {{ $fileExistsDirect ? 'Yes' : 'No' }}</small>
                        <br><small>Public: {{ $fileExistsPublic ? 'Yes' : 'No' }}</small>
                        <br><small>ID: {{ $material->id }}</small>
                        <br><small>URL: {{ $fileUrl }}</small>
                      </span>
                    @endif
                  </td>
                  <td style="min-width: 100px;">
                        <button class="btn btn-outline-warning btn-sm action-btn" data-bs-toggle="modal" data-bs-target="#editMaterialModal{{ $material->id }}"><i class="fas fa-edit"></i></button>
                    <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this material?');">
                      @csrf
                          <button type="submit" class="btn btn-outline-danger btn-sm action-btn"><i class="fas fa-trash"></i></button>
                    </form>
                  </td>
                </tr>
                @empty
                    <tr>
                      <td colspan="6" class="text-center text-muted py-4 empty-state">
                        <i class="fas fa-calendar-times fa-2x mb-3 d-block"></i>
                        <p class="mb-0">No files materials found</p>
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
            <h5 class="modal-title" id="addMaterialModalLabel">Add New file</h5>
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

  <!-- Edit Material Modals -->
  @foreach($materials as $material)
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
              <input type="file" name="file" class="form-control" id="fileInput{{ $material->id }}">
              <small class="text-muted">Leave empty to keep current file.</small>
              <div class="selected-file-info mt-2" id="selectedFileInfo{{ $material->id }}" style="display: none;">
                <i class="fas fa-check-circle text-success me-2"></i>
                <span class="selected-file-name"></span>
              </div>
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
  @endforeach



    </div>
  </main>
  <script>
    // Fix modal shaking by preventing body scroll
    document.addEventListener('DOMContentLoaded', function() {
        const modals = document.querySelectorAll('.modal');
        modals.forEach(modal => {
            modal.addEventListener('show.bs.modal', function() {
                document.body.style.overflow = 'hidden';
            });
            modal.addEventListener('hidden.bs.modal', function() {
                document.body.style.overflow = '';
            });
        });
        
        // Handle file input changes for edit modals
        document.querySelectorAll('input[type="file"]').forEach(input => {
            input.addEventListener('change', function() {
                const file = this.files[0];
                const modalId = this.closest('.modal').id;
                const materialId = modalId.replace('editMaterialModal', '');
                const selectedFileInfo = document.getElementById('selectedFileInfo' + materialId);
                const selectedFileName = selectedFileInfo.querySelector('.selected-file-name');
                
                if (file) {
                    selectedFileName.textContent = file.name;
                    selectedFileInfo.style.display = 'block';
                } else {
                    selectedFileInfo.style.display = 'none';
                }
            });
        });
        
        // Live search functionality
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            console.log('Search input found, setting up search functionality...');
            
            searchInput.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                console.log('Searching for:', searchTerm);
                
                const tbody = document.querySelector('tbody');
                const allRows = tbody.querySelectorAll('tr');
                let visibleCount = 0;
                
                // Remove any existing no-results row
                const existingNoResults = tbody.querySelector('tr.no-results');
                if (existingNoResults) {
                    existingNoResults.remove();
                }
                
                allRows.forEach(row => {
                    // Skip the original empty state row
                    if (row.querySelector('.empty-state')) {
                        row.style.display = 'none';
                        return;
                    }
                    
                    const title = row.querySelector('td:first-child')?.textContent.toLowerCase() || '';
                    const type = row.querySelector('td:nth-child(2)')?.textContent.toLowerCase() || '';
                    const course = row.querySelector('td:nth-child(3)')?.textContent.toLowerCase() || '';
                    
                    const matches = title.includes(searchTerm) || 
                                  type.includes(searchTerm) || 
                                  course.includes(searchTerm);
                    
                    if (matches || searchTerm === '') {
                        row.style.display = '';
                        visibleCount++;
                    } else {
                        row.style.display = 'none';
                    }
                });
                
                console.log('Visible count:', visibleCount);
                
                // Show no results message if needed
                if (visibleCount === 0 && searchTerm !== '') {
                    console.log('Creating no results message');
                    const noResultsRow = document.createElement('tr');
                    noResultsRow.className = 'no-results';
                    noResultsRow.innerHTML = `
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="fas fa-search fa-2x mb-3 d-block" style="color: #6c757d; opacity: 0.5;"></i>
                            <p class="mb-0">No materials found matching "${searchTerm}"</p>
                        </td>
                    `;
                    tbody.appendChild(noResultsRow);
                }
            });
            
            // Clear search on escape key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    this.value = '';
                    this.dispatchEvent(new Event('input'));
                }
            });
        } else {
            console.log('Search input not found!');
        }
    });
  </script>

  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
</body>
</html> 