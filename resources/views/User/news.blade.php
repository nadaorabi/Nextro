@extends('layouts.app')

@section('title', 'News')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-6-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Latest News & Updates</h1>
            <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
              <p>Stay updated with the latest news about our educational programs, new courses, institute developments, and student achievements.</p>
            </div>
            <p class="mb-0" data-aos="fade-up" data-aos-delay="300">
              <a href="#news-section" class="btn btn-secondary">Read Latest News</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')

{{-- Latest News Section --}}
<div class="untree_co-section bg-light" id="news-section">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-7 text-center" data-aos="fade-up">
        <h2 class="line-bottom text-center mb-4">Latest News & Announcements</h2>
        <p>Discover the latest updates from our educational institute</p>
      </div>
    </div>

    <div class="row">
      {{-- News Item 1 --}}
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('images/img-school-1-min.jpg') }}" class="card-img-top" alt="New Programming Course">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">January 15, 2025</small>
              <span class="badge bg-primary">New Course</span>
            </div>
            <h5 class="card-title">Advanced Programming Course Launched</h5>
            <p class="card-text">We're excited to announce our new Advanced Programming course covering web development, mobile apps, and AI fundamentals. This comprehensive program is designed for students interested in modern technology careers.</p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">Duration: 6 months</small>
              <a href="#" class="btn btn-outline-primary btn-sm">Learn More</a>
            </div>
          </div>
        </div>
      </div>

      {{-- News Item 2 --}}
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('images/img-school-2-min.jpg') }}" class="card-img-top" alt="Science Lab">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">January 12, 2025</small>
              <span class="badge bg-success">Facility Update</span>
            </div>
            <h5 class="card-title">New Science Laboratory Opening</h5>
            <p class="card-text">Our state-of-the-art science laboratory is now open! Equipped with modern equipment for physics, chemistry, and biology experiments. Students can now conduct hands-on research and practical experiments.</p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">Available for all science courses</small>
              <a href="#" class="btn btn-outline-success btn-sm">View Details</a>
            </div>
          </div>
        </div>
      </div>

      {{-- News Item 3 --}}
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('images/img-school-3-min.jpg') }}" class="card-img-top" alt="Student Achievement">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">January 10, 2025</small>
              <span class="badge bg-warning">Achievement</span>
            </div>
            <h5 class="card-title">Student Excellence Awards 2024</h5>
            <p class="card-text">Congratulations to our outstanding students who received excellence awards in mathematics, science, and languages. Their dedication and hard work have set new standards for academic achievement.</p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">15 students recognized</small>
              <a href="#" class="btn btn-outline-warning btn-sm">View Winners</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Second Row of News --}}
    <div class="row mt-4">
      {{-- News Item 4 --}}
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="400">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('images/img-school-4-min.jpg') }}" class="card-img-top" alt="Language Course">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">January 8, 2025</small>
              <span class="badge bg-info">Language Program</span>
            </div>
            <h5 class="card-title">Enhanced Language Learning Program</h5>
            <p class="card-text">Our language department has introduced new conversation-focused courses in English, Arabic, and French. Interactive sessions with native speakers and cultural exchange programs are now available.</p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">3 languages available</small>
              <a href="#" class="btn btn-outline-info btn-sm">Enroll Now</a>
            </div>
          </div>
        </div>
      </div>

      {{-- News Item 5 --}}
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="500">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('images/img-school-5-min.jpg') }}" class="card-img-top" alt="Art Studio">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">January 5, 2025</small>
              <span class="badge bg-secondary">Art & Design</span>
            </div>
            <h5 class="card-title">New Art & Drawing Studio</h5>
            <p class="card-text">Express your creativity in our newly opened art studio! Professional drawing courses, digital art workshops, and traditional painting techniques are now available for all skill levels.</p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">All skill levels welcome</small>
              <a href="#" class="btn btn-outline-secondary btn-sm">Join Studio</a>
            </div>
          </div>
        </div>
      </div>

      {{-- News Item 6 --}}
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="600">
        <div class="card h-100 shadow-sm">
          <img src="{{ asset('images/img-school-6-min.jpg') }}" class="card-img-top" alt="Business Course">
          <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
              <small class="text-muted">January 3, 2025</small>
              <span class="badge bg-dark">Business</span>
            </div>
            <h5 class="card-title">Business Administration Certification</h5>
            <p class="card-text">Launch your business career with our comprehensive Business Administration program. Learn management principles, marketing strategies, and entrepreneurial skills from industry experts.</p>
            <div class="d-flex justify-content-between align-items-center">
              <small class="text-muted">Certified program</small>
              <a href="#" class="btn btn-outline-dark btn-sm">Get Certified</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Institute Updates Section --}}
