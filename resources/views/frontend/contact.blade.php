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

        <div class="intro-section small" style="background-image: url('{{ asset('frontend/images/hero_2.jpg') }}');">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 mx-auto text-center" data-aos="fade-up">
                        <div class="intro">
                            <h1>Contact us</h1>
                            <p><a href="#" class="btn btn-primary">Get Started</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="site-section">
            <div class="container">
                <div id="form-messages">

                </div>
                <form id="contactForm">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="firstName">First Name</label>
                            <input type="text" id="firstName" name="firstName" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="lastName">Last Name</label>
                            <input type="text" id="lastName" name="lastName" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="email">Email</label>
                            <input type="text" id="email" name="email" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" id="phone" name="phone" class="form-control form-control-lg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label for="message">Message</label>
                            <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
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

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script>
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
        </script>
    </body>

    </html>
@endsection
