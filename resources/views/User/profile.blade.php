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
            position: relative;
        }
        .sd-header-avatar img { width: 100%; height: 100%; object-fit: cover; }
        .sd-header-avatar .avatar-preview {
            width: 100%; height: 100%; object-fit: cover; border-radius: 50%;
        }
        .sd-header-avatar .avatar-edit-btn {
            position: absolute; bottom: 0; right: 0; background: #4f8cff; color: #fff; border-radius: 50%; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border: 2px solid #fff; cursor: pointer; font-size: 1.1rem;
        }
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
        /* Special styling for the 5th button */
        .sd-quick-action:nth-child(5) {
            grid-column: 1 / -1;
            background: linear-gradient(120deg, #fff5f5 60%, #ffe8e8 100%);
        }
        .sd-quick-action:nth-child(5):hover {
            background: linear-gradient(120deg, #ffe8e8 60%, #fff5f5 100%);
        }
        .sd-quick-action:nth-child(5) .qa-icon {
            color: #ff4757;
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
            <div class="sd-header-avatar" id="studentAvatarBox">
                <img id="studentAvatar" src="{{ Auth::user()->image ? asset('storage/'.Auth::user()->image) : asset('images/default-avatar.png') }}" alt="Profile Picture" class="avatar-preview">
                <span class="avatar-edit-btn" onclick="showProfileModal()" title="Edit Profile"><i class="uil uil-edit"></i></span>
            </div>
            <div class="sd-header-info">
                <h2 id="studentName">{{ Auth::user()->name }}</h2>
                <div class="student-id">Student ID: <span id="studentIdText">{{ Auth::user()->login_id }}</span></div>
                <div class="status-badge">{{ Auth::user()->is_active == 1 ? 'Active Student' : 'Inactive' }}</div>
            </div>
        </div>
        <div class="sd-header-actions">
            <button class="sd-btn-action" onclick="showStudentIdCard()"><i class="uil uil-qrcode-scan"></i>SHOW QR</button>
            <button class="sd-btn-action" onclick="contactSupport()"><i class="uil uil-envelope"></i>CONTACT SUPPORT</button>
            <button class="sd-btn-action" onclick="showProfileModal()"><i class="uil uil-user-edit"></i>EDIT PROFILE</button>
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
                                        $courseImage = $enrollment->course->image
                                            ? asset('storage/' . $enrollment->course->image)
                                            : ( ($enrollment->course->category && $enrollment->course->category->image)
                                                ? asset('storage/' . $enrollment->course->category->image)
                                                : asset('images/img_3.jpg')
                                            );
                                    @endphp
                                    <img src="{{ $courseImage }}" alt="Course Image" onerror="this.src='{{ asset('images/img_3.jpg') }}'">
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
                                    <button class="btn btn-sm btn-outline-primary" onclick="showCourseSchedule({{ $enrollment->course->id }})">View Details</button>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="sd-empty-state">
                            <i class="uil uil-book-open"></i>
                            <h4>No Courses Enrolled</h4>
                            <p>You haven't enrolled in any courses yet.</p>
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
                                    <button class="btn btn-sm btn-outline-primary" onclick="showPackageSchedule({{ $studentPackage->package->id }})">View Details</button>
                                </div>
                            </div>
                        @endif
                    @empty
                        @if(($enrollments ?? collect())->isEmpty())
                            <div class="sd-empty-state">
                                <i class="uil uil-box"></i>
                                <h4>No Packages Enrolled</h4>
                                <p>You haven't enrolled in any packages yet.</p>
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
                                    <p>
                                        {{ \Carbon\Carbon::parse($attendance->date)->format('l, F d, Y') }}
                                        @if($attendance->schedule)
                                            <span style="color:#4f8cff;font-size:0.98em;">
                                                | {{ \Carbon\Carbon::parse($attendance->schedule->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($attendance->schedule->end_time)->format('H:i') }}
                                            </span>
                                        @endif
                                    </p>
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
                    <button class="sd-quick-action"><span class="qa-icon"><i class="uil uil-qrcode-scan"></i></span><span class="qa-title">Show QR Code</span><span class="qa-desc">View ID Card</span></button>
                    <button class="sd-quick-action"><span class="qa-icon"><i class="uil uil-chart-line"></i></span><span class="qa-title">View Grades</span><span class="qa-desc">Check your progress</span></button>
                    <button class="sd-quick-action"><span class="qa-icon"><i class="uil uil-usd-circle"></i></span><span class="qa-title">Financial Status</span><span class="qa-desc">Payment history</span></button>
                    <button class="sd-quick-action"><span class="qa-icon"><i class="uil uil-envelope"></i></span><span class="qa-title">Contact Support</span><span class="qa-desc">Get help</span></button>
                    <button class="sd-quick-action" onclick="showPasswordModal()"><span class="qa-icon"><i class="uil uil-lock"></i></span><span class="qa-title">Change Password</span><span class="qa-desc">Update your password</span></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- QR Code Modal -->
<div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="qrModalLabel">Student QR Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div id="qrCodeContainer">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="mt-3">
                    <p class="text-muted">Scan this QR code to mark your attendance</p>
                    <button class="btn btn-primary" onclick="downloadQRCode()">
                        <i class="uil uil-download-alt"></i> Download QR Code
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Profile Edit Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="profileModalLabel"><i class="uil uil-user"></i> Student Profile</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="profileForm" enctype="multipart/form-data" autocomplete="off">
                    @csrf
                    <div class="row g-4 align-items-center mb-4">
                        <div class="col-md-3 text-center">
                            <div style="position:relative;display:inline-block;">
                                <img id="profileImagePreview" src="{{ Auth::user()->image ? asset('storage/'.Auth::user()->image) : asset('images/default-avatar.png') }}" class="rounded-circle border border-3 border-primary-subtle" style="width:100px;height:100px;object-fit:cover;">
                                <label for="image" class="avatar-edit-btn" style="position:absolute;bottom:0;right:0;cursor:pointer;background:#4f8cff;color:#fff;width:32px;height:32px;display:flex;align-items:center;justify-content:center;border-radius:50%;border:2px solid #fff;">
                                    <i class="uil uil-camera"></i>
                                </label>
                                <input type="file" id="image" name="image" accept="image/*" style="display:none;">
                            </div>
                            <p class="text-muted mt-2" style="font-size: 0.9rem;">Click camera to update photo</p>
                        </div>
                        <div class="col-md-9">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" readonly>
                                    <small class="text-muted">Name cannot be edited</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="login_id" class="form-label">Student ID</label>
                                    <input type="text" class="form-control" id="login_id" name="login_id" value="{{ Auth::user()->login_id }}" readonly>
                                    <small class="text-muted">Student ID cannot be edited</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile Number</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ Auth::user()->mobile }}" readonly>
                                    <small class="text-muted">Mobile cannot be edited</small>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="birth_date" class="form-label">Birth Date</label>
                                    <input type="date" class="form-control" id="birth_date" name="birth_date" value="{{ Auth::user()->birth_date ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-control" id="gender" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="nationality" class="form-label">Nationality</label>
                                    <input type="text" class="form-control" id="nationality" name="nationality" value="{{ Auth::user()->nationality ?? '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-12">
                            <h6 class="text-primary mb-3"><i class="uil uil-info-circle"></i> Additional Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="emergency_contact" class="form-label">Emergency Contact</label>
                                    <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" value="{{ Auth::user()->emergency_contact ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="parent_name" class="form-label">Parent/Guardian Name</label>
                                    <input type="text" class="form-control" id="parent_name" name="parent_name" value="{{ Auth::user()->parent_name ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="parent_mobile" class="form-label">Parent/Guardian Mobile</label>
                                    <input type="text" class="form-control" id="parent_mobile" name="parent_mobile" value="{{ Auth::user()->parent_mobile ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="medical_conditions" class="form-label">Medical Conditions</label>
                                    <textarea class="form-control" id="medical_conditions" name="medical_conditions" rows="2">{{ Auth::user()->medical_conditions ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary px-4" id="updateProfileBtn">
                            <i class="uil uil-save"></i> Update Profile
                        </button>
                        <button type="button" class="btn btn-secondary px-4 ms-2" data-bs-dismiss="modal">
                            <i class="uil uil-times"></i> Close
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="passwordModalLabel"><i class="uil uil-lock"></i> Change Password</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="passwordForm">
                    @csrf
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="toastMsg" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="toastBody">Success!</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<!-- Contact Support Modal -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactModalLabel">Contact Support</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <i class="uil uil-whatsapp" style="font-size: 3rem; color: #25D366;"></i>
                    <h4 class="mt-3">Contact via WhatsApp</h4>
                    <p class="text-muted">Get instant support from our team</p>
                </div>
                <a href="#" id="whatsappLink" class="btn btn-success btn-lg" target="_blank">
                    <i class="uil uil-whatsapp"></i> Open WhatsApp
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Financial Status Modal -->
<div class="modal fade" id="financialStatusModal" tabindex="-1" aria-labelledby="financialStatusModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="financialStatusModalLabel"><i class="uil uil-usd-circle"></i> Financial Status</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="financialStatusContent">
                <style>
                    #financialStatusContent { background: #f8f9fa; border-radius: 12px; padding: 18px 10px; }
                    #financialStatusContent .summary-item { background: #fff; border-radius: 10px; box-shadow: 0 1px 6px #4f8cff11; margin-bottom: 10px; padding: 12px 16px; border-left: 4px solid #4f8cff; }
                    #financialStatusContent h6 { color: #4f8cff; font-weight: bold; margin-top: 18px; }
                    #financialStatusContent table { background: #fff; border-radius: 8px; overflow: hidden; }
                    #financialStatusContent th, #financialStatusContent td { vertical-align: middle; }
                </style>
                <div class="mb-3">
                    <strong>Student:</strong> {{ Auth::user()->name }}<br>
                    <strong>Student ID:</strong> {{ Auth::user()->login_id }}
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="summary-item">
                            <span class="meta-item"><i class="uil uil-file-invoice-dollar"></i> Total Fees Due:</span> 
                            <b>${{ number_format($totalDue ?? 0, 0) }}</b>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="summary-item">
                            <span class="meta-item"><i class="uil uil-arrow-up"></i> Total Paid:</span> 
                            <b style="color: #2ecc40;">${{ number_format($totalPaid ?? 0, 0) }}</b>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="summary-item">
                            <span class="meta-item"><i class="uil uil-arrow-down"></i> Outstanding Balance:</span> 
                            <b style="color: {{ ($outstandingBalance ?? 0) > 0 ? '#ff4757' : '#2ecc40' }};">${{ number_format($outstandingBalance ?? 0, 0) }}</b>
                        </div>
                    </div>
                </div>
                <h6 class="mb-2 mt-4"><i class="uil uil-transaction"></i> Financial Transactions</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Date</th>
                                <th>Type</th>
                                <th>Notes</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($recentTransactions ?? collect()) as $transaction)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($transaction->payment_date)->format('M d, Y') }}</td>
                                    <td>{{ ucfirst(str_replace('_', ' ', $transaction->type)) }}</td>
                                    <td>{{ $transaction->notes ?: '-' }}</td>
                                    <td class="{{ $transaction->amount >= 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $transaction->amount >= 0 ? '+' : '' }}${{ number_format($transaction->amount, 0) }}
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center">No transactions found.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printFinancialStatus()"><i class="uil uil-print"></i> Print</button>
                <button type="button" class="btn btn-danger" onclick="downloadFinancialStatusPDF()"><i class="uil uil-file-pdf"></i> Download PDF</button>
            </div>
        </div>
    </div>
</div>

<!-- Course Schedule Modal -->
<div class="modal fade" id="courseScheduleModal" tabindex="-1" aria-labelledby="courseScheduleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-primary" id="courseScheduleModalLabel">
          <i class="uil uil-calendar-alt me-2"></i>
          Scheduled Lectures
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="courseScheduleContent">
        <!-- Content will be populated by JavaScript -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!-- Student ID Card Modal -->
<div class="modal fade" id="studentIdCardModal" tabindex="-1" aria-labelledby="studentIdCardModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content modern-card">
      <div class="modal-header gradient-header">
        <h5 class="modal-title text-white" id="studentIdCardModalLabel">
          <i class="uil uil-id-card me-2"></i>
          Student ID Card
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <div class="student-photo-container mb-3">
            @if(Auth::user()->image)
              <img src="{{ asset('storage/' . Auth::user()->image) }}" alt="Student Photo" class="student-photo-small" onerror="this.src='{{ asset('images/default-avatar.png') }}'">
            @else
              <div class="default-avatar-small">
                <div class="default-avatar-text-small">STUDENT</div>
              </div>
            @endif
          </div>
          <h5 class="student-name mb-2">{{ Auth::user()->name }}</h5>
          <p class="student-role mb-3">Student</p>
          
          <div class="qr-code-container-small mb-3">
            <div id="studentQRCode"></div>
          </div>
          
          <div class="student-details-small">
            <div class="detail-item-small">
              <span class="detail-label-small">Student ID:</span>
              <span class="detail-value-small">{{ Auth::user()->login_id ?? 'N/A' }}</span>
            </div>
            <div class="detail-item-small">
              <span class="detail-label-small">Registration Date:</span>
              <span class="detail-value-small">{{ Auth::user()->created_at ? Auth::user()->created_at->format('Y-m-d') : 'N/A' }}</span>
            </div>
            <div class="detail-item-small">
              <span class="detail-label-small">Status:</span>
              <span class="detail-value-small status-active-small">Active</span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer modern-footer">
        <button type="button" class="btn btn-outline-light modern-btn" data-bs-dismiss="modal">
          <i class="uil uil-times me-1"></i>Close
        </button>
        <button type="button" class="btn btn-light modern-btn" onclick="printIdCard()">
          <i class="uil uil-print me-1"></i>Print Card
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Include QR Code Library -->
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<style>
/* Enhanced Modal Styles - Cleaner Design */
.modal-lg {
    max-width: 800px;
}

.modal-header {
    background: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.modal-title {
    color: #495057 !important;
    font-weight: 600;
}

.table-light th {
    background: #f8f9fa !important;
    color: #495057;
    border-color: #dee2e6;
    font-weight: 600;
}

.badge {
    font-size: 0.75rem;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
}

.bg-success {
    background-color: #28a745 !important;
    color: white !important;
}

.bg-danger {
    background-color: #dc3545 !important;
    color: white !important;
}

.bg-warning {
    background-color: #ffc107 !important;
    color: #212529 !important;
}

.bg-secondary {
    background-color: #6c757d !important;
    color: white !important;
}

.bg-info {
    background-color: #17a2b8 !important;
    color: white !important;
}

.card.bg-light {
    background: #f8f9fa !important;
    border: 1px solid #dee2e6;
    border-radius: 8px;
}

.alert-info {
    background: #d1ecf1;
    border-color: #bee5eb;
    color: #0c5460;
    border-radius: 8px;
}

.alert-warning {
    background: #fff3cd;
    border-color: #ffeaa7;
    color: #856404;
    border-radius: 8px;
}

/* Enhanced table styles */
.table {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f8f9fa;
}

.table-hover tbody tr:hover {
    background-color: #e9ecef;
}

.table th {
    border-top: none;
    font-weight: 600;
}

/* Status badges with icons */
.status-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-weight: 500;
}

.status-badge.present {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.status-badge.absent {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.status-badge.late {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.status-badge.pending {
    background: #e2e3e5;
    color: #383d41;
    border: 1px solid #d6d8db;
}

/* Modern Student ID Card Modal Styles */
.modern-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    overflow: hidden;
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.95);
}

/* Small Modal Styles */
.student-photo-small {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.default-avatar-small {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.default-avatar-text-small {
    font-size: 0.8rem;
    color: white;
    font-weight: 700;
    text-align: center;
    line-height: 80px;
}

.qr-code-container-small {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.05);
}

.student-details-small {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 10px;
    padding: 1rem;
    box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.05);
}

.detail-item-small {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    font-size: 0.85rem;
}

.detail-item-small:last-child {
    border-bottom: none;
}

.detail-label-small {
    font-weight: 600;
    color: #2c3e50;
    font-size: 0.8rem;
}

.detail-value-small {
    color: #495057;
    font-weight: 600;
    font-size: 0.8rem;
}

.status-active-small {
    color: #28a745 !important;
    font-weight: 700;
    background: rgba(40, 167, 69, 0.1);
    padding: 0.2rem 0.5rem;
    border-radius: 15px;
    font-size: 0.75rem;
}

.gradient-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    padding: 2rem;
    position: relative;
    overflow: hidden;
}

.gradient-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 50%, rgba(255,255,255,0.1) 100%);
    animation: shimmer 2s infinite;
}

@keyframes shimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.gradient-header .modal-title {
    font-weight: 700;
    font-size: 1.4rem;
    position: relative;
    z-index: 1;
}

.modern-footer {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border: none;
    padding: 2rem;
    border-top: 1px solid rgba(0,0,0,0.05);
}

.student-photo-section {
    padding: 2rem 1rem;
}

.student-photo-container {
    position: relative;
    margin-bottom: 1rem;
}

.student-photo {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid #fff;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.student-photo:hover {
    transform: scale(1.05);
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
}

.default-avatar {
    width: 140px;
    height: 140px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 5px solid #fff;
    box-shadow: 0 15px 40px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.default-avatar::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.3), transparent);
    animation: rotate 3s linear infinite;
}

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.default-avatar-text {
    font-size: 1.2rem;
    color: white;
    font-weight: 700;
    text-align: center;
    line-height: 140px;
}

