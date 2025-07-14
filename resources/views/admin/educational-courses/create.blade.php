@extends('layouts.admin')

@section('title', 'Create Educational Course')

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

        .price-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .price-section .form-label {
            color: white;
            font-weight: 600;
        }

        .price-section .form-control, 
        .price-section .form-select {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            color: #344767;
        }

        .price-section .form-control:focus, 
        .price-section .form-select:focus {
            background: white;
            border-color: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        }

        .final-price-display {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            font-size: 1.2rem;
            font-weight: 700;
        }

        .instructor-section {
            background: linear-gradient(135deg, #11cdef 0%, #1171ef 100%);
            color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .instructor-section .form-label {
            color: white;
            font-weight: 600;
        }

        .instructor-section .form-control, 
        .instructor-section .form-select {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            color: #344767;
        }

        .instructor-section .form-control:focus, 
        .instructor-section .form-select:focus {
            background: white;
            border-color: white;
            box-shadow: 0 0 0 0.2rem rgba(255, 255, 255, 0.25);
        }

        .form-check-input:checked {
            background-color: #667eea;
            border-color: #667eea;
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
            <div class="col-12" style="max-width:1000px;">
                
                <!-- Header Card -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-0">Add New Educational Course</h4>
                                <p class="text-muted mb-0">Create a new course for your educational platform</p>
                            </div>
                            <div>
                                <a href="{{ route('admin.educational-courses.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Back to Courses
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
                        <form action="{{ route('admin.educational-courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Basic Information Section -->
                            <div class="form-section">
                                <h5 class="section-title">
                                    <i class="fas fa-info-circle me-2"></i>Basic Information
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-4">
                                            <label for="title" class="form-label">
                                                <i class="fas fa-book me-2"></i>Course Title *
                                            </label>
                                            <input type="text" name="title" id="title" 
                                                class="form-control @error('title') is-invalid @enderror" 
                                                value="{{ old('title') }}" 
                                                placeholder="Enter course title (e.g., Introduction to Web Development)"
                                                required>
                                            @error('title')
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
                                                placeholder="Provide a detailed description of this course...">{{ old('description') }}</textarea>
                                            @error('description')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label for="credit_hours" class="form-label">
                                                        <i class="fas fa-clock me-2"></i>Credit Hours *
                                                    </label>
                                                    <input type="number" name="credit_hours" id="credit_hours"
                                                        class="form-control @error('credit_hours') is-invalid @enderror" 
                                                        value="{{ old('credit_hours') }}" 
                                                        min="1" max="10"
                                                        placeholder="e.g., 3"
                                                        required>
                                                    @error('credit_hours')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-4">
                                                    <label for="category_id" class="form-label">
                                                        <i class="fas fa-folder me-2"></i>Category *
                                                    </label>
                                                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                                        <option value="">Select Category</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="status" class="form-label">
                                                <i class="fas fa-toggle-on me-2"></i>Course Status
                                            </label>
                                            <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                                    Active - Available to students
                                                </option>
                                                <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>
                                                    Inactive - Hidden from students
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
                                                <i class="fas fa-image me-2"></i>Course Image
                                            </label>
                                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewCourseImage(event)">
                                            @error('image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="mt-2 text-center">
                                                <img id="courseImagePreview" src="{{ asset('images/default-course.png') }}" style="max-width:100%;max-height:180px;border-radius:10px;display:none;" alt="Course Image Preview">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pricing Section -->
                            <div class="price-section">
                                <h5 class="mb-4">
                                    <i class="fas fa-dollar-sign me-2"></i>Pricing Information
                                </h5>
                                
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="is_free" id="isFree" value="1" {{ old('is_free') ? 'checked' : '' }}>
                                            <label class="form-check-label fw-bold" for="isFree">
                                                <i class="fas fa-gift me-2"></i>This course is free
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div id="priceFields" class="{{ old('is_free') ? 'd-none' : '' }}">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-tag me-2"></i>Price *
                                                </label>
                                                <input type="number" name="price" class="form-control" step="0.01" min="0" value="{{ old('price', 0) }}" placeholder="0.00">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-money-bill me-2"></i>Currency
                                                </label>
                                                <select name="currency" class="form-select">
                                                    <option value="USD" {{ old('currency', 'USD') == 'USD' ? 'selected' : '' }}>USD ($)</option>
                                                    <option value="SAR" {{ old('currency') == 'SAR' ? 'selected' : '' }}>SAR (ر.س)</option>
                                                    <option value="AED" {{ old('currency') == 'AED' ? 'selected' : '' }}>AED (د.إ)</option>
                                                    <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">
                                                    <i class="fas fa-percentage me-2"></i>Discount %
                                                </label>
                                                <div class="input-group">
                                                    <input type="number" name="discount_percentage" class="form-control" step="0.01" min="0" max="100" value="{{ old('discount_percentage', 0) }}" placeholder="0">
                                                    <span class="input-group-text bg-white">%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mx-auto">
                                            <label class="form-label text-center d-block">
                                                <i class="fas fa-calculator me-2"></i>Final Price
                                            </label>
                                            <div class="final-price-display" id="finalPrice">
                                                $0.00
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Instructor Section -->
                            <div class="instructor-section">
                                <h5 class="mb-4">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>Instructor Information
                                </h5>
                                
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="instructor_id" class="form-label">
                                                <i class="fas fa-user-tie me-2"></i>Select Instructor *
                                            </label>
                                            <select name="instructor_id" id="instructor_id" class="form-select @error('instructor_id') is-invalid @enderror" required>
                                                <option value="">Choose an instructor</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}" {{ old('instructor_id') == $teacher->id ? 'selected' : '' }}>
                                                        {{ $teacher->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('instructor_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="instructor_percentage" class="form-label">
                                                <i class="fas fa-percent me-2"></i>Instructor Share (%) *
                                            </label>
                                            <div class="input-group">
                                                <input type="number" name="instructor_percentage" id="instructor_percentage"
                                                    class="form-control @error('instructor_percentage') is-invalid @enderror" 
                                                    min="0" max="100" value="{{ old('instructor_percentage') }}" 
                                                    placeholder="e.g., 70" required>
                                                <span class="input-group-text bg-white">%</span>
                                            </div>
                                            @error('instructor_percentage')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Form Actions -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.educational-courses.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Create Course
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

        function previewCourseImage(event) {
            const [file] = event.target.files;
            if (file) {
                const img = document.getElementById('courseImagePreview');
                img.src = URL.createObjectURL(file);
                img.style.display = 'block';
            }
        }

        // Toggle price fields based on free checkbox
        document.getElementById('isFree').addEventListener('change', function() {
            const priceFields = document.getElementById('priceFields');
            const priceInput = document.querySelector('input[name="price"]');
            const discountInput = document.querySelector('input[name="discount_percentage"]');
            
            if (this.checked) {
                priceFields.classList.add('d-none');
                priceInput.value = '0';
                discountInput.value = '0';
                updateFinalPrice();
            } else {
                priceFields.classList.remove('d-none');
            }
        });

        // Calculate final price
        function updateFinalPrice() {
            const price = parseFloat(document.querySelector('input[name="price"]').value) || 0;
            const discount = parseFloat(document.querySelector('input[name="discount_percentage"]').value) || 0;
            const currency = document.querySelector('select[name="currency"]').value;
            const isFree = document.getElementById('isFree').checked;
            
            let finalPrice = 0;
            
            if (!isFree && price > 0) {
                if (discount > 0) {
                    const discountAmount = (price * discount) / 100;
                    finalPrice = price - discountAmount;
                } else {
                    finalPrice = price;
                }
            }
            
            const finalPriceElement = document.getElementById('finalPrice');
            if (isFree || finalPrice === 0) {
                finalPriceElement.innerHTML = '<i class="fas fa-gift me-2"></i>Free';
            } else {
                const currencySymbol = currency === 'USD' ? '$' : currency === 'SAR' ? 'ر.س' : currency === 'AED' ? 'د.إ' : '€';
                finalPriceElement.innerHTML = `<i class="fas fa-tag me-2"></i>${currencySymbol} ${finalPrice.toFixed(2)}`;
            }
        }

        // Add event listeners for price calculation
        document.querySelector('input[name="price"]').addEventListener('input', updateFinalPrice);
        document.querySelector('input[name="discount_percentage"]').addEventListener('input', updateFinalPrice);
        document.querySelector('select[name="currency"]').addEventListener('change', updateFinalPrice);

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            updateFinalPrice();
            
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
