<div class="container-fluid px-0">
  <div class="tab-pane px-0">
    <h5 class="text-center">📅 Attendance Record - Modern Institute</h5>
    <hr>

    <!-- Attendance Summary Cards -->
    <div class="row mb-4">
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-primary text-white text-center">
          <div class="card-body">
            <h4>{{ $totalSessions ?? 0 }}</h4>
            <p class="mb-0">Total Sessions</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-success text-white text-center">
          <div class="card-body">
            <h4>{{ $presentSessions ?? 0 }}</h4>
            <p class="mb-0">Present</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-danger text-white text-center">
          <div class="card-body">
            <h4>{{ $absentSessions ?? 0 }}</h4>
            <p class="mb-0">Absent</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-warning text-white text-center">
          <div class="card-body">
            <h4>{{ $lateSessions ?? 0 }}</h4>
            <p class="mb-0">Late</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Attendance Rate -->
    <div class="text-center mb-4">
      <h5>Attendance Rate: <span class="text-primary">{{ $attendanceRate ?? 0 }}%</span></h5>
    </div>

    <!-- Attendance Table -->
    <div class="table-responsive px-0">
      <table class="table table-bordered text-center m-0" style="min-width: 700px; width: 100%;">
        <thead class="thead-light">
          <tr>
            <th>Date</th>
            <th>Day</th>
            <th>Course</th>
            <th>Status</th>
            <th>Method</th>
            <th>Notes</th>
          </tr>
        </thead>
        <tbody>
          @forelse($attendances ?? [] as $attendance)
            <tr>
              <td>{{ \Carbon\Carbon::parse($attendance->date)->format('Y-m-d') }}</td>
              <td>{{ \Carbon\Carbon::parse($attendance->date)->format('l') }}</td>
              <td>
                <strong>{{ $attendance->enrollment->course->title ?? 'Unknown Course' }}</strong>
              </td>
              <td>
                @if($attendance->status == 'present')
                  <span class="badge bg-success text-white">✅ Present</span>
                @elseif($attendance->status == 'absent')
                  <span class="badge bg-danger text-white">❌ Absent</span>
                @elseif($attendance->status == 'late')
                  <span class="badge bg-warning text-white">⏰ Late</span>
                @else
                  <span class="badge bg-secondary text-white">⏳ Pending</span>
                @endif
              </td>
              <td>
                @if($attendance->method == 'QR')
                  <span class="badge bg-info">QR Code</span>
                @elseif($attendance->method == 'manual')
                  <span class="badge bg-secondary">Manual</span>
                @else
                  <span class="badge bg-light text-dark">Auto</span>
                @endif
              </td>
              <td>{{ $attendance->notes ?? '-' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted">
                <i class="fas fa-calendar-times"></i>
                No attendance records found
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if(($attendances ?? collect())->isEmpty())
      <div class="text-center mt-4">
        <div class="card shadow-sm border-0">
          <div class="card-body p-5">
            <i class="fas fa-calendar-times text-muted" style="font-size: 3rem;"></i>
            <h5 class="mt-3 text-muted">No Attendance Records</h5>
            <p class="text-muted">You haven't attended any sessions yet.</p>
          </div>
        </div>
      </div>
    @endif
  </div>
</div>

<style>
  .container-fluid,
  .tab-pane,
  .table-responsive {
    padding-left: 0 !important;
    padding-right: 0 !important;
    margin-left: 0 !important;
    margin-right: 0 !important;
  }

  .table {
    table-layout: auto;
  }

  .card {
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }

  @media (max-width: 576px) {
    th, td {
      padding: 14px;
      font-size: 15px;
    }
    
    .card-body h4 {
      font-size: 1.5rem;
    }
  }
</style>
