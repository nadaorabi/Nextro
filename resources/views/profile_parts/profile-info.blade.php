<div class="tab-pane active" id="profile">
  <h6>YOUR PROFILE INFORMATION</h6>
  <hr>
  <form>
    <!-- Profile Picture Section -->
    <div class="form-group text-center mb-4">
      <label for="profilePic" class="d-block">Profile Picture</label>
      <div class="profile-pic-container">
        <img id="profilePic" src="images/staff_1.jpg" alt="Profile Picture" class="rounded-circle" width="150" height="150" style="object-fit: cover;">
        <div class="mt-2">
          <input type="file" class="form-control-file" id="uploadPic" accept="image/*" style="display:none;">
          <button type="button" class="btn btn-secondary upload-btn" id="uploadBtn">Upload Image</button>
        </div>
      </div>
    </div>

    <!-- First Name -->
    <div class="form-group">
      <label for="firstName">First Name</label>
      <input type="text" class="form-control" id="firstName" placeholder="Enter your first name" value="Kenneth">
    </div>

    <!-- Last Name -->
    <div class="form-group">
      <label for="lastName">Last Name</label>
      <input type="text" class="form-control" id="lastName" placeholder="Enter your last name" value="Valdez">
    </div>

    <!-- Contact Number -->
    <div class="form-group">
      <label for="contactNumber">Contact Number</label>
      <input type="tel" class="form-control" id="contactNumber" placeholder="Enter your contact number" value="+1234567890">
    </div>

    <!-- Email Address -->
    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" class="form-control" id="email" placeholder="Enter your email" value="kenneth@example.com">
    </div>

    <!-- Address -->
    <div class="form-group">
      <label for="address">Address</label>
      <input type="text" class="form-control" id="address" placeholder="Enter your address" value="Bay Area, San Francisco, CA">
    </div>

    <!-- Consent -->
    <div class="form-group small text-muted">
      All of the fields on this page are optional and can be deleted at any time. By filling them out, you're giving us consent to share this data wherever your user profile appears.
    </div>

    <!-- Action Buttons -->
    <div class="text-center">
      <button type="button" class="btn btn-primary">Save Changes</button>
      <button type="reset" class="btn btn-light">Reset Changes</button>
    </div>
  </form>

  <!-- Keep the same styling -->
  <style>
    .profile-pic-container {
      position: relative;
      display: inline-block;
      text-align: center;
    }

    .profile-pic-container img {
      border: 4px solid #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease-in-out;
    }

    .profile-pic-container:hover img {
      transform: scale(1.05);
    }

    .upload-btn {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    .upload-btn:hover {
      background-color: #45a049;
    }

    .profile-pic-container .mt-2 {
      margin-top: 15px;
    }

    .btn-primary, .btn-light {
      margin: 10px 0;
    }
  </style>
</div>
<script>
  // Trigger file input when clicking the upload button
  document.getElementById("uploadBtn").addEventListener("click", function () {
    document.getElementById("uploadPic").click();
  });

  // Preview selected image
  document.getElementById("uploadPic").addEventListener("change", function (event) {
    const file = event.target.files[0];
    if (file && file.type.startsWith("image/")) {
      const reader = new FileReader();
      reader.onload = function (e) {
        document.getElementById("profilePic").src = e.target.result;
      };
      reader.readAsDataURL(file);
    }
  });
</script>
