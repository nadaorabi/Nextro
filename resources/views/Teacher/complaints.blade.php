<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
     students Complaints
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
    .complaint-card {
      transition: all 0.3s ease;
    }
    .complaint-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .student-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }
    .status-badge {
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 0.8rem;
    }
    .status-pending {
      background-color: #ffd700;
      color: #000;
    }
    .status-replied {
      background-color: #28a745;
      color: #fff;
    }
    .search-box {
      border-radius: 20px;
      padding: 10px 20px;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('teacher.parts.sidebar-teacher')
  <div class="main-content position-relative max-height-vh-100 h-100">
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row align-items-center">
                <div class="col-6">
                  <h6 class="mb-0">شكاوى الطلاب</h6>
                </div>
                <div class="col-6 text-end">
                  <div class="input-group search-box">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="ابحث عن شكوى...">
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الطالب</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">الشكوى</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">التاريخ</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الحالة</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">الإجراءات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- شكوى 1 -->
                    <tr class="complaint-card">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="student-avatar me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">أحمد محمد</h6>
                            <p class="text-xs text-secondary mb-0">ahmed@example.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">مشكلة في المحتوى التعليمي</p>
                        <p class="text-xs text-secondary mb-0">المحتوى غير واضح بما فيه الكفاية</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">23/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="status-badge status-pending">معلق</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-link text-primary text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#replyModal">
                          <i class="fas fa-reply me-2"></i>رد
                        </button>
                        <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="fas fa-trash-alt me-2"></i>حذف
                        </button>
                      </td>
                    </tr>

                    <!-- شكوى 2 -->
                    <tr class="complaint-card">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="student-avatar me-3" alt="user2">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">سارة أحمد</h6>
                            <p class="text-xs text-secondary mb-0">sara@example.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">طلب توضيح إضافي</p>
                        <p class="text-xs text-secondary mb-0">أحتاج إلى مزيد من الشرح حول الدرس الأخير</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">22/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="status-badge status-replied">تم الرد</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-link text-primary text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#replyModal">
                          <i class="fas fa-reply me-2"></i>رد
                        </button>
                        <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="fas fa-trash-alt me-2"></i>حذف
                        </button>
                      </td>
                    </tr>

                    <!-- شكوى 3 -->
                    <tr class="complaint-card">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="https://randomuser.me/api/portraits/men/67.jpg" class="student-avatar me-3" alt="user3">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">محمد علي</h6>
                            <p class="text-xs text-secondary mb-0">mohammed@example.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">مشكلة تقنية</p>
                        <p class="text-xs text-secondary mb-0">لا يمكنني الوصول إلى المواد التعليمية</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">21/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="status-badge status-pending">معلق</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-link text-primary text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#replyModal">
                          <i class="fas fa-reply me-2"></i>رد
                        </button>
                        <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="fas fa-trash-alt me-2"></i>حذف
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- نافذة الرد -->
  <div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="replyModalLabel">الرد على الشكوى</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="replyMessage">ردك</label>
              <textarea class="form-control" id="replyMessage" rows="4" placeholder="اكتب ردك هنا..."></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
          <button type="button" class="btn btn-primary">إرسال الرد</button>
        </div>
      </div>
    </div>
  </div>

  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
  
  <script>
    // وظيفة البحث في الشكاوى
    document.addEventListener('DOMContentLoaded', function() {
      const searchInput = document.querySelector('.search-box input');
      const complaintRows = document.querySelectorAll('.complaint-card');

      searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();

        complaintRows.forEach(row => {
          const studentName = row.querySelector('h6').textContent.toLowerCase();
          const studentEmail = row.querySelector('p.text-secondary').textContent.toLowerCase();
          const complaintText = row.querySelector('td:nth-child(2) p').textContent.toLowerCase();
          const complaintDetails = row.querySelector('td:nth-child(2) p:last-child').textContent.toLowerCase();

          if (studentName.includes(searchTerm) || 
              studentEmail.includes(searchTerm) || 
              complaintText.includes(searchTerm) || 
              complaintDetails.includes(searchTerm)) {
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