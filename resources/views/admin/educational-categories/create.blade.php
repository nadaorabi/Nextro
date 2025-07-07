@extends('layouts.admin')

@section('title', 'Create Educational Category')

@push('styles')
    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .card-body {
            padding: 2rem 2.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #344767;
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

        .form-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: #667eea;
            font-weight: 700;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        @media (max-width: 600px) {
            .card-body {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-12" style="max-width:900px;">
                
                <!-- Header Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">Add New Educational Category</h4>
                                <p class="text-muted mb-0">Create a new category to organize your educational content</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.educational-categories.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Categories
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Success/Error Messages -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <strong>Please fix the following errors:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="{{ route('admin.educational-categories.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <!-- Basic Information Section -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-info-circle me-2"></i>Basic Information
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-4">
                                            <label for="name" class="form-label">
                                                <i class="fas fa-tag me-2"></i>Category Name *
                                            </label>
                                            <input type="text" name="name" id="name" 
                                                class="form-control @error('name') is-invalid @enderror" 
                                                value="{{ old('name') }}" 
                                                placeholder="Enter category name (e.g., Mathematics, Science, Languages)"
                                                required>
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="description" class="form-label">
                                                <i class="fas fa-align-left me-2"></i>Description
                                            </label>
                                            <textarea name="description" id="description" 
                                                class="form-control @error('description') is-invalid @enderror" 
                                                rows="4" 
                                                placeholder="Provide a detailed description of this category...">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-4">
                                            <label for="status" class="form-label">
                                                <i class="fas fa-toggle-on me-2"></i>Category Status
                                            </label>
                                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                                    Active - Visible to users
                                                </option>
                                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                                    Inactive - Hidden from users
                                                </option>
                                            </select>
                                            @error('status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="mb-4">
                                            <label for="image" class="form-label">
                                                <i class="fas fa-image me-2"></i>Category Image
                                            </label>
                                            <div class="border-2 border-dashed rounded-3 p-4 text-center bg-light">
                                                <input type="file" name="image" id="image" 
                                                    class="form-control @error('image') is-invalid @enderror" 
                                                    accept="image/*"
                                                    onchange="previewImage(event)">
                                                <small class="text-muted d-block mt-2">
                                                    Upload an image (optional)<br>
                                                    <span class="text-primary">Supported: JPG, PNG, GIF (Max: 2MB)</span>
                                                </small>
                                                
                                                <!-- Image Preview -->
                                                <div id="imagePreview" class="mt-3" style="display: none;">
                                                    <img id="preview" src="" class="img-thumbnail" width="150" alt="Preview">
                                                    <div class="mt-2">
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="removeImage()">
                                                            <i class="fas fa-trash"></i> Remove
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.educational-categories.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        }

        function removeImage() {
            document.getElementById('image').value = '';
            document.getElementById('imagePreview').style.display = 'none';
        }

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
@endpush
