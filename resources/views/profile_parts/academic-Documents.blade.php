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

  @media (max-width: 768px) {
    .form-control {
      font-size: 14px;
      padding: 10px;
    }

    h6 {
      font-size: 18px;
    }

    .btn-primary {
      font-size: 14px;
      padding: 8px 20px;
    }
  }

  @media (max-width: 576px) {
    .form-control {
      font-size: 13px;
      padding: 8px;
    }

    h6 {
      font-size: 16px;
    }

    .btn-primary {
      font-size: 13px;
      padding: 6px 18px;
    }
  }
</style>

<div class="container-fluid py-4">
  <div class="w-100 mx-auto" style="max-width: 700px;">
    <div class="tab-pane">
      <h6 class="mb-4 text-center">Official Document Request</h6>

      <form>
        <div class="mb-3">
          <label for="programType" class="form-label">Program Type</label>
          <select class="form-control" id="programType">
            <option value="baccalaureate">Baccalaureate</option>
            <option value="grade9">Grade 9</option>
            <option value="languages">Language Courses</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="documentType" class="form-label">Document Type</label>
          <select class="form-control" id="documentType">
            <option value="attendance_certificate">Attendance Certificate</option>
            <option value="final_report">Academic Performance Report</option>
            <option value="attendance_summary">Attendance Summary</option>
            <option value="financial_status">Financial Statement / Payments</option>
            <option value="language_course_certificate">Language Course Completion Certificate</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="semester" class="form-label">Semester</label>
          <select class="form-control" id="semester">
            <option value="first">First Semester</option>
            <option value="second">Second Semester</option>
            <option value="summer">Summer Semester</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="notes" class="form-label">Additional Notes (Optional)</label>
          <textarea class="form-control" id="notes" rows="3" placeholder="e.g., Required for university or work..."></textarea>
        </div>

        <hr>

        <div class="text-center">
          <button class="btn btn-primary" type="submit">
            <i class="fas fa-print me-2"></i> Submit Request 
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
