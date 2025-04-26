<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  
  <!-- Fonts & Styles -->
  <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">

  <title>Courses Page</title>

  <style>
    .site-nav,
    .site-nav .top-bar,
    .site-nav .sticky-nav {
      background-color: #136ad5 !important;
    }
    .site-nav a,
    .site-nav .small,
    .site-nav .logo,
    .site-nav .site-menu a,
    .site-nav .burger span {
      color: #fff !important;
    }
    .site-nav .icon-question-circle-o,
    .site-nav .icon-phone,
    .site-nav .icon-envelope {
      color: #fff !important;
    }

    /* أزرار تسجيل الدخول والتسجيل والبروفايل بشكل بسيط */
    .auth-btn {
      padding: 8px 16px;
      font-weight: 500;
      border-radius: 5px;
      font-size: 14px;
      background: white;
      color: #136ad5;
      border: 1px solid #136ad5;
      display: inline-flex;
      align-items: center;
      transition: 0.3s;
      margin-left: 8px;
    }
    .auth-btn:hover {
      background: #136ad5;
      color: white;
    }
    .auth-btn i {
      margin-right: 6px;
      font-size: 16px;
    }

    /* فلترة الكورسات */
    .filter-group .nav-link {
      border: 1px solid #136ad5;
      color: #136ad5;
      border-radius: 30px;
      padding: 5px 15px;
      transition: all 0.3s;
    }
    .filter-group .nav-link.active,
    .filter-group .nav-link:hover {
      background-color: #136ad5;
      color: white;
    }

    .course-card img {
      border-radius: 8px;
    }

    .price {
      font-weight: bold;
      color: #007bff;
    }

    .btn-white {
      background-color: #fff;
      color: #007bff;
      font-weight: 500;
      border: 2px solid #fff;
      transition: all 0.3s ease-in-out;
    }
    .btn-white:hover {
      background-color: #007bff;
      color: #fff;
      border-color: #fff;
    }
    .btn-white i {
      font-size: 1rem;
    }
    
  </style>
</head>

<body style="background-color: #f7f7f7;">

  <!-- MOBILE MENU -->
  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <!-- NAVBAR -->
  @include('parts/navbar')

  <br><br><br><br><br><br><br>

  <!-- FILTER NAV -->
  <div class="container my-5">
    <div class="d-flex justify-content-center">
      <ul class="nav filter-group flex-wrap list-unstyled" role="group" aria-label="فلترة الكورسات">
        <li class="nav-item mx-2">
          <a href="#" class="nav-link active" data-filter="all">الكل</a>
        </li>
        <li class="nav-item mx-2">
          <a href="#" class="nav-link" data-filter="secondary">الثانوي</a>
        </li>
        <li class="nav-item mx-2">
          <a href="#" class="nav-link" data-filter="prep">الإعدادي</a>
        </li>
        <li class="nav-item mx-2">
          <a href="#" class="nav-link" data-filter="languages">لغات</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- COURSES SECTION -->
  <div class="container">
    <div class="row" id="courses-container">
      <!-- Course 1 -->
      <div class="col-md-6 col-lg-4 mb-4 course-card" data-category="secondary">
        <div class="bg-white p-3 shadow-sm rounded h-100">
          <img src="images/img_1.jpg" alt="كورس ثانوي" class="img-fluid mb-3">
          <h5>الرياضيات للثانوي</h5>
          <p>شرح مفصل لمنهج الثانوية العامة في الرياضيات مع تمارين تفاعلية.</p>
          <div class="d-flex justify-content-between mt-3">
            <span class="price">$49</span>
            <a href="#" class="btn btn-sm btn-outline-primary">تفاصيل</a>
          </div>
        </div>
      </div>

      <!-- Course 2 -->
      <div class="col-md-6 col-lg-4 mb-4 course-card" data-category="prep">
        <div class="bg-white p-3 shadow-sm rounded h-100">
          <img src="https://via.placeholder.com/400x200" alt="كورس إعدادي" class="img-fluid mb-3">
          <h5>العلوم للمرحلة الإعدادية</h5>
          <p>محتوى علمي شيق ومبسط لتلاميذ الإعدادية مع أنشطة تفاعلية.</p>
          <div class="d-flex justify-content-between mt-3">
            <span class="price">$39</span>
            <a href="#" class="btn btn-sm btn-outline-primary">تفاصيل</a>
          </div>
        </div>
      </div>

      <!-- Course 3 -->
      <div class="col-md-6 col-lg-4 mb-4 course-card" data-category="languages">
        <div class="bg-white p-3 shadow-sm rounded h-100">
          <img src="https://via.placeholder.com/400x200" alt="كورس لغات" class="img-fluid mb-3">
          <h5>اللغة الإنجليزية للمبتدئين</h5>
          <p>تعلم قواعد ومفردات اللغة الإنجليزية من الصفر بطريقة سهلة.</p>
          <div class="d-flex justify-content-between mt-3">
            <span class="price">$29</span>
            <a href="#" class="btn btn-sm btn-outline-primary">تفاصيل</a>
          </div>
        </div>
      </div>

    </div>
  </div>

  <!-- SCRIPTS -->
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/aos.js"></script>
  <script>
    AOS.init();
  </script>

  <script>
    const buttons = document.querySelectorAll('.filter-group .nav-link');
    const cards = document.querySelectorAll('.course-card');

    buttons.forEach(button => {
      button.addEventListener('click', (e) => {
        e.preventDefault();
        buttons.forEach(btn => btn.classList.remove('active'));
        button.classList.add('active');

        const filter = button.getAttribute('data-filter');

        cards.forEach(card => {
          const category = card.getAttribute('data-category');
          if (filter === 'all' || filter === category) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    });
  </script>

</body>
</html>
