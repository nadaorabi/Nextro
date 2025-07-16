<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
  <title>
    Profile 
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
    @media (max-width: 600px) {
      .card-profile-bottom {
        max-width: 98% !important;
        width: 100% !important;
        margin-left: auto !important;
        margin-right: auto !important;
      }
    }
    .card-profile-bottom .btn {
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      border: none;
      font-weight: 500;
      text-transform: none;
      border-radius: 8px;
      padding: 0.5rem 1rem;
      font-size: 0.875rem;
    }
    .card-profile-bottom .btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    .card-profile-bottom .btn-primary {
      background: linear-gradient(135deg,rgb(87, 99, 227) 0%,rgb(87, 99, 227) 100%);
      border: none;
    }
    .card-profile-bottom .btn-success {
      background: linear-gradient(135deg,rgb(246, 4, 4) 0%,rgb(238, 8, 8) 100%);
      border: none;
    }
    @media (max-width: 768px) {
      .card-profile-bottom .d-flex {
        justify-content: center !important;
        flex-wrap: wrap;
      }
      .card-profile-bottom .btn {
        margin-bottom: 0.5rem;
      }
    }
    .modal-content {
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }
    .modal-header {
      border-bottom: 1px solid #e9ecef;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border-radius: 15px 15px 0 0;
      padding: 1.5rem;
    }
    .modal-header .btn-close {
      filter: invert(1);
    }
    .modal-body {
      padding: 2rem;
    }
    .modal-footer {
      padding: 1.5rem;
      border-top: 1px solid #e9ecef;
    }
    .form-group {
      margin-bottom: 1.5rem;
    }
    .form-group label {
      font-weight: 600;
      color: #495057;
      margin-bottom: 0.5rem;
    }
    .form-control {
      border-radius: 8px;
      border: 2px solid #e9ecef;
      transition: all 0.3s ease;
    }
    .form-control:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }
    .modal-footer .btn {
      border-radius: 8px;
      font-weight: 500;
      padding: 0.75rem 1.5rem;
      transition: all 0.3s ease;
    }
    .modal-footer .btn:hover {
      transform: translateY(-1px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    }
    .modal-footer .btn-primary {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
    }
    .modal-footer .btn-success {
      background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
      border: none;
    }
    /* Toast Notifications */
    .toast-container {
      position: fixed;
      top: 20px;
      right: 20px;
      z-index: 9999;
    }
    .toast {
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      margin-bottom: 10px;
      min-width: 300px;
      border-left: 4px solid #28a745;
    }
    .toast.error {
      border-left-color: #dc3545;
    }
    .toast.warning {
      border-left-color: #ffc107;
    }
    .toast-header {
      background: transparent;
      border-bottom: 1px solid #e9ecef;
      padding: 0.75rem 1rem;
    }
    .toast-body {
      padding: 1rem;
      color: #495057;
    }
    .toast.show {
      animation: slideInRight 0.3s ease-out;
    }
    @keyframes slideInRight {
      from {
        transform: translateX(100%);
        opacity: 0;
      }
      to {
        transform: translateX(0);
        opacity: 1;
      }
    }
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  <!-- Toast Container -->
  <div class="toast-container" id="toastContainer"></div>
  
  <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
    <span class="mask bg-primary opacity-6"></span>
  </div>
  @include('teacher.parts.sidebar-teacher')
  <div class="main-content position-relative max-height-vh-100 h-100">

    <div class="card shadow-lg mx-4 card-profile-bottom" style="margin-top: -1px;">
      <div class="card-body p-3">
        <div class="row gx-4 align-items-center">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative" style="display: flex; flex-direction: column; align-items: center; position: relative; width: 100px;">
              <img id="profileImage" src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : 'https://randomuser.me/api/portraits/women/44.jpg' }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm" style="width:100px;height:100px;object-fit:cover;border-radius:50%;" onerror="this.src='https://randomuser.me/api/portraits/women/44.jpg'" onload="console.log('Image loaded:', this.src)">
              <form id="profileImageUploadForm" method="POST" action="{{ route('teacher.profile.update') }}" enctype="multipart/form-data" autocomplete="off" style="display:inline;">
                @csrf
                @method('PUT')
                <input type="file" name="image" id="imageInput" accept="image/*" style="display:none">
                <button type="button" onclick="document.getElementById('imageInput').click();" class="btn btn-primary" style="position:absolute; right:-18px; bottom:-10px; width:38px; height:38px; border-radius:50%; padding:0; display:flex; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(44,62,80,0.13); font-size:1.1rem; z-index:2;"><i class="fa fa-camera"></i></button>
                <button type="submit" id="saveImageBtn" class="btn btn-success" style="position:absolute; left:-18px; bottom:-10px; width:38px; height:38px; border-radius:50%; padding:0; display:none; align-items:center; justify-content:center; box-shadow:0 2px 8px rgba(44,62,80,0.13); font-size:1.1rem; z-index:2;"><i class="fa fa-save"></i></button>
              </form>
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1" id="firstLastName">{{ Auth::user()->name ?? 'Not Set' }}</h5>
              <p class="mb-0 font-weight-bold text-sm">{{ Auth::user()->specialization ?? 'Teacher' }}</p>
            </div>
          </div>
          <!-- Edit Buttons -->
          <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="d-flex gap-2 justify-content-end">
              <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                <i class="fas fa-edit me-1"></i> Edit Information
              </button>
              <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                <i class="fas fa-key me-1"></i> Change Password
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <h5 class="mb-0">Profile</h5>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Name</label>
                    <input class="form-control" type="text" name="name" value="{{ Auth::user()->name ?? '' }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile</label>
                    <input class="form-control" type="text" name="mobile" value="{{ Auth::user()->mobile ?? '' }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="email" value="{{ Auth::user()->email ?? '' }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Login ID</label>
                    <input class="form-control" type="text" name="login_id" value="{{ Auth::user()->login_id ?? '' }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Address</label>
                    <input class="form-control" type="text" name="address" value="{{ Auth::user()->address ?? '' }}" readonly>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group">
                    <label>Note</label>
                    <textarea class="form-control" name="note" rows="3" readonly>{{ Auth::user()->note ?? '' }}</textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Edit Profile Modal -->
  <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Edit Personal Information</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="editProfileForm" method="POST" action="{{ route('teacher.profile.update') }}">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Name</label>
                  <input class="form-control" type="text" name="name" value="{{ Auth::user()->name ?? '' }}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Mobile</label>
                  <input class="form-control" type="text" name="mobile" value="{{ Auth::user()->mobile ?? '' }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                  <input class="form-control" type="email" name="email" value="{{ Auth::user()->email ?? '' }}" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Address</label>
                  <input class="form-control" type="text" name="address" value="{{ Auth::user()->address ?? '' }}">
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <label>Notes</label>
                  <textarea class="form-control" name="note" rows="3">{{ Auth::user()->note ?? '' }}</textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times me-1"></i> Cancel
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-save me-1"></i> Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Change Password Modal -->
  <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="changePasswordForm" method="POST" action="{{ route('teacher.password.update') }}">
          @csrf
          @method('PUT')
          <div class="modal-body">
            <div class="form-group">
              <label>Current Password</label>
              <input class="form-control" type="password" name="current_password" required>
            </div>
            <div class="form-group">
              <label>New Password</label>
              <input class="form-control" type="password" name="password" required>
            </div>
            <div class="form-group">
              <label>Confirm New Password</label>
              <input class="form-control" type="password" name="password_confirmation" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
              <i class="fas fa-times me-1"></i> Cancel
            </button>
            <button type="submit" class="btn btn-success">
              <i class="fas fa-key me-1"></i> Change Password
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Argon Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0 overflow-auto">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <hr class="horizontal dark my-sm-4">
        <div class="mt-2 mb-5 d-flex">
          <h6 class="mb-0">Light / Dark</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
          </div>
        </div>
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/argon-dashboard.min.js') }}"></script>
  <script>
    // Toast Notification Function
    function showToast(message, type = 'success') {
      const toastContainer = document.getElementById('toastContainer');
      const toast = document.createElement('div');
      toast.className = `toast ${type} show`;
      toast.innerHTML = `
        <div class="toast-header">
          <strong class="me-auto">${type === 'success' ? 'Success' : type === 'error' ? 'Error' : 'Warning'}</strong>
          <button type="button" class="btn-close" onclick="this.parentElement.parentElement.remove()"></button>
        </div>
        <div class="toast-body">
          ${message}
        </div>
      `;
      toastContainer.appendChild(toast);
      
      // Auto remove after 5 seconds
      setTimeout(() => {
        if (toast.parentElement) {
          toast.remove();
        }
      }, 5000);
    }

    const imageInput = document.getElementById('imageInput');
    const profileImage = document.getElementById('profileImage');
    const saveImageBtn = document.getElementById('saveImageBtn');
    let imageChanged = false;

    imageInput.addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
          showToast('Please select a valid image file', 'error');
          return;
        }
        
        // Validate file size (2MB max)
        if (file.size > 2 * 1024 * 1024) {
          showToast('Image size should be less than 2MB', 'error');
          return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
          profileImage.src = e.target.result;
        };
        reader.readAsDataURL(file);
        saveImageBtn.style.display = 'flex';
        imageChanged = true;
        showToast('Image selected. Click save to upload.', 'success');
      }
    });

    document.getElementById('profileImageUploadForm').addEventListener('submit', function(e) {
      e.preventDefault();
      if (!imageChanged) {
        return;
      }
      
      saveImageBtn.disabled = true;
      saveImageBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
      const formData = new FormData(this);
      
      // Debug: Log form data
      console.log('Form data entries:');
      for (let [key, value] of formData.entries()) {
        console.log(key, value);
      }
      
      fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        }
      })
      .then(response => {
        console.log('Response status:', response.status);
        console.log('Response headers:', response.headers);
        
        if (!response.ok) {
          return response.json().then(errorData => {
            console.error('Error response:', errorData);
            throw new Error(errorData.message || 'Network response was not ok');
          });
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          showToast('Profile image updated successfully', 'success');
          saveImageBtn.style.display = 'none';
          imageChanged = false;
          
          // Update the image source with the new path
          if (data.image_path) {
            profileImage.src = data.image_path + '?t=' + new Date().getTime();
            
            // Also update the image in the profile card
            const profileCardImage = document.querySelector('.card-profile-bottom img');
            if (profileCardImage) {
              profileCardImage.src = data.image_path + '?t=' + new Date().getTime();
            }
          }
        } else {
          showToast(data.message || 'Error updating profile image', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('Error updating profile image: ' + error.message, 'error');
      })
      .finally(() => {
        saveImageBtn.disabled = false;
        saveImageBtn.innerHTML = '<i class="fa fa-save"></i>';
      });
    });

    // Edit Profile Form Handling
    document.getElementById('editProfileForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      
      // Show loading state
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.disabled = true;
      submitBtn.textContent = 'Saving...';
      
      fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        }
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(errorData => {
            throw new Error(errorData.message || 'Network response was not ok');
          });
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          // Update the displayed information
          document.getElementById('firstLastName').textContent = formData.get('name');
          // Close modal
          bootstrap.Modal.getInstance(document.getElementById('editProfileModal')).hide();
          // Show success toast
          showToast('Information updated successfully', 'success');
          // Reload page to reflect changes
          location.reload();
        } else {
          showToast(data.message || 'Error updating information', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('Error connecting to server. Please try again.', 'error');
      })
      .finally(() => {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      });
    });

    // Change Password Form Handling
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const formData = new FormData(this);
      
      // Validate password confirmation
      if (formData.get('password') !== formData.get('password_confirmation')) {
        showToast('New password and confirmation do not match', 'error');
        return;
      }

      // Show loading state
      const submitBtn = this.querySelector('button[type="submit"]');
      const originalText = submitBtn.textContent;
      submitBtn.disabled = true;
      submitBtn.textContent = 'Changing...';

      fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          'Accept': 'application/json'
        }
      })
      .then(response => {
        if (!response.ok) {
          return response.json().then(errorData => {
            throw new Error(errorData.message || 'Network response was not ok');
          });
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          // Close modal
          bootstrap.Modal.getInstance(document.getElementById('changePasswordModal')).hide();
          // Show success toast
          showToast('Password changed successfully', 'success');
          // Clear form
          this.reset();
        } else {
          showToast(data.message || 'Error changing password', 'error');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showToast('Error connecting to server. Please try again.', 'error');
      })
      .finally(() => {
        // Reset button state
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
      });
    });
  </script>
</body>

</html>