<style>
  .form-label {
    font-weight: 600;
    font-size: 14px;
    color: #333;
  }

  .form-control {
    border-radius: 10px;
    font-size: 15px;
    padding: 12px 15px;
    background-color: #f9f9f9;
    border: 1px solid #ccc;
  }

  .form-control:read-only {
    background-color: #f5f5f5;
    cursor: default;
  }

  img.rounded-circle {
    width: 110px;
    height: 110px;
    object-fit: cover;
  }

  @media (max-width: 768px) {
    .form-control {
      font-size: 13px;
      padding: 10px;
    }

    .form-label {
      font-size: 12px;
    }

    img.rounded-circle {
      width: 90px !important;
      height: 90px !important;
    }

    .p-4 {
      padding: 1rem !important;
    }
  }

  @media (max-width: 576px) {
    .container {
      padding-left: 15px;
      padding-right: 15px;
    }

    .form-control {
      font-size: 12px;
      padding: 8px;
    }

    img.rounded-circle {
      width: 80px !important;
      height: 80px !important;
    }

    .p-4 {
      padding: 0.8rem !important;
    }
  }
</style>

<div class="container py-4 d-flex justify-content-center">
  <div class="w-100 mx-auto" style="max-width: 700px;">
    
    <div class="text-center mb-4">
      <img src="images/staff_1.jpg" alt="Profile Picture" class="rounded-circle border shadow">
      <h4 class="mt-3 mb-1 fw-semibold">Student Profile</h4>
      <p class="text-muted mb-0">kenneth@example.com</p>
    </div>

    <form id="studentProfileForm" class="bg-white p-4 shadow-sm rounded-4">
      <div class="row gy-3">
        <div class="col-12">
          <label for="firstName" class="form-label">First Name</label>
          <input type="text" id="firstName" class="form-control" value="Kenneth" readonly>
        </div>
        <div class="col-12">
          <label for="lastName" class="form-label">Last Name</label>
          <input type="text" id="lastName" class="form-control" value="Valdez" readonly>
        </div>
        <div class="col-12">
          <label for="email" class="form-label">Email</label>
          <input type="email" id="email" class="form-control" value="kenneth@example.com" readonly>
        </div>
        <div class="col-12">
          <label for="phone" class="form-label">Phone Number</label>
          <input type="text" id="phone" class="form-control" value="+1234567890" readonly>
        </div>
        <div class="col-12">
          <label for="address" class="form-label">Address</label>
          <input type="text" id="address" class="form-control" value="Bay Area, San Francisco, CA" readonly>
        </div>
      </div>
    </form>
  </div>
</div>
