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

    <div class="site-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-7">
                    <h2 class="heading">Book Screenshot</h2>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos,
                        harum repudiandae provident neque voluptas odio nostrum officiis
                        debitis et vitae, dolorem placeat fugiat recusandae aperiam
                        aspernatur expedita alias, officia. Suscipit!
                    </p>
                    <p class="mb-3">
                        <a href="#" class="customNextBtn">Prev</a>
                        <span class="mx-2">/</span>
                        <a href="#" class="customPrevBtn">Next</a>
                    </p>
                </div>
            </div>

            <div class="owl-carousel slide-one-item">
                <img src="{{ asset('newui/images/img_1.jpg') }}" alt="Image" class="img-fluid" />
                <img src="{{ asset('newui/images/img_2.jpg') }}" alt="Image" class="img-fluid" />
                <img src="{{ asset('newui/images/img_3.jpg') }}" alt="Image" class="img-fluid" />
                <img src="{{ asset('newui/images/img_4.jpg') }}" alt="Image" class="img-fluid" />
                <img src="{{ asset('newui/images/img_5.jpg') }}" alt="Image" class="img-fluid" />
            </div>
        </div>
    </div>

    <div class="author d-lg-flex" id="about-section">
        <div class="bg-img" style="background-image: url({{ asset('newui/images/author_1.jpg') }})"></div>
        <div class="text">
            <h3>Hello It's Jane</h3>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis
                qui voluptates illum harum minima accusantium praesentium eos aut
                ab. Voluptate nulla illum ullam maxime consequuntur labore qui
                delectus, omnis saepe.
            </p>
            <p>
                Eos ratione repellat ea dignissimos iure ipsam sed dolore, excepturi
                id recusandae cumque sit, fugiat obcaecati necessitatibus nisi
                voluptate similique? Sed quae itaque nisi magnam amet aut maiores
                debitis temporibus.
            </p>
            <p>
                Iste repellendus libero cumque facilis sint quas quis temporibus
                quia veritatis reiciendis obcaecati, magni, dolorum aspernatur
                laborum, est, sequi rerum! Perspiciatis facilis commodi libero ipsa
                minima reiciendis rerum, facere quaerat.
            </p>

            div.social_

            <div class="mt-5">
                <span class="d-block text-black mb-4">Jane Smith,
                    <span class="text-muted">Book Author &amp; Publisher</span></span>
                <img src="{{ asset('newui/images/signature.png') }}" alt="Image" class="img-fluid w-25" />
            </div>
        </div>
    </div>

    <div class="site-section bg-light" id="testimonial-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-12">
                    <h2 class="heading">Testimonial From Readers</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="testimonial bg-white h-100">
                        <blockquote class="mb-3">
                            <p>
                                Far far away, behind the word mountains, far from the
                                countries Vokalia and Consonantia, there live the blind
                                texts. Separated they live in Bookmarksgrove right at the
                                coast of the Semantics, a large language ocean.&rdquo;
                            </p>
                        </blockquote>
                        <div class="d-flex align-items-center vcard">
                            <figure class="mb-0 mr-3">
                                <img src="{{ asset('newui/images/person_1.jpg') }}" alt="Free website template by Free-Template.co"
                                    class="img-fluid ounded-circle" />
                            </figure>
                            <div class="vcard-text">
                                <span class="d-block">Jacob Spencer</span>
                                <span class="position">Web Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial bg-white h-100">
                        <blockquote class="mb-3">
                            <p>
                                Far far away, behind the word mountains, far from the
                                countries Vokalia and Consonantia, there live the blind
                                texts. Separated they live in Bookmarksgrove right at the
                                coast of the Semantics, a large language ocean.&rdquo;
                            </p>
                        </blockquote>
                        <div class="d-flex align-items-center vcard">
                            <figure class="mb-0 mr-3">
                                <img src="{{ asset('newui/images/person_2.jpg') }}" alt="Free website template by Free-Template.co"
                                    class="img-fluid ounded-circle" />
                            </figure>
                            <div class="vcard-text">
                                <span class="d-block">David Shaun</span>
                                <span class="position">Web Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial bg-white h-100">
                        <blockquote class="mb-3">
                            <p>
                                Far far away, behind the word mountains, far from the
                                countries Vokalia and Consonantia, there live the blind
                                texts. Separated they live in Bookmarksgrove right at the
                                coast of the Semantics, a large language ocean.&rdquo;
                            </p>
                        </blockquote>
                        <div class="d-flex align-items-center vcard">
                            <figure class="mb-0 mr-3">
                                <img src="{{ asset('newui/images/person_3.jpg') }}" alt="Free website template by Free-Template.co"
                                    class="img-fluid ounded-circle" />
                            </figure>
                            <div class="vcard-text">
                                <span class="d-block">Craig Smith</span>
                                <span class="position">Web Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{-- 
    <div class="site-section py-5 bg-primary">
        <div class="container">
            <h3 class="text-white h4 mb-3 ml-3">Subscribe For The New Updates</h3>
            <div class="d-flex">
                <input type="text" class="form-control mr-4 px-4" placeholder="Enter your email address..." />
                <input type="submit" class="btn btn-white px-4" value="Send Email" />
            </div>
        </div>
    </div> --}}


@endsection
