<!DOCTYPE html>
<html lang="en" dir="LTR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>Teacher Students - {{ $teacher->name }}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    <style>
        .page-header {
            background: linear-gradient(135deg,#fff 0%,#fff 100%);
            color: rgb(123, 105, 172);
            border-radius: 15px;
            padding: 1.2rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .schedule-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            border: none;
            transition: all 0.3s ease;
        }
        .schedule-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 25px rgba(0,0,0,0.12);
        }
        .table-header {
            background: linear-gradient(135deg,rgb(255, 255, 255) 0%,rgb(255, 255, 255) 100%) !important;
            color: rgb(123, 105, 172) !important;
            border-bottom: 2px solid #e9ecef;
        }
        .table-header th {
            color: rgb(123, 105, 172) !important;
            font-weight: 600 !important;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
        }
        .table-row {
            transition: all 0.2s ease;
            border-bottom: 1px solid #f8f9fa;
        }
        .table-row:hover {
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 86, 179, 0.05) 100%) !important;
            transform: scale(1.01);
        }
        .badge {
            border-radius: 20px;
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
        }
        .badge-success, .bg-gradient-success {
            background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%) !important;
            color: #fff !important;
        }
        .badge-info, .bg-gradient-info {
            background: linear-gradient(135deg, #20c997 0%, #1ea085 100%) !important;
            color: #fff !important;
        }
        .badge-secondary, .bg-gradient-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%) !important;
            color: #fff !important;
        }
        .empty-state {
            background: linear-gradient(135deg, rgba(0, 123, 255, 0.05) 0%, rgba(0, 86, 179, 0.05) 100%);
            border-radius: 15px;
            padding: 3rem 2rem;
        }
        .empty-state i {
            color: rgb(123, 105, 172);
            opacity: 0.8;
        }
    </style>
