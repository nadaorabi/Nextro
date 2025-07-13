@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-6-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Student Dashboard</h1>
            <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
              <p>Welcome to your academic dashboard. Track your courses, attendance, and financial status.</p>
            </div>
            <p class="mb-0" data-aos="fade-up" data-aos-delay="300">
              <a href="#" class="btn btn-secondary">Explore courses</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')
<div class="sd-dashboard">
    <style>
        .sd-dashboard { font-family: 'Poppins', Arial, sans-serif !important; background: #f6f8fb; max-width: 1200px; margin: 32px auto; padding: 0 16px; }
        .sd-header {
            background: linear-gradient(100deg, #4f8cff 0%, #7b6ffb 100%);
            border-radius: 24px;
            padding: 32px 32px 24px 32px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 6px 32px rgba(80,80,180,0.10);
            position: relative;
            margin-bottom: 32px;
            color: #fff;
        }
        .sd-header-user {
            display: flex; align-items: center; gap: 20px;
        }
        .sd-header-avatar {
            width: 80px; height: 80px;
            border-radius: 50%;
            box-shadow: 0 4px 16px rgba(80,80,180,0.13);
            overflow: hidden;
            border: 4px solid #fff3;
            background: #fff;
            display: flex; align-items: center; justify-content: center;
        }
        .sd-header-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sd-header-info h2 { font-size: 1.6rem; font-weight: 700; margin: 0; }
        .sd-header-info .student-id { font-size: 1.05rem; opacity: 0.85; }
        .sd-header-info .status-badge {
            display: inline-block;
            background: #2ecc40;
            color: #fff;
            font-size: 0.95rem;
            border-radius: 12px;
            padding: 2px 14px;
            margin-top: 6px;
            font-weight: 500;
            box-shadow: 0 2px 8px #2ecc4040;
        }
        .sd-header-actions {
            display: flex; gap: 14px;
        }
        .sd-header-actions .sd-btn-action {
            background: #fff;
            color: #4f8cff;
            border: none;
            border-radius: 22px;
            padding: 10px 28px;
            font-weight: 600;
            font-size: 1rem;
            box-shadow: 0 2px 12px #4f8cff22;
            transition: all 0.18s;
            display: flex; align-items: center; gap: 8px;
            cursor: pointer;
        }
        .sd-header-actions .sd-btn-action:hover {
            background: #eaf2ff;
            color: #7b6ffb;
            transform: translateY(-2px) scale(1.04);
        }
        /* Stats Cards */
        .sd-stats {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 32px;
        }
        .sd-stat-card {
            background: rgba(255,255,255,0.95);
            border-radius: 18px;
            box-shadow: 0 2px 16px #4f8cff0d;
            padding: 28px 18px 22px 18px;
            display: flex; flex-direction: column; align-items: flex-start;
            position: relative;
            transition: box-shadow 0.18s, transform 0.18s;
            overflow: hidden;
            border: 1px solid rgba(79, 140, 255, 0.1);
        }
        .sd-stat-card:hover {
            box-shadow: 0 8px 32px #4f8cff22;
            transform: translateY(-4px) scale(1.03);
        }
        .sd-stat-icon {
            width: 48px; height: 48px;
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.7rem;
            margin-bottom: 18px;
            background: linear-gradient(135deg, #4f8cff 60%, #7b6ffb 100%);
            color: #fff;
            box-shadow: 0 2px 8px #4f8cff22;
        }
        .sd-stat-card.green .sd-stat-icon { background: linear-gradient(135deg, #1fd976 60%, #4f8cff 100%); }
        .sd-stat-card.purple .sd-stat-icon { background: linear-gradient(135deg, #7b6ffb 60%, #4f8cff 100%); }
        .sd-stat-card.pink .sd-stat-icon { background: linear-gradient(135deg, #ff6fd8 60%, #ffb86c 100%); }
        .sd-stat-card.orange .sd-stat-icon { background: linear-gradient(135deg, #ff6b35 60%, #f7931e 100%); }
        .sd-stat-card.red .sd-stat-icon { background: linear-gradient(135deg, #ff4757 60%, #ff3742 100%); }
        .sd-stat-title { color: #7b6ffb; font-size: 1rem; font-weight: 600; margin-bottom: 2px; }
        .sd-stat-value { font-size: 2.1rem; font-weight: 700; color: #222; margin-bottom: 2px; }
        .sd-stat-desc { color: #888; font-size: 0.9rem; font-weight: 500; }
        /* Main Sections */
        .sd-main-content {
            display: grid;
            grid-template-columns: 2.2fr 1fr;
            gap: 28px;
        }
        .sd-section, .sd-side-section {
            background: rgba(255,255,255,0.95);
            border-radius: 18px;
            box-shadow: 0 2px 16px #4f8cff0d;
            margin-bottom: 24px;
            padding: 22px 20px 18px 20px;
            position: relative;
            border: 1px solid rgba(79, 140, 255, 0.1);
        }
        .sd-section h3, .sd-side-section h3 {
            font-size: 1.13rem;
            font-weight: 700;
            color: #4f8cff;
            margin-bottom: 18px;
            display: flex; align-items: center; gap: 8px;
        }
        .sd-section-badge {
            background: #eaf2ff;
            color: #4f8cff;
            border-radius: 8px;
            padding: 2px 12px;
            font-size: 0.95rem;
            margin-left: 8px;
        }
        /* Course Cards */
        .course-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 16px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            display: flex;
            align-items: center;
            gap: 20px;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .course-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }
        .course-image {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }
        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .course-info {
            flex: 1;
        }
        .course-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #222;
            margin-bottom: 6px;
        }
        .course-description {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 8px;
        }
        .course-meta {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }
        .meta-item {
            display: flex;
            align-items: center;
            gap: 4px;
            font-size: 0.9rem;
            color: #888;
        }
        .course-actions {
            flex-shrink: 0;
        }
        /* Attendance List */
        .attendance-list {
            max-height: 400px;
            overflow-y: auto;
        }
        .attendance-item {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 16px;
            border-bottom: 1px solid #f0f0f0;
            transition: background 0.2s;
        }
        .attendance-item:hover {
            background: #f8f9fa;
        }
        .attendance-date {
            text-align: center;
            min-width: 60px;
        }
        .date-day {
            font-size: 1.5rem;
            font-weight: 700;
            color: #4f8cff;
        }
        .date-month {
            font-size: 0.8rem;
            color: #888;
            text-transform: uppercase;
        }
        .attendance-info {
            flex: 1;
        }
        .attendance-info h5 {
            font-size: 1rem;
            font-weight: 600;
            margin: 0 0 4px 0;
            color: #222;
        }
        .attendance-info p {
            font-size: 0.9rem;
            color: #666;
            margin: 0;
        }
        .attendance-status {
            flex-shrink: 0;
        }
        .status-badge.present {
            background: #2ecc40;
            color: #fff;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .status-badge.absent {
            background: #ff4757;
            color: #fff;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        /* Schedule Table */
        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        .schedule-table th,
        .schedule-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #f0f0f0;
        }
        .schedule-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #4f8cff;
            font-size: 0.9rem;
        }
        .schedule-table td {
            font-size: 0.9rem;
            color: #666;
        }
        .schedule-type {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .schedule-type.course {
            background: #e3f2fd;
            color: #1976d2;
        }
        .schedule-type.package {
            background: #f3e5f5;
            color: #7b1fa2;
        }
        .schedule-table tr:hover {
            background: #f8f9fa;
        }
        .schedule-table td {
            vertical-align: middle;
        }
        /* Transaction List */
        .transaction-list {
            max-height: 300px;
            overflow-y: auto;
        }
        .transaction-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        .transaction-info {
            flex: 1;
        }
        .transaction-title {
            font-size: 0.95rem;
            font-weight: 500;
            color: #222;
            margin-bottom: 2px;
        }
        .transaction-date {
            font-size: 0.85rem;
            color: #888;
        }
        .transaction-amount {
            font-weight: 600;
            font-size: 1rem;
        }
        .transaction-amount.positive {
            color: #2ecc40;
        }
        .transaction-amount.negative {
            color: #ff4757;
        }
        .transaction-item:hover {
            background: #f8f9fa;
            border-radius: 8px;
            margin: 0 -8px;
            padding: 12px 8px;
        }
        /* Financial Summary */
        .financial-summary {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 16px;
            background: #f8f9fa;
            border-radius: 12px;
            border-left: 4px solid #4f8cff;
        }
        .summary-item .meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #666;
        }
        .summary-item b {
            font-size: 1rem;
            font-weight: 600;
        }
        /* Quick Actions */
        .sd-quick-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }
        .sd-quick-action {
            background: linear-gradient(120deg, #f6f8fb 60%, #eaf2ff 100%);
            border-radius: 14px;
            padding: 18px 10px;
            display: flex; flex-direction: column; align-items: center;
            box-shadow: 0 1px 8px #4f8cff0a;
            cursor: pointer;
            transition: box-shadow 0.18s, transform 0.18s;
            border: none;
        }
        .sd-quick-action:hover {
            box-shadow: 0 4px 18px #4f8cff22;
            transform: scale(1.04);
            background: linear-gradient(120deg, #eaf2ff 60%, #f6f8fb 100%);
        }
        .sd-quick-action .qa-icon {
            font-size: 1.7rem;
            color: #4f8cff;
            margin-bottom: 8px;
        }
        .sd-quick-action .qa-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: #222;
            margin-bottom: 2px;
        }
        .sd-quick-action .qa-desc {
            font-size: 0.93rem;
            color: #888;
        }
        /* Empty State */
        .sd-empty-state {
            text-align: center;
            color: #b0b0b0;
            padding: 32px 0;
        }
        .sd-empty-state i { font-size: 2.2rem; margin-bottom: 8px; color: #4f8cff; }
        .sd-empty-state h4 { font-size: 1.1rem; color: #4f8cff; margin-bottom: 6px; }
        .sd-empty-state p { color: #888; font-size: 1rem; }
        .sd-empty-state .btn {
            background: #4f8cff;
            color: #fff;
            border-radius: 22px;
            padding: 8px 28px;
            font-weight: 600;
            margin-top: 10px;
            border: none;
            transition: background 0.18s;
        }
        .sd-empty-state .btn:hover { background: #7b6ffb; }
        @media (max-width: 991px) {
            .sd-stats { grid-template-columns: repeat(3, 1fr); }
            .sd-main-content { grid-template-columns: 1fr; }
        }
        @media (max-width: 767px) {
            .sd-header { flex-direction: column; align-items: flex-start; gap: 18px; padding: 22px 10px 16px 10px; }
            .sd-stats { grid-template-columns: 1fr; gap: 14px; }
            .sd-main-content { gap: 14px; }
            .course-card { flex-direction: column; text-align: center; }
            .course-meta { justify-content: center; }
        }
    </style>
    <!-- Header -->
    <div class="sd-header">
        <div class="sd-header-user">
            <div class="sd-header-avatar">
                @if(Auth::user()->image)
                    <img src="{{ asset(Auth::user()->image) }}" alt="Profile Picture">
                @else
                    <i class="uil uil-user"></i>
                @endif
            </div>
            <div class="sd-header-info">
                <h2>{{ Auth::user()->name }}</h2>
                <div class="student-id">Student ID: {{ Auth::user()->login_id }}</div>
                <div class="status-badge">{{ Auth::user()->is_active == 1 ? 'Active Student' : 'Inactive' }}</div>
            </div>
        </div>
        <div class="sd-header-actions">
            <button class="sd-btn-action"><i class="uil uil-qrcode-scan"></i>SCAN QR</button>
            <button class="sd-btn-action"><i class="uil uil-envelope"></i>CONTACT SUPPORT</button>
        </div>
    </div>
    <!-- Stats Cards -->
    <div class="sd-stats">
        <div class="sd-stat-card purple">
            <div class="sd-stat-icon"><i class="uil uil-graduation-cap"></i></div>
            <div class="sd-stat-title">Total Courses</div>
            <div class="sd-stat-value">{{ ($enrollments ?? collect())->count() }}</div>
            <div class="sd-stat-desc">Enrolled Courses</div>
        </div>
        <div class="sd-stat-card orange">
            <div class="sd-stat-icon"><i class="uil uil-box"></i></div>
            <div class="sd-stat-title">Total Packages</div>
            <div class="sd-stat-value">{{ ($studentPackages ?? collect())->count() }}</div>
            <div class="sd-stat-desc">Enrolled Packages</div>
        </div>
        <div class="sd-stat-card red">
            <div class="sd-stat-icon"><i class="uil uil-file-invoice-dollar"></i></div>
            <div class="sd-stat-title">Outstanding Balance</div>
            <div class="sd-stat-value">${{ number_format($outstandingBalance ?? 0, 0) }}</div>
            <div class="sd-stat-desc">Remaining Fees</div>
        </div>
        <div class="sd-stat-card green">
            <div class="sd-stat-icon"><i class="uil uil-arrow-up"></i></div>
            <div class="sd-stat-title">Total Paid</div>
            <div class="sd-stat-value">${{ number_format($totalPaid ?? 0, 0) }}</div>
            <div class="sd-stat-desc">Amount Paid</div>
        </div>
        <div class="sd-stat-card pink">
            <div class="sd-stat-icon"><i class="uil uil-file-invoice-dollar"></i></div>
            <div class="sd-stat-title">Total Fees Due</div>
            <div class="sd-stat-value">${{ number_format($totalDue ?? 0, 0) }}</div>
            <div class="sd-stat-desc">All Fees</div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="sd-main-content">
        <div>
            <!-- Student Enrollments -->
            <div class="sd-section">
                <h3><i class="uil uil-books"></i>Student Enrollments <span class="sd-section-badge">{{ ($enrollments ?? collect())->count() + ($studentPackages ?? collect())->count() }} Total</span></h3>
                <div>
                    @forelse($enrollments ?? [] as $enrollment)
                        @if($enrollment->course)
                            <div class="course-card">
                                <div class="course-image">
                                    @php
                                        $courseImage = $enrollment->course->image ?? ($enrollment->course->category->image ?? 'images/img_3.jpg');
                                    @endphp
                                    <img src="{{ asset($courseImage) }}" alt="Course Image" onerror="this.src='{{ asset('images/img_3.jpg') }}'">
                                </div>
                                <div class="course-info">
                                    <div class="course-title">{{ $enrollment->course->title }}</div>
                                    <div class="course-description">{{ Str::limit($enrollment->course->description ?? 'No description available', 100) }}</div>
                                    <div class="course-meta">
                                        <span class="meta-item">
                                            <i class="uil uil-tag"></i>
                                            {{ $enrollment->course->category->name ?? 'No Category' }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="uil uil-user"></i>
                                            {{ $enrollment->course->courseInstructors->first()->instructor->name ?? 'No Instructor' }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="uil uil-calendar-alt"></i>
                                            {{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('M d, Y') }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="uil uil-usd-circle"></i>
                                            ${{ number_format($enrollment->course->final_price ?? 0, 0) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="course-actions">
                                    <button class="btn btn-sm btn-outline-primary">View Details</button>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="sd-empty-state">
                            <i class="uil uil-book-open"></i>
                            <h4>No Courses Enrolled</h4>
                            <p>You haven't enrolled in any courses yet.</p>
                            <a href="#" class="btn">Browse Courses</a>
                        </div>
                    @endforelse

                    @forelse($studentPackages ?? [] as $studentPackage)
                        @if($studentPackage->package)
                            <div class="course-card">
                                <div class="course-image">
                                    @php
                                        $packageImage = $studentPackage->package->image ?? ($studentPackage->package->category->image ?? 'images/img_3.jpg');
                                    @endphp
                                    <img src="{{ asset($packageImage) }}" alt="Package Image" onerror="this.src='{{ asset('images/img_3.jpg') }}'">
                                </div>
                                <div class="course-info">
                                    <div class="course-title">{{ $studentPackage->package->name }}</div>
                                    <div class="course-description">{{ Str::limit($studentPackage->package->description ?? 'No description available', 100) }}</div>
                                    <div class="course-meta">
                                        <span class="meta-item">
                                            <i class="uil uil-tag"></i>
                                            {{ $studentPackage->package->category->name ?? 'No Category' }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="uil uil-calendar-alt"></i>
                                            {{ \Carbon\Carbon::parse($studentPackage->purchase_date)->format('M d, Y') }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="uil uil-usd-circle"></i>
                                            ${{ number_format($studentPackage->amount_paid ?? 0, 0) }}
                                        </span>
                                        <span class="meta-item">
                                            <i class="uil uil-books"></i>
                                            {{ $studentPackage->package->packageCourses->count() ?? 0 }} Courses
                                        </span>
                                    </div>
                                </div>
                                <div class="course-actions">
                                    <button class="btn btn-sm btn-outline-primary">View Details</button>
                                </div>
                            </div>
                        @endif
                    @empty
                        @if(($enrollments ?? collect())->isEmpty())
                            <div class="sd-empty-state">
                                <i class="uil uil-box"></i>
                                <h4>No Packages Enrolled</h4>
                                <p>You haven't enrolled in any packages yet.</p>
                                <a href="#" class="btn">Browse Packages</a>
                            </div>
                        @endif
                    @endforelse
                </div>
            </div>

            <!-- Class Schedule -->
            <div class="sd-section">
                <h3><i class="uil uil-calendar-alt"></i>Class Schedule <span class="sd-section-badge">{{ ($allSchedules ?? collect())->count() }} Sessions</span></h3>
                <div>
                    @if(($allSchedules ?? collect())->isNotEmpty())
                        <table class="schedule-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Course</th>
                                    <th>Type</th>
                                    <th>Instructor</th>
                                    <th>Room</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allSchedules as $schedule)
                                    <tr>
                                        <td>
                                            <div>
                                                <strong>{{ \Carbon\Carbon::parse($schedule['session_date'])->format('M d') }}</strong>
                                                <div style="font-size: 0.8rem; color: #888;">{{ \Carbon\Carbon::parse($schedule['session_date'])->format('D') }}</div>
                                            </div>
                                        </td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($schedule['start_time'])->format('H:i') }} - 
                                            {{ \Carbon\Carbon::parse($schedule['end_time'])->format('H:i') }}
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $schedule['name'] }}</strong>
                                                @if($schedule['type'] === 'package')
                                                    <div style="font-size: 0.8rem; color: #888;">{{ $schedule['package_name'] }}</div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <span class="schedule-type {{ $schedule['type'] }}">
                                                {{ ucfirst($schedule['type']) }}
                                            </span>
                                        </td>
                                        <td>{{ $schedule['instructor'] }}</td>
                                        <td>{{ $schedule['room'] ?: 'TBD' }}</td>
                                        <td>
                                            @if($schedule['attendance_status'] === 'present')
                                                <span class="status-badge present">Present</span>
                                            @elseif($schedule['attendance_status'] === 'absent')
                                                <span class="status-badge absent">Absent</span>
                                            @else
                                                <span style="color: #888; font-size: 0.85rem; background: #f8f9fa; padding: 4px 8px; border-radius: 6px;">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <div class="sd-empty-state">
                            <i class="uil uil-calendar-slash"></i>
                            <h4>No Class Schedule</h4>
                            <p>No scheduled classes found for your enrolled courses.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Attendance -->
            <div class="sd-section">
                <h3><i class="uil uil-calendar-alt"></i>Recent Attendance <span class="sd-section-badge">{{ ($attendances ?? collect())->count() }} Records</span></h3>
                <div>
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
                                    @else
                                        <span style="color: #888; font-size: 0.85rem;">Pending</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="sd-empty-state">
                                <i class="uil uil-calendar-slash"></i>
                                <h4>No Attendance Records</h4>
                                <p>No attendance records found yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div>
            <!-- Financial Summary -->
            <div class="sd-side-section">
                <h3><i class="uil uil-usd-circle"></i>Financial Summary</h3>
                <div class="financial-summary">
                    <div class="summary-item">
                        <span class="meta-item"><i class="uil uil-file-invoice-dollar"></i> Total Fees Due:</span> 
                        <b>${{ number_format($totalDue ?? 0, 0) }}</b>
                    </div>
                    <div class="summary-item">
                        <span class="meta-item"><i class="uil uil-arrow-up"></i> Total Paid:</span> 
                        <b style="color: #2ecc40;">${{ number_format($totalPaid ?? 0, 0) }}</b>
                    </div>
                    <div class="summary-item">
                        <span class="meta-item"><i class="uil uil-arrow-down"></i> Outstanding Balance:</span> 
                        <b style="color: {{ ($outstandingBalance ?? 0) > 0 ? '#ff4757' : '#2ecc40' }};">${{ number_format($outstandingBalance ?? 0, 0) }}</b>
                    </div>
                    <div class="summary-item">
                        <span class="meta-item"><i class="uil uil-percentage"></i> Attendance Rate:</span> 
                        <b style="color: {{ ($attendanceRate ?? 0) >= 80 ? '#2ecc40' : (($attendanceRate ?? 0) >= 60 ? '#f39c12' : '#ff4757') }};">{{ $attendanceRate ?? 0 }}%</b>
                    </div>
                    <div class="summary-item">
                        <span class="meta-item"><i class="uil uil-chart-line"></i> Average Grade:</span> 
                        <b style="color: {{ ($averageGrade ?? 0) >= 80 ? '#2ecc40' : (($averageGrade ?? 0) >= 60 ? '#f39c12' : '#ff4757') }};">{{ $averageGrade ?? 0 }}%</b>
                    </div>
                </div>
            </div>

            <!-- Recent Financial Transactions -->
            <div class="sd-side-section">
                <h3><i class="uil uil-transaction"></i>Recent Financial Transactions</h3>
                <div class="transaction-list">
                    @forelse(($recentTransactions ?? collect()) as $transaction)
                        <div class="transaction-item">
                            <div class="transaction-info">
                                <div class="transaction-title">
                                    {{ $transaction->notes ?: ucfirst(str_replace('_', ' ', $transaction->type)) }}
                                    <span style="font-size: 0.8rem; color: #888; font-weight: normal;">
                                        ({{ ucfirst(str_replace('_', ' ', $transaction->type)) }})
                                    </span>
                                </div>
                                <div class="transaction-date">{{ \Carbon\Carbon::parse($transaction->payment_date)->format('M d, Y') }}</div>
                            </div>
                            <div class="transaction-amount {{ $transaction->amount >= 0 ? 'positive' : 'negative' }}">
                                {{ $transaction->amount >= 0 ? '+' : '' }}${{ number_format($transaction->amount, 0) }}
                            </div>
                        </div>
                    @empty
                        <div class="sd-empty-state">
                            <i class="uil uil-transaction"></i>
                            <h4>No Transactions</h4>
                            <p>No financial transactions found.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="sd-side-section">
                <h3><i class="uil uil-bolt"></i>Quick Actions</h3>
                <div class="sd-quick-actions">
                    <button class="sd-quick-action"><span class="qa-icon"><i class="uil uil-qrcode-scan"></i></span><span class="qa-title">Scan QR Code</span><span class="qa-desc">Mark your attendance</span></button>
                    <button class="sd-quick-action"><span class="qa-icon"><i class="uil uil-chart-line"></i></span><span class="qa-title">View Grades</span><span class="qa-desc">Check your progress</span></button>
                    <button class="sd-quick-action"><span class="qa-icon"><i class="uil uil-usd-circle"></i></span><span class="qa-title">Financial Status</span><span class="qa-desc">Payment history</span></button>
                    <button class="sd-quick-action"><span class="qa-icon"><i class="uil uil-envelope"></i></span><span class="qa-title">Contact Support</span><span class="qa-desc">Get help</span></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection