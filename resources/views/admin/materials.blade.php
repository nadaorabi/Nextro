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
@include('admin.parts.sidebar-admin')
<main class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <div class="materials-header">
        <div class="materials-title">
          <i class="fa fa-folder-open text-primary"></i> Study Materials
        </div>
        <div class="glassy-search">
          <span class="search-icon"><i class="fas fa-search"></i></span>
          <input type="text" id="materialSearch" placeholder="Search by material name...">
        </div>
        <select class="subject-filter" id="subjectFilter">
          <option value="all">All Subjects</option>
          <option value="Mathematics">Mathematics</option>
          <option value="Science">Science</option>
          <option value="English">English</option>
          <option value="History">History</option>
        </select>
        <button class="btn btn-primary add-material-desktop" data-bs-toggle="modal" data-bs-target="#addMaterialModal" style="height:44px;display:inline-flex;align-items:center;gap:7px;font-weight:600;">
          <i class="fa fa-plus"></i> <span>Add Material</span>
        </button>
      </div>
      <div id="materialsLoader" style="display:none;text-align:center; margin: 40px 0;">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <div class="materials-table-container">
        <table class="materials-table">
          <thead>
            <tr>
              <th>Title</th>
              <th>Subject</th>
              <th>Subject (EN)</th>
              <th>Type</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="materialsList">
            <!-- Material rows will be rendered here -->
          </tbody>
        </table>
      </div>
   
    </div>
  </main>
  <!-- Modal لإضافة مادة جديدة -->
  <div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="addMaterialLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addMaterialLabel">Add New Material</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addMaterialForm">
            <div class="mb-3">
              <label class="form-label">Title</label>
              <input type="text" class="form-control" id="newMaterialTitle" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Subject</label>
              <select class="form-select" id="newMaterialSubject" required>
                <option value="Mathematics">Mathematics</option>
                <option value="Science">Science</option>
                <option value="English">English</option>
                <option value="History">History</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Type</label>
              <select class="form-select" id="newMaterialType" required>
                <option value="video">Video</option>
                <option value="image">Image</option>
                <option value="pdf">PDF</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">File</label>
              <input type="file" class="form-control" id="newMaterialFile" accept="video/*,image/*,application/pdf" required>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary" id="saveMaterialBtn">Add</button>
        </div>
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
  </script>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
</body>
</html> 