<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>Student List</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>
<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')
  <main class="main-content position-relative border-radius-lg ">
    <div class="container mt-4 text-center">
      <h1 class="welcome-animated">Student List</h1>
    </div>
    <style>
      .welcome-animated {
        display: inline-block;
        font-size: 2.5rem;
        font-weight: bold;
        color: #007bff;
        animation: bounce 1.5s infinite alternate, gradientMove 3s linear infinite;
        letter-spacing: 2px;
        margin-top: 20px;
        background: linear-gradient(90deg, #007bff, #00c6ff, #007bff);
        background-size: 200% 200%;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
      }
      @keyframes bounce {
        0%   { transform: translateY(0); }
        100% { transform: translateY(-20px); }
      }
      @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
      }
      .students-filters {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: flex-start;
        margin-bottom: 1.5rem;
      }
      .students-filters .filter-btn {
        background: #7b8cff;
        color: #fff;
        border: none;
        border-radius: 2rem;
        padding: 0.5rem 1.2rem;
        font-weight: bold;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        opacity: 0.85;
        transition: background 0.2s, opacity 0.2s;
      }
      .students-filters .filter-btn.active, .students-filters .filter-btn:hover {
        background: linear-gradient(90deg, #7b8cff, #5e72e4);
        opacity: 1;
      }
      .students-filters .filter-count {
        background: #fff;
        color: #7b8cff;
        border-radius: 1rem;
        padding: 0 0.6em;
        font-size: 0.9em;
        font-weight: bold;
      }
      .students-search-box {
        background: #e3eaff;
        border-radius: 2rem;
        padding: 0.7rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.7rem;
        margin-bottom: 1.5rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
      }
      .students-search-box input {
        border: none;
        background: transparent;
        outline: none;
        width: 100%;
        font-size: 1.1rem;
        color: #333;
      }
      .students-table-header {
        background: linear-gradient(90deg, #7b8cff, #5e72e4);
        color: #fff;
        border-radius: 1rem 1rem 0 0;
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0;
      }
      .students-table th, .students-table td {
        vertical-align: middle !important;
      }
      .students-table .student-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #7b8cff;
        margin-left: 0.5rem;
      }
      .students-table .student-name {
        font-weight: bold;
        color: #3a3a7c;
        font-size: 1.1rem;
      }
      .students-table .student-course {
        font-weight: bold;
      }
      .students-table .student-action {
        font-size: 1.3rem;
        color: #5e72e4;
        background: #e3eaff;
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 2px;
        transition: background 0.2s, color 0.2s;
        border: none;
      }
      .students-table .student-action:hover {
        background: #5e72e4;
        color: #fff;
      }
    </style>
    <div class="container-fluid py-4">
      <div class="students-filters mb-3">
        <button class="filter-btn active" type="button" data-course="all"><i class="fas fa-users"></i> All <span class="filter-count">6</span></button>
        <button class="filter-btn" type="button" data-course="mathematics"><i class="fas fa-calculator"></i> Mathematics <span class="filter-count">0</span></button>
        <button class="filter-btn" type="button" data-course="science"><i class="fas fa-flask"></i> Science <span class="filter-count">2</span></button>
        <button class="filter-btn" type="button" data-course="english"><i class="fas fa-language"></i> English <span class="filter-count">1</span></button>
        <button class="filter-btn" type="button" data-course="history"><i class="fas fa-university"></i> History <span class="filter-count">1</span></button>
      </div>
      <div class="students-search-box mb-3">
        <i class="fas fa-search" style="color:#7b8cff;font-size:1.3rem;"></i>
        <input type="text" id="studentSearchInput" placeholder="Search student by name...">
      </div>
      <div class="students-table-header">Showing 6 students</div>
      <div class="table-responsive">
        <table class="table students-table align-middle mb-0">
          <thead>
            <tr>
              <th>Student</th>
              <th>Course</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Contact</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="studentsTableBody">
            <tr data-course="mathematics">
              <td>
                <img src="https://randomuser.me/api/portraits/men/32.jpg" class="student-img" alt="Ali Hassan">
                <span class="student-name">Ali Hassan</span>
              </td>
              <td><span class="student-course" style="color:#6c63ff">Mathematics</span></td>
              <td><i class="fas fa-envelope me-1"></i> ali@example.com</td>
              <td><i class="fas fa-phone me-1"></i> +20 123 456 7890</td>
              <td>
                <a href="https://wa.me/201234567890" target="_blank" class="student-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>
              </td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <button class="student-action" title="Edit"><i class="fas fa-pen"></i></button>
                  <button class="student-action" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
            <tr data-course="science">
              <td>
                <img src="https://randomuser.me/api/portraits/women/44.jpg" class="student-img" alt="Sara Ahmed">
                <span class="student-name">Sara Ahmed</span>
              </td>
              <td><span class="student-course" style="color:#00b894">Science</span></td>
              <td><i class="fas fa-envelope me-1"></i> sara@example.com</td>
              <td><i class="fas fa-phone me-1"></i> +20 123 456 7891</td>
              <td>
                <a href="https://wa.me/201234567891" target="_blank" class="student-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>
              </td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <button class="student-action" title="Edit"><i class="fas fa-pen"></i></button>
                  <button class="student-action" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
            <tr data-course="english">
              <td>
                <img src="https://randomuser.me/api/portraits/men/45.jpg" class="student-img" alt="John Smith">
                <span class="student-name">John Smith</span>
              </td>
              <td><span class="student-course" style="color:#fdcb6e">English</span></td>
              <td><i class="fas fa-envelope me-1"></i> john@example.com</td>
              <td><i class="fas fa-phone me-1"></i> +20 123 456 7892</td>
              <td>
                <a href="https://wa.me/201234567892" target="_blank" class="student-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>
              </td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <button class="student-action" title="Edit"><i class="fas fa-pen"></i></button>
                  <button class="student-action" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
            <tr data-course="science">
              <td>
                <img src="https://randomuser.me/api/portraits/men/46.jpg" class="student-img" alt="Omar Khaled">
                <span class="student-name">Omar Khaled</span>
              </td>
              <td><span class="student-course" style="color:#00b894">Science</span></td>
              <td><i class="fas fa-envelope me-1"></i> omar@example.com</td>
              <td><i class="fas fa-phone me-1"></i> +20 123 456 7893</td>
              <td>
                <a href="https://wa.me/201234567893" target="_blank" class="student-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>
              </td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <button class="student-action" title="Edit"><i class="fas fa-pen"></i></button>
                  <button class="student-action" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
            <tr data-course="mathematics">
              <td>
                <img src="https://randomuser.me/api/portraits/women/47.jpg" class="student-img" alt="Nada Adel">
                <span class="student-name">Nada Adel</span>
              </td>
              <td><span class="student-course" style="color:#6c63ff">Mathematics</span></td>
              <td><i class="fas fa-envelope me-1"></i> nada@example.com</td>
              <td><i class="fas fa-phone me-1"></i> +20 123 456 7894</td>
              <td>
                <a href="https://wa.me/201234567894" target="_blank" class="student-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>
              </td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <button class="student-action" title="Edit"><i class="fas fa-pen"></i></button>
                  <button class="student-action" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
            <tr data-course="history">
              <td>
                <img src="https://randomuser.me/api/portraits/men/48.jpg" class="student-img" alt="Kareem Samir">
                <span class="student-name">Kareem Samir</span>
              </td>
              <td><span class="student-course" style="color:#636e72">History</span></td>
              <td><i class="fas fa-envelope me-1"></i> kareem@example.com</td>
              <td><i class="fas fa-phone me-1"></i> +20 123 456 7895</td>
              <td>
                <a href="https://wa.me/201234567895" target="_blank" class="student-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a>
              </td>
              <td>
                <div class="d-flex justify-content-center gap-2">
                  <button class="student-action" title="Edit"><i class="fas fa-pen"></i></button>
                  <button class="student-action" title="Delete"><i class="fas fa-trash"></i></button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script>
      // بحث فوري بالاسم
      document.getElementById('studentSearchInput').addEventListener('input', function() {
        const value = this.value.trim().toLowerCase();
        document.querySelectorAll('#studentsTableBody tr').forEach(row => {
          const name = row.querySelector('.student-name').textContent.toLowerCase();
          row.style.display = name.includes(value) ? '' : 'none';
        });
      });

      // فلترة حسب الكورس
      document.querySelectorAll('.students-filters .filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          document.querySelectorAll('.students-filters .filter-btn').forEach(b => b.classList.remove('active'));
          this.classList.add('active');
          const course = this.getAttribute('data-course');
          document.querySelectorAll('#studentsTableBody tr').forEach(row => {
            if (course === 'all' || row.getAttribute('data-course') === course) {
              row.style.display = '';
            } else {
              row.style.display = 'none';
            }
          });
        });
      });
    </script>
  </main>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>
</html> 