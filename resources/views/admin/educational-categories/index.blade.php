@extends('layouts.admin')

@section('title', 'Educational Categories List')

@push('styles')
    <style>
        .custom-icon-style {
            transform: translateY(-4px);
            display: inline-block;
        }

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
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-20px);
            }
        }

        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }

            100% {
                background-position: 100% 50%;
            }
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .filter-bar {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .filter-bar select,
        .filter-bar input[type="text"] {
            min-width: 140px;
            max-width: 200px;
            border-radius: 8px;
            border: 1px solid #ddd;
            padding: 6px 12px;
        }

        @media (max-width: 600px) {
            .filter-bar {
                flex-direction: column;
                align-items: stretch;
            }
        }

        /* Modal Enhancements */
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
            background-color: #ffffff;
        }

        .modal-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-body {
            background-color: #ffffff;
        }

        .modal-footer {
            background-color: #ffffff;
            border-top: 1px solid #e9ecef;
        }

        .form-control:focus,
        .form-select:focus {
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

        /* Animation for modal */
        .modal.fade .modal-dialog {
            transition: transform 0.3s ease-out;
            transform: translate(0, -50px);
        }

        .modal.show .modal-dialog {
            transform: none;
        }

        /* Icon animations */
        .icon-shape {
            transition: all 0.3s ease;
        }

        .icon-shape:hover {
            transform: scale(1.1);
        }

        /* File upload area */
        .border-dashed:hover {
            border-color: #667eea !important;
            background-color: rgba(102, 126, 234, 0.05) !important;
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
                    <h1 class="text-gradient text-primary welcome-animated">Educational Category 📚
                    </h1>
                    <p class="mb-0">Manage, add, and edit educational materials and resources</p>
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
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Total Categories
                                </p>
                                <h5 class="font-weight-bolder">{{ $totalCategories }}</h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">+{{ $categories->count() }}</span>
                                    on this page
                                </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-collection text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Active
                                    Categories</p>
                                <h5 class="font-weight-bolder">{{ $activeCategories }}</h5>
                                <p class="mb-0">
                                    <span class="text-success text-sm font-weight-bolder">
                                        {{ round(($activeCategories / max($totalCategories, 1)) * 100) }}%
                                    </span> are active
                                </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-check-bold text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Linked Courses
                                </p>
                                <h5 class="font-weight-bolder">{{ $linkedCourses }}</h5>
                                <p class="mb-0">
                                    <span
                                        class="text-info text-sm font-weight-bolder">{{ $categories->where('courses_count', '>', 0)->count() }}</span>
                                    categories linked
                                </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="icon icon-shape bg-gradient-info shadow-info text-center rounded-circle">
                                <i class="ni ni-tag text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Last Created</p>
                                <h5 class="font-weight-bolder">
                                    {{ $latestCategory ? \Illuminate\Support\Str::limit($latestCategory->name, 14) : '-' }}
                                </h5>
                                <p class="mb-0">
                                    <span class="text-warning text-sm font-weight-bolder">
                                        {{ $latestCategory ? $latestCategory->created_at->diffForHumans() : '' }}
                                    </span>
                                    created
                                </p>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                <i class="ni ni-time-alarm text-lg opacity-10 custom-icon-style" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
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
                        <label class="form-label">Status</label>
                        <select id="status-filter" class="form-select">
                            <option value="">All Statuses</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label class="form-label">Search</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-search"></i></span>
                            <input id="search-input" type="text" class="form-control" placeholder="Search by category name...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Materials Table -->
    <div class="card">
        <div class="card-header pb-0">
            <h6 class="text-primary fw-bold">Categories</h6>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Category</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                Courses</th>
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
                                        <div class="d-flex flex-column justify-content-center ">
                                            <h6 class="mb-0 text-sm ">{{ $category->name }}</h6>
                                            <p class="text-xs text-secondary mb-0">
                                                {{ $category->description }}
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
                                            data-bs-target="#editCategoryModal-{{ $category->id }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <a href="{{ route('admin.educational-categories.show', $category->id) }}"
                                            class="btn btn-link text-primary p-2">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <button class="btn btn-link text-danger p-2" data-bs-toggle="modal"
                                            data-bs-target="#deleteCategoryModal"
                                            onclick="confirmCategoryDelete({{ $category->id }}, '{{ $category->name }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Modal Delete Confirmation -->
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
        <!-- Modal Edit Category خارج الجدول -->
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
                                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
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
        function confirmCategoryDelete(categoryId, categoryName) {
            const form = document.getElementById('deleteCategoryForm');
            const namePlaceholder = document.getElementById('categoryNamePlaceholder');
            namePlaceholder.textContent = `"${categoryName}"`;
            form.action = `/admin/educational-categories/${categoryId}`;
        }

        document.addEventListener('DOMContentLoaded', function () {
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