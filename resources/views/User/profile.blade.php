@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('hero')
<link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-3-min.jpg') }}');">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Student Dashboard</h1>
                <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <p>Welcome to your personalized academic dashboard</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="welcome-card">
                <div class="welcome-content">
                    <div class="welcome-avatar">
                        @if(Auth::user()->image)
                            <img src="{{ asset(Auth::user()->image) }}" alt="Profile Picture">
                        @else
                            <img src="{{ asset('images/staff_1.jpg') }}" alt="Profile Picture">
                        @endif
                    </div>
                    <div class="welcome-info">
                        <h2 class="welcome-name">{{ Auth::user()->name }}</h2>
                        <p class="welcome-id">Student ID: {{ Auth::user()->login_id }}</p>
                        <p class="welcome-email">{{ Auth::user()->email }}</p>
                        <div class="welcome-status">
                            <span class="status-badge {{ Auth::user()->is_active == 1 ? 'active' : 'inactive' }}">
                                {{ Auth::user()->is_active == 1 ? 'Active Student' : 'Inactive' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="welcome-actions">
                    <a href="#qr-scanner" class="btn btn-primary btn-lg">
                        <i class="fas fa-qrcode me-2"></i>Scan QR
                    </a>
                    <a href="#contact" class="btn btn-outline-primary btn-lg">
                        <i class="fas fa-envelope me-2"></i>Contact Support
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card stats-card-primary">
                <div class="stats-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number">{{ ($enrollments ?? collect())->count() }}</h3>
                    <p class="stats-label">Enrolled Courses</p>
                    <div class="stats-progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card stats-card-success">
                <div class="stats-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number">{{ $attendanceRate ?? 0 }}%</h3>
                    <p class="stats-label">Attendance Rate</p>
                    <div class="stats-progress">
                        <div class="progress-bar" style="width: {{ $attendanceRate ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card stats-card-info">
                <div class="stats-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number">{{ $averageGrade ?? 0 }}%</h3>
                    <p class="stats-label">Average Grade</p>
                    <div class="stats-progress">
                        <div class="progress-bar" style="width: {{ $averageGrade ?? 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stats-card stats-card-warning">
                <div class="stats-icon">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number">${{ number_format($netPayment ?? 0, 0) }}</h3>
                    <p class="stats-label">Net Payment</p>
                    <div class="stats-progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="row">
        <!-- Left Column -->
        <div class="col-lg-8">
            <!-- Current Courses Section -->
            <div class="dashboard-section mb-4">
                <div class="section-header">
                    <h3><i class="fas fa-book me-2"></i>Current Courses</h3>
                    <span class="section-badge">{{ ($enrollments ?? collect())->count() }} Courses</span>
                </div>
                <div class="section-content">
                    @forelse($enrollments ?? [] as $enrollment)
                        @if($enrollment->course)
                            <div class="course-card">
                                <div class="course-image">
                                    @php
                                        $courseImage = $enrollment->course->image ?? ($enrollment->course->category->image ?? 'images/img_3.jpg');
                                    @endphp
                                    <img src="{{ asset($courseImage) }}" alt="Course Image" onerror="this.src='{{ asset('images/img_3.jpg') }}'">
                                    <div class="course-badge">Active</div>
                                </div>
                                <div class="course-info">
                                    <h4 class="course-title">{{ $enrollment->course->title }}</h4>
                                    <p class="course-description">{{ Str::limit($enrollment->course->description ?? 'No description available', 100) }}</p>
                                    <div class="course-meta">
                                        <span class="meta-item">
                                            <i class="fas fa-tag"></i>
                                            {{ $enrollment->course->category->name ?? 'No Category' }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-user"></i>
                                            {{ $enrollment->course->courseInstructors->first()->instructor->name ?? 'No Instructor' }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="fas fa-calendar"></i>
                                            {{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('M d, Y') }}
                                        </span>
                                    </div>
                                </div>
                                <div class="course-actions">
                                    <button class="btn btn-sm btn-outline-primary">View Details</button>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-book-open"></i>
                            <h4>No Courses Enrolled</h4>
                            <p>You haven't enrolled in any courses yet.</p>
                            <a href="#" class="btn btn-primary">Browse Courses</a>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Recent Attendance -->
            <div class="dashboard-section mb-4">
                <div class="section-header">
                    <h3><i class="fas fa-calendar-check me-2"></i>Recent Attendance</h3>
                    <span class="section-badge">{{ ($attendances ?? collect())->count() }} Records</span>
                </div>
                <div class="section-content">
                    <div class="attendance-list">
                        @forelse(($attendances ?? collect())->take(5) as $attendance)
                            <div class="attendance-item">
                                <div class="attendance-date">
                                    <div class="date-day">{{ \Carbon\Carbon::parse($attendance->date)->format('d') }}</div>
                                    <div class="date-month">{{ \Carbon\Carbon::parse($attendance->date)->format('M') }}</div>
                                </div>
                                <div class="attendance-info">
                                    <h5>{{ $attendance->enrollment->course->title ?? 'Unknown Course' }}</h5>
                                    <p>{{ \Carbon\Carbon::parse($attendance->date)->format('l, F d, Y') }}</p>
                                </div>
                                <div class="attendance-status">
                                    @if($attendance->status == 'present')
                                        <span class="status-badge present">Present</span>
                                    @elseif($attendance->status == 'absent')
                                        <span class="status-badge absent">Absent</span>
                                    @elseif($attendance->status == 'late')
                                        <span class="status-badge late">Late</span>
                                    @else
                                        <span class="status-badge pending">Pending</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-calendar-times"></i>
                                <h4>No Attendance Records</h4>
                                <p>Your attendance records will appear here.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="col-lg-4">
            <!-- Quick Actions -->
            <div class="dashboard-section mb-4">
                <div class="section-header">
                    <h3><i class="fas fa-bolt me-2"></i>Quick Actions</h3>
                </div>
                <div class="section-content">
                    <div class="quick-actions">
                        <a href="#qr-scanner" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <div class="action-text">
                                <h5>Scan QR Code</h5>
                                <p>Mark your attendance</p>
                            </div>
                        </a>
                        
                        <a href="#grades" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="action-text">
                                <h5>View Grades</h5>
                                <p>Check your progress</p>
                            </div>
                        </a>
                        
                        <a href="#financial" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-wallet"></i>
                            </div>
                            <div class="action-text">
                                <h5>Financial Status</h5>
                                <p>Payment history</p>
                            </div>
                        </a>
                        
                        <a href="#contact" class="action-card">
                            <div class="action-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="action-text">
                                <h5>Contact Support</h5>
                                <p>Get help</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Academic Summary -->
            <div class="dashboard-section mb-4">
                <div class="section-header">
                    <h3><i class="fas fa-graduation-cap me-2"></i>Academic Summary</h3>
                </div>
                <div class="section-content">
                    <div class="academic-summary">
                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fas fa-book"></i>
                            </div>
                            <div class="summary-content">
                                <h4>{{ ($enrollments ?? collect())->count() }}</h4>
                                <p>Enrolled Courses</p>
                            </div>
                        </div>
                        
                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="summary-content">
                                <h4>{{ ($studentPackages ?? collect())->count() }}</h4>
                                <p>Enrolled Packages</p>
                            </div>
                        </div>
                        
                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="summary-content">
                                <h4>{{ $totalGrades ?? 0 }}</h4>
                                <p>Completed Assessments</p>
                            </div>
                        </div>
                        
                        <div class="summary-item">
                            <div class="summary-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="summary-content">
                                <h4>{{ $totalSessions ?? 0 }}</h4>
                                <p>Total Sessions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Grades -->
            <div class="dashboard-section">
                <div class="section-header">
                    <h3><i class="fas fa-star me-2"></i>Recent Grades</h3>
                </div>
                <div class="section-content">
                    <div class="grades-list">
                        @forelse(($grades ?? collect())->take(3) as $grade)
                            <div class="grade-item">
                                <div class="grade-course">
                                    <h6>{{ $grade->enrollment->course->title ?? 'Unknown Course' }}</h6>
                                    <p>{{ ucfirst($grade->assessment_type) }}</p>
                                </div>
                                <div class="grade-score">
                                    <span class="grade-badge grade-{{ $grade->score >= 90 ? 'a' : ($grade->score >= 80 ? 'b' : ($grade->score >= 70 ? 'c' : ($grade->score >= 60 ? 'd' : 'f'))) }}">
                                        {{ $grade->score }}%
                                    </span>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <i class="fas fa-star"></i>
                                <h4>No Grades Yet</h4>
                                <p>Your grades will appear here.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QR Scanner Modal -->
<div class="modal fade" id="qrModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title">
                    <i class="fas fa-qrcode me-2"></i>Scan QR Code
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                @include('profile_parts.QR')
            </div>
        </div>
    </div>
</div>

<!-- Contact Modal -->
<div class="modal fade" id="contactModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-envelope me-2"></i>Contact Support
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                @include('profile_parts.Contact-Us')
            </div>
        </div>
    </div>
</div>

<!-- Grades Modal -->
<div class="modal fade" id="gradesModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-chart-line me-2"></i>Academic Grades
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                @include('profile_parts.grade')
            </div>
        </div>
    </div>
</div>

<!-- Financial Modal -->
<div class="modal fade" id="financialModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-gradient-warning text-white">
                <h5 class="modal-title">
                    <i class="fas fa-wallet me-2"></i>Financial Status
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                @include('profile_parts.Financial-Status')
            </div>
        </div>
    </div>
</div>

<style>
/* Modern Dashboard Styles */
.container-fluid {
    max-width: 1400px;
    margin: 0 auto;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 2rem 1rem;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #5a6fd8 0%, #6a4190 100%);
}

/* Welcome Card */
.welcome-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 2rem;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.welcome-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: float 6s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

.welcome-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}

.welcome-content {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.welcome-avatar img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid rgba(255,255,255,0.3);
}

.welcome-info h2 {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 700;
    text-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.welcome-info p {
    margin: 0.25rem 0;
    opacity: 0.9;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.status-badge.active {
    background: rgba(40, 167, 69, 0.2);
    color: #28a745;
}

.status-badge.inactive {
    background: rgba(220, 53, 69, 0.2);
    color: #dc3545;
}

.welcome-actions {
    display: flex;
    gap: 1rem;
}

.welcome-actions .btn {
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.welcome-actions .btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Statistics Cards */
.stats-card {
    background: white;
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.2);
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.stats-card:hover::before {
    left: 100%;
}

.stats-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
}

.stats-card-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.stats-card-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
}

.stats-card-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.stats-card-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
}

.stats-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1rem;
}

.stats-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    line-height: 1;
}

.stats-label {
    font-size: 0.875rem;
    opacity: 0.9;
    margin: 0.5rem 0;
}

.stats-progress {
    height: 4px;
    background: rgba(255,255,255,0.2);
    border-radius: 2px;
    overflow: hidden;
}

.progress-bar {
    height: 100%;
    background: rgba(255,255,255,0.8);
    transition: width 0.3s ease;
}

/* Dashboard Sections */
.dashboard-section {
    background: white;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    overflow: hidden;
}

.section-header {
    background: #f8f9fa;
    padding: 1.5rem;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.section-header h3 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: #344767;
}

.section-badge {
    background: #667eea;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.section-content {
    padding: 1.5rem;
}

/* Course Cards */
.course-card {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding: 1.5rem;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    margin-bottom: 1rem;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    background: white;
    position: relative;
    overflow: hidden;
}

.course-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: scaleY(0);
    transition: transform 0.3s ease;
}

