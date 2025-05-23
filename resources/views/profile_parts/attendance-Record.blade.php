<div class="container-fluid px-0">
  <div class="tab-pane px-0">
    <h5 class="text-center">📅 Attendance Record - Modern Institute</h5>
    <hr>

    <!-- Attendance Table -->
    <div class="table-responsive px-0">
      <table class="table table-bordered text-center m-0" style="min-width: 700px; width: 100%;">
        <thead class="thead-light">
          <tr>
            <th>Date</th>
            <th>Day</th>
            <th>Course Type</th>
            <th>Status</th>
            <th>Notes</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2025-04-01</td>
            <td>Tuesday</td>
            <td><strong>Baccalaureate</strong></td>
            <td><span class="badge bg-success text-white">✅ Present</span></td>
            <td>Math class</td>
          </tr>
          <tr>
            <td>2025-04-02</td>
            <td>Wednesday</td>
            <td><strong>Ninth Grade</strong></td>
            <td><span class="badge bg-danger text-white">❌ Absent</span></td>
            <td>No excuse</td>
          </tr>
          <tr>
            <td>2025-04-03</td>
            <td>Thursday</td>
            <td><strong>English Language</strong></td>
            <td><span class="badge bg-success text-white">✅ Present</span></td>
            <td>Good participation</td>
          </tr>
          <tr>
            <td>2025-04-04</td>
            <td>Friday</td>
            <td><strong>Baccalaureate</strong></td>
            <td><span class="badge bg-success text-white">✅ Present</span></td>
            <td>-</td>
          </tr>
          <tr>
            <td>2025-04-05</td>
            <td>Saturday</td>
            <td><strong>English Language</strong></td>
            <td><span class="badge bg-danger text-white">❌ Absent</span></td>
            <td>Sick leave</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Attendance Summary -->
    <div class="mt-3 text-center">
      <strong>Attendance Rate:</strong> <span id="attendanceRate">--%</span>
    </div>
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

  @media (max-width: 576px) {
    th, td {
      padding: 14px;
      font-size: 15px;
    }
  }
</style>