</head>
<body class="g-sidenav-show bg-gray-100">
@include('teacher.parts.sidebar-teacher')
    <main class="main-content position-relative border-radius-lg overflow-hidden">
        <div class="container-fluid py-4">
        <!-- Page Header -->
        <div class="row mb-2">
                <div class="col-12">
                <div class="page-header d-flex align-items-center">
                    <div class="me-3">
                        <i class="fas fa-users fa-2x"></i>
                        </div>
                        <div>
                        <h2 class="mb-1">Teacher Students</h2>
                        <p class="mb-0 opacity-75">View all students registered for {{ $teacher->name }}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-md-6 mb-2">
                <select class="form-select" id="filterSelect" style="border-radius: 10px; border: 1.5px solid #b3d4fc; color: #7b69ac; font-weight: 600;">
                            <option value="all">All Students</option>
                            @foreach($teacherCourses as $courseInstructor)
                              @php $course = $courseInstructor->course; @endphp
                              <option value="course-{{ $course->id }}">Course: {{ $course->title }}</option>
                            @endforeach
                            @foreach($teacherPackages ?? [] as $package)
                              <option value="package-{{ $package->id }}">Package: {{ $package->title }}</option>
                            @endforeach
                        </select>
                    </div>
            <div class="col-md-6 mb-2">
                <input type="text" id="studentSearch" class="form-control" placeholder="Search by student name..." style="border-radius: 10px; border: 1.5px solid #b3d4fc;">
            </div>
        </div>
        <!-- Students Table -->
            <div class="row">
                <div class="col-12">
                <div class="schedule-card card mb-4">
                        <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Registered Students List</h5>
                                <div>
                                    <span class="badge bg-info me-2" id="current-count">{{ $allStudents->count() }}</span>
                                    <span class="text-sm text-secondary">student(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="studentsTable">
                                <thead class="table-header">
                                    <tr>
                                        <th>Student</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th class="text-center">Enrollment Type</th>
                                        <th class="text-center">Course/Package</th>
                                        <th class="text-center">Registration Date</th>
                                        <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($allStudents as $student)
                                    <tr class="table-row" data-course-id="{{ $student['course_id'] ?? '' }}" data-package-id="{{ $student['package_id'] ?? '' }}" data-type="{{ $student['enrollment_type'] }}" data-name="{{ strtolower($student['name']) }}">
                                            <td>
                                            <div class="d-flex px-3 py-1 align-items-center">
                                                    <div>
                                                        <img src="{{ asset($student['avatar'] ?? 'images/default-avatar.png') }}" class="avatar avatar-sm me-3" alt="Avatar">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $student['name'] }}</h6>
                                                        <p class="text-xs text-secondary mb-0">ID: {{ $student['login_id'] ?? 'N/A' }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $student['email'] ?? '-' }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $student['mobile'] ?? '-' }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                @if(($student['enrollment_type'] ?? '') == 'course')
                                                <span class="badge bg-gradient-success">Direct Course</span>
                                                @elseif(($student['enrollment_type'] ?? '') == 'package')
                                                <span class="badge bg-gradient-info">Package</span>
                                                @else
                                                <span class="badge bg-gradient-secondary">N/A</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                @if(($student['enrollment_type'] ?? '') == 'course')
                                                    <p class="text-xs font-weight-bold mb-0">{{ $student['course_name'] ?? '-' }}</p>
                                                @elseif(($student['enrollment_type'] ?? '') == 'package')
                                                    <p class="text-xs font-weight-bold mb-0">{{ $student['package_name'] ?? '-' }}</p>
                                                @else
                                                    <p class="text-xs font-weight-bold mb-0">-</p>
                                                @endif
                                            </td>
                                            <td class="align-middle text-center">
                                                <p class="text-xs font-weight-bold mb-0">{{ $student['registration_date'] ?? '-' }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                @php
                                                    $status = strtolower($student['status'] ?? 'inactive');
                                                @endphp
                                                @if($status == 'active' || $status == '1')
                                                <span class="badge bg-gradient-success">Active</span>
                                                @else
                                                <span class="badge bg-gradient-secondary">Inactive</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                        <td colspan="7" class="text-center text-muted py-4 empty-state">
                                            <i class="fas fa-users fa-2x mb-3 d-block"></i>
                                                <p class="mb-0">No students registered</p>
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
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
        // تحسين البحث والفلترة
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.getElementById('filterSelect');
            const studentSearch = document.getElementById('studentSearch');
            const studentsTable = document.getElementById('studentsTable');
            const currentCount = document.getElementById('current-count');
            function updateTable() {
                const searchValue = studentSearch.value.trim().toLowerCase();
                const filterValue = filterSelect.value;
                let visibleCount = 0;
                Array.from(studentsTable.tBodies[0].rows).forEach(row => {
                    if (row.querySelector('td[colspan]')) return;
                    const studentName = row.getAttribute('data-name') || '';
                    const courseId = row.getAttribute('data-course-id') || '';
                    const packageId = row.getAttribute('data-package-id') || '';
                    const enrollmentType = row.getAttribute('data-type') || '';
                    let showRow = true;
                    if (searchValue && !studentName.includes(searchValue)) {
                        showRow = false;
                    }
                    if (filterValue !== 'all') {
                        if (filterValue.startsWith('course-')) {
                            const courseIdFilter = filterValue.replace('course-', '');
                            showRow = showRow && (enrollmentType === 'course' && courseId === courseIdFilter);
                        } else if (filterValue.startsWith('package-')) {
                            const packageIdFilter = filterValue.replace('package-', '');
                            showRow = showRow && (enrollmentType === 'package' && packageId === packageIdFilter);
                        }
                    }
                    row.style.display = showRow ? '' : 'none';
                    if (showRow) visibleCount++;
                });
                currentCount.textContent = visibleCount;
                const noDataRow = studentsTable.querySelector('tr.no-data-row');
                if (noDataRow) noDataRow.remove();
                if (visibleCount === 0) {
                    const tr = document.createElement('tr');
                    tr.className = 'no-data-row';
                tr.innerHTML = `<td colspan="7" class="text-center text-muted py-4 empty-state">
                    <i class="fas fa-users fa-2x mb-3 d-block"></i>
                        <p class="mb-0">No students match your search or filter</p>
                    </td>`;
                    studentsTable.tBodies[0].appendChild(tr);
                }
            }
            filterSelect.addEventListener('change', updateTable);
            studentSearch.addEventListener('input', updateTable);
        });
    </script>
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>
</html> 