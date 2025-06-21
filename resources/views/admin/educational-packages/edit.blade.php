@extends('layouts.admin')

@section('title', 'Edit Package')

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
        .current-image {
            max-width: 200px;
            border-radius: 10px;
            margin-top: 10px;
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
                                Edit Package
                            </h4>
                            <a href="{{ route('admin.educational-packages.show', $package) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-eye me-2"></i>
                                View Package
                            </a>
                        </div>

                        <form action="{{ route('admin.educational-packages.update', $package) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                       required value="{{ old('name', $package->name) }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $package->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Category</label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_id', $package->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" 
                                       required step="0.01" value="{{ old('price', $package->price) }}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Currency</label>
                                <select name="currency" class="form-select @error('currency') is-invalid @enderror">
                                    <option value="USD" {{ old('currency', $package->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                                    <option value="SAR" {{ old('currency', $package->currency) == 'SAR' ? 'selected' : '' }}>SAR</option>
                                    <option value="AED" {{ old('currency', $package->currency) == 'AED' ? 'selected' : '' }}>AED</option>
                                </select>
                                @error('currency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active" {{ old('status', $package->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $package->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Image</label>
                                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                @if($package->image)
                                    <div class="mt-2">
                                        <label class="form-label">Current Image:</label>
                                        <img src="{{ asset('storage/' . $package->image) }}" 
                                             alt="Current Package Image" class="current-image">
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Courses</label>
                                <select name="courses[]" class="form-select @error('courses') is-invalid @enderror" multiple>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" 
                                                {{ in_array($course->id, old('courses', $package->courses->pluck('id')->toArray())) ? 'selected' : '' }}>
                                            {{ $course->title }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('courses')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple courses.</small>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.educational-packages.show', $package) }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left me-2"></i>
                                    Cancel
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-2"></i>
                                    Update Package
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
        // Preview image before upload
        document.querySelector('input[name="image"]').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('img');
                    preview.src = e.target.result;
                    preview.className = 'current-image mt-2';
                    preview.alt = 'Preview';
                    
                    const container = document.querySelector('input[name="image"]').parentNode;
                    const existingPreview = container.querySelector('.current-image');
                    if (existingPreview) {
                        existingPreview.remove();
                    }
                    container.appendChild(preview);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush 