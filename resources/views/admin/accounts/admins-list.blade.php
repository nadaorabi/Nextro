<!DOCTYPE html>
<html lang="ar">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>استعراض المسؤولين</title>
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
      <h1 class="welcome-animated">استعراض المسؤولين</h1>
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
      .admins-filters {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: flex-start;
        margin-bottom: 1.5rem;
      }
      .admins-filters .filter-btn {
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
      .admins-filters .filter-btn.active, .admins-filters .filter-btn:hover {
        background: linear-gradient(90deg, #7b8cff, #5e72e4);
        opacity: 1;
      }
      .admins-filters .filter-count {
        background: #fff;
        color: #7b8cff;
        border-radius: 1rem;
        padding: 0 0.6em;
        font-size: 0.9em;
        font-weight: bold;
      }
      .admins-search-box {
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
      .admins-search-box input {
        border: none;
        background: transparent;
        outline: none;
        width: 100%;
        font-size: 1.1rem;
        color: #333;
      }
      .admins-table-header {
        background: linear-gradient(90deg, #7b8cff, #5e72e4);
        color: #fff;
        border-radius: 1rem 1rem 0 0;
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        font-weight: bold;
        margin-bottom: 0;
      }
      .admins-table th, .admins-table td {
        vertical-align: middle !important;
      }
      .admins-table .admin-img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #7b8cff;
        margin-left: 0.5rem;
      }
      .admins-table .admin-name {
        font-weight: bold;
        color: #3a3a7c;
        font-size: 1.1rem;
      }
      .admins-table .admin-role {
        font-weight: bold;
      }
      .admins-table .admin-action {
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
      .admins-table .admin-action:hover {
        background: #5e72e4;
        color: #fff;
      }
    </style>
    <div class="container py-4">
      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-body text-center">
              <p class="lead">هذه الصفحة مخصصة لاستعراض جميع المسؤولين في النظام.</p>
              <!-- يمكنك إضافة جدول المسؤولين هنا لاحقاً -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="admins-filters mb-3">
        <button class="filter-btn active" type="button" data-role="all"><i class="fas fa-users-cog"></i> All <span class="filter-count">3</span></button>
        <button class="filter-btn" type="button" data-role="superadmin"><i class="fas fa-user-shield"></i> Super Admin <span class="filter-count">1</span></button>
        <button class="filter-btn" type="button" data-role="admin"><i class="fas fa-user-tie"></i> Admin <span class="filter-count">2</span></button>
      </div>
      <div class="admins-search-box mb-3">
        <i class="fas fa-search" style="color:#7b8cff;font-size:1.3rem;"></i>
        <input type="text" id="adminSearchInput" placeholder="Search admin by name...">
      </div>
      <div class="admins-table-header">Showing 3 admins</div>
      <div class="table-responsive">
        <table class="table admins-table align-middle mb-0">
          <thead>
            <tr>
              <th>Photo</th>
              <th>Name</th>
              <th>Role</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Contact</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody id="adminsTableBody">
            <tr data-role="superadmin">
              <td><img src="https://randomuser.me/api/portraits/men/60.jpg" class="admin-img" alt="Adam SuperAdmin"></td>
              <td><span class="admin-name">Adam SuperAdmin</span></td>
              <td><span class="admin-role" style="color:#e17055">Super Admin</span></td>
              <td>adam.superadmin@example.com</td>
              <td>+20 123 456 8000</td>
              <td><a href="https://wa.me/201234568000" target="_blank" class="admin-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a></td>
              <td><div class="d-flex justify-content-center gap-2"><button class="admin-action" title="Edit"><i class="fas fa-pen"></i></button><button class="admin-action" title="Delete"><i class="fas fa-trash"></i></button></div></td>
            </tr>
            <tr data-role="admin">
              <td><img src="https://randomuser.me/api/portraits/women/61.jpg" class="admin-img" alt="Lina Admin"></td>
              <td><span class="admin-name">Lina Admin</span></td>
              <td><span class="admin-role" style="color:#0984e3">Admin</span></td>
              <td>lina.admin@example.com</td>
              <td>+20 123 456 8001</td>
              <td><a href="https://wa.me/201234568001" target="_blank" class="admin-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a></td>
              <td><div class="d-flex justify-content-center gap-2"><button class="admin-action" title="Edit"><i class="fas fa-pen"></i></button><button class="admin-action" title="Delete"><i class="fas fa-trash"></i></button></div></td>
            </tr>
            <tr data-role="admin">
              <td><img src="https://randomuser.me/api/portraits/men/62.jpg" class="admin-img" alt="Omar Admin"></td>
              <td><span class="admin-name">Omar Admin</span></td>
              <td><span class="admin-role" style="color:#0984e3">Admin</span></td>
              <td>omar.admin@example.com</td>
              <td>+20 123 456 8002</td>
              <td><a href="https://wa.me/201234568002" target="_blank" class="admin-action" title="WhatsApp"><i class="fab fa-whatsapp" style="color:#25d366"></i></a></td>
              <td><div class="d-flex justify-content-center gap-2"><button class="admin-action" title="Edit"><i class="fas fa-pen"></i></button><button class="admin-action" title="Delete"><i class="fas fa-trash"></i></button></div></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </main>
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
  <script>
    // Instant search by name
    document.getElementById('adminSearchInput').addEventListener('input', function() {
      const value = this.value.trim().toLowerCase();
      document.querySelectorAll('#adminsTableBody tr').forEach(row => {
        const name = row.querySelector('.admin-name').textContent.toLowerCase();
        row.style.display = name.includes(value) ? '' : 'none';
      });
    });
    // Filtering by role
    document.querySelectorAll('.admins-filters .filter-btn').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.admins-filters .filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        const role = this.getAttribute('data-role');
        document.querySelectorAll('#adminsTableBody tr').forEach(row => {
          if (role === 'all' || row.getAttribute('data-role') === role) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });
      });
    });
  </script>
</body>
</html> 