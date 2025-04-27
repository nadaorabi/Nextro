@extends('layouts.app')

@section('title', 'News')  {{-- العنوان الخاص بالصفحة --}}

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-6-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">News</h1>
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
    <div class="row align-items-stretch">
      
      @foreach(range(1,6) as $index)
      <div class="col-lg-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $index % 2 == 0 ? '200' : '100' }}">
        <div class="media-h d-flex h-100">
          <figure>
            <img src="{{ asset('images/img-school-' . (($index % 6) + 1) . '-min.jpg') }}" alt="Image">
          </figure>
          <div class="media-h-body">
            <h2 class="mb-3"><a href="#">
              @if($index % 2 == 0) Enroll Your Kids This Summer to get 30% off 
              @else Education for Tomorrow's Leaders 
              @endif
            </a></h2>
            <div class="meta">
              <span class="icon-calendar mr-2"></span><span>June 22, 2020</span>  
              <span class="icon-person mr-2"></span>Untree.co
            </div>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
          </div>
        </div>
      </div>
      @endforeach

    </div>

    <div class="row mt-5">
      <div class="col-12 text-center">
        <ul class="list-unstyled custom-pagination">
          <li><a href="#">1</a></li>
          <li class="active"><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">4</a></li>
        </ul>
      </div>
    </div>

  </div>
</div>
@endsection
