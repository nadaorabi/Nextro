@extends('layouts.app')

@section('title', 'Our Staff')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-3-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">School Staff</h1>
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
<div class="untree_co-section bg-light">
  <div class="container">
    <div class="row">
      @foreach([
        ['name' => 'Mina Collins', 'position' => 'Teacher in Math', 'image' => 'staff_1.jpg'],
        ['name' => 'Anderson Matthew', 'position' => 'Teacher in Music', 'image' => 'staff_2.jpg'],
        ['name' => 'Cynthia Misso', 'position' => 'Teacher English', 'image' => 'staff_3.jpg']
      ] as $index => $staff)
      <div class="col-12 col-sm-6 col-md-6 mb-4 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
        <div class="staff text-center">
          <div class="mb-4">
            <img src="{{ asset('images/' . $staff['image']) }}" alt="Staff Image" class="img-fluid">
          </div>
          <div class="staff-body">
            <h3 class="staff-name">{{ $staff['name'] }}</h3>
            <span class="d-block position mb-4">{{ $staff['position'] }}</span>
            <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
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
