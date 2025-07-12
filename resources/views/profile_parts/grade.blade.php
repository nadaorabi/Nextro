<div class="container-fluid px-2">
  <div class="tab-pane">
    <h6 class="text-center mb-3">📊 Student Grades</h6>
    <hr>

    <!-- Grades Summary Cards -->
    <div class="row mb-4">
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-primary text-white text-center">
          <div class="card-body">
            <h4>{{ $totalGrades ?? 0 }}</h4>
            <p class="mb-0">Total Assessments</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-success text-white text-center">
          <div class="card-body">
            <h4>{{ $averageGrade ?? 0 }}%</h4>
            <p class="mb-0">Average Grade</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-info text-white text-center">
          <div class="card-body">
            <h4>{{ $highestGrade ?? 0 }}%</h4>
            <p class="mb-0">Highest Grade</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 mb-3">
        <div class="card bg-warning text-white text-center">
          <div class="card-body">
            <h4>{{ $lowestGrade ?? 0 }}%</h4>
            <p class="mb-0">Lowest Grade</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Grades Table -->
    <div class="table-responsive">
      <table class="table text-center w-100">
        <thead class="thead-light">
          <tr>
            <th>Course</th>
            <th>Assessment Type</th>
            <th>Grade</th>
            <th>Letter Grade</th>
            <th>Percentage</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          @forelse($grades ?? [] as $grade)
            <tr>
              <td>
                <strong>{{ $grade->enrollment->course->title ?? 'Unknown Course' }}</strong>
              </td>
              <td>{{ ucfirst($grade->assessment_type) }}</td>
              <td>{{ $grade->score }}</td>
              <td>
                @if($grade->score >= 90)
                  <span class="badge bg-success">A</span>
                @elseif($grade->score >= 80)
                  <span class="badge bg-primary">B</span>
                @elseif($grade->score >= 70)
                  <span class="badge bg-warning">C</span>
                @elseif($grade->score >= 60)
                  <span class="badge bg-info">D</span>
                @else
                  <span class="badge bg-danger">F</span>
                @endif
              </td>
              <td>{{ $grade->score }}%</td>
              <td>{{ \Carbon\Carbon::parse($grade->created_at)->format('Y-m-d') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="text-center text-muted">
                <i class="fas fa-chart-line"></i>
                No grades available yet
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- GPA Summary -->
    <div class="mt-4 p-3 bg-light rounded text-center">
      @if($totalGrades > 0)
        <strong>Average Grade:</strong> {{ $averageGrade }}%<br>
        <strong>Status:</strong> 
        @if($averageGrade >= 80)
          <span class="text-success">Excellent</span>
        @elseif($averageGrade >= 70)
          <span class="text-primary">Good</span>
        @elseif($averageGrade >= 60)
          <span class="text-warning">Average</span>
        @else
          <span class="text-danger">Needs Improvement</span>
        @endif
      @else
        <strong>No grades available yet</strong><br>
        <span class="text-muted">Grades will appear here once assessments are completed</span>
      @endif
    </div>

    @if(($grades ?? collect())->isEmpty())
      <div class="text-center mt-4">
        <div class="card shadow-sm border-0">
          <div class="card-body p-5">
            <i class="fas fa-chart-line text-muted" style="font-size: 3rem;"></i>
            <h5 class="mt-3 text-muted">No Grades Available</h5>
            <p class="text-muted">Your grades will appear here once you complete assessments.</p>
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
    .table {
      font-size: 12px;
    }
    th, td {
      padding: 8px;
      white-space: nowrap;
    }
    .container-fluid {
      padding: 0;
    }
    .tab-pane {
      padding: 10px;
    }
    .card-body h4 {
      font-size: 1.5rem;
    }
  }
</style>
