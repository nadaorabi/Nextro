@extends('layouts.admin')

@section('title', 'Educational Categories List')

@push('styles')
    <style>
        .stat-card {
            min-height: 140px;
            border-radius: 16px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
            padding: 24px;
            background: #fff;
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 0, 0.04);
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.12);
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--card-color, #5e72e4);
        }
        
        .stat-card.primary::before { background: #5e72e4; }
        .stat-card.success::before { background: #2dce89; }
        .stat-card.info::before { background: #11cdef; }
        .stat-card.warning::before { background: #fb6340; }
        
        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px auto;
            font-size: 24px;
            color: white;
        }
        
        .stat-card .stat-icon.primary { background: linear-gradient(45deg, #5e72e4, #825ee4); }
        .stat-card .stat-icon.success { background: linear-gradient(45deg, #2dce89, #2dcecc); }
        .stat-card .stat-icon.info { background: linear-gradient(45deg, #11cdef, #1171ef); }
        .stat-card .stat-icon.warning { background: linear-gradient(45deg, #fb6340, #fbb140); }
        
        .stat-card .stat-title {
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #8898aa;
            margin-bottom: 8px;
            line-height: 1.2;
        }
        
        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            color: #32325d;
            margin-bottom: 4px;
            line-height: 1;
        }
        
        .stat-card .stat-description {
            font-size: 0.875rem;
            color: #8898aa;
            margin: 0;
            line-height: 1.3;
        }
        
        .stat-card .stat-description .highlight {
            font-weight: 600;
        }
        
        .stat-card .stat-description .success { color: #2dce89; }
        .stat-card .stat-description .info { color: #11cdef; }
        .stat-card .stat-description .warning { color: #fb6340; }

        .welcome-animated {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            animation: bounce 1.5s infinite alternate, gradientMove 3s linear infinite;
            letter-spacing: 2px;
            margin-top: 20px;
            background: linear-gradient(90deg, #007bff, #00c6ff, #007bff);
            background-size: 200% 200%;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-20px); }
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            100% { background-position: 100% 50%; }
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .modal-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }

        .border-dashed {
            border-style: dashed !important;
        }

        .bg-light-warning {
            background-color: rgba(255, 193, 7, 0.1) !important;
        }

        .bg-light-danger {
            background-color: rgba(220, 53, 69, 0.1) !important;
        }

        .btn-lg {
            border-radius: 10px;
            font-weight: 600;
        }

        .alert {
            border-radius: 10px;
        }

        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        .icon-shape {
            transition: all 0.3s ease;
        }

        .icon-shape:hover {
            transform: scale(1.1);
        }

        .border-dashed:hover {
            border-color: #667eea !important;
            background-color: rgba(102, 126, 234, 0.05) !important;
        }

        /* Custom file input styling for English */
        input[type="file"] {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            color: #495057 !important;
        }

        input[type="file"]::-webkit-file-upload-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            margin-right: 10px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            font-size: 0.875rem;
        }

        input[type="file"]::-webkit-file-upload-button:hover {
            background: #0056b3;
        }

        /* For Firefox */
        input[type="file"]::file-selector-button {
            background: #007bff;
            color: white;
            border: none;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            cursor: pointer;
            margin-right: 10px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif !important;
            font-size: 0.875rem;
        }

        input[type="file"]::file-selector-button:hover {
            background: #0056b3;
        }
        
        @media (max-width: 991px) {
            .stat-card {
                min-height: 120px;
                padding: 20px;
            }
            
            .stat-card .stat-icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
                margin-bottom: 12px;
            }
            
            .stat-card .stat-value {
                font-size: 2rem;
            }

            .modal-dialog.modal-lg {
                max-width: 95%;
                margin: 0.5rem auto;
            }

            .modal-body .row {
                flex-direction: column;
            }

            .modal-body .col-md-8,
            .modal-body .col-md-4 {
                max-width: 100%;
                flex: 0 0 100%;
            }
        }

        @media (max-width: 576px) {
            .modal-dialog.modal-lg {
                max-width: 98%;
                margin: 0.25rem auto;
            }

            .modal-body {
                padding: 1rem !important;
            }

            .form-control-lg,
            .form-select-lg {
                font-size: 1rem;
                padding: 0.5rem 0.75rem;
            }

            .btn-lg {
                padding: 0.5rem 1rem;
                font-size: 1rem;
            }

            .table-responsive {
                font-size: 0.875rem;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')

    <!-- Welcome Card -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="text-gradient text-primary">Educational Categories Management</h1>
                    <p class="mb-0">Manage, add, and edit educational categories and resources</p>
                </div>
                <div class="col-lg-6 text-end">
                    <a href="{{ route('admin.educational-categories.create') }}" class="btn btn-primary mb-0">
                        <i class="fas fa-plus"></i>&nbsp;&nbsp;Add New Category
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card primary">
                <div class="stat-icon primary">
                    <i class="fas fa-folder"></i>
                </div>
                <div class="stat-title">Total Categories</div>
                <div class="stat-value">{{ $totalCategories }}</div>
                <div class="stat-description">
                    <span class="highlight success">+{{ $categories->count() }}</span> on this page
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card success">
                <div class="stat-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-title">Active Categories</div>
                <div class="stat-value">{{ $activeCategories }}</div>
                <div class="stat-description">
                    <span class="highlight success">{{ round(($activeCategories / max($totalCategories, 1)) * 100) }}%</span> are active
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card stat-card info">
                <div class="stat-icon info">
                    <i class="fas fa-link"></i>
                </div>
                <div class="stat-title">Linked Courses</div>
                <div class="stat-value">{{ $linkedCourses }}</div>
                <div class="stat-description">
                    <span class="highlight info">{{ $categories->where('courses_count', '>', 0)->count() }}</span> categories linked
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card stat-card warning">
                <div class="stat-icon warning">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-title">Latest Category</div>
                <div class="stat-value">{{ $latestCategory ? \Illuminate\Support\Str::limit($latestCategory->name, 10) : '-' }}</div>
                <div class="stat-description">
                    <span class="highlight warning">{{ $latestCategory ? $latestCategory->created_at->diffForHumans() : 'None' }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Status Filter</label>
                        <select id="status-filter" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Search Categories</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input id="search-input" type="text" class="form-control" placeholder="Search by category name...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories Table -->
    <div class="card">
        <div class="card-header pb-0">
            <h6 class="text-primary fw-bold">Educational Categories</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Category Details</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Category ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Linked Courses</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Status</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Created Date</th>
                            <th class="text-secondary opacity-7">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ $category->image ? asset('storage/' . $category->image) : asset('images/theme/category-default.png') }}"
                                                class="avatar avatar-sm me-3" alt="category">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $category->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">
                                                {{ $category->description ?: 'No description available' }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        CAT-{{ str_pad($category->id, 3, '0', STR_PAD_LEFT) }}</p>
                                </td>
                                <td><span class="badge badge-sm bg-gradient-info">{{ $category->courses_count }}
                                        courses</span></td>
                                <td>
                                    @if($category->status === 'active')
                                        <span class="badge badge-sm bg-gradient-success">Active</span>
                                    @else
                                        <span class="badge badge-sm bg-gradient-warning">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">
                                        {{ $category->created_at->format('Y-m-d') }}
                                    </p>
                                </td>
                                <td class="align-middle">
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-link text-info p-2" data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal-{{ $category->id }}"
                                            title="Edit Category">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <a href="{{ route('admin.educational-categories.show', $category->id) }}"
                                            class="btn btn-link text-primary p-2"
                                            title="View Category Details">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <button class="btn btn-link text-danger p-2" data-bs-toggle="modal"
                                            data-bs-target="#deleteCategoryModal"
                                            onclick="confirmCategoryDelete({{ $category->id }}, '{{ $category->name }}')"
                                            title="Delete Category">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Delete Confirmation Modal -->
            <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <form method="POST" id="deleteCategoryForm">
                        @csrf
                        @method('DELETE')
                        <div class="modal-content border-0 shadow-lg">
                            <div class="modal-header bg-white text-dark border-bottom">
                                <h5 class="modal-title fw-bold" id="deleteCategoryModalLabel">
                                    <i class="fas fa-exclamation-triangle me-2 text-danger"></i>Confirm Deletion
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 text-center bg-white">
                                <div class="mb-4">
                                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle mx-auto mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-trash-alt text-white text-lg opacity-10" style="font-size: 2rem; line-height: 80px;"></i>
                                    </div>
                                    <h4 class="text-danger fw-bold mb-3">Are you sure?</h4>
                                    <p class="text-muted mb-2">You are about to delete the category:</p>
                                    <div class="alert alert-warning border-0 bg-light-warning">
                                        <strong class="text-warning" id="categoryNamePlaceholder"></strong>
                                    </div>
                                    <div class="alert alert-danger border-0 bg-light-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <strong>This action cannot be undone!</strong>
                                        <br>
                                        <small>All associated data will be permanently removed.</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer bg-white border-top justify-content-center">
                                <button type="button" class="btn btn-secondary btn-lg px-4 me-3" data-bs-dismiss="modal">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </button>
                                <button type="submit" class="btn btn-danger btn-lg px-4">
                                    <i class="fas fa-trash-alt me-2"></i>Delete Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <p class="text-sm mb-0">Showing
                    {{ $categories->firstItem() }}-{{ $categories->lastItem() }} of
                    {{ $categories->total() }} categories
                </p>
                {{ $categories->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    @foreach ($categories as $category)
        <!-- Edit Category Modal -->
        <div class="modal fade" id="editCategoryModal-{{ $category->id }}" tabindex="-1"
            aria-labelledby="editCategoryModalLabel-{{ $category->id }}" aria-hidden="true"
            data-bs-backdrop="static">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('admin.educational-categories.update', $category->id) }}" method="POST"
                    enctype="multipart/form-data" class="modal-content border-0 shadow-lg">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-white text-dark border-bottom">
                        <h5 class="modal-title fw-bold" id="editCategoryModalLabel-{{ $category->id }}">
                            <i class="fas fa-edit me-2 text-primary"></i>Edit Category
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4 bg-white">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="fas fa-tag me-2"></i>Category Name
                                    </label>
                                    <input type="text" name="name" value="{{ old('name', $category->name) }}"
                                        class="form-control form-control-lg border-2 border-light @error('name') is-invalid @enderror"
                                        placeholder="Enter category name..." required>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="fas fa-align-left me-2"></i>Description
                                    </label>
                                    <textarea name="description" class="form-control border-2 border-light @error('description') is-invalid @enderror"
                                        rows="4" placeholder="Enter category description...">{{ old('description', $category->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="fas fa-toggle-on me-2"></i>Status
                                    </label>
                                    <select name="status" class="form-select form-select-lg border-2 border-light @error('status') is-invalid @enderror">
                                        <option value="active" {{ old('status', $category->status) === 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive" {{ old('status', $category->status) === 'inactive' ? 'selected' : '' }}>
                                            Inactive
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="form-label fw-bold text-primary">
                                        <i class="fas fa-image me-2"></i>Category Image
                                    </label>
                                    <div class="border-2 border-dashed border-light rounded-3 p-3 text-center bg-light">
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*" lang="en">
                                        <small class="text-muted d-block mt-2">Upload new image (optional)</small>
                                    </div>
                                    @error('image')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                    @if ($category->image)
                                        <div class="mt-3 text-center">
                                            <label class="form-label fw-bold text-success">Current Image:</label>
                                            <div class="position-relative d-inline-block">
                                                <img src="{{ asset('storage/' . $category->image) }}"
                                                    class="img-thumbnail rounded-3 shadow-sm"
                                                    width="150" alt="Current category image">
                                                <div class="position-absolute top-0 end-0">
                                                    <span class="badge bg-success rounded-pill">
                                                        <i class="fas fa-check"></i> Current
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-white border-top">
                        <button type="button" class="btn btn-secondary btn-lg px-4" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Set page language to English to ensure file input displays English text
        document.documentElement.lang = 'en';
        
        function confirmCategoryDelete(categoryId, categoryName) {
            const form = document.getElementById('deleteCategoryForm');
            const namePlaceholder = document.getElementById('categoryNamePlaceholder');
            namePlaceholder.textContent = `"${categoryName}"`;
            form.action = `/admin/educational-categories/${categoryId}`;
        }

        document.addEventListener('DOMContentLoaded', function () {
            // Force English for all file inputs
            const fileInputs = document.querySelectorAll('input[type="file"]');
            fileInputs.forEach(input => {
                input.setAttribute('lang', 'en');
                input.style.fontFamily = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
            });

            const searchInput = document.getElementById('search-input');
            const statusFilter = document.getElementById('status-filter');
            const tableRows = document.querySelectorAll('table tbody tr');

            function filterCategories() {
                const searchText = searchInput.value.toLowerCase();
                const selectedStatus = statusFilter.value;

                tableRows.forEach(row => {
                    const name = row.querySelector('h6').textContent.toLowerCase();
                    const description = row.querySelector('p.text-secondary').textContent.toLowerCase();
                    const statusCell = row.cells[3];
                    if (!statusCell) return;
                    const status = statusCell.textContent.trim();

                    const matchesSearch = name.includes(searchText) || description.includes(searchText);
                    const matchesStatus = selectedStatus === '' || status === selectedStatus;

                    row.style.display = (matchesSearch && matchesStatus) ? '' : 'none';
                });
            }

            searchInput.addEventListener('input', filterCategories);
            statusFilter.addEventListener('change', filterCategories);
        });
    </script>
@endpush