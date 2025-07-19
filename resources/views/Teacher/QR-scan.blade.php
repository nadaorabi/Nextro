{{-- Unified attendance system with admin --}}
@extends('layouts.teacher')
@section('content')
<div class="container-fluid mt-4">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-11">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h2 class="mb-1 fw-bold" style="color:#5f5aad">
                        <i class="fas fa-clipboard-check text-primary me-2"></i>
                        Attendance Management
                    </h2>
                    <div class="text-muted small">Select a course and session to take attendance or view details</div>
                </div>
                <div>
                    <a href="{{ route('teacher.attendance.details') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-list me-1"></i> Attendance Details
                    </a>
                    <a href="{{ route('teacher.attendance.export') }}" class="btn btn-outline-success">
                        <i class="fas fa-download me-1"></i> Export Data
                    </a>
                </div>
            </div>

            <!-- Courses List -->
            @forelse($teacherCourses as $courseInstructor)
            @php $course = $courseInstructor->course; @endphp
            <div class="card mb-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-2">
                        <div class="fw-bold" style="color:#5f5aad;font-size:1.1rem">
                            <i class="fas fa-book me-2"></i>{{ $course->title }}
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <div class="text-muted small">
                                <i class="fas fa-users me-1"></i>{{ $course->enrollments->count() }} Students
                            </div>
                            <div>
                                <span class="badge bg-light text-dark me-1">
                                    <i class="fas fa-chalkboard-teacher me-1"></i>{{ $courseInstructor->instructor->name }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Course Category and Package Information -->
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        @if($course->category)
                            <span class="badge bg-primary">
                                <i class="fas fa-folder me-1"></i>{{ $course->category->name }}
                            </span>
                        @endif
                        @if($course->packages && $course->packages->count() > 0)
                            <span class="badge bg-success">
                                <i class="fas fa-box me-1"></i>Package ({{ $course->packages->count() }})
                            </span>
                        @endif
                        @if($course->is_free)
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-gift me-1"></i>Free
                            </span>
                        @else
                            <span class="badge bg-info">
                                <i class="fas fa-dollar-sign me-1"></i>{{ $course->price ?? 0 }} {{ $course->currency ?? 'SAR' }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Linked Packages Details -->
                    @if($course->packages && $course->packages->count() > 0)
                        <div class="mb-3">
                            <small class="text-muted fw-bold">
                                <i class="fas fa-boxes me-1"></i>Linked Packages:
                            </small>
                            <div class="d-flex flex-wrap gap-1 mt-1">
                                @foreach($course->packages as $package)
                                    <span class="badge bg-light text-dark border">
                                        <i class="fas fa-box me-1"></i>{{ $package->name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Course Description -->
                    @if($course->description)
                        <div class="mb-3">
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>{{ Str::limit($course->description, 150) }}
                            </small>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Date</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Room</th>
                                    <th>Total / Present</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($course->schedules as $schedule)
                                @php
                                    $today = now()->format('Y-m-d');
                                    $scheduleDate = $schedule->session_date;
                                    $status = '';
                                    $statusClass = '';
                                    
                                    if ($scheduleDate < $today) {
                                        $status = 'Completed';
                                        $statusClass = 'text-muted';
                                    } elseif ($scheduleDate == $today) {
                                        $status = 'Today';
                                        $statusClass = 'text-success fw-bold';
                                    } else {
                                        $status = 'Upcoming';
                                        $statusClass = 'text-warning';
                                    }
                                    
                                    // Calculate attendance statistics
                                    $totalStudents = \App\Models\Enrollment::where('course_id', $course->id)->count();
                                    $presentStudents = \App\Models\Attendance::where('schedule_id', $schedule->id)
                                        ->where('status', 'present')
                                        ->count();
                                @endphp
                                <tr>
                                    <td>
                                        <span class="{{ $statusClass }}">{{ \Carbon\Carbon::parse($schedule->session_date)->format('Y-m-d') }}</span>
                                        <br><small class="text-muted">{{ $status }}</small>
                                    </td>
                                    <td>{{ __(ucfirst($schedule->day_of_week)) }}</td>
                                    <td>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }}</td>
                                    <td>{{ $schedule->room ? ($schedule->room->room_number ?? $schedule->room->name) : 'Not specified' }}</td>
                                    <td class="text-center">
                                        <span style="color:#5f5aad;font-weight:bold;font-size:1.15em">{{ $totalStudents }}</span>
                                        <span style="color:#888;font-size:1.1em">/</span>
                                        <span style="color:#28a745;font-weight:bold;font-size:1.15em">{{ $presentStudents }}</span>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-outline-primary btn-sm me-1" onclick="openAttendanceModal('{{ $course->title }}', {{ $schedule->id }})">
                                            <i class="fas fa-camera me-1"></i> Take Attendance
                                        </button>
                                        <a href="{{ route('teacher.attendance.qr-codes', $schedule->id) }}" class="btn btn-outline-info btn-sm me-1">
                                            <i class="fas fa-qrcode me-1"></i> QR Codes
                                        </a>
                                        <a href="{{ route('teacher.attendance.schedule-details', $schedule->id) }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="fas fa-list me-1"></i> Details
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-muted text-center">No scheduled sessions for this course</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @empty
            <div class="card shadow-sm border-0">
                <div class="card-body text-center py-5">
                    <i class="fas fa-book-open text-muted mb-3" style="font-size: 4rem;"></i>
                    <h4 class="text-muted">No courses assigned</h4>
                    <p class="text-muted">No courses have been assigned to you yet</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<!-- Modal for QR Code Scanner -->
<div class="modal fade" id="attendanceModal" tabindex="-1" role="dialog" aria-labelledby="attendanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="attendanceModalLabel">
                    <i class="fas fa-qrcode me-2"></i>
                    Take Attendance - <span id="subjectName"></span>
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row">
                    <div class="col-md-8">
                        <div class="scanner-container position-relative" style="border-radius: 10px; overflow: hidden;">
                            <div id="qr-reader" style="width: 100%"></div>
                            <div class="scanner-overlay">
                                <div class="scanner-line"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="attendance-stats p-3 bg-light rounded">
                            <h6 class="text-center mb-3">Attendance Statistics</h6>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Present Count:</span>
                                <span class="badge bg-primary" id="attendanceCount">0</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span>Last Scan:</span>
                                <span id="lastScanTime">-</span>
                            </div>
                            <div class="recent-scans mt-4">
                                <h6 class="mb-2">Recent Scans</h6>
                                <div id="recentScansList" class="list-group">
                                    <!-- Recent scans will be added here -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="qr-reader-results" class="mt-3"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    border: none;
}

.badge {
    font-size: 0.9rem;
    border-radius: 12px;
    padding: 0.4em 1em;
}

.badge.bg-primary {
    background-color: #5f5aad !important;
}

.badge.bg-success {
    background-color: #28a745 !important;
}

.badge.bg-warning {
    background-color: #ffc107 !important;
}

.badge.bg-info {
    background-color: #17a2b8 !important;
}

.badge.bg-light {
    background-color: #f8f9fa !important;
    color: #6c757d !important;
    border: 1px solid #dee2e6 !important;
}

.table thead th {
    font-weight: bold;
    color: #5f5aad;
    background: #f8f9fb !important;
    border-bottom: 2px solid #e9ecef;
}

.table td, .table th {
    vertical-align: middle;
}

/* QR Scanner Styles */
.scanner-container {
    position: relative;
    background: #000;
    min-height: 300px;
    border-radius: 1rem;
    overflow: hidden;
}

.scanner-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
}

