<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>طلاب المعلم - {{ $teacher->name }}</title>
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
    .teacher-info-card {
      background: linear-gradient(45deg, #5e72e4, #825ee4);
      color: white;
      border-radius: 1rem;
      padding: 1.5rem;
      margin-bottom: 2rem;
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
      background: linear-gradient(90deg, #818cf8 0%, #6366f1 100%);
      font-weight: 700;
      color: #fff;
      padding: 16px 18px;
      border-bottom: 2px solid #e0e7ff;
      font-size: 1.01rem;
      letter-spacing: 0.5px;
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
    .course-badge {
      background: linear-gradient(45deg, #2dce89, #2dcecc);
      color: white;
      padding: 0.3rem 0.8rem;
      border-radius: 50px;
      font-size: 0.8rem;
      margin: 0.2rem;
      display: inline-block;
    }
    .package-badge {
      background: linear-gradient(45deg, #fb6340, #fbb140);
      color: white;
      padding: 0.3rem 0.8rem;
      border-radius: 50px;
      font-size: 0.8rem;
      margin: 0.2rem;
      display: inline-block;
    }
    .enrollment-type-badge {
      background: linear-gradient(45deg, #11cdef, #1171ef);
      color: white;
      padding: 0.2rem 0.6rem;
      border-radius: 50px;
      font-size: 0.7rem;
      margin: 0.1rem;
      display: inline-block;
    }
    .badge-status {
      font-size: 0.98em;
      padding: 6px 18px;
      border-radius: 999px;
      font-weight: 700;
      letter-spacing: 1px;
      background: #e0e7ff;
      color: #6366f1;
      border: none;
      display: inline-block;
    }
    .badge-status.active {
      background: linear-gradient(90deg, #2ecc71 0%, #27ae60 100%);
      color: #fff;
    }
    .badge-status.inactive {
      background: linear-gradient(90deg, #b0b7c3 0%, #636c72 100%);
      color: #fff;
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
  @include('teacher.parts.sidebar-teacher')
  
  <main class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <!-- معلومات المعلم -->
      <div class="teacher-info-card">
        <div class="row align-items-center">
          <div class="col-md-8">
            <h3 class="mb-2">
              <i class="fas fa-chalkboard-teacher me-2"></i>
              {{ $teacher->name }}
            </h3>
            <p class="mb-1">
              <i class="fas fa-id-card me-2"></i>
              ID: {{ $teacher->login_id }}
            </p>
            <p class="mb-1">
              <i class="fas fa-phone me-2"></i>
              Phone: {{ $teacher->mobile ?? 'Not set' }}
            </p>
            @if($teacher->email)
            <p class="mb-0">
              <i class="fas fa-envelope me-2"></i>
              Email: {{ $teacher->email }}
            </p>
            @endif
          </div>
          <div class="col-md-4 text-end">
            <div class="stats-card">
              <h4 class="mb-1">{{ $allStudents->count() }}</h4>
              <p class="mb-0 text-muted">Total Students</p>
            </div>
          </div>
        </div>
      </div>

      <!-- Filter Bar Modern -->
      <div class="row mb-3">
        <div class="col-md-4 mb-2">
          <select class="form-select" id="filterSelect">
            <option value="all">All Students</option>
            @foreach($teacherCourses as $courseInstructor)
              @php $course = $courseInstructor->course; @endphp
              <option value="course-{{ $course->id }}">Course: {{ $course->title }}</option>
            @endforeach
            @foreach($teacherPackages ?? [] as $package)
              <option value="package-{{ $package->id }}">Package: {{ $package->title }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-md-4 mb-2">
          <input type="text" id="studentSearch" class="form-control" placeholder="Search by student name...">
        </div>
      </div>

      <div class="students-count-bar" id="studentsCountBar">
        Showing <span id="current-count">{{ $allStudents->count() }}</span> students
      </div>

      <div class="card border-0 shadow-sm mt-0">
        <div class="card-body p-0">
          <div class="students-table">
            <div class="table-responsive">
              <table class="table align-items-center mb-0" id="studentsTable">
                <thead>
                  <tr>
                    <th>Student</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Registration Type</th>
                    <th>Course/Package</th>
                    <th>Registration Date</th>
                    <th>Status</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($allStudents as $student)
                  <tr data-course-id="{{ $student['course_id'] ?? '' }}" data-package-id="{{ $student['package_id'] ?? '' }}" data-type="{{ $student['enrollment_type'] }}" data-name="{{ strtolower($student['name']) }}">
                    <td>
                      <div class="student-info">
                        <img src="{{ asset($student['avatar'] ?? 'images/default-avatar.png') }}" class="student-avatar" alt="Avatar">
                        <span class="student-name">{{ $student['name'] }}</span>
                      </div>
                    </td>
                    <td>{{ $student['email'] ?? '-' }}</td>
                    <td>{{ $student['mobile'] ?? '-' }}</td>
                    <td>{{ ucfirst($student['enrollment_type'] ?? '-') }}</td>
                    <td>
                      @if(($student['enrollment_type'] ?? '') == 'course')
                        {{ $student['course_name'] ?? '-' }}
                      @elseif(($student['enrollment_type'] ?? '') == 'package')
                        {{ $student['package_name'] ?? '-' }}
                      @else
                        -
                      @endif
                    </td>
                    <td>{{ $student['registration_date'] ?? '-' }}</td>
                    <td>
                      @php
                        $status = strtolower($student['status'] ?? 'inactive');
                      @endphp
                      <span class="badge-status {{ $status == 'active' || $status == '1' ? 'active' : 'inactive' }}">
                        {{ ($status == 'active' || $status == '1') ? 'ACTIVE' : 'INACTIVE' }}
                      </span>
                    </td>
                  </tr>
                  @empty
                  <tr><td colspan="7" class="text-center text-muted">No students found.</td></tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
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
    // بيانات الطلاب من الخادم
    const students = @json($allStudents);
    const teacherCourses = @json($teacherCourses);

    let selectedCourse = 'all';

    function updateCourseCounts() {
      const counts = {
        'all': students.length,
        'direct_courses': students.filter(s => s.enrollment_type === 'course').length,
        'packages': students.filter(s => s.enrollment_type === 'package').length,
      };

      // إضافة عدد الطلاب لكل كورس
      teacherCourses.forEach(courseInstructor => {
        const courseTitle = courseInstructor.course.title;
        counts[courseTitle] = students.filter(student => 
          student.courses.some(course => course.title === courseTitle)
        ).length;
      });

      Object.keys(counts).forEach(course => {
        const countElement = document.getElementById(`${course.toLowerCase().replace(/\s+/g, '-')}-count`);
        if (countElement) {
          countElement.textContent = counts[course];
        }
      });
    }

    function renderStudents() {
      const search = document.getElementById('studentSearch').value.toLowerCase();
      const list = document.getElementById('studentsList');
      list.innerHTML = '';

      const filteredStudents = students.filter(stu => {
        const matchesSearch = stu.name.toLowerCase().includes(search);
        let matchesCourse = true;
        
        if (selectedCourse === 'all') {
          matchesCourse = true;
        } else if (selectedCourse === 'direct_courses') {
          matchesCourse = stu.enrollment_type === 'course';
        } else if (selectedCourse === 'packages') {
          matchesCourse = stu.enrollment_type === 'package';
        } else {
          matchesCourse = stu.courses.some(course => course.title === selectedCourse);
        }
        
        return matchesSearch && matchesCourse;
      });

      document.getElementById('current-count').textContent = filteredStudents.length;

      if (filteredStudents.length === 0) {
        list.innerHTML = `
          <tr>
            <td colspan="7" class="text-center text-muted py-4">
              <i class="fas fa-search fa-2x mb-3"></i>
              <p class="mb-0">لا توجد نتائج للبحث</p>
            </td>
          </tr>
        `;
        return;
      }

      filteredStudents.forEach((stu, idx) => {
        const coursesHtml = stu.courses.map(course => {
          let badgeClass = 'course-badge';
          let text = course.title;
          if (course.type === 'package_course') {
            text += ` <small>(${course.package_name})</small>`;
          }
          return `<span class="${badgeClass}">${text}</span>`;
        }).join('');

        const packagesHtml = stu.packages.map(package => 
          `<span class="package-badge">${package.title}</span>`
        ).join('');

        const enrollmentType = stu.enrollment_type === 'course' ? 'كورس مباشر' : 'بكج';

        list.innerHTML += `
          <tr style="animation-delay:${idx * 0.07}s">
            <td>
              <div class="student-info">
                <img src="${stu.avatar ? '{{ asset('') }}' + stu.avatar : '{{ asset('images/default-avatar.png') }}'" 
                     class="student-avatar" alt="${stu.name}"
                     onerror="this.src='{{ asset('images/default-avatar.png') }}'">
                <div>
                  <span class="student-name">${stu.name}</span>
                  <br>
                  <small class="text-muted">ID: ${stu.login_id}</small>
                </div>
              </div>
            </td>
            <td>${coursesHtml}</td>
            <td>${packagesHtml}</td>
            <td>
              <span class="enrollment-type-badge">${enrollmentType}</span>
            </td>
            <td>
              <span class="student-contact">
                <i class="fas fa-envelope"></i> 
                ${stu.email || 'غير محدد'}
              </span>
            </td>
            <td>
              <span class="student-contact">
                <i class="fas fa-phone"></i> 
                ${stu.mobile || 'غير محدد'}
              </span>
            </td>
            <td>
              <button class="message-btn" onclick="sendMessage('${stu.name}')">
                <i class="fas fa-paper-plane"></i>
                <span class="btn-text">رسالة</span>
              </button>
            </td>
          </tr>
        `;
      });
    }

    function sendMessage(studentName) {
      alert(`إرسال رسالة إلى ${studentName}`);
    }

    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
      updateCourseCounts();
      
      // Filter pills
      document.querySelectorAll('.filter-pill').forEach(pill => {
        pill.addEventListener('click', function() {
          document.querySelectorAll('.filter-pill').forEach(p => p.classList.remove('active'));
          this.classList.add('active');
          selectedCourse = this.dataset.course;
          renderStudents();
        });
      });

      // Search input
      document.getElementById('studentSearch').addEventListener('input', renderStudents);

      const filterSelect = document.getElementById('filterSelect');
      const studentsTable = document.getElementById('studentsTable');
      filterSelect.addEventListener('change', function() {
        const value = this.value;
        Array.from(studentsTable.tBodies[0].rows).forEach(row => {
          if (value === 'all') {
            row.style.display = '';
          } else if (value.startsWith('course-')) {
            const courseId = value.replace('course-', '');
            row.style.display = (row.getAttribute('data-type') === 'course' && row.getAttribute('data-course-id') === courseId) ? '' : 'none';
          } else if (value.startsWith('package-')) {
            const packageId = value.replace('package-', '');
            row.style.display = (row.getAttribute('data-type') === 'package' && row.getAttribute('data-package-id') === packageId) ? '' : 'none';
          } else {
            row.style.display = 'none';
          }
        });
      });
    });
  </script>
</body>

</html> 