<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>Study Materials</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
  <style>
    .material-card { box-shadow:0 2px 12px rgba(44,62,80,0.08); border-radius:18px; }
    .material-thumb { width:100%; height:180px; object-fit:cover; border-radius:12px; }
    .material-actions button { margin-right: 8px; }
    #filterBtns .btn { background:#fff; color:#344767; border:none; font-weight:600; border-radius:20px; margin-right:6px; transition:background 0.2s,color 0.2s; padding:6px 22px; }
    #filterBtns .btn.active { background:#8795e5; color:#fff; }
  </style>
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('teacher.parts.sidebar-teacher')
  <main class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <div class="row mb-4 align-items-center">
        <div class="col-md-6">
          <h4 class="mb-0"><i class="fa fa-folder-open text-primary me-2"></i>Study Materials</h4>
        </div>
        <div class="col-md-4">
          <input type="text" id="materialSearch" class="form-control" placeholder="Search by material name...">
        </div>
        <div class="col-md-2 text-end">
          <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMaterialModal" style="margin-top: 18px;"><i class="fa fa-plus me-1"></i> Add Material</button>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-12 d-flex align-items-center" id="filterBtns">
          <button class="btn active" data-type="all">All</button>
          <button class="btn" data-type="video">Videos</button>
          <button class="btn" data-type="image">Images</button>
          <button class="btn" data-type="pdf">PDFs</button>
        </div>
      </div>
      <div id="materialsLoader" style="display:none;text-align:center; margin: 40px 0;">
        <div class="spinner-border text-primary" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
      <div class="row" id="materialsList">
        <!-- البطاقات ستملأ بالجافاسكريبت -->
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
              <label class="form-label">Type</label>
              <select class="form-control" id="newMaterialType" required>
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
      {id:1, type:'video', title:'Math Lesson 1', src:'https://www.w3schools.com/html/mov_bbb.mp4', thumb:'https://img.youtube.com/vi/1/0.jpg'},
      {id:2, type:'image', title:'Algebra Notes', src:'https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80'},
      {id:3, type:'pdf', title:'Exam Review', src:'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
      {id:4, type:'video', title:'Geometry Basics', src:'https://www.w3schools.com/html/movie.mp4', thumb:'https://img.youtube.com/vi/2/0.jpg'},
      {id:5, type:'image', title:'Graphs Example', src:'https://images.unsplash.com/photo-1465101046530-73398c7f28ca?auto=format&fit=crop&w=400&q=80'},
      {id:6, type:'pdf', title:'Homework Solutions', src:'https://www.w3.org/WAI/ER/tests/xhtml/testfiles/resources/pdf/dummy.pdf'},
    ];
    let selectedType = 'all';
    function renderMaterials() {
      document.getElementById('materialsLoader').style.display = 'block';
      const list = document.getElementById('materialsList');
      const search = document.getElementById('materialSearch').value.toLowerCase();
      setTimeout(() => {
        list.innerHTML = '';
        materials.filter(mat =>
          (selectedType==='all' || mat.type===selectedType) &&
          (mat.title.toLowerCase().includes(search))
        ).forEach(mat => {
          let content = '';
          if(mat.type==='video') {
            content = `<video class='material-thumb mb-2' src='${mat.src}' controls poster='${mat.thumb||''}'></video>`;
          } else if(mat.type==='image') {
            content = `<img class='material-thumb mb-2' src='${mat.src}' alt='${mat.title}'>`;
          } else if(mat.type==='pdf') {
            content = `<embed class='material-thumb mb-2' src='${mat.src}' type='application/pdf'>`;
          }
          list.innerHTML += `
            <div class='col-md-4 mb-4'>
              <div class='card material-card p-3'>
                ${content}
                <h6 class='mt-2 mb-1'>${mat.title}</h6>
                <div class='material-actions text-end'>
                  <button class='btn btn-sm btn-info' onclick='alert("Frontend only: Edit")'><i class='fa fa-edit'></i></button>
                  <button class='btn btn-sm btn-danger' onclick='removeMaterial(${mat.id})'><i class='fa fa-trash'></i></button>
                </div>
              </div>
            </div>
          `;
        });
        document.getElementById('materialsLoader').style.display = 'none';
      }, 50); // وقت مؤقت لمحاكاة التحميل
    }
    document.querySelectorAll('#filterBtns .btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('#filterBtns .btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        selectedType = this.getAttribute('data-type');
        renderMaterials();
      });
    });
    document.getElementById('materialSearch').addEventListener('input', renderMaterials);
    function removeMaterial(id) {
      const idx = materials.findIndex(m=>m.id===id);
      if(idx>-1) { materials.splice(idx,1); renderMaterials(); }
    }
    document.getElementById('saveMaterialBtn').onclick = function() {
      const title = document.getElementById('newMaterialTitle').value.trim();
      const type = document.getElementById('newMaterialType').value;
      const fileInput = document.getElementById('newMaterialFile');
      const file = fileInput.files[0];
      if(!title || !type || !file) return;
      const src = URL.createObjectURL(file);
      materials.unshift({
        id: Date.now(),
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