.course-card:hover::before {
    transform: scaleY(1);
}

.course-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transform: translateY(-5px);
    border-color: #667eea;
}

.course-image {
    position: relative;
    flex-shrink: 0;
}

.course-image img {
    width: 80px;
    height: 80px;
    border-radius: 15px;
    object-fit: cover;
}

.course-badge {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #28a745;
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 600;
}

.course-info {
    flex: 1;
}

.course-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0 0 0.5rem 0;
    color: #344767;
}

.course-description {
    color: #6c757d;
    margin: 0 0 1rem 0;
    font-size: 0.875rem;
}

.course-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: #6c757d;
}

.meta-item i {
    color: #667eea;
}

/* Attendance List */
.attendance-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.attendance-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    transition: all 0.3s ease;
}

.attendance-item:hover {
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.attendance-date {
    text-align: center;
    min-width: 60px;
}

.date-day {
    font-size: 1.5rem;
    font-weight: 700;
    color: #667eea;
    line-height: 1;
}

.date-month {
    font-size: 0.875rem;
    color: #6c757d;
    text-transform: uppercase;
}

.attendance-info {
    flex: 1;
}

.attendance-info h5 {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
    font-weight: 600;
}

.attendance-info p {
    margin: 0;
    font-size: 0.875rem;
    color: #6c757d;
}

.status-badge.present {
    background: #d4edda;
    color: #155724;
}

.status-badge.absent {
    background: #f8d7da;
    color: #721c24;
}

.status-badge.late {
    background: #fff3cd;
    color: #856404;
}

.status-badge.pending {
    background: #e2e3e5;
    color: #383d41;
}

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.action-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.5rem;
    border: 1px solid #e9ecef;
    border-radius: 15px;
    text-decoration: none;
    color: inherit;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    background: white;
    position: relative;
    overflow: hidden;
}

