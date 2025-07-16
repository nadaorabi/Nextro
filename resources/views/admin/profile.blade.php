@extends('layouts.admin')

@section('title', 'Admin Profile')

@push('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="60" r="0.5" fill="white" opacity="0.1"/><circle cx="90" cy="40" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        opacity: 0.3;
    }

    .profile-content {
        position: relative;
        z-index: 1;
    }

    .profile-avatar {
        position: relative;
        display: inline-block;
    }

    .profile-avatar img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        background: #f8f9fa;
    }
    
    .profile-avatar img[src*="ui-avatars.com"] {
        background: linear-gradient(45deg, #667eea, #764ba2);
    }
    
    .profile-avatar img {
        transition: all 0.3s ease;
    }
    
    .profile-avatar img:hover {
        transform: scale(1.05);
    }
    
    .profile-avatar.loading img {
        opacity: 0.7;
    }
    
    .profile-avatar.loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        border: 2px solid #fff;
        border-top: 2px solid transparent;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: translate(-50%, -50%) rotate(0deg); }
        100% { transform: translate(-50%, -50%) rotate(360deg); }
    }

    .avatar-upload-btn {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: 3px solid white;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .avatar-upload-btn:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    .profile-info h3 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .profile-info p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 0;
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        border: none;
        margin-bottom: 2rem;
    }

    .card-header {
        background: linear-gradient(45deg, #f8f9fa, #e9ecef);
        border-radius: 15px 15px 0 0;
        border: none;
        padding: 1.5rem;
    }

    .card-header h5 {
        margin: 0;
        color: #495057;
        font-weight: 600;
    }

    .form-label {
        font-weight: 600;
        color: #344767;
        margin-bottom: 0.5rem;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 12px 15px;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
    }

    .btn-primary {
        background: linear-gradient(45deg, #667eea, #764ba2);
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #5a67d8, #6b46c1);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-secondary {
        background: #6c757d;
        border: none;
        border-radius: 10px;
        padding: 12px 30px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 10px;
        border: none;
    }

    .password-section {
        background: #f8f9fa;
        border-radius: 10px;
        padding: 1.5rem;
        margin-top: 2rem;
    }

    .password-section h6 {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    @media (max-width: 768px) {
        .profile-header {
            text-align: center;
            padding: 1.5rem;
        }
        
        .profile-info h3 {
            font-size: 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="profile-content">
            <div class="row align-items-center">
                <div class="col-md-3 text-center">
                    <div class="profile-avatar">
                        <img id="profileImage" src="{{ \App\Helpers\ImageHelper::getProfileImageUrl(auth()->user()) }}" alt="Profile Image" onerror="this.src='{{ \App\Helpers\ImageHelper::getDefaultAvatarUrl(auth()->user()->name ?? 'Admin') }}'">
                        <label for="imageInput" class="avatar-upload-btn">
                            <i class="fas fa-camera"></i>
                        </label>
                        <input type="file" id="imageInput" accept="image/*" style="display: none;">
                        
                        <!-- Fallback form for image upload -->
                        <form id="imageUploadForm" action="{{ route('admin.profile.image') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                            @csrf
                            @method('PUT')
                            <input type="file" name="profile_image" id="fallbackImageInput" accept="image/*">
                        </form>
                        
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="profile-info">
                        <h3>{{ auth()->user()->name ?? 'Admin User' }}</h3>
                        <p><i class="fas fa-envelope me-2"></i>{{ auth()->user()->email ?? 'admin@example.com' }}</p>
                        <p><i class="fas fa-user-tie me-2"></i>Administrator</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Please fix the following errors:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Profile Information Form -->
    <div class="card">
        <div class="card-header">
            <h5><i class="fas fa-user me-2"></i>Profile Information</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user me-2"></i>Full Name
                            </label>
                            <input type="text" name="name" id="name" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name', auth()->user()->name) }}" 
                                   placeholder="Enter your full name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope me-2"></i>Email Address
                            </label>
                            <input type="email" name="email" id="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email', auth()->user()->email) }}" 
                                   placeholder="Enter your email address" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                <i class="fas fa-phone me-2"></i>Phone Number
                            </label>
                            <input type="tel" name="phone" id="phone" 
                                   class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone', auth()->user()->phone) }}" 
                                   placeholder="Enter your phone number">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address" class="form-label">
                                <i class="fas fa-map-marker-alt me-2"></i>Address
                            </label>
                            <input type="text" name="address" id="address" 
                                   class="form-control @error('address') is-invalid @enderror" 
                                   value="{{ old('address', auth()->user()->address) }}" 
                                   placeholder="Enter your address">
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Dashboard
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Change Password Section -->
    <div class="card">
        <div class="card-header">
            <h5><i class="fas fa-lock me-2"></i>Change Password</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profile.password') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-key me-2"></i>Current Password
                            </label>
                            <input type="password" name="current_password" id="current_password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   placeholder="Enter current password" required>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">
                                <i class="fas fa-lock me-2"></i>New Password
                            </label>
                            <input type="password" name="new_password" id="new_password" 
                                   class="form-control @error('new_password') is-invalid @enderror" 
                                   placeholder="Enter new password" required>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">
                                <i class="fas fa-lock me-2"></i>Confirm New Password
                            </label>
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" 
                                   class="form-control @error('new_password_confirmation') is-invalid @enderror" 
                                   placeholder="Confirm new password" required>
                            @error('new_password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-key me-2"></i>Change Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Profile image upload functionality
document.getElementById('imageInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        console.log('File selected:', {
            name: file.name,
            size: file.size,
            type: file.type
        });
        
        // Validate file type
        if (!file.type.startsWith('image/')) {
            alert('Please select an image file.');
            return;
        }
        
        // Validate file size (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('Image size should be less than 2MB.');
            return;
        }
        
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
        
        // Show loading state
        const profileAvatar = document.querySelector('.profile-avatar');
        profileAvatar.classList.add('loading');
        
        // Disable the upload button during upload
        const uploadBtn = document.querySelector('.avatar-upload-btn');
        uploadBtn.style.pointerEvents = 'none';
        uploadBtn.style.opacity = '0.5';
        
        // Try AJAX upload first
        const form = new FormData();
        form.append('profile_image', file);
        form.append('_token', '{{ csrf_token() }}');
        form.append('_method', 'PUT');
        
        console.log('Uploading to:', '{{ route("admin.profile.image") }}');
        console.log('Form data:', {
            file: file.name,
            token: '{{ csrf_token() }}',
            method: 'PUT'
        });
        
        fetch('{{ route("admin.profile.image") }}', {
            method: 'POST',
            body: form,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Remove loading state
            profileAvatar.classList.remove('loading');
            uploadBtn.style.pointerEvents = '';
            uploadBtn.style.opacity = '';
            
            if (data.success) {
                // Update the profile image immediately
                if (data.image_url) {
                    const profileImage = document.getElementById('profileImage');
                    profileImage.src = data.image_url;
                    console.log('Profile image updated:', data.image_url);
                    
                    // Force image reload
                    profileImage.onload = function() {
                        console.log('Image loaded successfully');
                    };
                    profileImage.onerror = function() {
                        console.log('Image failed to load, using fallback');
                        this.src = '{{ \App\Helpers\ImageHelper::getDefaultAvatarUrl(auth()->user()->name ?? 'Admin') }}';
                    };
                }
                
                // Show success message
                const alert = document.createElement('div');
                alert.className = 'alert alert-success alert-dismissible fade show';
                alert.innerHTML = `
                    <i class="fas fa-check-circle me-2"></i>
                    Profile image updated successfully!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                `;
                document.querySelector('.container-fluid').insertBefore(alert, document.querySelector('.card'));
                
                // Auto-hide after 3 seconds
                setTimeout(() => {
                    alert.remove();
                }, 3000);
            } else {
                throw new Error(data.message || 'Upload failed');
            }
        })
        .catch(error => {
            console.error('AJAX upload failed:', error);
            
            // Remove loading state
            profileAvatar.classList.remove('loading');
            uploadBtn.style.pointerEvents = '';
            uploadBtn.style.opacity = '';
            
            // Show error message first
            const alert = document.createElement('div');
            alert.className = 'alert alert-warning alert-dismissible fade show';
            alert.innerHTML = `
                <i class="fas fa-exclamation-triangle me-2"></i>
                AJAX upload failed, trying traditional form submission...
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.querySelector('.container-fluid').insertBefore(alert, document.querySelector('.card'));
            
            // Auto-hide after 3 seconds
            setTimeout(() => {
                alert.remove();
            }, 3000);
            
            // Fallback to traditional form submission
            console.log('Trying fallback form submission...');
            const fallbackInput = document.getElementById('fallbackImageInput');
            const fallbackForm = document.getElementById('imageUploadForm');
            
            // Create a new FileList-like object
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fallbackInput.files = dataTransfer.files;
            
            // Submit the form
            fallbackForm.submit();
        });
    }
});

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(function(alert) {
        setTimeout(function() {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});
</script>
@endsection