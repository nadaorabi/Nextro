@extends('layouts.app')

@section('title', 'Contact Us')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-2-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Contact Syrian Educational Institutes</h1>
            <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
              <p>Get in touch with our educational team. We're here to answer your questions and help you with enrollment information.</p>
            </div>
            <p class="mb-0" data-aos="fade-up" data-aos-delay="300"><a href="#contact-form" class="btn btn-secondary">Send Message</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')

{{-- Contact Information Section --}}
<div class="untree_co-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-7 text-center" data-aos="fade-up">
        <h2 class="line-bottom text-center mb-4">Get In Touch</h2>
        <p>We're here to help you with any questions about our educational programs and services.</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 mb-5 order-2 mb-lg-0" data-aos="fade-up" data-aos-delay="100">
        <div class="contact-info">
          <div class="address mt-4">
            <i class="icon-room"></i>
            <h4 class="mb-2">Main Campus Location:</h4>
            <p>Damascus University District<br>Al-Mazzeh Street, Building 15<br>Damascus, Syria</p>
          </div>
          <div class="open-hours mt-4">
            <i class="icon-clock-o"></i>
            <h4 class="mb-2">Working Hours:</h4>
            <p>Sunday-Thursday:<br>8:00 AM - 4:00 PM<br>Friday-Saturday: Closed</p>
          </div>
          <div class="email mt-4">
            <i class="icon-envelope"></i>
            <h4 class="mb-2">Email Address:</h4>
            <p>info@syrianeducation.edu.sy<br>admissions@syrianeducation.edu.sy</p>
          </div>
          <div class="phone mt-4">
            <i class="icon-phone"></i>
            <h4 class="mb-2">Phone Numbers:</h4>
            <p>Main Office: +963 11 234 5678<br>Admissions: +963 11 345 6789<br>Support: +963 11 456 7890</p>
          </div>
          <div class="social mt-4">
            <i class="icon-globe"></i>
            <h4 class="mb-2">Social Media:</h4>
            <p>Facebook: Syrian Education Institute<br>Twitter: @SyrianEdu<br>LinkedIn: Syrian Educational Network</p>
          </div>
        </div>
      </div>

      <div class="col-lg-7 mr-auto order-1" data-aos="fade-up" data-aos-delay="200">
        <form action="#" id="contact-form">
          <div class="row">
            <div class="col-6 mb-3">
              <input type="text" class="form-control" placeholder="Your Full Name" required>
            </div>
            <div class="col-6 mb-3">
              <input type="email" class="form-control" placeholder="Your Email Address" required>
            </div>
            <div class="col-6 mb-3">
              <input type="tel" class="form-control" placeholder="Your Phone Number" required>
            </div>
            <div class="col-6 mb-3">
              <select class="form-control" required>
                <option value="">Select Inquiry Type</option>
                <option value="admission">Admission Information</option>
                <option value="courses">Course Details</option>
                <option value="fees">Fees & Payment</option>
                <option value="schedule">Class Schedule</option>
                <option value="faculty">Faculty Information</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="col-12 mb-3">
              <input type="text" class="form-control" placeholder="Subject of Your Message" required>
            </div>
            <div class="col-12 mb-3">
              <textarea name="message" id="message" cols="30" rows="7" class="form-control" placeholder="Please describe your inquiry in detail..." required></textarea>
            </div>
            <div class="col-12 mb-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="newsletter" required>
                <label class="form-check-label" for="newsletter">
                  I agree to receive updates and newsletters from Syrian Educational Institutes
                </label>
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Send Message</button>
              <button type="reset" class="btn btn-secondary ml-2">Clear Form</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Additional Contact Information --}}
<div class="untree_co-section">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-7 text-center" data-aos="fade-up">
        <h2 class="line-bottom text-center mb-4">Our Branch Locations</h2>
        <p>Find our educational institutes across major Syrian cities</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <i class="icon-room mb-3" style="font-size: 2rem; color: #007bff;"></i>
            <h4>Damascus Branch</h4>
            <p class="text-muted">Main Campus</p>
            <p>Al-Mazzeh Street, Building 15<br>Damascus, Syria</p>
            <p><strong>Phone:</strong> +963 11 234 5678</p>
            <p><strong>Email:</strong> damascus@syrianeducation.edu.sy</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <i class="icon-room mb-3" style="font-size: 2rem; color: #28a745;"></i>
            <h4>Aleppo Branch</h4>
            <p class="text-muted">Northern Campus</p>
            <p>University Street, Building 8<br>Aleppo, Syria</p>
            <p><strong>Phone:</strong> +963 21 345 6789</p>
            <p><strong>Email:</strong> aleppo@syrianeducation.edu.sy</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card h-100 shadow-sm">
          <div class="card-body text-center">
            <i class="icon-room mb-3" style="font-size: 2rem; color: #ffc107;"></i>
            <h4>Homs Branch</h4>
            <p class="text-muted">Central Campus</p>
            <p>Al-Baath University Area<br>Homs, Syria</p>
            <p><strong>Phone:</strong> +963 31 456 7890</p>
            <p><strong>Email:</strong> homs@syrianeducation.edu.sy</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Emergency Contact --}}
<div class="untree_co-section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center" data-aos="fade-up">
        <h3 class="mb-4">Emergency Contact Information</h3>
        <p class="mb-4">For urgent matters outside of working hours, please use our emergency contact numbers:</p>
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="emergency-contact">
              <i class="icon-phone mb-2" style="font-size: 1.5rem; color: #dc3545;"></i>
              <h5>Emergency Hotline</h5>
              <p>+963 11 999 8888</p>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="emergency-contact">
              <i class="icon-envelope mb-2" style="font-size: 1.5rem; color: #dc3545;"></i>
              <h5>Emergency Email</h5>
              <p>emergency@syrianeducation.edu.sy</p>
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <div class="emergency-contact">
              <i class="icon-clock-o mb-2" style="font-size: 1.5rem; color: #dc3545;"></i>
              <h5>24/7 Support</h5>
              <p>Available for urgent inquiries</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
