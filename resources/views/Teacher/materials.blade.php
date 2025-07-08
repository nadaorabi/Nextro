<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>Study Materials</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #e0e7ff 0%, #f5f7fa 100%);
      min-height: 100vh;
    }
    .materials-header {
      background: #f6f8fc;
      border-radius: 16px;
      box-shadow: 0 2px 12px rgba(99,102,241,0.06);
      padding: 24px 18px 18px 18px;
      margin-bottom: 22px;
      display: flex;
      flex-wrap: wrap;
      align-items: flex-end;
      gap: 18px 24px;
      justify-content: flex-start;
    }
    .materials-title {
      font-size: 1.3rem;
      font-weight: 700;
      color: #3730a3;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-bottom: 0;
    }
    .subject-filter {
      min-width: 180px;
      border-radius: 12px;
      border: 1px solid #e0e7ff;
      background: #fff;
      color: #6366f1;
      font-weight: 600;
      font-size: 1rem;
      padding: 10px 18px;
      box-shadow: 0 2px 8px rgba(99,102,241,0.04);
      outline: none;
      transition: border 0.2s;
    }
    .subject-filter:focus {
      border: 1.5px solid #6366f1;
    }
    .glassy-search {
      position: relative;
      min-width: 220px;
      width: 100%;
      max-width: 320px;
    }
    .glassy-search input {
      width: 100%;
      background: #f3f4f6;
      border: none;
      border-radius: 12px;
      padding: 12px 18px 12px 40px;
      font-size: 1rem;
      color: #3730a3;
      font-family: inherit;
      transition: box-shadow 0.2s, background 0.2s;
      box-shadow: 0 2px 8px rgba(99,102,241,0.04);
    }
    .glassy-search input:focus {
      background: #fff;
      box-shadow: 0 4px 16px rgba(99,102,241,0.10);
      outline: none;
    }
    .glassy-search .search-icon {
      position: absolute;
      left: 13px;
      top: 50%;
      transform: translateY(-50%);
      color: #6366f1;
      font-size: 1.1em;
    }
    .materials-table-container {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 2px 12px rgba(99,102,241,0.08);
      padding: 0 0 10px 0;
      margin-top: 10px;
      overflow-x: auto;
    }
    .materials-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      min-width: 540px;
    }
    .materials-table th {
      background: #f3f4f6;
      font-weight: 700;
      color: #3730a3;
      padding: 16px 18px;
      border-bottom: 2px solid #e0e7ff;
      font-size: 1.01rem;
      text-align: left;
    }
    .materials-table td {
      padding: 15px 18px;
      vertical-align: middle;
      border-bottom: 1px solid #f1f5f9;
      background: transparent;
      font-size: 1.01rem;
      transition: background 0.18s;
    }
    .materials-table tr:nth-child(even) td {
      background: #f8fafc;
    }
    .materials-table tr:hover td {
      background: #eef2ff;
    }
    .material-type {
      display: flex;
      align-items: center;
      gap: 7px;
      font-weight: 600;
      font-size: 1.01rem;
    }
    .material-type.video { color: #6366f1; }
    .material-type.image { color: #059669; }
    .material-type.pdf { color: #e11d48; }
    .view-btn {
      background: #6366f1;
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 7px 18px;
      font-weight: 600;
      font-size: 1rem;
      box-shadow: 0 2px 8px rgba(99,102,241,0.13);
      transition: box-shadow 0.2s, background 0.2s;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 7px;
    }
    .view-btn:hover {
      background: #818cf8;
      box-shadow: 0 4px 16px rgba(99,102,241,0.18);
    }
    @media (max-width: 900px) {
      .materials-table th, .materials-table td {
        padding: 10px 8px;
        font-size: 0.97rem;
      }
      .materials-header { flex-direction: column; align-items: stretch; gap: 10px; }
      .materials-title { font-size: 1.18rem; justify-content: center; }
      .glassy-search { max-width: 100vw; }
    }
    @media (max-width: 600px) {
      .materials-table-container { border-radius: 10px; padding: 0 0 6px 0; }
      .materials-table th, .materials-table td { padding: 8px 4px; font-size: 0.93rem; }
      .materials-table { min-width: 420px; }
      .view-btn { padding: 7px 12px; font-size: 0.95rem; }
      .materials-header { padding: 14px 4px 10px 4px; }
    }
    /* Modal modern styles */
    .modal-content {
      border-radius: 18px;
      box-shadow: 0 4px 24px rgba(99,102,241,0.13);
      border: none;
    }
    .modal-header {
      border-bottom: none;
      padding-bottom: 0.5rem;
    }
    .modal-title {
      font-weight: 700;
      color: #3730a3;
      font-size: 1.25rem;
    }
    .modal-body {
      padding-top: 0.5rem;
    }
    .modal-footer {
      border-top: none;
      padding-top: 0.5rem;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }
    .modal .form-label {
      font-weight: 600;
      color: #6366f1;
      margin-bottom: 4px;
    }
    .modal .form-control, .modal .form-select {
      border-radius: 10px;
      border: 1.5px solid #e0e7ff;
      font-size: 1rem;
      padding: 10px 14px;
      margin-bottom: 14px;
      box-shadow: 0 1px 4px rgba(99,102,241,0.04);
      transition: border 0.2s;
    }
    .modal .form-control:focus, .modal .form-select:focus {
      border: 1.5px solid #6366f1;
      outline: none;
      box-shadow: 0 2px 8px rgba(99,102,241,0.10);
    }
    .modal .btn-primary {
      background: linear-gradient(90deg, #6366f1 0%, #818cf8 100%);
      border: none;
      border-radius: 10px;
      font-weight: 600;
      padding: 8px 28px;
      font-size: 1rem;
      box-shadow: 0 2px 8px rgba(99,102,241,0.13);
      transition: box-shadow 0.2s, background 0.2s;
    }
    .modal .btn-primary:hover {
      background: linear-gradient(90deg, #818cf8 0%, #6366f1 100%);
      box-shadow: 0 4px 16px rgba(99,102,241,0.18);
    }
    .modal .btn-secondary {
      border-radius: 10px;
      font-weight: 600;
      padding: 8px 22px;
      font-size: 1rem;
      background: #e0e7ff;
      color: #3730a3;
      border: none;
      transition: background 0.2s;
    }
    .modal .btn-secondary:hover {
      background: #c7d2fe;
      color: #3730a3;
    }
    @media (max-width: 600px) {
      .modal-dialog {
        margin: 0.5rem auto;
        max-width: 98vw;
      }
      .modal-content {
        border-radius: 12px;
        padding: 0 2px;
      }
      .modal .form-control, .modal .form-select {
        font-size: 1.08rem;
        padding: 13px 12px;
      }
      .modal-title {
        font-size: 1.08rem;
      }
      .modal-footer {
        flex-direction: column;
        gap: 8px;
        padding-bottom: 0.5rem;
      }
    }
  </style>
</head>
<body class="g-sidenav-show">
  @include('teacher.parts.sidebar-teacher')
  <main class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary mb-0">Study Materials</h2>
        <button class="btn btn-success shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
          <i class="fas fa-plus me-1"></i> Add Material
        </button>
      </div>
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
            <div class="mb-3" style="max-width: 300px;">
                <form method="GET" action="{{ route('teacher.materials.index') }}">
                    <select class="form-select" name="course_id" onchange="this.form.submit()">
                        <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" {{ (isset($courseId) && $courseId == $course->id) ? 'selected' : '' }}>
                                {{ $course->title ?? $course->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
            <table class="table table-hover table-striped align-middle mb-0">
              <thead class="bg-light">
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
                <tr>
                  <td>{{ $material->title }}</td>
                  <td><span class="badge bg-info">{{ ucfirst($material->type) }}</span></td>
                  <td>{{ $material->course->title ?? $material->course->name ?? '-' }}</td>
                  <td>{{ $material->upload_date ? date('Y-m-d', strtotime($material->upload_date)) : '-' }}</td>
                  <td>
                    @php $fileUrl = asset('storage/' . $material->file_url); @endphp
                    @if($material->file_type == 'pdf')
                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
                        <button onclick="printFile('{{ $fileUrl }}', 'pdf')" class="btn btn-outline-secondary btn-sm">Print</button>
                    @elseif($material->file_type == 'image')
                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
                        <button onclick="printFile('{{ $fileUrl }}', 'image')" class="btn btn-outline-secondary btn-sm">Print</button>
                        <br><img src="{{ $fileUrl }}" width="200">
                    @elseif($material->file_type == 'video')
                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
                        <video width="200" controls style="display:block;margin-top:5px;">
                            <source src="{{ $fileUrl }}">
                            Your browser does not support the video tag.
                        </video>
                    @else
                        <a href="{{ $fileUrl }}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
                    @endif
                  </td>
                  <td>
                    <button class="btn btn-outline-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMaterialModal{{ $material->id }}"><i class="fas fa-edit"></i></button>
                    <form action="{{ route('teacher.materials.destroy', $material->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this material?');">
                      @csrf
                      <button type="submit" class="btn btn-outline-danger btn-sm"><i class="fas fa-trash"></i></button>
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
                <tr><td colspan="6" class="text-center text-muted">No materials found.</td></tr>
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
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
            <button type="submit" class="btn btn-primary">Add Material</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <script>
    // بيانات وهمية
    const materials = [
      {id:1, subject:'Mathematics', type:'video', title:'Math Lesson 1', src:'https://www.w3schools.com/html/mov_bbb.mp4', thumb:'https://img.youtube.com/vi/1/0.jpg'},
      {id:2, subject:'Mathematics', type:'image', title:'Algebra Notes', src:'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80'},
      {id:3, subject:'Science', type:'pdf', title:'Exam Review', src:'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
      {id:4, subject:'Science', type:'video', title:'Geometry Basics', src:'https://www.w3schools.com/html/movie.mp4', thumb:'https://img.youtube.com/vi/2/0.jpg'},
      {id:5, subject:'English', type:'image', title:'Grammar Guide', src:'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80'},
      {id:6, subject:'History', type:'pdf', title:'Homework Solutions', src:'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
    ];
    let selectedSubject = 'all';
    function renderMaterials() {
      document.getElementById('materialsLoader').style.display = 'block';
      const list = document.getElementById('materialsList');
      const search = document.getElementById('materialSearch').value.toLowerCase();
      setTimeout(() => {
        list.innerHTML = '';
        materials.filter(mat =>
          (selectedSubject==='all' || mat.subject===selectedSubject) &&
          (mat.title.toLowerCase().includes(search))
        ).forEach(mat => {
          let typeIcon = '';
          let typeClass = '';
          if(mat.type==='video') { typeIcon = '<i class="fas fa-video"></i>'; typeClass = 'video'; }
          if(mat.type==='image') { typeIcon = '<i class="fas fa-image"></i>'; typeClass = 'image'; }
          if(mat.type==='pdf')   { typeIcon = '<i class="fas fa-file-pdf"></i>'; typeClass = 'pdf'; }
          list.innerHTML += `
            <tr>
              <td>${mat.title}</td>
              <td>${mat.subject}</td>
              <td>${mat.subject}</td>
              <td><span class="material-type ${typeClass}">${typeIcon} ${mat.type.charAt(0).toUpperCase() + mat.type.slice(1)}</span></td>
              <td>
                <a href="${mat.src}" target="_blank" class="view-btn"><i class="fas fa-eye"></i> View</a>
              </td>
            </tr>
          `;
        });
        document.getElementById('materialsLoader').style.display = 'none';
      }, 50);
    }
    document.getElementById('subjectFilter').addEventListener('change', function() {
      selectedSubject = this.value;
        renderMaterials();
    });
    document.getElementById('materialSearch').addEventListener('input', renderMaterials);
    function removeMaterial(id) {
      const idx = materials.findIndex(m=>m.id===id);
      if(idx>-1) { materials.splice(idx,1); renderMaterials(); }
    }
    document.getElementById('saveMaterialBtn').onclick = function() {
      const title = document.getElementById('newMaterialTitle').value.trim();
      const type = document.getElementById('newMaterialType').value;
      const subject = document.getElementById('newMaterialSubject').value;
      const fileInput = document.getElementById('newMaterialFile');
      const file = fileInput.files[0];
      if(!title || !type || !file || !subject) return;
      const src = URL.createObjectURL(file);
      materials.unshift({
        id: Date.now(),
        subject,
        type,
        title,
        src,
        thumb: type==='video' ? '' : undefined
      });
      renderMaterials();
      document.getElementById('addMaterialForm').reset();
      var modal = bootstrap.Modal.getInstance(document.getElementById('addMaterialModal'));
      modal.hide();
    };
    renderMaterials();
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