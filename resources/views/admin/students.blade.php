<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>Students</title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Cairo:wght@400;700&display=swap" rel="stylesheet">
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', 'Cairo', sans-serif;
      background: linear-gradient(135deg, #e0e7ff 0%, #f5f7fa 100%);
      min-height: 100vh;
    }
    .filter-bar {
      display: flex;
      gap: 12px;
      overflow-x: auto;
      padding-bottom: 8px;
      margin-bottom: 18px;
      scrollbar-width: thin;
      scrollbar-color: #a5b4fc #f3f4f6;
    }
    .filter-pill {
      display: flex;
      align-items: center;
      gap: 7px;
      background: linear-gradient(90deg, #6366f1 0%, #a5b4fc 100%);
      color: #fff;
      border: none;
      border-radius: 999px;
      padding: 10px 22px;
      font-weight: 600;
      font-size: 1rem;
      box-shadow: 0 2px 8px rgba(99,102,241,0.08);
      cursor: pointer;
      transition: transform 0.15s, box-shadow 0.15s, background 0.3s;
      position: relative;
      outline: none;
      min-width: 120px;
      opacity: 0.85;
    }
    .filter-pill .filter-icon {
      font-size: 1.1em;
      animation: filterIconPulse 1.5s infinite alternate;
    }
    @keyframes filterIconPulse {
      0% { transform: scale(1); }
      100% { transform: scale(1.18); }
    }
    .filter-pill.active, .filter-pill:focus {
      background: linear-gradient(90deg, #6366f1 0%, #818cf8 100%);
      box-shadow: 0 4px 16px rgba(99,102,241,0.13);
      transform: scale(1.06);
      opacity: 1;
    }
    .filter-pill .count {
      background: rgba(255,255,255,0.18);
      border-radius: 999px;
      padding: 2px 10px;
      font-size: 0.9em;
      margin-left: 6px;
      font-weight: 700;
    }
    .glass-search {
      position: relative;
      margin: 0 auto 28px auto;
      max-width: 400px;
      width: 100%;
    }
    .glass-search input {
      width: 100%;
      background: rgba(255,255,255,0.55);
      border: none;
      border-radius: 30px;
      padding: 15px 22px 15px 50px;
      font-size: 1.08rem;
      box-shadow: 0 4px 16px rgba(99,102,241,0.07);
      transition: box-shadow 0.2s, background 0.2s;
      color: #3730a3;
      font-family: inherit;
    }
    .glass-search input:focus {
      background: rgba(255,255,255,0.85);
      box-shadow: 0 8px 24px rgba(99,102,241,0.13);
      outline: none;
    }
    .glass-search .search-icon {
      position: absolute;
      left: 18px;
      top: 50%;
      transform: translateY(-50%);
      color: #6366f1;
      font-size: 1.2em;
      animation: searchIconFloat 2s infinite alternate;
    }
    @keyframes searchIconFloat {
      0% { transform: translateY(-50%) scale(1); }
      100% { transform: translateY(-60%) scale(1.13); }
    }
    .students-count-bar {
      background: linear-gradient(90deg, #818cf8 0%, #a5b4fc 100%);
      color: #fff;
      border-radius: 10px 10px 0 0;
      padding: 8px 22px;
      font-weight: 600;
      font-size: 1.08rem;
      margin-bottom: 0;
      box-shadow: 0 2px 8px rgba(99,102,241,0.07);
      letter-spacing: 0.5px;
    }
    .students-table {
      background: rgba(255,255,255,0.97);
      border-radius: 0 0 18px 18px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(99,102,241,0.09);
    }
    .students-table table {
      margin: 0;
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
    }
    .students-table th {
      background: #f3f4f6;
      font-weight: 700;
      color: #3730a3;
      padding: 16px 18px;
      border-bottom: 2px solid #e0e7ff;
      font-size: 1.01rem;
    }
    .students-table td {
      padding: 15px 18px;
      vertical-align: middle;
      border-bottom: 1px solid #f1f5f9;
      background: transparent;
      font-size: 1.01rem;
      transition: background 0.18s;
    }
    .students-table tr {
      opacity: 0;
      animation: fadeInRow 0.7s forwards;
    }
    .students-table tr:nth-child(even) td {
      background: #f8fafc;
    }
    .students-table tr:hover td {
      background: #eef2ff;
    }
    @keyframes fadeInRow {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: none; }
    }
    .student-avatar {
      width: 44px;
      height: 44px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid;
      border-image: linear-gradient(135deg, #6366f1, #a5b4fc) 1;
      box-shadow: 0 2px 8px rgba(99,102,241,0.09);
      margin-right: 10px;
    }
    .student-info {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .student-name {
      font-weight: 700;
      color: #3730a3;
      margin: 0;
      font-size: 1.08rem;
    }
    .student-course {
      font-weight: 600;
      margin: 0;
      text-decoration: none;
      transition: color 0.2s;
    }
    .student-course.math { color: #6366f1; }
    .student-course.science { color: #059669; }
    .student-course.english { color: #f59e42; }
    .student-course.history { color: #e11d48; }
    .student-contact {
      color: #64748b;
      font-size: 0.97rem;
      margin: 0;
      display: flex;
      align-items: center;
      gap: 5px;
    }
    .message-btn {
      background: linear-gradient(135deg, #6366f1 0%, #818cf8 100%);
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 44px;
      height: 44px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25em;
      box-shadow: 0 2px 8px rgba(99,102,241,0.13);
      transition: box-shadow 0.2s, background 0.2s, width 0.2s;
      position: relative;
      overflow: hidden;
      cursor: pointer;
    }
    .message-btn .btn-text {
      display: none;
      margin-left: 8px;
      font-size: 1rem;
      font-weight: 600;
      white-space: nowrap;
    }
    .message-btn:hover, .message-btn:focus {
      background: linear-gradient(90deg, #818cf8 0%, #6366f1 100%);
      box-shadow: 0 4px 16px rgba(99,102,241,0.18);
      width: 120px;
      border-radius: 30px;
    }
    .message-btn:hover .btn-text, .message-btn:focus .btn-text {
      display: inline;
      animation: fadeInText 0.3s;
    }
    @keyframes fadeInText {
      from { opacity: 0; transform: translateX(-10px); }
      to { opacity: 1; transform: none; }
    }
    @media (max-width: 900px) {
      .students-table th, .students-table td {
        padding: 10px 8px;
        font-size: 0.97rem;
      }
      .students-count-bar {
        padding: 7px 10px;
        font-size: 0.98rem;
      }
    }
    @media (max-width: 600px) {
      .students-table th, .students-table td {
        padding: 7px 4px;
        font-size: 0.93rem;
      }
      .student-avatar {
        width: 34px; height: 34px;
      }
      .filter-bar {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px 8px;
        width: 100%;
        margin-bottom: 16px;
        padding: 0 2px 8px 2px;
      }
      .filter-pill {
        width: 100%;
        min-width: 0;
        justify-content: center;
        font-size: 0.97rem;
        padding: 10px 0;
      }
      .glass-search input {
        padding: 12px 12px 12px 38px;
        font-size: 0.97rem;
      }
    }
    .modal-lg { max-width: 500px; }
    .qr-preview { display: flex; flex-direction: column; align-items: center; margin-top: 10px; }
    .students-table th, .students-table td { vertical-align: middle; }
    .student-avatar { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; margin-right: 8px; }
    .table thead { background: #f1f5f9; }
    .table-striped > tbody > tr:nth-of-type(odd) { background-color: #f6faff; }
    .badge { font-size: 0.95em; }
    .btn { font-size: 0.95em; }
    .modal-lg { max-width: 420px; }
    .qr-preview { display: flex; flex-direction: column; align-items: center; margin-top: 10px; }
    .form-label { font-weight: 600; }
    @media (max-width: 600px) {
      .students-table th, .students-table td { font-size: 0.93rem; padding: 8px 4px; }
      .student-avatar { width: 30px; height: 30px; }
      .modal-lg { max-width: 98vw; }
    }
  </style>
</head>

<body class="g-sidenav-show">
  @include('admin.parts.sidebar-admin')
  
  <main class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <h2 class="fw-bold text-primary mb-0">Students Management</h2>
        <button class="btn btn-success shadow-sm px-4" data-bs-toggle="modal" data-bs-target="#addStudentModal">
          <i class="fas fa-user-plus me-1"></i> Add Student
        </button>
      </div>
      <div class="row g-2 mb-3">
        <div class="col-12 col-md-4">
          <input type="text" id="searchInput" class="form-control shadow-sm" placeholder="Search by name or email...">
        </div>
        <div class="col-6 col-md-3">
          <select id="courseFilter" class="form-select shadow-sm">
            <option value="">All Courses</option>
            <option>Mathematics</option>
            <option>Science</option>
            <option>English</option>
            <option>History</option>
          </select>
        </div>
        <div class="col-6 col-md-3">
          <select id="statusFilter" class="form-select shadow-sm">
            <option value="">All Status</option>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
          </select>
        </div>
      </div>
      <div class="students-count-bar" id="studentsCountBar">
        Showing <span id="current-count">0</span> students
      </div>
      <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-hover table-striped students-table mb-0 align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Course</th>
                  <th>Status</th>
                  <th>QR</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody id="studentsTableBody">
                <!-- Students will be rendered here -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Add Student Modal -->
  <div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold" id="addStudentModalLabel">Add New Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="addStudentForm">
            <div class="mb-3">
              <label for="studentName" class="form-label">Name</label>
              <input type="text" class="form-control" id="studentName" required>
            </div>
            <div class="mb-3">
              <label for="studentEmail" class="form-label">Email</label>
              <input type="email" class="form-control" id="studentEmail" required>
            </div>
            <div class="mb-3">
              <label for="studentPhone" class="form-label">Phone</label>
              <input type="text" class="form-control" id="studentPhone" required>
            </div>
            <div class="mb-3">
              <label for="studentCourse" class="form-label">Course</label>
              <select class="form-select" id="studentCourse" required>
                <option value="">Select Course</option>
                <option>Mathematics</option>
                <option>Science</option>
                <option>English</option>
                <option>History</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success w-100">Save</button>
          </form>
          <div id="studentResult" class="mt-4" style="display:none;">
            <h6 class="fw-bold text-success mb-2">Student Created!</h6>
            <div class="mb-2"><b>Password:</b> <span id="generatedPassword" class="text-primary"></span></div>
            <div class="qr-preview">
              <canvas id="studentQR"></canvas>
              <div class="mt-2"><b>QR Code (unique):</b></div>
              <div id="qrValue" class="small text-muted"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Core JS Files -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Sample data
    let students = [
      {id: 1, name: 'Ali Hassan', email: 'ali@example.com', phone: '+20 123 456 7890', course: 'Mathematics', status: 'active', qr: 'QR1', password: 'pass1', img: 'https://randomuser.me/api/portraits/men/32.jpg'},
      {id: 2, name: 'Sara Ahmed', email: 'sara@example.com', phone: '+20 123 456 7891', course: 'Science', status: 'inactive', qr: 'QR2', password: 'pass2', img: 'https://randomuser.me/api/portraits/women/44.jpg'},
    ];

    function renderStudents() {
      const tbody = document.getElementById('studentsTableBody');
      const search = document.getElementById('searchInput').value.toLowerCase();
      const course = document.getElementById('courseFilter').value;
      const status = document.getElementById('statusFilter').value;
      tbody.innerHTML = '';
      let filtered = students.filter(s =>
        (s.name.toLowerCase().includes(search) || s.email.toLowerCase().includes(search)) &&
        (course === '' || s.course === course) &&
        (status === '' || s.status === status)
      );
      filtered.forEach((s, i) => {
        tbody.innerHTML += `<tr>
          <td>${i+1}</td>
          <td><div class="d-flex align-items-center"><img src="${s.img}" class="student-avatar" alt="${s.name}"><span class="student-name">${s.name}</span></div></td>
          <td>${s.email}</td>
          <td><span class="badge bg-light text-dark">${s.course}</span></td>
          <td><span class="badge bg-${s.status==='active'?'success':'secondary'}">${s.status.charAt(0).toUpperCase()+s.status.slice(1)}</span></td>
          <td><span class="badge bg-info">${s.qr}</span></td>
          <td>
            <button class="btn btn-sm btn-outline-info me-1" onclick="viewStudent(${s.id})"><i class="fas fa-eye"></i></button>
            <button class="btn btn-sm btn-outline-warning me-1" onclick="editStudent(${s.id})"><i class="fas fa-edit"></i></button>
            <button class="btn btn-sm btn-outline-danger" onclick="deleteStudent(${s.id})"><i class="fas fa-trash"></i></button>
          </td>
        </tr>`;
      });
      document.getElementById('current-count').textContent = filtered.length;
    }

    document.getElementById('searchInput').addEventListener('input', renderStudents);
    document.getElementById('courseFilter').addEventListener('change', renderStudents);
    document.getElementById('statusFilter').addEventListener('change', renderStudents);

    // Add Student Modal Logic
    const addStudentForm = document.getElementById('addStudentForm');
    addStudentForm.onsubmit = function(e) {
      e.preventDefault();
      // Generate password and QR
      const password = Math.random().toString(36).slice(-8);
      const qrValue = 'STU-' + Date.now() + '-' + Math.random().toString(36).substr(2,6);
      // Add to students array
      const newStudent = {
        id: students.length+1,
        name: document.getElementById('studentName').value,
        email: document.getElementById('studentEmail').value,
        phone: document.getElementById('studentPhone').value,
        course: document.getElementById('studentCourse').value,
        status: 'active',
        qr: qrValue,
        password: password,
        img: 'https://randomuser.me/api/portraits/men/' + (30 + Math.floor(Math.random()*50)) + '.jpg'
      };
      students.push(newStudent);
      renderStudents();
      // Show result
      document.getElementById('studentResult').style.display = '';
      document.getElementById('generatedPassword').textContent = password;
      document.getElementById('qrValue').textContent = qrValue;
      // Generate QR code
      const qr = new QRious({
        element: document.getElementById('studentQR'),
        value: qrValue,
        size: 120
      });
      // Reset form fields
      addStudentForm.reset();
      // Hide result after 6 seconds and close modal
      setTimeout(()=>{
        document.getElementById('studentResult').style.display = 'none';
        var modal = bootstrap.Modal.getInstance(document.getElementById('addStudentModal'));
        modal.hide();
      }, 6000);
    };

    function viewStudent(id) {
      alert('View student #' + id);
    }
    function editStudent(id) {
      alert('Edit student #' + id);
    }
    function deleteStudent(id) {
      if(confirm('Delete student #' + id + '?')) {
        students = students.filter(s => s.id !== id);
        renderStudents();
      }
    }

    // Initial render
    renderStudents();
  </script>
</body>

</html> 