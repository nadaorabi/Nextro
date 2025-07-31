@extends('layouts.app')

@section('title', 'home')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/hero-img-1-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <a href="https://vimeo.com/342333493" data-fancybox class="caption mb-4 d-inline-block">Watch the video</a>
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Educationششis the Mother of Leadershipali</h1>
            <p class="mb-0" data-aos="fade-up" data-aos-delay="300">
              <a href="#" class="btn btn-secondary">Explore courses</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')

{{-- Browse Top Category --}}
<div class="untree_co-section">
  <div class="container">
    <div class="row justify-content-center mb-3">
      <div class="col-lg-7 text-center" data-aos="fade-up">
        <h2 class="line-bottom text-center mb-4">Browse Top Category</h2>
      </div>
    </div>

    <div class="row align-items-stretch">
      @foreach([
        ['icon' => 'uil-graduation-cap', 'title' => '9th Grade Scientific', 'count' => '12'],
        ['icon' => 'uil-book-open', 'title' => 'Secondary Literary', 'count' => '8'],
        ['icon' => 'uil-briefcase', 'title' => 'Business Administration', 'count' => '15'],
        ['icon' => 'uil-code-branch', 'title' => 'Programming', 'count' => '19'],
        ['icon' => 'uil-palette', 'title' => 'Drawing', 'count' => '6'],
        ['icon' => 'uil-comments', 'title' => 'Conversation', 'count' => '11'],
        ['icon' => 'uil-globe', 'title' => 'Languages', 'count' => '14'],
        ['icon' => 'uil-atom', 'title' => 'Secondary Scientific', 'count' => '17']
      ] as $index => $category)
      <div class="col-sm-6 col-md-6 col-lg-3 mb-4" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
        <a href="#" class="category d-flex align-items-start h-100">
          <div><i class="uil {{ $category['icon'] }}"></i></div>
          <div>
            <h3>{{ $category['title'] }}</h3>
            <span>{{ $category['count'] }} courses</span>
          </div>
        </a>
      </div>
      @endforeach
    </div>

    <div class="row justify-content-center" data-aos="fade-up" data-aos-delay="400">
     
    </div>
  </div>
</div>

{{-- Become an Instructor --}}
<div class="services-section">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up">
        <div class="section-title mb-3">
          <h2 class="line-bottom mb-4">Become an Instructor</h2>
        </div>
        <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
        <ul class="ul-check list-unstyled mb-5 primary">
          <li>Behind the word Mountains.</li>
          <li>Far far away Mountains.</li>
          <li>Large language Ocean.</li>
        </ul>
        <p><a href="#" class="btn btn-primary">Get Started</a></p>
      </div>
      <div class="col-lg-6" data-aos="fade-up">
        <figure class="img-wrap-2">
          <img src="{{ asset('images/teacher-min.jpg') }}" alt="Image" class="img-fluid">
          <div class="dotted"></div>
        </figure>
      </div>
    </div>
  </div>
</div>

{{-- We Have Best Education --}}
{{-- @include('components.best-education') --}}

{{-- The Right Course For You --}}
{{-- @include('components.right-course') --}}

{{-- Call To Action --}}
{{-- @include('components.cta-section') --}}

{{-- About Us --}}
{{-- @include('components.about-us') --}}

{{-- School News --}}
{{-- @include('components.school-news') --}}

{{-- Pricing --}}
{{-- @include(view: 'components.pricing') --}}

{{-- Testimonials --}}
{{-- @include('components.testimonials') --}}

{{-- Why Choose Us --}}
{{-- @include('components.why-choose-us') --}} 

@endsection
