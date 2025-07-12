<div class="container-fluid px-2">
  <div class="tab-pane">
    <h6 class="text-center mb-3">🎓 Academic Status</h6>
    <hr>

    <!-- Academic Summary Cards -->
    <div class="row mb-4">
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-primary text-white text-center">
          <div class="card-body">
            <h4>{{ ($enrollments ?? collect())->count() }}</h4>
            <p class="mb-0">Enrolled Courses</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-success text-white text-center">
          <div class="card-body">
            <h4>{{ ($studentPackages ?? collect())->count() }}</h4>
            <p class="mb-0">Enrolled Packages</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-info text-white text-center">
          <div class="card-body">
            <h4>{{ $totalGrades ?? 0 }}</h4>
            <p class="mb-0">Completed Assessments</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-warning text-white text-center">
          <div class="card-body">
            <h4>{{ $attendanceRate ?? 0 }}%</h4>
            <p class="mb-0">Attendance Rate</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Student Information -->
    <div class="row">
      <!-- Student Status -->
      <div class="col-md-6 col-sm-12 mb-3">
        <div class="border rounded p-3 bg-light">
          <label class="font-weight-bold mb-1">Student Status</label>
          <div class="{{ Auth::user()->is_active == 1 ? 'text-success' : 'text-danger' }}">
            {{ Auth::user()->is_active == 1 ? 'Active' : 'Inactive' }}
          </div>
        </div>
      </div>

      <!-- Registration Date -->
      <div class="col-md-6 col-sm-12 mb-3">
        <div class="border rounded p-3 bg-light">
          <label class="font-weight-bold mb-1">Registration Date</label>
          <div class="text-muted">{{ Auth::user()->created_at ? Auth::user()->created_at->format('F Y') : 'N/A' }}</div>
        </div>
      </div>

      <!-- Student ID -->
      <div class="col-md-6 col-sm-12 mb-3">
        <div class="border rounded p-3 bg-light">
          <label class="font-weight-bold mb-1">Student ID</label>
          <div class="text-muted">{{ Auth::user()->login_id ?? 'N/A' }}</div>
        </div>
      </div>

      <!-- Account Type -->
      <div class="col-md-6 col-sm-12 mb-3">
        <div class="border rounded p-3 bg-light">
          <label class="font-weight-bold mb-1">Account Type</label>
          <div class="text-muted">{{ ucfirst(Auth::user()->role ?? 'Student') }}</div>
        </div>
      </div>
    </div>

    <!-- Current Enrollments -->
    @if(($enrollments ?? collect())->isNotEmpty())
      <div class="mt-4">
        <h6 class="mb-3">Current Course Enrollments</h6>
        <div class="table-responsive">
          <table class="table table-bordered table-sm">
            <thead class="thead-light">
              <tr>
                <th>Course</th>
                <th>Category</th>
                <th>Enrollment Date</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($enrollments as $enrollment)
                <tr>
                  <td>
                    <strong>{{ $enrollment->course->title ?? 'Unknown Course' }}</strong>
                  </td>
                  <td>{{ $enrollment->course->category->name ?? 'No Category' }}</td>
                  <td>{{ \Carbon\Carbon::parse($enrollment->enrollment_date)->format('Y-m-d') }}</td>
                  <td>
                    @if($enrollment->status)
                      <span class="badge bg-success">{{ ucfirst($enrollment->status) }}</span>
                    @else
                      <span class="badge bg-secondary">Active</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endif

    <!-- Package Enrollments -->
    @if(($studentPackages ?? collect())->isNotEmpty())
      <div class="mt-4">
        <h6 class="mb-3">Package Enrollments</h6>
        <div class="table-responsive">
          <table class="table table-bordered table-sm">
            <thead class="thead-light">
              <tr>
                <th>Package</th>
                <th>Category</th>
                <th>Purchase Date</th>
                <th>Amount Paid</th>
              </tr>
            </thead>
            <tbody>
              @foreach($studentPackages as $studentPackage)
                <tr>
                  <td>
                    <strong>{{ $studentPackage->package->name ?? 'Unknown Package' }}</strong>
                  </td>
                  <td>{{ $studentPackage->package->category->name ?? 'No Category' }}</td>
                  <td>{{ \Carbon\Carbon::parse($studentPackage->purchase_date)->format('Y-m-d') }}</td>
                  <td>${{ number_format($studentPackage->amount_paid, 2) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @endif

    @if(($enrollments ?? collect())->isEmpty() && ($studentPackages ?? collect())->isEmpty())
      <div class="text-center mt-4">
        <div class="card shadow-sm border-0">
          <div class="card-body p-5">
            <i class="fas fa-graduation-cap text-muted" style="font-size: 3rem;"></i>
            <h5 class="mt-3 text-muted">No Academic Records</h5>
            <p class="text-muted">You haven't enrolled in any courses or packages yet.</p>
          </div>
        </div>
      </div>
    @endif
  </div>
</div>

<style>
  .card {
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }

  @media (max-width: 576px) {
    .container-fluid {
      padding: 0;
    }
    .tab-pane {
      padding: 10px;
    }
    .border {
      padding: 12px;
      text-align: center;
    }
    .card-body h4 {
      font-size: 1.5rem;
    }
  }
</style>