.student-name {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
}

.student-role {
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 0;
}

.qr-section {
    padding: 2rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 15px;
    margin: 1rem 0;
}

.qr-code-container-modern {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 2.5rem;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
    border: 1px solid rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
}

.qr-code-container-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #667eea, #764ba2, #667eea);
    background-size: 200% 100%;
    animation: gradientMove 2s ease infinite;
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

#studentQRCode {
    display: flex;
    justify-content: center;
    align-items: center;
}

.student-details {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 20px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    border: 1px solid rgba(0,0,0,0.05);
    position: relative;
    overflow: hidden;
}

.student-details::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
}

.detail-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.detail-item:hover {
    background: rgba(102, 126, 234, 0.05);
    margin: 0 -2rem;
    padding: 1rem 2rem;
    border-radius: 10px;
}

.detail-item:last-child {
    border-bottom: none;
}

.detail-label {
    font-weight: 700;
    color: #2c3e50;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
}

.detail-label::before {
    content: '•';
    color: #667eea;
    margin-right: 0.5rem;
    font-weight: bold;
}

.detail-value {
    color: #495057;
    font-weight: 600;
    font-size: 0.95rem;
}

.status-active {
    color: #28a745 !important;
    font-weight: 700;
    background: rgba(40, 167, 69, 0.1);
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.85rem;
}

