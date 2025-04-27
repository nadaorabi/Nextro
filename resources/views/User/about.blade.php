@extends('layouts.app')
@section('hero')
@section('title', 'About Us')


<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-1-min.jpg') }}');">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <div class="row justify-content-center">
                    <div class="col-lg-6 text-center">
                        <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">About Us</h1>
                        <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                            <p>Another free template by <a href="https://untree.co/" target="_blank" class="link-highlight">Untree.co</a>. Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live.</p>
                        </div>
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

{{-- Become an Instructor --}}
<div class="services-section">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-up" data-aos-delay="0">
                <div class="section-title mb-3">
                    <h2 class="line-bottom mb-4">Become an Instructor</h2>
                </div>
                <p data-aos="fade-up" data-aos-delay="100">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                <ul class="ul-check list-unstyled mb-5 primary" data-aos="fade-up" data-aos-delay="200">
                    <li>Behind the word Mountains.</li>
                    <li>Far far away Mountains.</li>
                    <li>Large language Ocean.</li>
                </ul>
                <p data-aos="fade-up" data-aos-delay="300">
                    <a href="#" class="btn btn-primary">Get Started</a>
                </p>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="0">
                <figure class="img-wrap-2">
                    <img src="{{ asset('images/teacher-min.jpg') }}" alt="Image" class="img-fluid">
                    <div class="dotted"></div>
                </figure>
            </div>
        </div>
    </div>
</div>

{{-- Our Team --}}
<div class="untree_co-section bg-light">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center" data-aos="fade-up">
                <h2 class="line-bottom text-center mb-4">Our Team</h2>
                <p>Far far away, behind the word mountains...</p>
            </div>
        </div>
        <div class="row">
            @foreach([1,2,3] as $i)
            <div class="col-12 col-sm-6 col-md-6 mb-4 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div class="staff text-center">
                    <div class="mb-4">
                        <img src="{{ asset('images/staff_'.$i.'.jpg') }}" alt="Staff Image" class="img-fluid">
                    </div>
                    <div class="staff-body">
                        <h3 class="staff-name">{{ ['Mina Collins', 'Anderson Matthew', 'Cynthia Misso'][$i-1] }}</h3>
                        <span class="d-block position mb-4">{{ ['Teacher in Math', 'Teacher in Music', 'Teacher English'][$i-1] }}</span>
                        <p class="mb-4">Far far away, behind the word mountains...</p>
                        <div class="social">
                            <a href="#" class="mx-2"><span class="icon-facebook"></span></a>
                            <a href="#" class="mx-2"><span class="icon-twitter"></span></a>
                            <a href="#" class="mx-2"><span class="icon-linkedin"></span></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- We Have Best Education --}}
<div class="untree_co-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center" data-aos="fade-up">
                <h2 class="line-bottom text-center mb-4">We Have Best Education</h2>
                <p>Far far away, behind the word mountains...</p>
            </div>
        </div>
        <div class="row">
            @foreach([
                ['icon' => 'uil-music', 'title' => 'Music Class'],
                ['icon' => 'uil-calculator-alt', 'title' => 'Math Class'],
                ['icon' => 'uil-book-open', 'title' => 'English Class'],
                ['icon' => 'uil-book-alt', 'title' => 'Reading for Kids'],
                ['icon' => 'uil-history', 'title' => 'History Class'],
                ['icon' => 'uil-headphones', 'title' => 'Music']
            ] as $index => $feature)
            <div class="col-6 col-sm-6 col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index+1) * 100 }}">
                <div class="feature">
                    <span class="{{ $feature['icon'] }}"></span>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>Far far away, behind the word mountains...</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Why Choose Us --}}
<div class="untree_co-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 mr-auto mb-5 mb-lg-0" data-aos="fade-up">
                <img src="{{ asset('images/img-school-5-min.jpg') }}" alt="School Image" class="img-fluid">
            </div>
            <div class="col-lg-7 ml-auto" data-aos="fade-up" data-aos-delay="100">
                <h3 class="line-bottom mb-4">Why Choose Us</h3>
                <p>Far far away, behind the word mountains...</p>

                <div class="custom-accordion" id="accordion_1">
                    @foreach([
                        ['title' => 'Good Teachers and Staffs', 'image' => 'img-school-1-min.jpg'],
                        ['title' => 'We Value Good Characters', 'image' => 'img-school-2-min.jpg'],
                        ['title' => 'Your Children are Safe', 'image' => 'img-school-3-min.jpg']
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
                                        <img src="{{ asset('images/'.$accordion['image']) }}" alt="Accordion Image" class="img-fluid">
                                    </div>
                                    <div>
                                        <p>Far far away, behind the word mountains...</p>
                                        <p>Separated they live in Bookmarksgrove right at the coast of the Semantics, a large language ocean.</p>
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

@endsection
