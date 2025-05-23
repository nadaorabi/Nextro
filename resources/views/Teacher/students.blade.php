<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    Students - Teacher Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
  <style>
    #courseFilterBtns .btn {
      background: #fff;
      color: #344767;
      border: none;
      font-weight: 600;
      box-shadow: none;
      border-radius: 20px;
      margin-right: 6px;
      transition: background 0.2s, color 0.2s;
      padding: 6px 22px;
    }
    #courseFilterBtns .btn.active, #courseFilterBtns .btn:active {
      background:rgb(184, 191, 231);
      color: #fff;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100" style="background: rgb(135, 149, 229);">
  @include('teacher.parts.sidebar-teacher')
  
  <main class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <div class="row mb-4">
        <div class="col-md-4 mb-2">
          <input type="text" id="studentSearch" class="form-control" placeholder="Search student by name...">
        </div>
        <div class="col-md-8 mb-2 d-flex align-items-center">
          <div id="courseFilterBtns" class="btn-group" role="group">
            <button type="button" class="btn btn-outline-primary active" data-course="all">All</button>
            <button type="button" class="btn btn-outline-primary" data-course="Mathematics">Mathematics</button>
            <button type="button" class="btn btn-outline-primary" data-course="Science">Science</button>
            <button type="button" class="btn btn-outline-primary" data-course="English">English</button>
            <button type="button" class="btn btn-outline-primary" data-course="History">History</button>
          </div>
        </div>
      </div>
      <div class="row" id="studentsList">
        <!-- بطاقات الطلاب ستملأ تلقائياً بالجافاسكريبت -->
      </div>
    </div>
  </main>

  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
  <script>
    // بيانات وهمية للطلاب
    const students = [
      {id:1, name:'Ali Hassan', course:'Mathematics', img:'https://randomuser.me/api/portraits/men/32.jpg', email:'ali@example.com'},
      {id:2, name:'Sara Ahmed', course:'Science', img:'https://randomuser.me/api/portraits/women/44.jpg', email:'sara@example.com'},
      {id:3, name:'John Smith', course:'English', img:'https://randomuser.me/api/portraits/men/45.jpg', email:'john@example.com'},
      {id:4, name:'Mona Khaled', course:'History', img:'https://randomuser.me/api/portraits/women/65.jpg', email:'mona@example.com'},
      {id:5, name:'Omar Youssef', course:'Mathematics', img:'https://randomuser.me/api/portraits/men/36.jpg', email:'omar@example.com'},
      {id:6, name:'Lina Samir', course:'Science', img:'https://randomuser.me/api/portraits/women/50.jpg', email:'lina@example.com'},
    ];

    let selectedCourse = 'all';
    function renderStudents() {
      const search = document.getElementById('studentSearch').value.toLowerCase();
      const list = document.getElementById('studentsList');
      list.innerHTML = '';
      students.filter(stu =>
        (selectedCourse === 'all' || stu.course === selectedCourse) &&
        (stu.name.toLowerCase().includes(search))
      ).forEach(stu => {
        list.innerHTML += `
          <div class="col-md-4 mb-4">
            <div class="card h-100 text-center p-3">
              <img src="${stu.img}" class="rounded-circle mx-auto mb-3" style="width:90px;height:90px;object-fit:cover;">
              <h5 class="mb-1">${stu.name}</h5>
              <p class="mb-1 text-secondary">${stu.course}</p>
              <p class="mb-2 text-xs">${stu.email}</p>
              <button class="btn btn-primary btn-sm"><i class="fa fa-envelope me-1"></i>Send Message</button>
            </div>
          </div>
        `;
      });
    }
    document.getElementById('studentSearch').addEventListener('input', renderStudents);
    document.querySelectorAll('#courseFilterBtns button').forEach(btn => {
      btn.addEventListener('click', function() {
        document.querySelectorAll('#courseFilterBtns button').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        selectedCourse = this.getAttribute('data-course');
        renderStudents();
      });
    });
    window.onload = renderStudents;
  </script>
</body>

</html> 