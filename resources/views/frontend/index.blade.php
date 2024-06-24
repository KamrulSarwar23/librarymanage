@extends('frontend.master')

@section('content')

    <div class="site-section" id="home-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-5">
                    <h1 class="text-white serif text-uppercase mb-4">
                        Meet Your Next Book
                    </h1>
                    <p class="text-white mb-5">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                        Debitis sint alias, doloribus assumenda totam porro ex impedit,
                        recusandae voluptatibus sed.
                    </p>
                    <p>
                        <a href="#" class="btn btn-white px-4 py-3">Get Started</a>
                    </p>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-10">
                    <img src="{{ asset('newui/images/book_1.png') }}" alt="Image" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light" id="features-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h2 class="heading">Features Of This Book</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos,
                        harum repudiandae provident neque voluptas odio nostrum officiis
                        debitis et vitae, dolorem placeat fugiat recusandae aperiam
                        aspernatur expedita alias, officia. Suscipit!
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
                        <span class="wrap-icon">
                            <span class="icon-book"></span>
                        </span>
                        <h3>Hard Cover</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic
                            tenetur ea in accusantium est.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
                        <span class="wrap-icon">
                            <span class="icon-bookmark"></span>
                        </span>
                        <h3>Paper Back</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic
                            tenetur ea in accusantium est.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
                        <span class="wrap-icon">
                            <span class="icon-files-o"></span>
                        </span>
                        <h3>Paper Back</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic
                            tenetur ea in accusantium est.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
                        <span class="wrap-icon">
                            <span class="icon-font"></span>
                        </span>
                        <h3>Big Text</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic
                            tenetur ea in accusantium est.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
                        <span class="wrap-icon">
                            <span class="icon-photo"></span>
                        </span>
                        <h3>Images</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic
                            tenetur ea in accusantium est.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="service h-100">
                        <span class="wrap-icon">
                            <span class="icon-text-height"></span>
                        </span>
                        <h3>Readable Text</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Hic
                            tenetur ea in accusantium est.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
