<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">
  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />
  <link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/animate.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">
  <title>Learner Free Bootstrap Template by Untree.co</title>
</head>
<body> 
  <style>
    body{
      margin-top:20px;
      color: #1a202c;
      text-align: left;
      background-color: #136ad5;    
  }
  .main-body {
      padding: 15px;
  }
  
  .nav-link {
      color: #4a5568;
  }
  .card {
      box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
  }
  
  .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;

    /* الحدود */
    border: 3px solid #76a1d6; /* حدد السماكة واللون معًا */

    border-radius: 8px;
    padding: 20px;
}

  
  .card-body {
      flex: 1 1 auto;
      min-height: 1px;
      padding: 1rem;
  }
  
  .gutters-sm {
      margin-right: -8px;
      margin-left: -8px;
  }
  
  .gutters-sm>.col, .gutters-sm>[class*=col-] {
      padding-right: 8px;
      padding-left: 8px;
  }
  .mb-3, .my-3 {
      margin-bottom: 1rem!important;
  }
  
  .bg-gray-300 {
      background-color: #e2e8f0;
  }
  .h-100 {
      height: 100%!important;
  }
  .shadow-none {
      box-shadow: none!important;
  }
  .breadcrumb {
  background-color: transparent; /* لا خلفية */
  padding: 0.75rem 1rem;         /* تبقي المساحة الداخلية كما هي */
  margin-bottom: 1rem;
  border: none;
  color: white;                  /* لون الكتابة الأبيض */
}

.breadcrumb-item,
.breadcrumb-item a {
  color: white;                  /* لون الروابط والنصوص أبيض */
}

