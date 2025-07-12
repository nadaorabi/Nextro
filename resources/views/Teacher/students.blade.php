<!DOCTYPE html>
<html lang="en" dir="LTR">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <title>قائمة الطلاب - {{ $teacher->name }}</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
</head>
<body class="g-sidenav-show rtl" style="background:rgb(252, 252, 252); min-height: 100vh;">
    <div class="min-height-300 position-absolute w-100" style="background: transparent;"></div>
    
@include('teacher.parts.sidebar-teacher')

    <main class="main-content position-relative border-radius-lg overflow-hidden">
        <!-- Modern Teacher Info Card -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center mb-2"><!-- Reduced margin-bottom -->
                <div class="col-12">
                    <div style="background: #fff; border-radius: 22px; box-shadow: 0 4px 24px rgba(99,102,241,0.10); padding: 2.2rem 2.5rem; display: flex; align-items: center; gap: 1.5rem;">
                        <div style="display: flex; align-items: center; justify-content: center; min-width: 70px;">
                            <span style="background: linear-gradient(135deg, #a78bfa 0%, #6366f1 100%); border-radius: 16px; padding: 18px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-users fa-2x" style="color: #a78bfa;"></i>
                            </span>
                        </div>
                        <div>
                            <h2 style="font-weight: 800; color: #3730a3; margin-bottom: 0.3rem; font-size: 2.1rem;">Teacher Students</h2>
                            <div style="color: #8b5cf6; font-size: 1.1rem; font-weight: 500;">
                                View all students registered for {{ $teacher->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Filter Bar -->
            <div class="row justify-content-center mb-2"><!-- Reduced margin-bottom -->
                <div class="col-12">
                    <div style="background: #fff; border-radius: 18px; box-shadow: 0 2px 12px rgba(99,102,241,0.08); padding: 1.2rem 1.5rem; display: flex; flex-direction: row; align-items: center; gap: 1.2rem; flex-wrap: wrap;">
                        <select class="form-select" id="filterSelect" style="flex: 1 1 220px; min-width: 180px; max-width: 320px; border-radius: 16px; box-shadow: none; font-size: 1.18rem; height: 54px; padding: 14px 20px;">
                            <option value="all">All Students</option>
                            @foreach($teacherCourses as $courseInstructor)
                              @php $course = $courseInstructor->course; @endphp
                              <option value="course-{{ $course->id }}">Course: {{ $course->title }}</option>
                            @endforeach
                            @foreach($teacherPackages ?? [] as $package)
                              <option value="package-{{ $package->id }}">Package: {{ $package->title }}</option>
                            @endforeach
                        </select>
                        <input type="text" id="studentSearch" class="form-control" placeholder="Search by student name..." style="flex: 2 1 320px; min-width: 200px; max-width: 500px; border-radius: 16px; box-shadow: none; font-size: 1.18rem; height: 54px; padding: 14px 20px;">
                        <!-- Removed total students badge -->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <div class="d-flex justify-content-between">
                                <h6>Registered Students List</h6>
                                <div>
                                    <span class="badge bg-info me-2" id="current-count">{{ $allStudents->count() }}</span>
                                    <span class="text-sm text-secondary">student(s)</span>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0" id="studentsTable">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Student</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Phone</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Enrollment Type</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course/Package</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registration Date</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                            <!-- Removed Actions column -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($allStudents as $student)
                                        <tr data-course-id="{{ $student['course_id'] ?? '' }}" data-package-id="{{ $student['package_id'] ?? '' }}" data-type="{{ $student['enrollment_type'] }}" data-name="{{ strtolower($student['name']) }}">
                                            <td>
                                                <div class="d-flex px-3 py-1">
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
                                                    <span class="badge badge-sm bg-gradient-success">Direct Course</span>
                                                @elseif(($student['enrollment_type'] ?? '') == 'package')
                                                    <span class="badge badge-sm bg-gradient-info">Package</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">N/A</span>
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
                                                    <span class="badge badge-sm bg-gradient-success">Active</span>
                                                @else
                                                    <span class="badge badge-sm bg-gradient-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <!-- Removed Actions cell -->
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="fas fa-users fa-2x mb-3 opacity-50"></i>
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

        // تحسين البحث والفلترة
        document.addEventListener('DOMContentLoaded', function() {
            const filterSelect = document.getElementById('filterSelect');
            const studentSearch = document.getElementById('studentSearch');
            const studentsTable = document.getElementById('studentsTable');
            const currentCount = document.getElementById('current-count');
            // const studentsCount = document.getElementById('studentsCount'); // removed

            function updateTable() {
                const searchValue = studentSearch.value.trim().toLowerCase();
                const filterValue = filterSelect.value;
                let visibleCount = 0;

                Array.from(studentsTable.tBodies[0].rows).forEach(row => {
                    // تخطي صف "لا يوجد طلاب"
                    if (row.querySelector('td[colspan]')) return;
                    const studentName = row.getAttribute('data-name') || '';
                    const courseId = row.getAttribute('data-course-id') || '';
                    const packageId = row.getAttribute('data-package-id') || '';
                    const enrollmentType = row.getAttribute('data-type') || '';

                    let showRow = true;

                    // Search filter
                    if (searchValue && !studentName.includes(searchValue)) {
                        showRow = false;
                    }

                    // Course/Package filter
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
                // studentsCount.innerHTML = `Total: ${visibleCount} student(s)`; // removed

                // إظهار رسالة لا يوجد طلاب إذا لم يوجد نتائج
                const noDataRow = studentsTable.querySelector('tr.no-data-row');
                if (noDataRow) noDataRow.remove();
                if (visibleCount === 0) {
                    const tr = document.createElement('tr');
                    tr.className = 'no-data-row';
                    tr.innerHTML = `<td colspan="7" class="text-center text-muted py-4">
                        <i class="fas fa-users fa-2x mb-3 opacity-50"></i>
                        <p class="mb-0">No students match your search or filter</p>
                    </td>`;
                    studentsTable.tBodies[0].appendChild(tr);
                }
            }

            filterSelect.addEventListener('change', updateTable);
            studentSearch.addEventListener('input', updateTable);
        });

        function sendMessage(studentName) {
            alert(`Send a message to ${studentName}`);
        }

        function viewProfile(studentName) {
            alert(`View profile of ${studentName}`);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('js/argon-dashboard.min.js?v=2.1.0') }}"></script>
</body>

</html> 