<div class="untree_co-section">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-7 text-center" data-aos="fade-up">
        <h2 class="line-bottom text-center mb-4">Institute Updates</h2>
        <p>Latest developments and improvements at our educational institute</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="feature d-flex">
          <div class="icon-wrap align-self-center">
            <span class="icon-graduation-cap"></span>
          </div>
          <div class="text">
            <h3>New Academic Programs</h3>
            <p>We've expanded our curriculum to include specialized programs in data science, artificial intelligence, and sustainable business practices. These programs are designed to prepare students for future career opportunities.</p>
            <ul class="list-unstyled">
              <li>✓ Data Science & Analytics</li>
              <li>✓ AI & Machine Learning</li>
              <li>✓ Sustainable Business Management</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="feature d-flex">
          <div class="icon-wrap align-self-center">
            <span class="icon-users"></span>
          </div>
          <div class="text">
            <h3>Expert Faculty Recruitment</h3>
            <p>We're proud to announce the addition of 5 new expert faculty members with international experience and advanced degrees. Our teaching staff now includes professionals from leading universities worldwide.</p>
            <ul class="list-unstyled">
              <li>✓ International Teaching Experience</li>
              <li>✓ Advanced Research Background</li>
              <li>✓ Industry Expertise</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="feature d-flex">
          <div class="icon-wrap align-self-center">
            <span class="icon-laptop"></span>
          </div>
          <div class="text">
            <h3>Digital Learning Platform</h3>
            <p>Our new digital learning platform is now live! Students can access course materials, submit assignments, and participate in virtual discussions from anywhere. The platform includes interactive tools and progress tracking.</p>
            <ul class="list-unstyled">
              <li>✓ 24/7 Course Access</li>
              <li>✓ Interactive Learning Tools</li>
              <li>✓ Progress Tracking System</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="400">
        <div class="feature d-flex">
          <div class="icon-wrap align-self-center">
            <span class="icon-award"></span>
          </div>
          <div class="text">
            <h3>International Partnerships</h3>
            <p>We've established partnerships with leading international universities and educational institutions. This provides our students with opportunities for exchange programs, joint research projects, and global networking.</p>
            <ul class="list-unstyled">
              <li>✓ Student Exchange Programs</li>
              <li>✓ Joint Research Initiatives</li>
              <li>✓ Global Networking Opportunities</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Upcoming Events Section --}}
<div class="untree_co-section bg-light">
  <div class="container">
    <div class="row justify-content-center mb-5">
      <div class="col-lg-7 text-center" data-aos="fade-up">
        <h2 class="line-bottom text-center mb-4">Upcoming Events</h2>
        <p>Mark your calendar for these exciting educational events</p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="event-card text-center p-4 bg-white rounded shadow-sm">
          <div class="event-date mb-3">
            <span class="badge bg-primary fs-6">Jan 20, 2025</span>
          </div>
          <h4>Open House Day</h4>
          <p class="text-muted">Visit our campus and meet our faculty. Learn about our programs and facilities firsthand.</p>
          <a href="#" class="btn btn-primary btn-sm">Register Now</a>
        </div>
      </div>

      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="event-card text-center p-4 bg-white rounded shadow-sm">
          <div class="event-date mb-3">
            <span class="badge bg-success fs-6">Jan 25, 2025</span>
          </div>
          <h4>Science Fair 2024</h4>
          <p class="text-muted">Students showcase their innovative projects and research findings in our annual science exhibition.</p>
          <a href="#" class="btn btn-success btn-sm">Learn More</a>
        </div>
      </div>

      <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="event-card text-center p-4 bg-white rounded shadow-sm">
          <div class="event-date mb-3">
            <span class="badge bg-warning fs-6">Feb 5, 2025</span>
          </div>
          <h4>Career Guidance Workshop</h4>
          <p class="text-muted">Expert career counselors help students choose the right educational path and career opportunities.</p>
          <a href="#" class="btn btn-warning btn-sm">Join Workshop</a>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