.scanner-line {
    position: absolute;
    width: 100%;
    height: 2px;
    background: #00ff00;
    box-shadow: 0 0 8px #00ff00;
    animation: scan 2s linear infinite;
}

@keyframes scan {
    0% { top: 0; }
    100% { top: 100%; }
}

.scan-success {
    animation: success-pulse 0.5s ease-in-out;
}

@keyframes success-pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); color: #28a745; }
    100% { transform: scale(1); }
}

.recent-scan-item {
    transition: all 0.3s ease;
}

.recent-scan-item:hover {
    transform: translateX(-5px);
}

.attendance-stats {
    background: #f6f9ff;
    border-radius: 1rem;
    box-shadow: 0 2px 8px 0 rgba(80, 120, 200, 0.07);
}
</style>

<!-- QR Code Scanner -->
<script src="https://unpkg.com/html5-qrcode"></script>

<script>
    let attendanceCount = 0;
    const recentScans = [];
    let currentScheduleId = null;
    let html5QrCode = null;
    let isScannerActive = false;
    let scannedStudents = new Set(); // Prevent duplicate scans
    
    function openAttendanceModal(subject, scheduleId) {
        console.log('Opening modal for subject:', subject, 'schedule ID:', scheduleId);
        document.getElementById('subjectName').textContent = subject;
        currentScheduleId = scheduleId;
        
        // Reset attendance count for new session
        attendanceCount = 0;
        scannedStudents.clear(); // Clear scanned students list
        document.getElementById('attendanceCount').textContent = attendanceCount;
        document.getElementById('lastScanTime').textContent = '-';
        document.getElementById('recentScansList').innerHTML = '';
        document.getElementById('qr-reader-results').innerHTML = '';
        
        var modal = new bootstrap.Modal(document.getElementById('attendanceModal'));
        modal.show();
        
        // Initialize QR Scanner only if not already active
        if (!isScannerActive) {
            startQRScanner();
        }
    }
    
    function startQRScanner() {
        if (html5QrCode) {
            html5QrCode.clear();
        }
        
        html5QrCode = new Html5Qrcode("qr-reader");
        isScannerActive = true;
        
        html5QrCode.start(
            { facingMode: "environment" },
            {
                fps: 10,
                qrbox: 250,
                aspectRatio: 1.0
            },
            (decodedText, decodedResult) => {
                handleQRScan(decodedText);
            },
            (errorMessage) => {
                // Ignore errors
            }
        ).catch(err => {
            console.error('QR Scanner error:', err);
            isScannerActive = false;
        });
    }
    
    function handleQRScan(decodedText) {
        // Check if student already scanned
        if (scannedStudents.has(decodedText)) {
            // Show duplicate message
            const resultsDiv = document.getElementById('qr-reader-results');
            resultsDiv.innerHTML = `
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    This student has already been scanned: ${decodedText}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
            return;
        }
        
        // Add student to scanned set
        scannedStudents.add(decodedText);
        
        // Add success animation
        const scannerContainer = document.querySelector('.scanner-container');
        scannerContainer.classList.add('scan-success');
        setTimeout(() => {
            scannerContainer.classList.remove('scan-success');
        }, 500);
        
        // Update attendance count
        attendanceCount++;
        document.getElementById('attendanceCount').textContent = attendanceCount;
        
        // Update last scan time
        const now = new Date();
        document.getElementById('lastScanTime').textContent = now.toLocaleTimeString();
        
        // Add to recent scans
        recentScans.unshift({
            id: decodedText,
            time: now.toLocaleTimeString()
        });
        
        // Keep only last 5 scans
        if (recentScans.length > 5) {
            recentScans.pop();
        }
        
        // Update recent scans list
        updateRecentScansList();
        
        // Show success message
        const resultsDiv = document.getElementById('qr-reader-results');
        resultsDiv.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                Student attendance recorded: ${decodedText}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Send attendance data to server
        console.log('Current schedule ID:', currentScheduleId);
        saveAttendance(decodedText, currentScheduleId);
        
        // Update attendance count in the main table
        updateAttendanceCount(currentScheduleId);

        // Play success sound
        const beepSound = document.getElementById('beepSound');
        beepSound.currentTime = 0;
        beepSound.volume = 1.0;
        beepSound.play();
    }
    
    function saveAttendance(studentId, scheduleId) {
        console.log('Saving attendance for student:', studentId, 'schedule:', scheduleId);
        
        fetch('/teacher/attendance/scan', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                qr: studentId,
                schedule_id: scheduleId
            })
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (!data.success) {
                // Show error message
                const resultsDiv = document.getElementById('qr-reader-results');
                resultsDiv.innerHTML = `
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
            } else {
                // Show success message
                const resultsDiv = document.getElementById('qr-reader-results');
                resultsDiv.innerHTML = `
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        Attendance recorded successfully for student: ${studentId}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `;
                
                // Update attendance count in the main table
                updateAttendanceCount(scheduleId);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Show error message
            const resultsDiv = document.getElementById('qr-reader-results');
            resultsDiv.innerHTML = `
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    An error occurred while recording attendance. Please try again.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `;
        });
    }
    
    function updateAttendanceCount(scheduleId) {
        // Find the row with this schedule ID and update the attendance count
        const rows = document.querySelectorAll('tbody tr');
        rows.forEach(row => {
            const buttons = row.querySelectorAll('button');
            buttons.forEach(button => {
                const onclick = button.getAttribute('onclick');
                if (onclick && onclick.includes(scheduleId.toString())) {
                    // This is the row for this schedule
                    const attendanceCell = row.querySelector('td:nth-child(5)');
                    if (attendanceCell) {
                        const totalSpan = attendanceCell.querySelector('span:first-child');
                        const presentSpan = attendanceCell.querySelector('span:last-child');
                        
                        if (totalSpan && presentSpan) {
                            const total = parseInt(totalSpan.textContent);
                            const present = parseInt(presentSpan.textContent) + 1;
                            presentSpan.textContent = present;
                            
                            // Add animation to the updated number
                            presentSpan.style.animation = 'pulse 0.5s ease-in-out';
                            setTimeout(() => {
                                presentSpan.style.animation = '';
                            }, 500);
                        }
                    }
                }
            });
        });
        
        // Also update the attendance count in the modal
        const modalAttendanceCount = document.getElementById('attendanceCount');
        if (modalAttendanceCount) {
            const currentCount = parseInt(modalAttendanceCount.textContent);
            modalAttendanceCount.textContent = currentCount + 1;
            
            // Add animation to the modal count
            modalAttendanceCount.style.animation = 'pulse 0.5s ease-in-out';
            setTimeout(() => {
                modalAttendanceCount.style.animation = '';
            }, 500);
        }
    }
    
    function updateRecentScansList() {
        const list = document.getElementById('recentScansList');
        list.innerHTML = recentScans.map(scan => `
            <div class="list-group-item recent-scan-item d-flex justify-content-between align-items-center">
                <span>${scan.id}</span>
                <small class="text-muted">${scan.time}</small>
            </div>
        `).join('');
    }
    
    // Stop scanner when modal is closed
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('attendanceModal');
        modal.addEventListener('hidden.bs.modal', function () {
            if (html5QrCode && isScannerActive) {
                html5QrCode.stop().then(() => {
                    isScannerActive = false;
                    console.log('QR Scanner stopped');
                }).catch(err => {
                    console.error('Error stopping QR Scanner:', err);
                });
            }
        });
    });
</script>

<audio id="beepSound" class="success-sound" src="https://cdn.pixabay.com/audio/2022/03/15/audio_115b9b7bfa.mp3"></audio>
<div id="duplicateAlert" class="alert alert-warning text-center py-2" style="display:none; font-size:0.95rem;">This student has already been scanned.</div>
 
@endsection