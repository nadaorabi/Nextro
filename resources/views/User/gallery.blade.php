@extends('layouts.app')

@section('title', 'Gallery')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-4-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Gallery</h1>
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
<div class="untree_co-section">
  <div class="container">
    <div class="row">
      @foreach([
        'img-school-5-min.jpg', 'img_1.jpg', 'img_2.jpg', 'img_3.jpg',
        'img-school-1-min.jpg', 'img_4.jpg', 'img_5.jpg', 'img_8.jpg',
        'img-school-2-min.jpg', 'img_9.jpg', 'img_6.jpg', 'img_7.jpg', 'img_10.jpg'
      ] as $index => $image)
      <div class="col-md-6 col-lg-4 item" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
        <a href="{{ asset('images/' . $image) }}" class="item-wrap fancybox mb-4" data-fancybox="gal">
          <span class="icon-search2"></span>
          <img class="img-fluid" src="{{ asset('images/' . $image) }}" alt="Gallery Image">
        </a>
      </div>
      @endforeach
    </div>
  </div>
</div>
@endsection
