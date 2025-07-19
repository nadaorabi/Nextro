@extends('layouts.app')
@section('hero')
@section('title', 'About Us')

<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-1-min.jpg') }}');">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">About Syrian Educational Institutes</h1>
                        <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                            <p>Discover the rich educational heritage of Syria and our commitment to providing quality education that prepares students for future success in a rapidly evolving world.</p>
                        </div>
                        <p class="mb-0" data-aos="fade-up" data-aos-delay="300">
                            <a href="#about-section" class="btn btn-secondary">Learn More About Us</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

{{-- About Syrian Education Section --}}
<div class="services-section" id="about-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="0">
                <div class="section-title mb-3">
                    <h2 class="line-bottom mb-4">Syrian Educational Excellence</h2>
                </div>
                <p data-aos="fade-up" data-aos-delay="100">Syria has a long-standing tradition of educational excellence, with institutions that have produced generations of scholars, scientists, and leaders. Our educational system combines traditional values with modern teaching methodologies to create a comprehensive learning environment.</p>
                <ul class="ul-check list-unstyled mb-5 primary" data-aos="fade-up" data-aos-delay="200">
                    <li>Rich Cultural and Academic Heritage</li>
                    <li>Modern Educational Technologies</li>
                    <li>Experienced Teaching Faculty</li>
                    <li>Comprehensive Curriculum Programs</li>
                </ul>
                <p data-aos="fade-up" data-aos-delay="300">
                    <a href="#institutes-section" class="btn btn-primary">Explore Our Institutes</a>
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="0">
                <figure class="img-wrap-2">
                    <img src="{{ asset('images/teacher-min.jpg') }}" alt="Syrian Education" class="img-fluid">
                    <div class="dotted"></div>
                </figure>
            </div>
        </div>
    </div>
</div>



{{-- Syrian Educational Programs --}}
<div class="untree_co-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center" data-aos="fade-up">
                <h2 class="line-bottom text-center mb-4">Syrian Educational Programs</h2>
                <p>Our comprehensive educational programs are designed to meet the diverse needs of Syrian students and prepare them for global opportunities.</p>
            </div>
        </div>
        <div class="row">
            @foreach([
                ['icon' => 'uil-graduation-cap', 'title' => 'Secondary Education', 'desc' => 'Comprehensive secondary education programs including scientific and literary tracks.'],
                ['icon' => 'uil-calculator-alt', 'title' => 'Mathematics & Sciences', 'desc' => 'Advanced mathematics, physics, chemistry, and biology programs.'],
                ['icon' => 'uil-book-open', 'title' => 'Language Studies', 'desc' => 'Arabic, English, French, and other language programs.'],
                ['icon' => 'uil-code-branch', 'title' => 'Technology & Programming', 'desc' => 'Modern programming, web development, and IT courses.'],
                ['icon' => 'uil-briefcase', 'title' => 'Business Administration', 'desc' => 'Management, economics, and business administration programs.'],
                ['icon' => 'uil-palette', 'title' => 'Arts & Design', 'desc' => 'Fine arts, drawing, and creative design programs.']
            ] as $index => $feature)
            <div class="col-6 col-sm-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index+1) * 100 }}">
                <div class="feature">
                    <span class="{{ $feature['icon'] }}"></span>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Why Choose Syrian Education --}}
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mr-auto mb-5 mb-lg-0" data-aos="fade-up">
                <img src="{{ asset('images/img-school-5-min.jpg') }}" alt="Syrian Education" class="img-fluid">
            </div>
            <div class="col-lg-7 ml-auto" data-aos="fade-up" data-aos-delay="100">
                <h3 class="line-bottom mb-4">Why Choose Syrian Educational Institutes</h3>
                <p>Syrian educational institutes offer a unique combination of traditional academic excellence and modern educational approaches, providing students with a solid foundation for their future careers.</p>

                <div class="custom-accordion" id="accordion_1">
                    @foreach([
                        ['title' => 'Experienced Syrian Faculty', 'image' => 'img-school-1-min.jpg', 'desc' => 'Our teaching staff consists of experienced Syrian educators with advanced degrees and international experience. They bring deep knowledge of local culture while incorporating global educational standards.'],
                        ['title' => 'Cultural Heritage Preservation', 'image' => 'img-school-2-min.jpg', 'desc' => 'We emphasize the preservation of Syrian cultural heritage while embracing modern educational methodologies. Students learn to appreciate their cultural roots while developing global perspectives.'],
                        ['title' => 'Quality Education Standards', 'image' => 'img-school-3-min.jpg', 'desc' => 'Our institutes maintain high educational standards that meet both local and international requirements. We focus on developing critical thinking, creativity, and practical skills.']
                    ] as $key => $accordion)
                    <div class="accordion-item">
                        <h2 class="mb-0">
                            <button class="btn btn-link {{ $key ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#collapse{{ $key+1 }}" aria-expanded="{{ !$key ? 'true' : 'false' }}" aria-controls="collapse{{ $key+1 }}">
                                {{ $accordion['title'] }}
                            </button>
                        </h2>

                        <div id="collapse{{ $key+1 }}" class="collapse {{ !$key ? 'show' : '' }}" aria-labelledby="heading{{ $key+1 }}" data-parent="#accordion_1">
                            <div class="accordion-body">
                                <div class="d-flex">
                                    <div class="accordion-img mr-4">
                                        <img src="{{ asset('images/'.$accordion['image']) }}" alt="Syrian Education Feature" class="img-fluid">
                                    </div>
                                    <div>
                                        <p>{{ $accordion['desc'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .accordion-item -->
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Syrian Educational Statistics --}}
<div class="untree_co-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center" data-aos="fade-up">
                <h2 class="line-bottom text-center mb-4">Syrian Educational Achievements</h2>
                <p>Our commitment to educational excellence has resulted in significant achievements and recognition.</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                <div class="counter-wrap">
                    <div class="counter">
                        <span class="number" data-number="95">0</span>
                        <span class="unit">%</span>
                    </div>
                    <h3>Student Success Rate</h3>
                    <p>High success rate in academic achievements and career placements</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="counter-wrap">
                    <div class="counter">
                        <span class="number" data-number="25">0</span>
                        <span class="unit">+</span>
                    </div>
                    <h3>Years of Excellence</h3>
                    <p>Over 25 years of providing quality education in Syria</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                <div class="counter-wrap">
                    <div class="counter">
                        <span class="number" data-number="1000">0</span>
                        <span class="unit">+</span>
                    </div>
                    <h3>Graduates</h3>
                    <p>Successful graduates working in various professional fields</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                <div class="counter-wrap">
                    <div class="counter">
                        <span class="number" data-number="50">0</span>
                        <span class="unit">+</span>
                    </div>
                    <h3>Expert Teachers</h3>
                    <p>Experienced faculty members with advanced qualifications</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
