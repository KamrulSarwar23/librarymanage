@extends('frontend.master')

@section('section')
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>

    <body>

        <div class="intro-section small" style="background-image: url('{{ asset('frontend/images/hero_2.jpg') }}')">
            <div class="container py-5">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
                        <div class="intro">
                            <h1>Contact us</h1>
                            <p><a href="javascript:;" class="btn btn-primary">Get Started</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="site-section mt-5">
            <div class="container">
                <form action="{{ route('send.message') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label for="firstName">First Name</label>
                            <input type="text" name="firstName" class="form-control form-control-lg" value="{{ old('firstName') }}">
                            @error('firstName')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" name="lastName" class="form-control form-control-lg" value="{{ old('lastName') }}">
                            @error('lastName')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mb-4">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control form-control-lg" value="{{ old('email') }}">
                            @error('email')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" name="phone" class="form-control form-control-lg" value="{{ old('phone') }}">
                            @error('phone')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12 form-group">
                            <label for="message">Message</label>
                            <textarea name="message" cols="30" rows="10" class="form-control">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <input type="submit" value="Send Message" class="btn btn-primary btn-lg px-5">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> --}}

        {{-- <script>
            $(document).ready(function() {
                $('#contactForm').on('submit', function(e) {
                    e.preventDefault();

                    $.ajax({
                        url: "{{ route('submit.form') }}",
                        type: "POST",
                        data: $(this).serialize(),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            $('#form-messages').html('<div class="alert alert-success">' + response
                                .success + '</div>');
                            $('#contactForm')[0].reset();
                        },
                        error: function(response) {
                            var errors = response.responseJSON.errors;
                            var errorMessages = '<div class="alert alert-danger"><ul>';
                            $.each(errors, function(key, value) {
                                errorMessages += '<li>' + value + '</li>';
                            });
                            errorMessages += '</ul></div>';

                            $('#form-messages').html(errorMessages);
                        }
                    });
                });
            });
        </script> --}}
    </body>

    </html>
@endsection