.breadcrumb-item.active {
  color: #ddd; /* اللون الرمادي الفاتح للنص الحالي (اختياري) */
}
.breadcrumb-item + .breadcrumb-item::before {
  color: white;
}


  </style>
  <div class="site-mobile-menu">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>
  @include('parts/navbar')

  <br><br><br><br><br>
    <div class="container">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item"><a href="javascript:void(0)">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
          </ol>
        </nav>
        <!-- /Breadcrumb -->
  
        <div class="row gutters-sm">
          <div class="col-md-4 d-none d-md-block">
            <div class="card">
              <div class="card-body">
                <nav class="nav flex-column nav-pills nav-gap-y-1">
                  <a href="#profile" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user mr-2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>Profile Information
                  </a>
                  <a href="#account" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings mr-2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>Account Settings
                  </a>
                  <a href="#security" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield mr-2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>Security
                  </a>
                  <a href="#notification" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell mr-2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>Notification
                  </a>
                  <a href="#billing" data-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card mr-2"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>Billing
                  </a>
                </nav>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card">
              <div class="card-header border-bottom mb-3 d-flex d-md-none">
                <ul class="nav nav-tabs card-header-tabs nav-gap-x-1" role="tablist">
                  <li class="nav-item">
                    <a href="#profile" data-toggle="tab" class="nav-link has-icon active"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#account" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#security" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shield"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#notification" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg></a>
                  </li>
                  <li class="nav-item">
                    <a href="#billing" data-toggle="tab" class="nav-link has-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg></a>
                  </li>
                </ul>
              </div>
              <div class="card-body tab-content">
                <div class="tab-pane active" id="profile" >

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
                </div>
                <div class="tab-pane" id="account">
                  <h6>ACCOUNT SETTINGS</h6>
                  <hr>
                  <form>
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" aria-describedby="usernameHelp" placeholder="Enter your username" value="kennethvaldez">
                      <small id="usernameHelp" class="form-text text-muted">After changing your username, your old username becomes available for anyone else to claim.</small>
                    </div>
                    <hr>
                    <div class="form-group">
                      <label class="d-block text-danger">Delete Account</label>
                      <p class="text-muted font-size-sm">Once you delete your account, there is no going back. Please be certain.</p>
                    </div>
                    <button class="btn btn-danger" type="button">Delete Account</button>
                  </form>
                </div>
                <div class="tab-pane" id="security">
                  <h6>SECURITY SETTINGS</h6>
                  <hr>
                  <form>
                    <div class="form-group">
                      <label class="d-block">Change Password</label>
                      <input type="text" class="form-control" placeholder="Enter your old password">
                      <input type="text" class="form-control mt-1" placeholder="New password">
                      <input type="text" class="form-control mt-1" placeholder="Confirm new password">
                    </div>
                  </form>
                  <hr>
                  <form>
                    <div class="form-group">
                      <label class="d-block">Two Factor Authentication</label>
                      <button class="btn btn-info" type="button">Enable two-factor authentication</button>
                      <p class="small text-muted mt-2">Two-factor authentication adds an additional layer of security to your account by requiring more than just a password to log in.</p>
                    </div>
                  </form>
                  <hr>
                  <form>
                    <div class="form-group mb-0">
                      <label class="d-block">Sessions</label>
                      <p class="font-size-sm text-secondary">This is a list of devices that have logged into your account. Revoke any sessions that you do not recognize.</p>
                      <ul class="list-group list-group-sm">
                        <li class="list-group-item has-icon">
                          <div>
                            <h6 class="mb-0">San Francisco City 190.24.335.55</h6>
                            <small class="text-muted">Your current session seen in United States</small>
                          </div>
                          <button class="btn btn-light btn-sm ml-auto" type="button">More info</button>
                        </li>
                      </ul>
                    </div>
                  </form>
                </div>
                <div class="tab-pane" id="notification">
                  <h6>NOTIFICATION SETTINGS</h6>
                  <hr>
                  <form>
                    <div class="form-group">
                      <label class="d-block mb-0">Security Alerts</label>
                      <div class="small text-muted mb-3">Receive security alert notifications via email</div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck1" checked="">
                        <label class="custom-control-label" for="customCheck1">Email each time a vulnerability is found</label>
                      </div>
                      <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customCheck2" checked="">
                        <label class="custom-control-label" for="customCheck2">Email a digest summary of vulnerability</label>
                      </div>
                    </div>
                    <div class="form-group mb-0">
                      <label class="d-block">SMS Notifications</label>
                      <ul class="list-group list-group-sm">
                        <li class="list-group-item has-icon">
                          Comments
                          <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                            <label class="custom-control-label" for="customSwitch1"></label>
                          </div>
                        </li>
                        <li class="list-group-item has-icon">
                          Updates From People
                          <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                            <input type="checkbox" class="custom-control-input" id="customSwitch2">
                            <label class="custom-control-label" for="customSwitch2"></label>
                          </div>
                        </li>
                        <li class="list-group-item has-icon">
                          Reminders
                          <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                            <input type="checkbox" class="custom-control-input" id="customSwitch3" checked="">
                            <label class="custom-control-label" for="customSwitch3"></label>
                          </div>
                        </li>
                        <li class="list-group-item has-icon">
                          Events
                          <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                            <input type="checkbox" class="custom-control-input" id="customSwitch4" checked="">
                            <label class="custom-control-label" for="customSwitch4"></label>
                          </div>
                        </li>
                        <li class="list-group-item has-icon">
                          Pages You Follow
                          <div class="custom-control custom-control-nolabel custom-switch ml-auto">
                            <input type="checkbox" class="custom-control-input" id="customSwitch5">
                            <label class="custom-control-label" for="customSwitch5"></label>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </form>
                </div>
                <div class="tab-pane" id="billing">
                  <h6>BILLING SETTINGS</h6>
                  <hr>
                  <form>
                    <div class="form-group">
                      <label class="d-block mb-0">Payment Method</label>
                      <div class="small text-muted mb-3">You have not added a payment method</div>
                      <button class="btn btn-info" type="button">Add Payment Method</button>
                    </div>
                    <div class="form-group mb-0">
                      <label class="d-block">Payment History</label>
                      <div class="border border-gray-500 bg-gray-200 p-3 text-center font-size-sm">You have not made any payment.</div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
  
    </div> <!-- /.container -->
  </div> <!-- /.untree_co-hero -->
  <div class="site-footer">
    <div class="container">

      <div class="row">
        <div class="col-lg-3 mr-auto">
          <div class="widget">
            <h3>About Us<span class="text-primary">.</span> </h3>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div> <!-- /.widget -->
          <div class="widget">
            <h3>Connect</h3>
            <ul class="list-unstyled social">
              <li><a href="#"><span class="icon-instagram"></span></a></li>
              <li><a href="#"><span class="icon-twitter"></span></a></li>
              <li><a href="#"><span class="icon-facebook"></span></a></li>
              <li><a href="#"><span class="icon-linkedin"></span></a></li>
              <li><a href="#"><span class="icon-pinterest"></span></a></li>
              <li><a href="#"><span class="icon-dribbble"></span></a></li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->

        <div class="col-lg-2 ml-auto">
          <div class="widget">
            <h3>Projects</h3>
            <ul class="list-unstyled float-left links">
              <li><a href="#">Web Design</a></li>
              <li><a href="#">HTML5</a></li>
              <li><a href="#">CSS3</a></li>
              <li><a href="#">jQuery</a></li>
              <li><a href="#">Bootstrap</a></li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->

        <div class="col-lg-3">
          <div class="widget">
            <h3>Gallery</h3>
            <ul class="instafeed instagram-gallery list-unstyled">
              <li><a class="instagram-item" href="images/gal_1.jpg" data-fancybox="gal"><img src="images/gal_1.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_2.jpg" data-fancybox="gal"><img src="images/gal_2.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_3.jpg" data-fancybox="gal"><img src="images/gal_3.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_4.jpg" data-fancybox="gal"><img src="images/gal_4.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_5.jpg" data-fancybox="gal"><img src="images/gal_5.jpg" alt="" width="72" height="72"></a>
              </li>
              <li><a class="instagram-item" href="images/gal_6.jpg" data-fancybox="gal"><img src="images/gal_6.jpg" alt="" width="72" height="72"></a>
              </li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->


        <div class="col-lg-3">
          <div class="widget">
            <h3>Contact</h3>
            <address>43 Raymouth Rd. Baltemoer, London 3910</address>
            <ul class="list-unstyled links mb-4">
              <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
              <li><a href="tel://11234567890">+1(123)-456-7890</a></li>
              <li><a href="mailto:info@mydomain.com">info@mydomain.com</a></li>
            </ul>
          </div> <!-- /.widget -->
        </div> <!-- /.col-lg-3 -->

      </div> <!-- /.row -->

      <div class="row mt-5">
        <div class="col-12 text-center">
          <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co">Untree.co</a>  Distributed By <a href="https://themewagon.com">ThemeWagon</a> <!-- License information: https://untree.co/license/ -->
          </div>
        </div>
      </div> <!-- /.container -->
    </div> <!-- /.site-footer -->

    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    @include('parts/Footer')

    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.fancybox.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/custom.js"></script>

  </body>

  </html>