/* Modern Button Styles */
.modern-btn {
    border-radius: 25px;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    position: relative;
    overflow: hidden;
}

.modern-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.modern-btn:hover::before {
    left: 100%;
}

.modern-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Responsive design */
@media (max-width: 768px) {
    .student-photo {
        width: 100px;
        height: 100px;
    }
    
    .default-avatar {
        width: 100px;
        height: 100px;
    }
    
    .default-avatar-text {
        font-size: 1rem;
        line-height: 100px;
    }
    
    .student-photo-small {
        width: 60px;
        height: 60px;
    }
    
    .default-avatar-small {
        width: 60px;
        height: 60px;
    }
    
    .default-avatar-text-small {
        font-size: 0.6rem;
        line-height: 60px;
    }
    
    .qr-section {
        padding: 1rem;
    }
    
    .student-details {
        padding: 1rem;
    }
    
    .modern-card {
        margin: 1rem;
    }
    
    .gradient-header {
        padding: 1.5rem;
    }
    
    .modern-footer {
        padding: 1.5rem;
    }
}

/* Responsive improvements */
@media (max-width: 768px) {
    .modal-lg {
        max-width: 95%;
        margin: 0.5rem;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .badge {
        font-size: 0.7rem;
        padding: 0.25rem 0.5rem;
    }
}
</style>

<script>
// QR Code Functions
function showQRModal() {
    const modal = new bootstrap.Modal(document.getElementById('qrModal'));
    modal.show();
    const studentId = document.getElementById('studentIdText').textContent.trim();
    const container = document.getElementById('qrCodeContainer');
    container.innerHTML = '';
    QRCode.toCanvas(container, studentId, {
        width: 300,
        margin: 2,
        color: { dark: '#000000', light: '#FFFFFF' }
    }, function (error) {
        if (error) {
            container.innerHTML = '<p class="text-danger">Error generating QR code</p>';
        }
    });
}

function showStudentIdCard() {
    const modal = new bootstrap.Modal(document.getElementById('studentIdCardModal'));
    modal.show();
    
    // Generate QR Code for student ID
    const studentId = '{{ Auth::user()->login_id ?? Auth::user()->id }}';
    const container = document.getElementById('studentQRCode');
    container.innerHTML = '';
    
    // Try QRCode.js first, then fallback to qrcode@1.5.3
    try {
        // Use QRCode.js library
        new QRCode(container, {
            text: studentId,
            width: 150,
            height: 150,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        console.log('QR Code generated successfully with QRCode.js');
    } catch (error) {
        console.log('QRCode.js failed, trying qrcode@1.5.3...');
        // Fallback to qrcode@1.5.3
        QRCode.toCanvas(container, studentId, {
            width: 150,
            margin: 2,
            color: { dark: '#000000', light: '#FFFFFF' }
        }, function (error) {
            if (error) {
                console.error('QR Code Error:', error);
                container.innerHTML = '<p class="text-danger">Error generating QR code</p>';
            } else {
                console.log('QR Code generated successfully with qrcode@1.5.3');
            }
        });
    }
}

function downloadQRCode() {
    const studentId = document.getElementById('studentIdText').textContent.trim();
    const canvas = document.querySelector('#qrCodeContainer canvas');
    if (canvas) {
        const link = document.createElement('a');
        link.download = 'student_qr_' + studentId + '.png';
        link.href = canvas.toDataURL();
        link.click();
    }
}

function printIdCard() {
    // Create a new window for printing
    const printWindow = window.open('', '_blank', 'width=600,height=800');
    
    // Get student data
    const studentName = '{{ Auth::user()->name }}';
    const studentId = '{{ Auth::user()->login_id ?? Auth::user()->id }}';
    const registrationDate = '{{ Auth::user()->created_at ? Auth::user()->created_at->format('Y-m-d') : 'N/A' }}';
    const studentImage = '{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('images/default-avatar.png') }}';
    
    // Create QR code for printing
    const qrContainer = document.createElement('div');
    qrContainer.id = 'printQRCode';
    
    // Generate QR code
    new QRCode(qrContainer, {
        text: studentId,
        width: 120,
        height: 120,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H
    });
    
    // Create print content
    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Student ID Card</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                    background: white;
                }
                .id-card {
                    width: 350px;
                    height: 220px;
                    border: 2px solid #333;
                    border-radius: 10px;
                    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
                    color: white;
                    position: relative;
                    overflow: hidden;
                }
                .id-card::before {
                    content: '';
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    height: 3px;
                    background: linear-gradient(90deg, #fff, #f0f0f0, #fff);
                }
                .header {
                    text-align: center;
                    padding: 10px;
                    background: rgba(255,255,255,0.1);
                    border-bottom: 1px solid rgba(255,255,255,0.2);
                }
                .header h2 {
                    margin: 0;
                    font-size: 18px;
                    font-weight: bold;
                }
                .content {
                    display: flex;
                    padding: 15px;
                    height: 150px;
                }
                .photo-section {
                    width: 80px;
                    text-align: center;
                }
                .student-photo {
                    width: 70px;
                    height: 70px;
                    border-radius: 50%;
                    border: 3px solid white;
                    object-fit: cover;
                    margin-bottom: 5px;
                }
                .default-photo {
                    width: 70px;
                    height: 70px;
                    border-radius: 50%;
                    background: rgba(255,255,255,0.2);
                    border: 3px solid white;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    font-size: 12px;
                    font-weight: bold;
                    margin-bottom: 5px;
                }
                .info-section {
                    flex: 1;
                    margin-left: 15px;
                }
                .info-row {
                    margin-bottom: 8px;
                    font-size: 12px;
                }
                .info-label {
                    font-weight: bold;
                    color: rgba(255,255,255,0.9);
                }
                .info-value {
                    color: white;
                }
                .qr-section {
                    position: absolute;
                    bottom: 10px;
                    right: 10px;
                    background: white;
                    padding: 5px;
                    border-radius: 5px;
                }
                .status-badge {
                    background: #28a745;
                    color: white;
                    padding: 2px 8px;
                    border-radius: 10px;
                    font-size: 10px;
                    font-weight: bold;
                }
                @media print {
                    body { margin: 0; }
                    .id-card { border: 2px solid #333; }
                }
            </style>
        </head>
        <body>
            <div class="id-card">
                <div class="header">
                    <h2>STUDENT ID CARD</h2>
                </div>
                <div class="content">
                    <div class="photo-section">
                        ${studentImage.includes('default-avatar') ? 
                            '<div class="default-photo">STUDENT</div>' : 
                            `<img src="${studentImage}" alt="Student Photo" class="student-photo">`
                        }
                        <div style="font-size: 10px; font-weight: bold;">${studentName}</div>
                    </div>
                    <div class="info-section">
                        <div class="info-row">
                            <span class="info-label">Student ID:</span>
                            <span class="info-value">${studentId}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Registration Date:</span>
                            <span class="info-value">${registrationDate}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            <span class="status-badge">ACTIVE</span>
                        </div>
                    </div>
                    <div class="qr-section">
                        <div id="printQRCode"></div>
                    </div>
                </div>
            </div>
        </body>
        </html>
    `;
    
    printWindow.document.write(printContent);
    printWindow.document.close();
    
    // Wait for QR code to generate then print
    setTimeout(() => {
        // Move QR code to print window
        const qrCode = qrContainer.querySelector('img');
        if (qrCode) {
            const printQRContainer = printWindow.document.getElementById('printQRCode');
            if (printQRContainer) {
                printQRContainer.innerHTML = '';
                printQRContainer.appendChild(qrCode.cloneNode(true));
            }
        }
        
        printWindow.focus();
        printWindow.print();
    }, 500);
}
// Profile Functions
function showProfileModal() {
    const modal = new bootstrap.Modal(document.getElementById('profileModal'));
    modal.show();
}
// إغلاق المودال يدويًا
function closeProfileModal() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('profileModal'));
    if (modal) modal.hide();
}
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(evt) {
            document.getElementById('profileImagePreview').src = evt.target.result;
        };
        reader.readAsDataURL(file);
    }
});
// إرسال النموذج وتحديث الصفحة بعد النجاح
if(document.getElementById('profileForm')) {
    document.getElementById('profileForm').addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const updateBtn = document.getElementById('updateProfileBtn');
        const originalText = updateBtn.innerHTML;
        updateBtn.disabled = true;
        updateBtn.innerHTML = '<i class="uil uil-spinner"></i> Updating...';
        fetch('{{ route("student.profile.update") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(async response => {
            let data;
            try {
                data = await response.json();
            } catch (e) {
                data = { success: false, message: 'Unknown error' };
            }
            if (response.ok && data.success) {
                showToast('Profile updated successfully!', true);
                setTimeout(() => { window.location.reload(); }, 1200);
            } else {
                // إذا كان هناك أخطاء فاليديشن من السيرفر
                if (data.errors) {
                    let msg = Object.values(data.errors).join(' | ');
                    showToast(msg, false);
                } else {
                    showToast(data.message || 'Error updating profile', false);
                }
            }
        })
        .catch(error => {
            showToast('Error updating profile', false);
        })
        .finally(() => {
            updateBtn.disabled = false;
            updateBtn.innerHTML = originalText;
        });
    });
}
// Password Functions
function showPasswordModal() {
    const modal = new bootstrap.Modal(document.getElementById('passwordModal'));
    modal.show();
}
document.getElementById('passwordForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    fetch('{{ route("student.password.change") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('Password changed successfully!', true);
            setTimeout(() => { bootstrap.Modal.getInstance(document.getElementById('passwordModal')).hide(); }, 1200);
            this.reset();
        } else {
            showToast(data.message || 'Error changing password', false);
        }
    })
    .catch(error => {
        showToast('Error changing password', false);
    });
});
// Toast Function
function showToast(msg, success = true) {
    const toast = document.getElementById('toastMsg');
    const body = document.getElementById('toastBody');
    body.textContent = msg;
    toast.classList.remove('bg-success', 'bg-danger');
    toast.classList.add(success ? 'bg-success' : 'bg-danger');
    const bsToast = new bootstrap.Toast(toast);
    bsToast.show();
}
// Contact Support Functions
function contactSupport() {
    fetch('{{ route("student.contact-support") }}')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('whatsappLink').href = data.whatsapp_url;
                const modal = new bootstrap.Modal(document.getElementById('contactModal'));
                modal.show();
            }
        })
        .catch(error => {
            showToast('Error loading contact support', false);
        });
}
// Update Quick Actions
document.addEventListener('DOMContentLoaded', function() {
    const quickActions = document.querySelectorAll('.sd-quick-action');
    quickActions[0].addEventListener('click', showStudentIdCard); // Show Student ID Card
    quickActions[1].addEventListener('click', function() { showToast('Grades feature coming soon!', true); });
    quickActions[2].addEventListener('click', function() { showToast('Financial status feature coming soon!', true); });
    quickActions[3].addEventListener('click', contactSupport); // Contact Support
    // زر تغيير كلمة السر موجود بالفعل
});
// إصلاح أزرار الإغلاق في جميع المودالات (زر X أو زر Close)
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.modal .btn-close, .modal [data-bs-dismiss="modal"]').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const modalEl = btn.closest('.modal');
            if (modalEl) {
                const modal = bootstrap.Modal.getInstance(modalEl);
                if (modal) modal.hide();
            }
        });
    });
});
// تغيير كلمة السر (كود وحيد وفعال مع console.log واختبار showToast)
if(document.getElementById('passwordForm')) {
    document.getElementById('passwordForm').addEventListener('submit', function(e) {
        e.preventDefault();
        console.log('Password form submitted'); // اختبار التنفيذ
        showToast('تم الضغط على زر تغيير كلمة السر (اختبار)', false); // اختبار ظهور الرسالة
        const formData = new FormData(this);
        const submitBtn = this.querySelector('button[type="submit"]');
        const originalText = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="uil uil-spinner"></i> Saving...';
        fetch('{{ route("student.password.change") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(async response => {
            let data;
            try {
                data = await response.json();
            } catch (e) {
                data = { success: false, message: 'Unknown error' };
            }
            if (response.ok && data.success) {
                showToast('Password changed successfully!', true);
                setTimeout(() => { bootstrap.Modal.getInstance(document.getElementById('passwordModal')).hide(); }, 1200);
                document.getElementById('passwordForm').reset();
            } else {
                if (data.errors) {
                    let msg = Object.values(data.errors).join(' | ');
                    showToast(msg, false);
                } else {
                    showToast(data.message || 'Error changing password', false);
                }
            }
        })
        .catch(error => {
            showToast('Error changing password', false);
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
        });
    });
}
// فتح مودال الحالة المالية
function showFinancialStatusModal() {
    const modal = new bootstrap.Modal(document.getElementById('financialStatusModal'));
    modal.show();
}
// تفعيل زر Financial Status
const financialBtn = document.querySelectorAll('.sd-quick-action .qa-title');
if (financialBtn && financialBtn.length > 0) {
    financialBtn.forEach(function(el) {
        if (el.textContent.trim() === 'Financial Status') {
            el.closest('.sd-quick-action').onclick = showFinancialStatusModal;
        }
    });
}
// طباعة الحالة المالية
function printFinancialStatus() {
    const printContents = document.getElementById('financialStatusContent').innerHTML;
    const win = window.open('', '', 'height=700,width=900');
    win.document.write('<html><head><title>Financial Status</title>');
    win.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">');
    win.document.write('</head><body>');
    win.document.write(printContents);
    win.document.write('</body></html>');
    win.document.close();
    win.print();
}
// تحميل PDF باستخدام html2pdf.js
function downloadFinancialStatusPDF() {
    const element = document.getElementById('financialStatusContent');
    const opt = {
        margin:       0.2,
        filename:     'financial_status.pdf',
        image:        { type: 'jpeg', quality: 0.98 },
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
}

function showCourseSchedule(courseId) {
    let schedules = @json($allSchedules ?? []);
    let courseSchedules = schedules.filter(s => s.course_id == courseId);
    let content = '';
    
    if (courseSchedules.length > 0) {
        // Get course details from the first schedule
        let courseInfo = courseSchedules[0];
        
        // Calculate attendance statistics
        let presentCount = courseSchedules.filter(s => s.attendance_status === 'present').length;
        let absentCount = courseSchedules.filter(s => s.attendance_status === 'absent').length;
        let lateCount = courseSchedules.filter(s => s.attendance_status === 'late').length;
        let pendingCount = courseSchedules.filter(s => s.attendance_status === 'pending').length;
        
        content += `
        <div class="row mb-3">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body py-3">
                        <h6 class="card-title text-primary mb-2">
                            <i class="uil uil-book-open me-2"></i>
                            ${courseInfo.name}
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 small"><strong>Category:</strong> ${courseInfo.category || 'Not specified'}</p>
                                <p class="mb-1 small"><strong>Instructor:</strong> ${courseInfo.instructor || 'Not assigned'}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 small"><strong>Total Sessions:</strong> ${courseSchedules.length}</p>
                                <p class="mb-1 small"><strong>Status:</strong> 
                                    <span class="badge ${presentCount > 0 ? 'bg-success' : 'bg-secondary'}">${presentCount} Present</span>
                                    <span class="badge ${absentCount > 0 ? 'bg-danger' : 'bg-secondary'}">${absentCount} Absent</span>
                                    <span class="badge ${lateCount > 0 ? 'bg-warning' : 'bg-secondary'}">${lateCount} Late</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th><i class="uil uil-calendar-alt me-1"></i>Date</th>
                        <th><i class="uil uil-clock me-1"></i>Time</th>
                        <th><i class="uil uil-map-marker me-1"></i>Room</th>
                        <th><i class="uil uil-check-circle me-1"></i>Status</th>
                    </tr>
                </thead>
                <tbody>`;
        
        courseSchedules.forEach(s => {
            let date = s.session_date ? new Date(s.session_date) : null;
            let shortDate = date ? date.toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric',
                weekday: 'short'
            }) : '-';
            let timeRange = `${s.start_time ? s.start_time.substring(0,5) : ''} - ${s.end_time ? s.end_time.substring(0,5) : ''}`;
            
            let statusBadge = '';
            let statusIcon = '';
            switch(s.attendance_status) {
                case 'present':
                    statusBadge = '<span class="status-badge present"><i class="uil uil-check-circle me-1"></i>Present</span>';
                    break;
                case 'absent':
                    statusBadge = '<span class="status-badge absent"><i class="uil uil-times-circle me-1"></i>Absent</span>';
                    break;
                case 'late':
                    statusBadge = '<span class="status-badge late"><i class="uil uil-clock me-1"></i>Late</span>';
                    break;
                default:
                    statusBadge = '<span class="status-badge pending"><i class="uil uil-clock-eight me-1"></i>Pending</span>';
            }
            
            content += `<tr>
                <td>
                    <div>
                        <strong>${shortDate}</strong>
                    </div>
                </td>
                <td>
                    <div>
                        <strong>${timeRange}</strong>
                    </div>
                </td>
                <td>
                    <span class="badge bg-info">${s.room || 'TBD'}</span>
                </td>
                <td>${statusBadge}</td>
            </tr>`;
        });
        
        content += `</tbody></table>
        </div>
        
        <div class="row mt-3">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="uil uil-info-circle me-2"></i>
                    <strong>Note:</strong> Attendance status is updated based on your participation in each session.
                </div>
            </div>
        </div>`;
    } else {
        content = `
        <div class="text-center py-4">
            <i class="uil uil-calendar-slash text-muted" style="font-size: 3rem;"></i>
            <h6 class="text-muted mt-2">No Scheduled Lectures</h6>
            <p class="text-muted small">There are currently no scheduled lectures for this course.</p>
        </div>`;
    }
    
    document.getElementById('courseScheduleContent').innerHTML = content;
    new bootstrap.Modal(document.getElementById('courseScheduleModal')).show();
}

function showPackageSchedule(packageId) {
    let schedules = @json($allSchedules ?? []);
    let packageSchedules = schedules.filter(s => s.type === 'package' && s.package_name);
    let content = '';
    
    if (packageSchedules.length > 0) {
        // Get package details from the first schedule
        let packageInfo = packageSchedules[0];
        
        // Calculate attendance statistics
        let presentCount = packageSchedules.filter(s => s.attendance_status === 'present').length;
        let absentCount = packageSchedules.filter(s => s.attendance_status === 'absent').length;
        let lateCount = packageSchedules.filter(s => s.attendance_status === 'late').length;
        let pendingCount = packageSchedules.filter(s => s.attendance_status === 'pending').length;
        
        content += `
        <div class="row mb-3">
            <div class="col-12">
                <div class="card bg-light">
                    <div class="card-body py-3">
                        <h6 class="card-title text-primary mb-2">
                            <i class="uil uil-box me-2"></i>
                            ${packageInfo.package_name}
                        </h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1 small"><strong>Package Type:</strong> Educational Package</p>
                                <p class="mb-1 small"><strong>Total Sessions:</strong> ${packageSchedules.length}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1 small"><strong>Status:</strong> <span class="badge bg-success">Active</span></p>
                                <p class="mb-1 small"><strong>Attendance:</strong> 
                                    <span class="badge ${presentCount > 0 ? 'bg-success' : 'bg-secondary'}">${presentCount} Present</span>
                                    <span class="badge ${absentCount > 0 ? 'bg-danger' : 'bg-secondary'}">${absentCount} Absent</span>
                                    <span class="badge ${lateCount > 0 ? 'bg-warning' : 'bg-secondary'}">${lateCount} Late</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th><i class="uil uil-book-open me-1"></i>Course</th>
                        <th><i class="uil uil-calendar-alt me-1"></i>Date</th>
                        <th><i class="uil uil-clock me-1"></i>Time</th>
                        <th><i class="uil uil-map-marker me-1"></i>Room</th>
                        <th><i class="uil uil-check-circle me-1"></i>Status</th>
                    </tr>
                </thead>
                <tbody>`;
        
        packageSchedules.forEach(s => {
            let date = s.session_date ? new Date(s.session_date) : null;
            let shortDate = date ? date.toLocaleDateString('en-US', { 
                month: 'short', 
                day: 'numeric',
                weekday: 'short'
            }) : '-';
            let timeRange = `${s.start_time ? s.start_time.substring(0,5) : ''} - ${s.end_time ? s.end_time.substring(0,5) : ''}`;
            
            let statusBadge = '';
            switch(s.attendance_status) {
                case 'present':
                    statusBadge = '<span class="status-badge present"><i class="uil uil-check-circle me-1"></i>Present</span>';
                    break;
                case 'absent':
                    statusBadge = '<span class="status-badge absent"><i class="uil uil-times-circle me-1"></i>Absent</span>';
                    break;
                case 'late':
                    statusBadge = '<span class="status-badge late"><i class="uil uil-clock me-1"></i>Late</span>';
                    break;
                default:
                    statusBadge = '<span class="status-badge pending"><i class="uil uil-clock-eight me-1"></i>Pending</span>';
            }
            
            content += `<tr>
                <td>
                    <div>
                        <strong>${s.name}</strong>
                        <div class="text-muted small">${s.category || 'No category'}</div>
                    </div>
                </td>
                <td>
                    <div>
                        <strong>${shortDate}</strong>
                    </div>
                </td>
                <td>
                    <div>
                        <strong>${timeRange}</strong>
                    </div>
                </td>
                <td>
                    <span class="badge bg-info">${s.room || 'TBD'}</span>
                </td>
                <td>${statusBadge}</td>
            </tr>`;
        });
        
        content += `</tbody></table>
        </div>
        
        <div class="row mt-3">
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="uil uil-info-circle me-2"></i>
                    <strong>Note:</strong> This schedule shows all scheduled lectures for courses included in this package.
                </div>
            </div>
        </div>`;
    } else {
        content = `
        <div class="text-center py-4">
            <i class="uil uil-calendar-slash text-muted" style="font-size: 3rem;"></i>
            <h6 class="text-muted mt-2">No Scheduled Lectures</h6>
            <p class="text-muted small">There are currently no scheduled lectures for courses in this package.</p>
        </div>`;
    }
    
    document.getElementById('courseScheduleContent').innerHTML = content;
    new bootstrap.Modal(document.getElementById('courseScheduleModal')).show();
}
</script>
@endsection