.action-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(102, 126, 234, 0.1), transparent);
    transition: left 0.5s;
}

.action-card:hover::before {
    left: 100%;
}

.action-card:hover {
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transform: translateY(-5px) scale(1.02);
    text-decoration: none;
    color: inherit;
    border-color: #667eea;
}

.action-icon {
    width: 50px;
    height: 50px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.action-text h5 {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
    font-weight: 600;
}

.action-text p {
    margin: 0;
    font-size: 0.875rem;
    color: #6c757d;
}

/* Academic Summary */
.academic-summary {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.summary-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.summary-item:hover {
    box-shadow: 0 3px 10px rgba(0,0,0,0.1);
}

.summary-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.summary-content h4 {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 700;
    color: #344767;
}

.summary-content p {
    margin: 0;
    font-size: 0.875rem;
    color: #6c757d;
}

/* Grades List */
.grades-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.grade-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    border: 1px solid #e9ecef;
    border-radius: 12px;
}

.grade-course h6 {
    margin: 0 0 0.25rem 0;
    font-size: 1rem;
    font-weight: 600;
}

.grade-course p {
    margin: 0;
    font-size: 0.875rem;
    color: #6c757d;
}

.grade-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.875rem;
}

.grade-a {
    background: #d4edda;
    color: #155724;
}

