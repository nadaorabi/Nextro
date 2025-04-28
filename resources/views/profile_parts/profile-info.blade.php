<div class="tab-pane active" id="profile">
    <h6>YOUR PROFILE INFORMATION</h6>
    <hr>
    <form>
      <!-- Profile Picture Section -->
      <div class="form-group text-center mb-4">
        <label for="profilePic" class="d-block">Profile Picture</label>
        <!-- Default profile image in case no image is uploaded -->
        <div class="profile-pic-container">
          <img id="profilePic" src="images/staff_1.jpg" alt="Profile Picture" class="rounded-circle" width="150" height="150" style="object-fit: cover;">
          <div class="mt-2">
            <input type="file" class="form-control-file" id="uploadPic" accept="image/*" style="display:none;">
            <button type="button" class="btn btn-secondary upload-btn" id="uploadBtn">Upload Image</button>
          </div>
        </div>
      </div>
    
      <!-- Full Name -->
      <div class="form-group">
        <label for="fullName">Full Name</label>
        <input type="text" class="form-control" id="fullName" placeholder="Enter your full name" value="Kenneth Valdez">
      </div>
    
      <!-- Bio -->
      <div class="form-group">
        <label for="bio">Your Bio</label>
        <textarea class="form-control" id="bio" placeholder="Write something about yourself" rows="3">A front-end developer focusing on user interface design. Passionate about creating seamless web experiences.</textarea>
      </div>
    
      <!-- URL -->
      <div class="form-group">
        <label for="url">Website URL</label>
        <input type="url" class="form-control" id="url" placeholder="Enter your website URL" value="http://benije.ke/pozzivkij">
      </div>
    
      <!-- Location -->
      <div class="form-group">
        <label for="location">Location</label>
        <input type="text" class="form-control" id="location" placeholder="Enter your location" value="Bay Area, San Francisco, CA">
      </div>
    
      <!-- Consent and Notes -->
      <div class="form-group small text-muted">
        All of the fields on this page are optional and can be deleted at any time. By filling them out, you're giving us consent to share this data wherever your user profile appears.
      </div>
    
      <!-- Action Buttons -->
      <div class="text-center">
        <button type="button" class="btn btn-primary">Save Changes</button>
        <button type="reset" class="btn btn-light">Reset Changes</button>
      </div>
    </form>
    
    <!-- CSS for Styling -->
    <style>
      .profile-pic-container {
        position: relative;
        display: inline-block;
        text-align: center;
      }
      
      .profile-pic-container img {
        border: 4px solid #fff; /* Border around the image */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.15); /* Subtle shadow */
        transition: transform 0.3s ease-in-out;
      }
    
      .profile-pic-container:hover img {
        transform: scale(1.05); /* Slight zoom effect on hover */
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
        background-color: #45a049; /* Darker shade when hovering */
      }
    
      /* Space between the profile pic and buttons */
      .profile-pic-container .mt-2 {
        margin-top: 15px;
      }
    
      /* Style for buttons in the form */
      .btn-primary, .btn-light {
        margin: 10px 0;
      }
    </style>
    
    
  </div>