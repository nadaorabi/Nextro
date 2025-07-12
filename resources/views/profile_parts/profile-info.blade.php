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
  img.rounded-circle {
  width: 110px;
  height: 110px;
  border-radius: 50%;
  object-fit: cover; /* ✅ Makes the image fill the circle completely */
  object-position: center center;
  display: block;
  margin: 0 auto;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  background-color: #fff;
}
@media (max-width: 768px) {
  img.rounded-circle {
    width: 90px !important;
    height: 90px !important;
  }
}
@media (max-width: 576px) {
  img.rounded-circle {
    width: 80px !important;
    height: 80px !important;
  }
}

</style>

<div class="container py-4 d-flex justify-content-center">
  <div class="w-100 mx-auto" style="max-width: 800px;">
    
    <div class="text-center mb-4">
      @if(Auth::user()->image)
        <img src="{{ asset(Auth::user()->image) }}" alt="Profile Picture" class="rounded-circle">
      @else
        <img src="{{ asset('images/staff_1.jpg') }}" alt="Profile Picture" class="rounded-circle">
      @endif
    
      @auth
        <h4 class="mt-3 mb-1 fw-semibold">{{ Auth::user()->name }}</h4>
        <p class="text-muted mb-0">{{ Auth::user()->email }}</p>
        <p class="text-muted mb-0">Student ID: {{ Auth::user()->login_id }}</p>
      @else
        <h4 class="mt-3 mb-1 fw-semibold">Student Name</h4>
        <p class="text-muted mb-0">email@example.com</p>
      @endauth
    </div>
    
  
    <form id="studentProfileForm" class="bg-white p-4 shadow-sm rounded-4">
      <div class="row gy-3">
        <!-- Personal Information -->
        <div class="col-12">
          <h5 class="mb-3 text-primary border-bottom pb-2">Personal Information</h5>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" value="{{ Auth::user()->name ?? '---' }}" readonly>
        </div>
        

        
        <div class="col-md-6">
          <label class="form-label">Father's Name</label>
          <input type="text" class="form-control" value="{{ Auth::user()->father_name ?? '---' }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Mother's Name</label>
          <input type="text" class="form-control" value="{{ Auth::user()->mother_name ?? '---' }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">National ID</label>
          <input type="text" class="form-control" value="{{ Auth::user()->national_id ?? '---' }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Date of Birth</label>
          <input type="text" class="form-control" value="{{ Auth::user()->birth_date ? \Carbon\Carbon::parse(Auth::user()->birth_date)->format('Y-m-d') : '---' }}" readonly>
        </div>
        
        <div class="col-12">
          <label class="form-label">Address</label>
          <input type="text" class="form-control" value="{{ Auth::user()->address ?? '---' }}" readonly>
        </div>
        
        <!-- Contact Information -->
        <div class="col-12">
          <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Contact Information</h5>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-control" value="{{ Auth::user()->email ?? '---' }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Primary Mobile Number</label>
          <input type="text" class="form-control" value="{{ Auth::user()->mobile ?? '---' }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Alternative Mobile Number</label>
          <input type="text" class="form-control" value="{{ Auth::user()->alt_mobile ?? '---' }}" readonly>
        </div>
        
        <!-- Account Information -->
        <div class="col-12">
          <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Account Information</h5>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Student ID (Login ID)</label>
          <input type="text" class="form-control" value="{{ Auth::user()->login_id ?? '---' }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Account Type</label>
          <input type="text" class="form-control" value="{{ Auth::user()->role == 'student' ? 'Student' : (Auth::user()->role == 'teacher' ? 'Teacher' : (Auth::user()->role == 'admin' ? 'Admin' : '---')) }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Account Status</label>
          <input type="text" class="form-control" value="{{ Auth::user()->is_active == 1 ? 'Active' : 'Inactive' }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Registration Date</label>
          <input type="text" class="form-control" value="{{ Auth::user()->created_at ? Auth::user()->created_at->format('Y-m-d') : '---' }}" readonly>
        </div>
        
        <div class="col-md-6">
          <label class="form-label">Last Updated</label>
          <input type="text" class="form-control" value="{{ Auth::user()->updated_at ? Auth::user()->updated_at->format('Y-m-d') : '---' }}" readonly>
        </div>
        
        @if(Auth::user()->specialization)
        <div class="col-md-6">
          <label class="form-label">Specialization</label>
          <input type="text" class="form-control" value="{{ Auth::user()->specialization ?? '---' }}" readonly>
        </div>
        @endif
        
        <!-- Notes -->
        @if(Auth::user()->notes || Auth::user()->note)
        <div class="col-12">
          <h5 class="mb-3 text-primary border-bottom pb-2 mt-4">Notes</h5>
        </div>
        
        @if(Auth::user()->notes)
        <div class="col-12">
          <label class="form-label">General Notes</label>
          <textarea class="form-control" rows="3" readonly>{{ Auth::user()->notes ?? '---' }}</textarea>
        </div>
        @endif
        
        @if(Auth::user()->note)
        <div class="col-12">
          <label class="form-label">Additional Notes</label>
          <textarea class="form-control" rows="3" readonly>{{ Auth::user()->note ?? '---' }}</textarea>
        </div>
        @endif
        @endif
      </div>
    </form>
  </div>
</div>
