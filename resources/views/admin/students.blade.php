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
  </style>
</head>

<body class="g-sidenav-show">
  @include('admin.parts.sidebar-admin')
  
  <main class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <div class="filter-bar" id="courseFilterBar">
        <button type="button" class="filter-pill active" data-course="all">
          <span class="filter-icon"><i class="fas fa-users"></i></span>
          All <span class="count" id="all-count">0</span>
        </button>
        <button type="button" class="filter-pill" data-course="Mathematics">
          <span class="filter-icon"><i class="fas fa-calculator"></i></span>
          Mathematics <span class="count" id="math-count">0</span>
        </button>
        <button type="button" class="filter-pill" data-course="Science">
          <span class="filter-icon"><i class="fas fa-flask"></i></span>
          Science <span class="count" id="science-count">0</span>
        </button>
        <button type="button" class="filter-pill" data-course="English">
          <span class="filter-icon"><i class="fas fa-book"></i></span>
          English <span class="count" id="english-count">0</span>
        </button>
        <button type="button" class="filter-pill" data-course="History">
          <span class="filter-icon"><i class="fas fa-landmark"></i></span>
          History <span class="count" id="history-count">0</span>
        </button>
      </div>
      <div class="glass-search">
        <span class="search-icon"><i class="fas fa-search"></i></span>
        <input type="text" id="studentSearch" placeholder="Search student by name...">
        </div>
      <div class="students-count-bar" id="studentsCountBar">
        Showing <span id="current-count">0</span> students
          </div>
      <div class="students-table">
        <div class="table-responsive">
          <table class="table align-items-center mb-0">
            <thead>
              <tr>
                <th>Student</th>
                <th>Course</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="studentsList">
              <!-- Student rows will be populated by JavaScript -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>

  <!-- Core JS Files -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
  <script>
    // Sample student data
    const students = [
      {
        id: 1,
        name: 'Ali Hassan',
        course: 'Mathematics',
        img: 'https://randomuser.me/api/portraits/men/32.jpg',
        email: 'ali@example.com',
        phone: '+20 123 456 7890'
      },
      {
        id: 2,
        name: 'Sara Ahmed',
        course: 'Science',
        img: 'https://randomuser.me/api/portraits/women/44.jpg',
        email: 'sara@example.com',
        phone: '+20 123 456 7891'
      },
      {
        id: 3,
        name: 'John Smith',
        course: 'English',
        img: 'https://randomuser.me/api/portraits/men/45.jpg',
        email: 'john@example.com',
        phone: '+20 123 456 7892'
      },
      {
        id: 4,
        name: 'Mona Khaled',
        course: 'History',
        img: 'https://randomuser.me/api/portraits/women/65.jpg',
        email: 'mona@example.com',
        phone: '+20 123 456 7893'
      },
      {
        id: 5,
        name: 'Omar Youssef',
        course: 'Mathematics',
        img: 'https://randomuser.me/api/portraits/men/36.jpg',
        email: 'omar@example.com',
        phone: '+20 123 456 7894'
      },
      {
        id: 6,
        name: 'Lina Samir',
        course: 'Science',
        img: 'https://randomuser.me/api/portraits/women/50.jpg',
        email: 'lina@example.com',
        phone: '+20 123 456 7895'
      }
    ];

    let selectedCourse = 'all';

    function updateCourseCounts() {
      const counts = {
        'all': students.length,
        'Mathematics': students.filter(s => s.course === 'Mathematics').length,
        'Science': students.filter(s => s.course === 'Science').length,
        'English': students.filter(s => s.course === 'English').length,
        'History': students.filter(s => s.course === 'History').length
      };

      Object.keys(counts).forEach(course => {
        const countElement = document.getElementById(`${course.toLowerCase()}-count`);
        if (countElement) {
          countElement.textContent = counts[course];
        }
      });
    }

    function renderStudents() {
      const search = document.getElementById('studentSearch').value.toLowerCase();
      const list = document.getElementById('studentsList');
      list.innerHTML = '';

      const filteredStudents = students.filter(stu =>
        (selectedCourse === 'all' || stu.course === selectedCourse) &&
        (stu.name.toLowerCase().includes(search))
      );

      document.getElementById('current-count').textContent = filteredStudents.length;

      filteredStudents.forEach((stu, idx) => {
        let courseClass = '';
        if (stu.course === 'Mathematics') courseClass = 'math';
        if (stu.course === 'Science') courseClass = 'science';
        if (stu.course === 'English') courseClass = 'english';
        if (stu.course === 'History') courseClass = 'history';
        list.innerHTML += `
          <tr style="animation-delay:${idx * 0.07}s">
            <td>
              <div class="student-info">
                <img src="${stu.img}" class="student-avatar" alt="${stu.name}">
                <span class="student-name">${stu.name}</span>
            </div>
            </td>
            <td>
              <a href="#" class="student-course ${courseClass}">${stu.course}</a>
            </td>
            <td>
              <span class="student-contact"><i class="fas fa-envelope"></i> ${stu.email}</span>
            </td>
            <td>
              <span class="student-contact"><i class="fas fa-phone"></i> ${stu.phone}</span>
            </td>
            <td>
              <button class="message-btn" onclick="sendMessage('${stu.name}')">
                <i class="fas fa-paper-plane"></i>
                <span class="btn-text">Message</span>
              </button>
            </td>
          </tr>
        `;
      });
    }

    function sendMessage(studentName) {
      alert(`Message form will open for ${studentName}`);
      // Here you can implement the actual messaging functionality
    }

    // Event Listeners
    document.getElementById('studentSearch').addEventListener('input', renderStudents);

    document.querySelectorAll('.filter-pill').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('.filter-pill').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        selectedCourse = this.getAttribute('data-course');
        renderStudents();
      });
    });

    // Initialize
    window.onload = function() {
      updateCourseCounts();
      renderStudents();
    };
  </script>
</body>

</html> 