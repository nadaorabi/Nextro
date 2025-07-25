@extends('layouts.admin')

@section('title', 'Edit Course')

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
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            .card-body {
                padding: 1rem 0.5rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12" style="max-width:900px;margin:auto;">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="mb-0 fw-bold text-primary">
                                <i class="fas fa-edit me-2"></i>
                                Edit Course
                            </h4>
                            <a href="{{ route('admin.educational-courses.show', $course) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-eye me-2"></i>
                                View Course
                            </a>
                        </div>

                        <form action="{{ route('admin.educational-courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" 
                                       required value="{{ old('title', $course->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $course->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Credit Hours</label>
                                <input type="number" name="credit_hours" class="form-control @error('credit_hours') is-invalid @enderror" 
                                       required value="{{ old('credit_hours', $course->credit_hours) }}">
                                @error('credit_hours')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price Section -->
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0 fw-bold">
                                        <i class="fas fa-dollar-sign me-2"></i>
                                        Pricing Information
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="is_free" id="isFree" value="1" 
                                                           {{ old('is_free', $course->is_free) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="isFree">
                                                        This course is free
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div id="priceFields" class="{{ old('is_free', $course->is_free) ? 'd-none' : '' }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Price</label>
                                                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                                           step="0.01" min="0" value="{{ old('price', $course->price) }}">
                                                    @error('price')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Currency</label>
                                                    <select name="currency" class="form-select @error('currency') is-invalid @enderror">
                                                        <option value="USD" {{ old('currency', $course->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                                        <option value="SAR" {{ old('currency', $course->currency) == 'SAR' ? 'selected' : '' }}>SAR</option>
                                                        <option value="AED" {{ old('currency', $course->currency) == 'AED' ? 'selected' : '' }}>AED</option>
                                                        <option value="EUR" {{ old('currency', $course->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                                                    </select>
                                                    @error('currency')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Discount Percentage</label>
                                                    <div class="input-group">
                                                        <input type="number" name="discount_percentage" class="form-control @error('discount_percentage') is-invalid @enderror" 
                                                               step="0.01" min="0" max="100" value="{{ old('discount_percentage', $course->discount_percentage) }}">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                    <small class="text-muted">Enter 0 for no discount</small>
                                                    @error('discount_percentage')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Final Price</label>
                                                    <div class="form-control-plaintext" id="finalPrice">
                                                        {{ $course->formatted_price }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="instructor-section" style="background: linear-gradient(135deg, #11cdef 0%, #1171ef 100%); color: white; border-radius: 10px; padding: 1.5rem; margin-bottom: 1.5rem;">
                                <h5 class="mb-4">
                                    <i class="fas fa-chalkboard-teacher me-2"></i>Instructor Information
                                </h5>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="mb-3">
                                            <label for="instructor_id" class="form-label" style="color:white;font-weight:600;">
                                                <i class="fas fa-user-tie me-2"></i>Select Instructor *
                                            </label>
                                            <select name="instructor_id" id="instructor_id" class="form-select @error('instructor_id') is-invalid @enderror" required>
                                                <option value="">Choose an instructor</option>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id }}" {{ old('instructor_id', optional($course->courseInstructors->first())->instructor_id) == $teacher->id ? 'selected' : '' }}>
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
                                            <label for="instructor_percentage" class="form-label" style="color:white;font-weight:600;">
                                                <i class="fas fa-percent me-2"></i>Instructor Share (%) *
                                            </label>
                                            <div class="input-group">
                                                <input type="number" name="instructor_percentage" id="instructor_percentage"
                                                    class="form-control @error('instructor_percentage') is-invalid @enderror" 
                                                    min="0" max="100" value="{{ old('instructor_percentage', optional($course->courseInstructors->first())->percentage) }}" 
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

                            <div class="mb-3">
                                <label class="form-label">Course Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" onchange="previewEditCourseImage(event)">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2 text-center">
                                    @if($course->hasImage())
                                        <img id="editCourseImagePreview" src="{{ $course->getImageUrl() }}" style="max-width:100%;max-height:180px;border-radius:10px;">
                                    @else
                                        <img id="editCourseImagePreview" src="" style="max-width:100%;max-height:180px;border-radius:10px;display:none;">
                                    @endif
                                </div>
                            </div>
                            <script>
                            function previewEditCourseImage(event) {
                                const [file] = event.target.files;
                                if (file) {
                                    const img = document.getElementById('editCourseImagePreview');
                                    img.src = URL.createObjectURL(file);
                                    img.style.display = 'block';
                                }
                            }
                            </script>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active" {{ old('status', $course->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="archived" {{ old('status', $course->status) == 'archived' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.educational-courses.show', $course) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>
                                    Update Course
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
                finalPriceElement.textContent = 'Free';
            } else {
                finalPriceElement.textContent = `${currency} ${finalPrice.toFixed(2)}`;
            }
        }

        // Add event listeners for price calculation
        document.querySelector('input[name="price"]').addEventListener('input', updateFinalPrice);
        document.querySelector('input[name="discount_percentage"]').addEventListener('input', updateFinalPrice);
        document.querySelector('select[name="currency"]').addEventListener('change', updateFinalPrice);

        // Initialize final price on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateFinalPrice();
        });
    </script>
@endpush 