@extends('frontend.master')

@section('section')

    <div class="intro-section small" style="background-image: url('{{ asset('frontend/images/hero_1.jpg') }}');">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
            <div class="intro">
            <h1>About Us</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, nihil.</p>
            <p><a href="#" class="btn btn-primary">Get Started</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <img src="{{ asset('frontend/images/hero_1.jpg') }}" alt="Image" class="img-fluid">
          </div>
          <div class="col-lg-5 ml-auto">
            <span class="caption">About Us</span>
            <h2 class="title-with-line">Mindful Planning of Monetary Spending and Saving</h2>


            <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sequi voluptate asperiores rem quis consectetur cum quae, ratione voluptatem aliquam sit aspernatur.</p>


            <div class="row">
              <div class="col-md-6">
                <ul class="list-unstyled ul-arrow">
                  <li>Dolor sit amet</li>
                  <li>Obcaecati similique excepturi</li>
                  <li>Ipsum amet voluptas</li>
                  <li>Aliquid facilis est</li>
                  <li>Eligendi laborum assumenda</li>
                </ul>

              </div>
              <div class="col-md-6">
                <ul class="list-unstyled ul-arrow float-left">
                  <li>Dolor sit amet</li>
                  <li>Obcaecati similique excepturi</li>
                  <li>Ipsum amet voluptas</li>
                  <li>Aliquid facilis est</li>
                  <li>Eligendi laborum assumenda</li>
                </ul>
              </div>
            </div>
            
            
          </div>
        </div>
      </div>
    </div>

    <div class="site-section pt-0">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="numbers">
              <strong class="d-block">32, 594</strong>
              <span>Number of Clients</span>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="numbers">
              <strong class="d-block">25</strong>
              <span>Years of Experience</span>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="numbers">
              <strong class="d-block">1,029</strong>
              <span>Employees</span>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="numbers">
              <strong class="d-block">10,200</strong>
              <span>Cup of Coffees</span>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="site-section pb-0">
      <div class="container">
        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-4 mb-5 text-center">
            <span class="caption">Our Team</span>
            <h2 class="title-with-line mb-2 text-center">Our Leadership</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">

            <div class="feature-1 border person text-center">
              <img src="{{ asset('frontend/images/person_1.jpg') }}" alt="Image" class="img-fluid">
              <div class="feature-1-content">
                <h2>Craig Daniel</h2>
                <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
            <div class="feature-1 border person text-center">
              <img src="{{ asset('frontend/images/person_2.jpg') }}" alt="Image" class="img-fluid">
              <div class="feature-1-content">
                <h2>Taylor Simpson</h2>
                <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
            <div class="feature-1 border person text-center">
              <img src="{{ asset('frontend/images/person_3.jpg') }}" alt="Image" class="img-fluid">
              <div class="feature-1-content">
                <h2>Jonas Tabble</h2>
                <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">

            <div class="feature-1 border person text-center">
              <img src="{{ asset('frontend/images/person_4.jpg') }}" alt="Image" class="img-fluid">
              <div class="feature-1-content">
                <h2>Craig Daniel</h2>
                <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
            <div class="feature-1 border person text-center">
              <img src="{{ asset('frontend/images/person_2.jpg') }}" alt="Image" class="img-fluid">
              <div class="feature-1-content">
                <h2>Taylor Simpson</h2>
                <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-5">
            <div class="feature-1 border person text-center">
              <img src="{{ asset('frontend/images/person_3.jpg') }}" alt="Image" class="img-fluid">
              <div class="feature-1-content">
                <h2>Jonas Tabble</h2>
                <span class="position mb-3 d-block">Co-Founder, CEO</span>    
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>




    <div class="intro-section small" style="background-image: url('{{ asset('frontend/images/hero_1.jpg') }}');">
      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
            <h1>We Are Here To Help Grow Your Business </h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, nihil.</p>
            <p><a href="#" class="btn btn-primary">Get Started</a></p>
          </div>
        </div>
      </div>
    </div>




@endsection
