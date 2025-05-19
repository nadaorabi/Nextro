<div class="container-fluid px-2">
  <div class="tab-pane">
    <h6 class="text-center mb-3">📊 Student Grades</h6>
    <hr>

    <!-- Grades Table -->
    <div class="table-responsive">
      <table class="table text-center w-100">
        <thead class="thead-light">
          <tr>
            <th>Subject</th>
            <th>Grade</th>
            <th>Letter</th>
            <th>Percentage</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Mathematics</td>
            <td>92</td>
            <td>A</td>
            <td>92%</td>
          </tr>
          <tr>
            <td>Physics</td>
            <td>85</td>
            <td>B</td>
            <td>85%</td>
          </tr>
          <tr>
            <td>English</td>
            <td>78</td>
            <td>C+</td>
            <td>78%</td>
          </tr>
          <tr>
            <td>History</td>
            <td>88</td>
            <td>B+</td>
            <td>88%</td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- GPA Summary -->
    <div class="mt-4 p-3 bg-light rounded text-center">
      <strong>GPA:</strong> 3.5 / 4.0<br>
      <strong>Status:</strong> Good Standing
    </div>
  </div>
</div>

<style>
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
  }
</style>