.grade-b {
    background: #cce7ff;
    color: #004085;
}

.grade-c {
    background: #fff3cd;
    color: #856404;
}

.grade-d {
    background: #ffeaa7;
    color: #6c5ce7;
}

.grade-f {
    background: #f8d7da;
    color: #721c24;
}

/* Empty States */
.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: #6c757d;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    border: 2px dashed #dee2e6;
    transition: all 0.3s ease;
}

.empty-state:hover {
    border-color: #667eea;
    background: linear-gradient(135deg, #f0f2ff 0%, #e8ecff 100%);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
    color: #667eea;
    transition: all 0.3s ease;
}

.empty-state:hover i {
    opacity: 0.8;
    transform: scale(1.1);
}

.empty-state h4 {
    margin: 0 0 0.5rem 0;
    font-size: 1.25rem;
    color: #344767;
}

.empty-state p {
    margin: 0 0 1.5rem 0;
    color: #6c757d;
}

/* Gradient Background Classes */
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important;
}

.bg-gradient-info {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .welcome-card {
        flex-direction: column;
        text-align: center;
        gap: 1.5rem;
    }
    
    .welcome-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
    
    .course-card {
        flex-direction: column;
        text-align: center;
    }
    
    .course-meta {
        justify-content: center;
    }
    
    .stats-card {
        padding: 1.5rem;
    }
    
    .stats-number {
        font-size: 2rem;
    }
}

@media (max-width: 576px) {
    .container-fluid {
        padding: 1rem;
    }
    
    .welcome-card {
        padding: 1.5rem;
    }
    
    .section-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .attendance-item {
        flex-direction: column;
        text-align: center;
    }
    
    .summary-item {
        flex-direction: column;
        text-align: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle quick action clicks
    const actionCards = document.querySelectorAll('.action-card');
    
    actionCards.forEach(card => {
        card.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            
            if (href === '#qr-scanner') {
                const modal = new bootstrap.Modal(document.getElementById('qrModal'));
                modal.show();
            } else if (href === '#contact') {
                const modal = new bootstrap.Modal(document.getElementById('contactModal'));
                modal.show();
            } else if (href === '#grades') {
                const modal = new bootstrap.Modal(document.getElementById('gradesModal'));
                modal.show();
            } else if (href === '#financial') {
                const modal = new bootstrap.Modal(document.getElementById('financialModal'));
                modal.show();
            }
        });
    });
    
    // Handle welcome card action buttons
    const welcomeActions = document.querySelectorAll('.welcome-actions a');
    welcomeActions.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const href = this.getAttribute('href');
            
            if (href === '#qr-scanner') {
                const modal = new bootstrap.Modal(document.getElementById('qrModal'));
                modal.show();
            } else if (href === '#contact') {
                const modal = new bootstrap.Modal(document.getElementById('contactModal'));
                modal.show();
            }
        });
    });
    
    // Animate stats cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.stats-card').forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(card);
    });
    
    // Animate dashboard sections
    const sectionObserver = new IntersectionObserver(function(entries) {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 200);
            }
        });
    }, observerOptions);
    
    document.querySelectorAll('.dashboard-section').forEach((section, index) => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = `opacity 0.8s ease ${index * 0.2}s, transform 0.8s ease ${index * 0.2}s`;
        sectionObserver.observe(section);
    });
    
    // Add hover effects to course cards
    document.querySelectorAll('.course-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
    
    // Add hover effects to attendance items
    document.querySelectorAll('.attendance-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
    
    // Add hover effects to summary items
    document.querySelectorAll('.summary-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
});
</script>
@endsection