<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>استعراض الأساتذة</title>
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
      <h1 class="welcome-animated">استعراض الأساتذة</h1>
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
      .teachers-filters {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: flex-start;
        margin-bottom: 1.5rem;
      }
      .teachers-filters .filter-btn {
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
      .teachers-filters .filter-btn.active, .teachers-filters .filter-btn:hover {
        background: linear-gradient(90deg, #7b8cff, #5e72e4);
        opacity: 1;
      }
      .teachers-filters .filter-count {
        background: #fff;
        color: #7b8cff;
        border-radius: 1rem;
        padding: 0 0.6em;
        font-size: 0.9em;
        font-weight: bold;
      }
      .teachers-search-box {
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
      .teachers-search-box input {
        border: none;
        background: transparent;
        outline: none;
        width: 100%;
        font-size: 1.1rem;
        color: #333;
      }
      .teachers-table-header {
        background: linear-gradient(90deg, #7b8cff, #5e72e4);
        color: #fff;
        border-radius: 1rem 1rem 0 0;
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0;
      }
      .teachers-table th, .teachers-table td {
        vertical-align: middle !important;
      }
      .teachers-table .teacher-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #7b8cff;
        margin-left: 0.5rem;
      }
      .teachers-table .teacher-name {
        font-weight: bold;
        color: #3a3a7c;
        font-size: 1.1rem;
      }
      .teachers-table .teacher-specialization {
        font-weight: bold;
      }
      .teachers-table .teacher-action {
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
      .teachers-table .teacher-action:hover {
        background: #5e72e4;
        color: #fff;
      }
    </style>
    <div class="container-fluid py-4">
      <div class="teachers-filters mb-3">
        <button class="filter-btn active" type="button" data-specialization="all"><i class="fas fa-users"></i> All <span class="filter-count">3</span></button>
        <button class="filter-btn" type="button" data-specialization="mathematics"><i class="fas fa-calculator"></i> Mathematics <span class="filter-count">1</span></button>
        <button class="filter-btn" type="button" data-specialization="science"><i class="fas fa-flask"></i> Science <span class="filter-count">1</span></button>
        <button class="filter-btn" type="button" data-specialization="english"><i class="fas fa-language"></i> English <span class="filter-count">1</span></button>
      </div>
      <div class="teachers-search-box mb-3">
        <i class="fas fa-search" style="color:#7b8cff;font-size:1.3rem;"></i>
        <input type="text" id="teacherSearchInput" placeholder="Search teacher by name...">
      </div>
      <div class="teachers-table-header">Showing 3 teachers</div>
      <div class="table-responsive">
        <table class="table teachers-table align-middle mb-0">
          <thead>
            <tr>
              <th>Photo</th>
              <th>Name</th>
              <th>Specialization</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Contact</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="teachersTableBody">
            <tr data-specialization="mathematics">
              <td><img src="https://randomuser.me/api/portraits/men/50.jpg" class="teacher-img" alt="Ali Teacher"></td>
              <td><span class="teacher-name">Ali Teacher</span></td>
              <td><span class="teacher-specialization" style="color:#6c63ff">Mathematics</span></td>
              <td>ali.teacher@example.com</td>
              <td>+20 123 456 7000</td>
              <td><a href="https://wa.me/201234567000" target="_blank" class="teacher-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a></td>
              <td><div class="d-flex justify-content-center gap-2"><button class="teacher-action" title="Edit"><i class="fas fa-pen"></i></button><button class="teacher-action" title="Delete"><i class="fas fa-trash"></i></button></div></td>
            </tr>
            <tr data-specialization="science">
              <td><img src="https://randomuser.me/api/portraits/women/51.jpg" class="teacher-img" alt="Sara Teacher"></td>
              <td><span class="teacher-name">Sara Teacher</span></td>
              <td><span class="teacher-specialization" style="color:#00b894">Science</span></td>
              <td>sara.teacher@example.com</td>
              <td>+20 123 456 7001</td>
              <td><a href="https://wa.me/201234567001" target="_blank" class="teacher-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a></td>
              <td><div class="d-flex justify-content-center gap-2"><button class="teacher-action" title="Edit"><i class="fas fa-pen"></i></button><button class="teacher-action" title="Delete"><i class="fas fa-trash"></i></button></div></td>
            </tr>
            <tr data-specialization="english">
              <td><img src="https://randomuser.me/api/portraits/men/52.jpg" class="teacher-img" alt="John Teacher"></td>
              <td><span class="teacher-name">John Teacher</span></td>
              <td><span class="teacher-specialization" style="color:#fdcb6e">English</span></td>
              <td>john.teacher@example.com</td>
              <td>+20 123 456 7002</td>
              <td><a href="https://wa.me/201234567002" target="_blank" class="teacher-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a></td>
              <td><div class="d-flex justify-content-center gap-2"><button class="teacher-action" title="Edit"><i class="fas fa-pen"></i></button><button class="teacher-action" title="Delete"><i class="fas fa-trash"></i></button></div></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <script>
      // Instant search by name
      document.getElementById('teacherSearchInput').addEventListener('input', function() {
        const value = this.value.trim().toLowerCase();
        document.querySelectorAll('#teachersTableBody tr').forEach(row => {
          const name = row.querySelector('.teacher-name').textContent.toLowerCase();
          row.style.display = name.includes(value) ? '' : 'none';
        });
      });
      // Filtering by specialization
      document.querySelectorAll('.teachers-filters .filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
          document.querySelectorAll('.teachers-filters .filter-btn').forEach(b => b.classList.remove('active'));
          this.classList.add('active');
          const specialization = this.getAttribute('data-specialization');
          document.querySelectorAll('#teachersTableBody tr').forEach(row => {
            if (specialization === 'all' || row.getAttribute('data-specialization') === specialization) {
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