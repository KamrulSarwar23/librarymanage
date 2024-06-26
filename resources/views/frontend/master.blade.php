<!DOCTYPE html>
<html lang="en">

<head>

    <title>Library Management</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,700|Roboto&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('newui/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('newui/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('newui/css/animate.css') }}" />
    <link rel="stylesheet" href="{{ asset('newui/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('newui/css/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('newui/css/bootstrap-datepicker.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}"> --}}
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('newui/fonts/flaticon/font/flaticon.css') }}" />
    <link rel="stylesheet" href="{{ asset('newui/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('newui/css/jquery.fancybox.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('newui/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('userdashboard/style.css') }}" />

</head>

<body class="book-details-page" data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <div class="site-wrap">

        @include('frontend.header')

        @yield('content')

        @include('frontend.footer')

    </div>

    <script src="{{ asset('newui/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('newui/js/popper.min.js') }}"></script>
    <script src="{{ asset('newui/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('newui/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('newui/js/aos.js') }}"></script>
    <script src="{{ asset('newui/js/jquery.sticky.js') }}"></script>
    <script src="{{ asset('newui/js/stickyfill.min.js') }}"></script>
    <script src="{{ asset('newui/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('newui/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('newui/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('newui/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}")
            @endforeach
        @endif
    </script>


    @stack('scripts')

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('body').on('click', '.applied', function(event) {
                event.preventDefault();
                let deleteUrl = $(this).attr('href');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "Do You want to apply for this Book?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Apply Now'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user confirms, submit the form
                        $(this).closest('form').submit();

                        $.ajax({
                            type: 'POST',
                            url: deleteUrl,

                            success: function(data) {
                                if (data.status == 'success') {
                                    Swal.fire(
                                        'Applied',
                                        data.message,
                                        'success'
                                    )

                                    window.location.reload();

                                } else if (data.status == 'error') {
                                    Swal.fire(
                                        'Cant Delete',
                                        data.message,
                                        'error'
                                    )
                                }

                            },

                            error: function(xhr, status, error) {
                                console.log(error);
                            }
                        })

                    }
                });
            });
        });
    </script>
</body>

</html>
