<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ asset('images/favicon.png') }}">
  <title>Admin Accounts Management</title>
  
  <!-- Fonts and CSS -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  
  <style>
    .table-action-buttons .btn {
      margin-right: 5px;
    }
    .table-action-buttons {
      white-space: nowrap;
    }
    .action-icon-btn {
      border: none;
      border-radius: 12px;
      width: 38px;
      height: 38px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      font-size: 1.15rem;
      color: #fff !important;
      box-shadow: 0 2px 8px rgba(44,62,80,0.10);
      transition: background 0.18s;
      padding: 0;
    }
    .action-icon-view { background: #17c1e8; }
    .action-icon-edit { background: #ff8c4b; }
    .action-icon-print { background: #5e72e4; }
    .action-icon-delete { background: #ea0606; }
    .action-icon-btn:hover, .action-icon-btn:focus { filter: brightness(0.93); }
    .valid {
      border-color: #28a745 !important;
      box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
    }
    
    .is-invalid {
      border-color: #dc3545 !important;
      box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }
    .stat-card {
      min-height: 170px;
      height: 170px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      border-radius: 18px;
      box-shadow: 0 2px 12px rgba(44,62,80,0.09);
      padding: 24px 18px 18px 18px;
      background: #fff;
      transition: box-shadow 0.2s;
    }
    .stat-card .icon {
      margin-bottom: 8px;
    }
    .stat-card h5,
    .stat-card .fs-2 {
      font-size: 2.1rem !important;
      font-weight: bold;
    }
    .stat-card p,
    .stat-card .fw-bold,
    .stat-card .text-info {
      font-size: 1rem;
    }
    .stat-card .text-sm {
      font-size: 0.98rem;
    }
    @media (max-width: 991px) {
      .stat-card {
        min-height: 140px;
        height: auto;
        padding: 18px 10px;
      }
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  @include('admin.parts.sidebar-admin')

  <main class="main-content position-relative border-radius-lg">
    <div class="container-fluid py-4">
      
      <!-- Page Header -->
      <div class="card mb-4" style="border-radius: 18px; box-shadow: 0 2px 12px rgba(44,62,80,0.09);">
        <div class="card-body p-4">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <h1 class="mb-1" style="font-size:2.8rem; font-weight:800; color:#7b61ff; line-height:1.1;">Admin<br>Management</h1>
              <p class="mb-0" style="font-size:1.15rem; color:#6c757d;">Manage, add, and edit admin accounts</p>
            </div>
            <div class="col-lg-4 text-end">
              <a href="{{ route('admin.accounts.admins.create') }}" class="btn btn-primary" style="font-weight:700; font-size:1.1rem; padding: 10px 26px; border-radius:10px; box-shadow:0 2px 8px rgba(44,62,80,0.10);">
                <i class="fas fa-plus me-2"></i> Add New Admin
              </a>
            </div>
          </div>
        </div>
      </div>

      <!-- Statistics Cards -->
      <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card stat-card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Admins</p>
                    <h5 class="font-weight-bolder">{{ $totalAdmins }}</h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">+{{ $adminsThisMonth }}</span>
                      this month
                    </p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="fas fa-users text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card stat-card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Active</p>
                    <h5 class="font-weight-bolder">{{ $activeAdmins }}</h5>
                    <p class="mb-0">
                      <span class="text-success text-sm font-weight-bolder">{{ $totalAdmins > 0 ? round(($activeAdmins/$totalAdmins)*100) : 0 }}%</span>
                      of admins
                    </p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="fas fa-check-circle text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card stat-card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Experienced</p>
                    <h5 class="font-weight-bolder">0</h5>
                    <p class="mb-0">
                      <span class="text-info text-sm font-weight-bolder">5+ years</span>
                      experience
                    </p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                    <i class="fas fa-trophy text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card stat-card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Inactive</p>
                    <h5 class="font-weight-bolder">{{ $blockedAdmins }}</h5>
                    <p class="mb-0">
                      <span class="text-danger text-sm font-weight-bolder">account</span>
                      inactive
                    </p>
                  </div>
                </div>
                <div class="col-4">
                  <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="fas fa-times-circle text-lg opacity-10"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Admins Table Card -->
      <div class="card">
        <div class="card-header pb-0">
          <div class="d-flex justify-content-between align-items-center">
          <h6>Admins List</h6>
            <a href="{{ route('admin.accounts.admins.create') }}" class="btn btn-primary">
              <i class="fas fa-plus me-2"></i>Add New Admin
            </a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table id="admins-table" class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th>Admin</th>
                  <th>ID</th>
                  <th>Password</th>
                  <th>Contact</th>
                  <th>Status</th>
                  <th>Registration Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($admins as $admin)
                <tr>
                  <td>
                    <div class="d-flex px-2 py-1">
                      <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-sm">{{ $admin->name }}</h6>
                        <p class="text-xs text-secondary mb-0">
                          {{ $admin->mobile ?? '-' }}
                        </p>
                      </div>
                    </div>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $admin->login_id }}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $admin->plain_password ?? '-' }}</p>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">{{ $admin->email }}</p>
                  </td>
                  <td>
                    <span class="badge badge-sm {{ $admin->is_active ? 'bg-gradient-success' : 'bg-gradient-secondary' }}">
                      {{ $admin->is_active ? 'Active' : 'Inactive' }}
                    </span>
                  </td>
                  <td>
                    <p class="text-xs font-weight-bold mb-0">
                      {{ $admin->created_at->format('Y-m-d') }}</p>
                  </td>
                  <td class="align-middle">
                    <div class="d-flex align-items-center gap-2">
                      <a href="{{ route('admin.accounts.admins.edit', $admin->id) }}"
                          class="btn btn-link text-info p-2">
                      <i class="fas fa-edit"></i>
                    </a>
                      <a href="{{ route('admin.accounts.admins.show', $admin->id) }}"
                          class="btn btn-link text-primary p-2">
                        <i class="fas fa-eye"></i>
                      </a>
                      <button class="btn btn-link text-dark p-2"
                          onclick="printCredentials('{{ $admin->login_id }}', '{{ $admin->name }}', '{{ $admin->plain_password }}')"
                          title="Print Credentials">
                        <i class="fas fa-key"></i>
                      </button>
                      <form action="{{ route('admin.accounts.admins.destroy', $admin->id) }}"
                          method="POST" onsubmit="return false;" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-link text-danger p-2 delete-btn"
                        data-admin-id="{{ $admin->id }}"
                        data-admin-name="{{ $admin->name }}">
                        <i class="fas fa-trash"></i>
                    </button>
                      </form>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="7" class="text-center py-4">
                    <p class="text-muted">No admins found.</p>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          <div class="d-flex justify-content-between align-items-center p-3">
            <p class="text-sm mb-0">Showing {{ $admins->firstItem() }} -
              {{ $admins->lastItem() }} of {{ $admins->total() }} admins</p>
            {{ $admins->links('pagination::bootstrap-4') }}
        </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Delete Confirmation Modal -->
  <div class="modal fade delete-modal" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content border-0 shadow">
              <div class="modal-header bg-danger text-white border-0">
                  <div class="d-flex align-items-center">
                      <div class="icon icon-shape bg-white bg-gradient-danger shadow-danger text-center rounded-circle me-3">
                          <i class="fas fa-exclamation-triangle text-danger text-lg opacity-10"></i>
                      </div>
                      <div>
                          <h5 class="modal-title mb-0" id="deleteConfirmModalLabel">Confirm Deletion</h5>
                          <p class="text-white-50 mb-0 small">This action cannot be undone</p>
                      </div>
                  </div>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body p-4">
                  <div class="text-center mb-4">
                      <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                          <i class="fas fa-user-times text-white text-lg opacity-10" style="font-size: 2rem;"></i>
                      </div>
                      <h6 class="text-danger mb-2">Are you sure you want to delete this admin?</h6>
                      <p class="text-muted mb-0" id="deleteAdminName"></p>
                  </div>
                  
                  <div class="alert alert-warning border-0">
                      <div class="d-flex">
                          <i class="fas fa-exclamation-triangle text-warning me-2 mt-1"></i>
                          <div>
                              <strong>Warning:</strong> This will permanently delete the admin account and all associated data.
                              <ul class="mb-0 mt-2 small">
                                  <li>Admin profile will be removed</li>
                                  <li>All records will be deleted</li>
                                  <li>This action cannot be undone</li>
                              </ul>
                          </div>
                      </div>
                  </div>
                  
                  <!-- Confirmation Input -->
                  <div class="form-group">
                      <label for="deleteConfirmation" class="form-label text-danger">
                          <i class="fas fa-keyboard me-2"></i>Type "DELETE" to confirm
                      </label>
                      <input type="text" id="deleteConfirmation" class="form-control" 
                             placeholder="Type DELETE to confirm" 
                             required>
                      <div class="form-text text-muted">
                          This extra step helps prevent accidental deletions.
                      </div>
        </div>
        </div>
              <div class="modal-footer border-0 bg-light">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                      <i class="fas fa-times me-2"></i>Cancel
                  </button>
                  <form id="deleteForm" method="POST" style="display: inline;">
            @csrf
            @method('DELETE')
                      <button type="submit" class="btn btn-secondary" disabled>
                          <i class="fas fa-trash me-2"></i>Delete Admin
                      </button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
  <script>
    function printCredentials(loginId, name, password) {
        if (!password || password.trim() === '') {
            alert('Initial password is not available for this admin.');
            return;
        }

        const printWindow = window.open('', 'PRINT', 'height=500,width=700');

        printWindow.document.write('<html><head><title>Admin Credentials</title>');
        printWindow.document.write('<style>');
        printWindow.document.write(`
            body { background: linear-gradient(120deg, #4f8cff 0%, #6dd5ed 100%); margin:0; height:100vh; display:flex; align-items:center; justify-content:center; }
            .cred-card { background: rgba(255,255,255,0.85); border-radius: 22px; box-shadow: 0 8px 32px rgba(44,62,80,0.18); border: 2px solid #4f8cff; padding: 40px 32px 32px 32px; width: 420px; max-width:95vw; margin:auto; font-family: 'Segoe UI', Arial, sans-serif; animation: fadeInCard 0.8s cubic-bezier(.4,2,.6,1) both; }
            .cred-card h2 { color: #4f8cff; margin-bottom: 18px; font-size: 2.1rem; letter-spacing: 1px; text-align:center; }
            .cred-card .cred-label { color: #6c757d; font-size: 1.1rem; margin-bottom: 2px; display:block; }
            .cred-card .cred-value { color: #222; font-size: 1.35rem; font-weight: bold; margin-bottom: 18px; letter-spacing: 0.5px; }
            .cred-card .cred-pass { color: #fff; background: linear-gradient(90deg, #4f8cff 0%, #6dd5ed 100%); border-radius: 10px; font-size: 1.5rem; font-weight: bold; padding: 10px 0; margin-bottom: 10px; text-align:center; letter-spacing: 1px; box-shadow: 0 2px 8px rgba(44,62,80,0.10); }
            .cred-card .cred-id { color: #4f8cff; font-size: 1.1rem; font-weight: 500; margin-bottom: 8px; text-align:center; }
            .cred-card .cred-footer { color: #6c757d; font-size: 0.95rem; text-align:center; margin-top: 18px; }
            .cred-card .print-btn { display: block; width: 100%; margin: 18px auto 0 auto; background: linear-gradient(90deg, #4f8cff 0%, #6dd5ed 100%); color: #fff; border: none; border-radius: 8px; font-size: 1.15rem; font-weight: bold; padding: 10px 0; cursor: pointer; transition: background 0.2s; box-shadow: 0 2px 8px rgba(44,62,80,0.10); }
            .cred-card .print-btn:hover { background: linear-gradient(90deg, #6dd5ed 0%, #4f8cff 100%); }
            @keyframes fadeInCard { 0% { opacity:0; transform: translateY(40px) scale(0.95);} 100% { opacity:1; transform: translateY(0) scale(1);} }
            @media print {
              html, body { background: #fff !important; height:100%; margin:0; padding:0; }
              body { display: flex; align-items: flex-start; justify-content: center; min-height: 100vh; }
              .cred-card { box-shadow:none !important; border:2px solid #4f8cff !important; width: 95vw !important; max-width: 420px !important; margin: 0 auto !important; position: relative; top: 2vh; }
              .print-btn { display: none !important; }
            }
        `);
        printWindow.document.write('</style></head><body>');
        printWindow.document.write('<div class="cred-card">');
        printWindow.document.write('<div style="position:absolute; left:32px; top:24px; font-size:2.2rem; font-weight:900; color:#4f8cff; letter-spacing:2px; font-family:inherit;">Nextro</div>');
        printWindow.document.write('<h2 style="font-size:1.25rem; margin-top:48px; margin-bottom:18px; color:#4f8cff; text-align:center; font-weight:700; letter-spacing:1px;">Admin Credentials</h2>');
        printWindow.document.write(`<div class="cred-label">Admin Name</div><div class="cred-value">${name}</div>`);
        printWindow.document.write(`<div class="cred-label">Admin ID</div><div class="cred-id">${loginId}</div>`);
        printWindow.document.write(`<div class="cred-label">Password</div><div class="cred-pass">${password}</div>`);
        printWindow.document.write('<div class="cred-footer">Keep this information confidential</div>');
        printWindow.document.write('<button class="print-btn" onclick="window.print()">Print</button>');
        printWindow.document.write('</div>');
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();
    }
    
    // Delete confirmation modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const deleteModal = document.getElementById('deleteConfirmModal');
        const deleteAdminName = document.getElementById('deleteAdminName');
        const deleteForm = document.getElementById('deleteForm');
        const deleteConfirmation = document.getElementById('deleteConfirmation');
        const deleteSubmitBtn = deleteForm.querySelector('button[type="submit"]');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const adminName = this.getAttribute('data-admin-name');
                const adminId = this.getAttribute('data-admin-id');
                const form = this.closest('.delete-form');
        
                // Update modal content
                deleteAdminName.textContent = adminName;
                
                // Update form action
                deleteForm.action = form.action;
                
                // Reset confirmation input
                deleteConfirmation.value = '';
                deleteSubmitBtn.disabled = true;
                deleteSubmitBtn.classList.remove('btn-danger');
                deleteSubmitBtn.classList.add('btn-secondary');
                
                // Show modal with animation
                const modal = new bootstrap.Modal(deleteModal, {
                    backdrop: 'static',
                    keyboard: false
                });
                modal.show();
            });
        });

        // Handle confirmation input
        deleteConfirmation.addEventListener('input', function() {
            const isConfirmed = this.value.toUpperCase() === 'DELETE';
            deleteSubmitBtn.disabled = !isConfirmed;
            
            // Update input styling
            this.classList.remove('valid', 'is-invalid');
            
            if (this.value.length > 0) {
                if (isConfirmed) {
                    this.classList.add('valid');
                    deleteSubmitBtn.classList.remove('btn-secondary');
                    deleteSubmitBtn.classList.add('btn-danger');
                } else {
                    this.classList.add('is-invalid');
                    deleteSubmitBtn.classList.remove('btn-danger');
                    deleteSubmitBtn.classList.add('btn-secondary');
                }
            } else {
                deleteSubmitBtn.classList.remove('btn-danger');
                deleteSubmitBtn.classList.add('btn-secondary');
            }
        });

        // Handle form submission
        deleteForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (deleteConfirmation.value.toUpperCase() !== 'DELETE') {
                return;
            }
            
            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Deleting...';
            submitBtn.disabled = true;

            // Submit the form
            fetch(this.action, {
                method: 'POST',
                body: new FormData(this),
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    submitBtn.innerHTML = '<i class="fas fa-check me-2"></i>Deleted Successfully!';
                    submitBtn.classList.remove('btn-danger');
                    submitBtn.classList.add('btn-success');
                    
                    // Close modal after delay
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(deleteModal);
                        modal.hide();
                        
                        // Reload page after modal is hidden
                        setTimeout(() => {
                            location.reload();
                        }, 300);
                    }, 1500);
                } else {
                    throw new Error(data.message || 'Failed to delete admin');
                }
            })
            .catch(error => {
                // Reset button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                
                // Show error message in modal
                const errorDiv = document.createElement('div');
                errorDiv.className = 'alert alert-danger mt-3';
                errorDiv.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>' + error.message;
                
                const modalBody = deleteModal.querySelector('.modal-body');
                modalBody.appendChild(errorDiv);
                
                // Remove error message after 5 seconds
                setTimeout(() => {
                    errorDiv.remove();
                }, 5000);
            });
        });

        // Reset modal when hidden
        deleteModal.addEventListener('hidden.bs.modal', function() {
            const submitBtn = deleteForm.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-trash me-2"></i>Delete Admin';
            submitBtn.disabled = true;
            submitBtn.classList.remove('btn-success', 'btn-danger');
            submitBtn.classList.add('btn-secondary');
            
            // Reset confirmation input
            deleteConfirmation.value = '';
            deleteConfirmation.classList.remove('valid', 'is-invalid');
            
            // Remove any error messages
            const errorMessages = deleteModal.querySelectorAll('.alert-danger');
            errorMessages.forEach(msg => msg.remove());
        });
    });
  </script>
</body>

</html> 