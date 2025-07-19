@extends('layouts.app')

@section('title', 'Our Staff')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-3-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Our Teaching Staff</h1>
            <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
              <p>We present to you an elite group of specialized teachers in various educational fields, with extensive experience in teaching and delivering outstanding results.</p>
            </div>
            <p class="mb-0" data-aos="fade-up" data-aos-delay="300">
              <a href="#staff-section" class="btn btn-secondary">Meet Our Teachers</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('content')
{{-- Syrian Educational Institutes Section --}}
<div class="untree_co-section bg-light" id="institutes-section">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center" data-aos="fade-up">
                <h2 class="line-bottom text-center mb-4">Syrian Educational Institutes</h2>
                <p>Syria's educational landscape encompasses diverse institutes specializing in various fields, from traditional academic subjects to modern technological disciplines.</p>
            </div>
        </div>
        <div class="row">
            @foreach([
                [
                    'name' => 'Zahraa Ahmed Hassan',
                    'position' => 'Mathematics Teacher',
                    'description' => 'Specialized in advanced mathematics and algebra with 8 years of teaching experience in Syrian educational institutions.',
                    'image' => 'staff_1.jpg'
                ],
                [
                    'name' => 'Ahmed Mohammed Ali',
                    'position' => 'English Language Teacher',
                    'description' => 'Expert in English literature and conversation with international teaching certification and experience in Syrian universities.',
                    'image' => 'staff_2.jpg'
                ],
                [
                    'name' => 'Nada Abdul Rahman',
                    'position' => 'Science Teacher',
                    'description' => 'Specialized in physics and chemistry with research background in modern sciences and Syrian educational standards.',
                    'image' => 'staff_3.jpg'
                ],
                [
                    'name' => 'Sarah Mahmoud Hassan',
                    'position' => 'Arabic Language Teacher',
                    'description' => 'Expert in Arabic literature and grammar with focus on classical and modern texts, preserving Syrian cultural heritage.',
                    'image' => 'teacher-min.jpg'
                ]
            ] as $index => $teacher)
            <div class="col-12 col-sm-6 col-md-6 mb-4 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="staff text-center">
                    <div class="mb-4">
                        <img src="{{ asset('images/'.$teacher['image']) }}" alt="Syrian Teacher" class="img-fluid">
                    </div>
                    <div class="staff-body">
                        <h3 class="staff-name">{{ $teacher['name'] }}</h3>
                        <span class="d-block position mb-4">{{ $teacher['position'] }}</span>
                        <p class="mb-4">{{ $teacher['description'] }}</p>
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
@endsection
