<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    Student Complaints
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
    .page-header {
      background: #ffffff;
      border-radius: 15px 15px 0 0;
      padding: 1.5rem;
      margin-bottom: 0;
      box-shadow: 0 2px 12px rgba(99,102,241,0.08);
      border: 1px solid #e2e8f0;
    }
    .page-header i {
      color: #6C2EB7;
    }
    .page-header h2 {
      color: #2d3748;
      font-weight: 700;
      margin-bottom: 0.25rem;
    }
    .page-header p {
      color: #6C2EB7;
      opacity: 0.8;
      margin-bottom: 0;
    }
    .complaint-card {
      transition: all 0.3s ease;
      border-radius: 12px;
      margin-bottom: 1rem;
      box-shadow: 0 2px 8px rgba(99,102,241,0.06);
    }
    .complaint-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 16px rgba(99,102,241,0.12);
    }
    .student-avatar {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #e2e8f0;
    }
    .status-badge {
      padding: 6px 16px;
      border-radius: 20px;
      font-size: 0.85rem;
      font-weight: 600;
      letter-spacing: 0.5px;
    }
    .status-pending {
      background: #fef3c7;
      color: #92400e;
    }
    .status-replied {
      background: #dbeafe;
      color: #1e40af;
    }
    .search-box {
      border-radius: 12px;
      background: #f8fafc;
      border: 1px solid #e2e8f0;
    }
    .search-box input {
      border: none;
      background: transparent;
      font-size: 0.95rem;
    }
    .search-box input:focus {
      outline: none;
      box-shadow: none;
    }
    .card {
      border-radius: 15px;
      border: 1px solid #e2e8f0;
      box-shadow: 0 2px 12px rgba(99,102,241,0.08);
    }
    .card-header {
      background: #f8fafc;
      border-bottom: 1px solid #e2e8f0;
      border-radius: 15px 15px 0 0;
    }
    .btn-primary {
      background: linear-gradient(90deg, #6C2EB7 0%, #8B5CF6 100%);
      border: none;
      border-radius: 8px;
      font-weight: 600;
    }
    .btn-primary:hover {
      background: linear-gradient(90deg, #5B21B6 0%, #7C3AED 100%);
      transform: translateY(-1px);
    }
    .btn-danger {
      border-radius: 8px;
      font-weight: 600;
    }
    .table th {
      border-top: none;
      font-weight: 600;
      color: #6C2EB7;
      font-size: 0.85rem;
    }
    .table td {
      border-top: 1px solid #f1f5f9;
      vertical-align: middle;
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('teacher.parts.sidebar-teacher')
  <main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      
      <!-- Page Header -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="page-header">
            <div class="d-flex align-items-center">
              <div class="me-3">
                <i class="fas fa-comments fa-2x"></i>
              </div>
              <div>
                <h2 class="mb-1">Student Complaints</h2>
                <p class="mb-0 opacity-75">View all student complaints and manage responses</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row align-items-center">
                <div class="col-6">
                  <h6 class="mb-0 text-dark font-weight-bold">Student Complaints</h6>
                </div>
                <div class="col-6 text-end">
                  <div class="input-group search-box">
                    <span class="input-group-text text-body border-0">
                      <i class="fas fa-search" aria-hidden="true"></i>
                    </span>
                    <input type="text" class="form-control border-0" placeholder="Search complaints...">
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
                    <!-- Complaint 1 -->
                    <tr class="complaint-card">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" class="student-avatar me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm font-weight-bold">John Smith</h6>
                            <p class="text-xs text-secondary mb-0">john.smith@example.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0 text-dark">Course Content Issue</p>
                        <p class="text-xs text-secondary mb-0">The course materials are not clear enough for understanding</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">23/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="status-badge status-pending">Pending</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#replyModal">
                          <i class="fas fa-reply me-1"></i>Reply
                        </button>
                        <button type="button" class="btn btn-danger btn-sm">
                          <i class="fas fa-trash-alt me-1"></i>Delete
                        </button>
                      </td>
                    </tr>

                    <!-- Complaint 2 -->
                    <tr class="complaint-card">
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="student-avatar me-3" alt="user2">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm font-weight-bold">Sarah Johnson</h6>
                            <p class="text-xs text-secondary mb-0">sarah.johnson@example.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0 text-dark">Technical Problem</p>
                        <p class="text-xs text-secondary mb-0">I cannot access the online study materials and assignments</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold">22/04/2024</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="status-badge status-replied">Replied</span>
                      </td>
                      <td class="align-middle text-center">
                        <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#replyModal">
                          <i class="fas fa-reply me-1"></i>Reply
                        </button>
                        <button type="button" class="btn btn-danger btn-sm">
                          <i class="fas fa-trash-alt me-1"></i>Delete
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
  </main>

  <!-- Reply Modal -->
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
    // Search functionality for complaints
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
      });
    });
  </script>
</body>

</html> 