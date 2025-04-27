@extends('layouts.app')

@section('title', 'Elements')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-3-min.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-12">
        <div class="row justify-content-center">
          <div class="col-lg-6 text-center">
            <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Elements</h1>
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
      
      {{-- Left Side Content --}}
      <div class="col-lg-6">
        
        {{-- Accordion --}}
        <div class="custom-block" data-aos="fade-up">
          <h2 class="section-title">Accordion</h2>
          <div class="custom-accordion" id="accordion_1">
            @foreach([
              ['title' => 'How to download and register?', 'content' => 'Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.'],
              ['title' => 'How to create your paypal account?', 'content' => 'A small river named Duden flows by their place and supplies it with the necessary regelialia.'],
              ['title' => 'How to link your paypal and bank account?', 'content' => 'When she reached the first hills of the Italic Mountains, she had a last view back on the skyline.']
            ] as $index => $faq)
            <div class="accordion-item">
              <h2 class="mb-0">
                <button class="btn btn-link {{ $index != 0 ? 'collapsed' : '' }}" type="button" data-toggle="collapse" data-target="#collapse{{ $index }}" aria-expanded="{{ $index == 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $index }}">
                  {{ $faq['title'] }}
                </button>
              </h2>
              <div id="collapse{{ $index }}" class="collapse {{ $index == 0 ? 'show' : '' }}" data-parent="#accordion_1">
                <div class="accordion-body">
                  {{ $faq['content'] }}
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>

        {{-- Gallery --}}
        <div class="custom-block" data-aos="fade-up">
          <h2 class="section-title">Gallery</h2>
          <div class="row gutter-v2 gallery">
            @foreach(range(1,6) as $i)
            <div class="col-4">
              <a href="{{ asset('images/gal_'.$i.'.jpg') }}" class="gal-item" data-fancybox="gal">
                <img src="{{ asset('images/gal_'.$i.'.jpg') }}" alt="Gallery Image" class="img-fluid">
              </a>
            </div>
            @endforeach
          </div>
        </div>

        {{-- Video --}}
        <div class="custom-block" data-aos="fade-up">
          <h2 class="section-title">Video</h2>
          <a href="https://vimeo.com/342333493" data-fancybox class="video-wrap">
            <span class="play-wrap"><span class="icon-play"></span></span>
            <img src="{{ asset('images/hero_bg.jpg') }}" alt="Video" class="img-fluid rounded">
          </a>
        </div>

        {{-- Unordered List --}}
        <div class="custom-block" data-aos="fade-up">
          <h2 class="section-title mb-3">Check Unordered List</h2>
          <ul class="list-unstyled ul-check primary">
            <li>Far far away, behind the word</li>
            <li>Far from the countries Vokalia</li>
            <li>Separated they live in Bookmarksgrove</li>
          </ul>
        </div>

      </div> {{-- End Left Side --}}

      {{-- Right Side Content --}}
      <div class="col-lg-6">
        
        {{-- Form --}}
        <div class="custom-block" data-aos="fade-up" data-aos-delay="100">
          <h2 class="section-title">Form</h2>
          <form class="contact-form">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="fname">First name</label>
                  <input type="text" class="form-control" id="fname">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lname">Last name</label>
                  <input type="text" class="form-control" id="lname">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="email">Email address</label>
              <input type="email" class="form-control" id="email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" id="password">
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea id="message" class="form-control" cols="30" rows="5"></textarea>
            </div>
            <div class="form-group">
              <label for="select">Select</label>
              <select id="select" class="custom-select">
                <option>Untree.co</option>
                <option>Offers high quality free template</option>
              </select>
            </div>
            <div class="form-group">
              <label class="control control--checkbox">
                <span class="caption">Custom checkbox</span>
                <input type="checkbox" checked />
                <div class="control__indicator"></div>
              </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>

        {{-- Social Icons --}}
        <div class="custom-block" data-aos="fade-up">
          <h2 class="section-title">Social Icons</h2>
          <ul class="list-unstyled social-icons light">
            <li><a href="#"><span class="icon-facebook"></span></a></li>
            <li><a href="#"><span class="icon-twitter"></span></a></li>
            <li><a href="#"><span class="icon-linkedin"></span></a></li>
            <li><a href="#"><span class="icon-google"></span></a></li>
            <li><a href="#"><span class="icon-play"></span></a></li>
          </ul>
        </div>

        {{-- Slider --}}
        <div class="custom-block" data-aos="fade-up" data-aos-delay="100">
          <h2 class="section-title text-center">Slider</h2>
          <div class="owl-single owl-carousel no-nav">
            @foreach([
              ['img' => 'person_2.jpg', 'name' => 'Adam Aderson'],
              ['img' => 'person_3.jpg', 'name' => 'Lukas Devlin'],
              ['img' => 'person_4.jpg', 'name' => 'Kayla Bryant']
            ] as $testimonial)
            <div class="testimonial mx-auto text-center">
              <figure class="img-wrap">
                <img src="{{ asset('images/'.$testimonial['img']) }}" alt="Image" class="img-fluid">
              </figure>
              <h3 class="name text-black">{{ $testimonial['name'] }}</h3>
              <blockquote>
                <p>&ldquo;There live the blind texts. Separated they live in Bookmarksgrove right at the coast of the Semantics.&rdquo;</p>
              </blockquote>
            </div>
            @endforeach
          </div>
        </div>

      </div> {{-- End Right Side --}}

    </div> {{-- End Row --}}
  </div> {{-- End Container --}}
</div> {{-- End Section --}}

@endsection
