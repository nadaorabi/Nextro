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
      box-shadow: 0 5px 15px rgba(99,102,241,0.13);
    }
    .student-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }
    .status-badge {
      padding: 5px 14px;
      border-radius: 20px;
      font-size: 0.9rem;
      font-weight: 600;
      letter-spacing: 0.5px;
      box-shadow: 0 2px 8px rgba(99,102,241,0.07);
    }
    .status-pending {
      background: #ffe066;
      color: #7c6f00;
    }
    .status-replied {
      background: #38bdf8;
      color: #fff;
    }
    .search-box {
      border-radius: 20px;
      padding: 10px 20px;
      background: #f3f4f6;
      box-shadow: 0 2px 8px rgba(99,102,241,0.04);
    }
    .search-box input {
      border-radius: 20px;
      background: #f3f4f6;
      border: none;
      font-size: 1rem;
    }
    .search-box input:focus {
      background: #fff;
      box-shadow: 0 2px 8px rgba(99,102,241,0.10);
      outline: none;
    }
    .card {
      border-radius: 18px;
      box-shadow: 0 2px 12px rgba(99,102,241,0.08);
    }
    .modal-content {
      border-radius: 16px;
      box-shadow: 0 4px 24px rgba(99,102,241,0.13);
      border: none;
    }
    .modal-header {
      border-bottom: none;
      padding-bottom: 0.5rem;
    }
    .modal-title {
      font-weight: 700;
      color: #3730a3;
      font-size: 1.25rem;
    }
    .modal-footer {
      border-top: none;
      padding-top: 0.5rem;
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }
    .modal .form-label {
      font-weight: 600;
      color: #6366f1;
      margin-bottom: 4px;
    }
    .modal .form-control {
      border-radius: 10px;
      border: 1.5px solid #e0e7ff;
      font-size: 1rem;
      padding: 10px 14px;
      margin-bottom: 14px;
      box-shadow: 0 1px 4px rgba(99,102,241,0.04);
      transition: border 0.2s;
    }
    .modal .form-control:focus {
      border: 1.5px solid #6366f1;
      outline: none;
      box-shadow: 0 2px 8px rgba(99,102,241,0.10);
    }
    .modal .btn-primary {
      background: linear-gradient(90deg, #6366f1 0%, #818cf8 100%);
      border: none;
      border-radius: 10px;
      font-weight: 600;
      padding: 8px 28px;
      font-size: 1rem;
      box-shadow: 0 2px 8px rgba(99,102,241,0.13);
      transition: box-shadow 0.2s, background 0.2s;
    }
    .modal .btn-primary:hover {
      background: linear-gradient(90deg, #818cf8 0%, #6366f1 100%);
      box-shadow: 0 4px 16px rgba(99,102,241,0.18);
    }
    .modal .btn-secondary {
      border-radius: 10px;
      font-weight: 600;
      padding: 8px 22px;
      font-size: 1rem;
      background: #e0e7ff;
      color: #3730a3;
      border: none;
      transition: background 0.2s;
    }
    .modal .btn-secondary:hover {
      background: #c7d2fe;
      color: #3730a3;
    }
    @media (max-width: 600px) {
      .modal-dialog {
        margin: 0.5rem auto;
        max-width: 98vw;
      }
      .modal-content {
        border-radius: 12px;
        padding: 0 2px;
      }
      .modal .form-control {
        font-size: 1.08rem;
        padding: 13px 12px;
      }
      .modal-title {
        font-size: 1.08rem;
      }
      .modal-footer {
        flex-direction: column;
        gap: 8px;
        padding-bottom: 0.5rem;
      }
      .card-body .table-responsive { display: none !important; }
      .mobile-complaints-list { display: block !important; }
      .complaint-mobile-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(99,102,241,0.08);
        margin-bottom: 14px;
        padding: 14px 12px;
        display: flex;
        gap: 12px;
        align-items: flex-start;
        animation: fadeInRow 0.7s;
      }
      .complaint-mobile-card .student-avatar {
        width: 48px;
        height: 48px;
        min-width: 48px;
        border-radius: 50%;
        object-fit: cover;
      }
      .complaint-mobile-card .info {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 2px;
      }
      .complaint-mobile-card .student-name {
        font-size: 1.08rem;
        font-weight: 700;
        color: #3730a3;
        margin-bottom: 2px;
      }
      .complaint-mobile-card .student-email {
        font-size: 0.93rem;
        color: #64748b;
        margin-bottom: 2px;
      }
      .complaint-mobile-card .complaint-title {
        font-size: 0.98rem;
        font-weight: 600;
        margin-bottom: 2px;
      }
      .complaint-mobile-card .complaint-details {
        font-size: 0.93rem;
        color: #64748b;
        margin-bottom: 2px;
      }
      .complaint-mobile-card .status-badge {
        margin-bottom: 6px;
        margin-top: 2px;
      }
      .complaint-mobile-card .actions {
        display: flex;
        gap: 8px;
        margin-top: 6px;
      }
      .complaint-mobile-card .btn {
        font-size: 0.97rem;
        padding: 6px 14px;
        border-radius: 8px;
      }
    }
    @media (min-width: 601px) {
      .mobile-complaints-list { display: none !important; }
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
                  <h6 class="mb-0">Student Complaints</h6>
                </div>
                <div class="col-6 text-end">
                  <div class="input-group search-box">
                    <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                    <input type="text" class="form-control" placeholder="Search complaints...">
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Complaint</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
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
                            <h6 class="mb-0 text-sm">Ahmed Mohamed</h6>
                            <p class="text-xs text-secondary mb-0">ahmed@example.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Content Issue</p>
                        <p class="text-xs text-secondary mb-0">The content is not clear enough</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">23/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="status-badge status-pending">Pending</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-link text-primary text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#replyModal">
                          <i class="fas fa-reply me-2"></i>Reply
                        </button>
                        <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="fas fa-trash-alt me-2"></i>Delete
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
                            <h6 class="mb-0 text-sm">Sara Ahmed</h6>
                            <p class="text-xs text-secondary mb-0">sara@example.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Request for Clarification</p>
                        <p class="text-xs text-secondary mb-0">I need more explanation about the last lesson</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">22/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="status-badge status-replied">Replied</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-link text-primary text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#replyModal">
                          <i class="fas fa-reply me-2"></i>Reply
                        </button>
                        <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="fas fa-trash-alt me-2"></i>Delete
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
                            <h6 class="mb-0 text-sm">Mohamed Ali</h6>
                            <p class="text-xs text-secondary mb-0">mohammed@example.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Technical Issue</p>
                        <p class="text-xs text-secondary mb-0">I can't access the study materials</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">21/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="status-badge status-pending">Pending</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-link text-primary text-gradient px-3 mb-0" data-bs-toggle="modal" data-bs-target="#replyModal">
                          <i class="fas fa-reply me-2"></i>Reply
                        </button>
                        <button type="button" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="fas fa-trash-alt me-2"></i>Delete
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="mobile-complaints-list" style="display:none;">
                <!-- Mobile complaint cards will be rendered by JS -->
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
          <h5 class="modal-title" id="replyModalLabel">Reply to Complaint</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form>
            <div class="form-group">
              <label for="replyMessage">Your Reply</label>
              <textarea class="form-control" id="replyMessage" rows="4" placeholder="Type your reply here..."></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Send Reply</button>
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
      const mobileList = document.querySelector('.mobile-complaints-list');
      // Mobile data
      const complaintsData = [
        {
          avatar: 'https://randomuser.me/api/portraits/men/32.jpg',
          name: 'Ahmed Mohamed',
          email: 'ahmed@example.com',
          title: 'Content Issue',
          details: 'The content is not clear enough',
          status: 'Pending',
          statusClass: 'status-pending',
          date: '23/04/2024',
        },
        {
          avatar: 'https://randomuser.me/api/portraits/women/44.jpg',
          name: 'Sara Ahmed',
          email: 'sara@example.com',
          title: 'Request for Clarification',
          details: 'I need more explanation about the last lesson',
          status: 'Replied',
          statusClass: 'status-replied',
          date: '22/04/2024',
        },
        {
          avatar: 'https://randomuser.me/api/portraits/men/67.jpg',
          name: 'Mohamed Ali',
          email: 'mohammed@example.com',
          title: 'Technical Issue',
          details: "I can't access the study materials",
          status: 'Pending',
          statusClass: 'status-pending',
          date: '21/04/2024',
        },
      ];
      function renderMobileComplaints(filter = '') {
        mobileList.innerHTML = '';
        complaintsData.forEach(c => {
          if (
            c.name.toLowerCase().includes(filter) ||
            c.email.toLowerCase().includes(filter) ||
            c.title.toLowerCase().includes(filter) ||
            c.details.toLowerCase().includes(filter)
          ) {
            mobileList.innerHTML += `
              <div class='complaint-mobile-card'>
                <img src="${c.avatar}" class="student-avatar" alt="${c.name}">
                <div class="info">
                  <span class="student-name">${c.name}</span>
                  <span class="student-email">${c.email}</span>
                  <span class="complaint-title">${c.title}</span>
                  <span class="complaint-details">${c.details}</span>
                  <span class="status-badge ${c.statusClass}">${c.status}</span>
                  <div class="actions">
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#replyModal"><i class="fas fa-reply me-1"></i>Reply</button>
                    <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt me-1"></i>Delete</button>
                  </div>
                </div>
              </div>
            `;
          }
        });
      }
      // Initial render
      if (window.innerWidth <= 600) renderMobileComplaints();
      // Search for mobile
      searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        if (window.innerWidth <= 600) {
          renderMobileComplaints(searchTerm);
        } else {
          complaintRows.forEach(row => {
            const studentName = row.querySelector('h6').textContent.toLowerCase();
            const studentEmail = row.querySelector('p.text-secondary').textContent.toLowerCase();
            const complaintText = row.querySelector('td:nth-child(2) p').textContent.toLowerCase();
            const complaintDetails = row.querySelector('td:nth-child(2) p:last-child').textContent.toLowerCase();
            if (
              studentName.includes(searchTerm) ||
              studentEmail.includes(searchTerm) ||
              complaintText.includes(searchTerm) ||
              complaintDetails.includes(searchTerm)
            ) {
              row.style.display = '';
            } else {
              row.style.display = 'none';
            }
          });
        }
      });
      // Re-render on resize
      window.addEventListener('resize', function() {
        if (window.innerWidth <= 600) {
          renderMobileComplaints(searchInput.value.toLowerCase());
        } else {
          mobileList.innerHTML = '';
        }
      });
    });
  </script>
</body>

</html> 