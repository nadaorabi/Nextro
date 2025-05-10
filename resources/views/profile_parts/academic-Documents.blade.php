<div class="tab-pane" id="account">
  <h6 class="mb-4">Request an Official Document</h6>

  <form>

    <!-- Program Type -->
    <div class="form-group">
      <label for="programType">Program Type</label>
      <select class="form-control" id="programType">
        <option value="baccalaureate">Baccalaureate</option>
        <option value="grade9">Grade 9</option>
        <option value="languages">Language Courses</option>
      </select>
    </div>

    <!-- Document Type -->
    <div class="form-group">
      <label for="documentType">Document Type</label>
      <select class="form-control" id="documentType">
        <option value="attendance_certificate">Attendance Certificate</option>
        <option value="final_report">Academic Performance Report</option>
        <option value="attendance_summary">Attendance Summary</option>
        <option value="financial_status">Financial Statement / Payments</option>
        <option value="language_course_certificate">Language Course Completion Certificate</option>
      </select>
    </div>

    <!-- Semester -->
    <div class="form-group">
      <label for="semester">Semester</label>
      <select class="form-control" id="semester">
        <option value="first">First Semester</option>
        <option value="second">Second Semester</option>
        <option value="summer">Summer Term</option>
      </select>
    </div>

    <!-- Additional Notes -->
    <div class="form-group">
      <label for="notes">Additional Notes (optional)</label>
      <textarea class="form-control" id="notes" rows="3" placeholder="e.g., Required for university application or job..."></textarea>
    </div>

    <hr>

    <!-- Submit Button -->
    <div class="text-right">
      <button class="btn btn-primary" type="submit">
        <i class="fas fa-print mr-1"></i> Submit Request / Print Document
      </button>
    </div>
  </form>

  <!-- Styling -->
  <style>
    .tab-pane {
      background-color: #fdfdfd;
      padding: 20px;
      border-radius: 10px;
    }

    h6 {
      font-weight: bold;
      font-size: 20px;
    }

    label {
      font-weight: 500;
    }

    .form-control {
      border-radius: 6px;
    }

    .btn-primary {
      border-radius: 6px;
      padding: 10px 24px;
      font-size: 15px;
    }
  </style>
</div>
