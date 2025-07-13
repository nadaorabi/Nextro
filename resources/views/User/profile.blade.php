@extends('layouts.app')

@section('title', 'Student Dashboard')
@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-6-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">News</h1>
            <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
              <p>Another free template by <a href="https://untree.co/" target="_blank" class="link-highlight">Untree.co</a>. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live.</p>
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
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-bottom: 32px;
        }
        .sd-stat-card {
            background: rgba(255,255,255,0.85);
            border-radius: 18px;
            box-shadow: 0 2px 16px #4f8cff0d;
            padding: 28px 18px 22px 18px;
            display: flex; flex-direction: column; align-items: flex-start;
            position: relative;
            transition: box-shadow 0.18s, transform 0.18s;
            overflow: hidden;
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
        .sd-stat-title { color: #7b6ffb; font-size: 1.05rem; font-weight: 500; margin-bottom: 2px; }
        .sd-stat-value { font-size: 2.1rem; font-weight: 700; color: #222; margin-bottom: 2px; }
        .sd-stat-desc { color: #888; font-size: 1rem; }
        /* Main Sections */
        .sd-main-content {
            display: grid;
            grid-template-columns: 2.2fr 1fr;
            gap: 28px;
        }
        .sd-section, .sd-side-section {
            background: rgba(255,255,255,0.92);
            border-radius: 18px;
            box-shadow: 0 2px 16px #4f8cff0d;
            margin-bottom: 24px;
            padding: 22px 20px 18px 20px;
            position: relative;
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
            .sd-stats { grid-template-columns: 1fr 1fr; }
            .sd-main-content { grid-template-columns: 1fr; }
        }
        @media (max-width: 767px) {
            .sd-header { flex-direction: column; align-items: flex-start; gap: 18px; padding: 22px 10px 16px 10px; }
            .sd-stats { grid-template-columns: 1fr; gap: 14px; }
            .sd-main-content { gap: 14px; }
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
            <div class="sd-stat-title">Enrolled Courses</div>
            <div class="sd-stat-value">{{ ($enrollments ?? collect())->count() }}</div>
        </div>
        <div class="sd-stat-card green">
            <div class="sd-stat-icon"><i class="uil uil-calendar-alt"></i></div>
            <div class="sd-stat-title">Attendance Rate</div>
            <div class="sd-stat-value">{{ $attendanceRate ?? 0 }}%</div>
        </div>
        <div class="sd-stat-card purple">
            <div class="sd-stat-icon"><i class="uil uil-chart-line"></i></div>
            <div class="sd-stat-title">Average Grade</div>
            <div class="sd-stat-value">{{ $averageGrade ?? 0 }}%</div>
        </div>
        <div class="sd-stat-card pink">
            <div class="sd-stat-icon"><i class="uil uil-usd-circle"></i></div>
            <div class="sd-stat-title">Net Payment</div>
            <div class="sd-stat-value">${{ number_format($netPayment ?? 0, 0) }}</div>
        </div>
    </div>
    <!-- Main Content -->
    <div class="sd-main-content">
        <div>
            <!-- Current Courses -->
            <div class="sd-section">
                <h3><i class="uil uil-books"></i>Current Courses <span class="sd-section-badge">{{ ($enrollments ?? collect())->count() }} Courses</span></h3>
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
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="sd-empty-state">
                                <i class="uil uil-calendar-slash"></i>
                                <h4>No Attendance Records</h4>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        <div>
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
            <!-- Academic Summary -->
            <div class="sd-side-section">
                <h3><i class="uil uil-graduation-cap"></i>Academic Summary</h3>
                <div class="academic-summary">
                    <div class="summary-item">
                        <span class="meta-item"><i class="uil uil-books"></i> Enrolled Courses:</span> <b>{{ ($enrollments ?? collect())->count() }}</b>
                    </div>
                    <div class="summary-item">
                        <span class="meta-item"><i class="uil uil-chart-line"></i> Average Grade:</span> <b>{{ $averageGrade ?? 0 }}%</b>
                    </div>
                    <div class="summary-item">
                        <span class="meta-item"><i class="uil uil-calendar-alt"></i> Attendance Rate:</span> <b>{{ $attendanceRate ?? 0 }}%</b>
                    </div>
                    <div class="summary-item">
                        <span class="meta-item"><i class="uil uil-usd-circle"></i> Net Payment:</span> <b>${{ number_format($netPayment ?? 0, 0) }}</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection