
@extends('frontend.master')

@section('section')

<div class="intro-section small" style="background-image: url('{{ asset('frontend/images/hero_2.jpg') }}');">
  <div class="container">
    <div class="row align-items-center justify-content-center">
      <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
        <div class="intro">
          <h1>Contact us</h1>
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
      <div class="col-md-6 form-group">
        <label for="fname">First Name</label>
        <input type="text" id="fname" class="form-control form-control-lg">
      </div>
      <div class="col-md-6 form-group">
        <label for="lname">Last Name</label>
        <input type="text" id="lname" class="form-control form-control-lg">
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 form-group">
        <label for="eaddress">Email Address</label>
        <input type="text" id="eaddress" class="form-control form-control-lg">
      </div>
      <div class="col-md-6 form-group">
        <label for="tel">Tel. Number</label>
        <input type="text" id="tel" class="form-control form-control-lg">
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 form-group">
        <label for="message">Message</label>
        <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <input type="submit" value="Send Message" class="btn btn-primary btn-lg px-5">
      </div>
    </div>
  </div>
</div>


@endsection





