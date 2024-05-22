  
    <div class="py-2 bg-light">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-9 d-none d-lg-block">
                    <a href="#" class="small mr-3"><span class="icon-question-circle-o mr-2"></span> Have a
                        questions?</a>
                    <a href="#" class="small mr-3"><span class="icon-phone2 mr-2"></span> 10 20 123 456</a>
                    <a href="#" class="small mr-3"><span class="icon-envelope-o mr-2"></span>
                        info@mydomain.com</a>
                </div>
  
            </div>
        </div>
    </div>

    <header class="site-navbar py-4 js-sticky-header site-navbar-target" role="banner">
  
        <div class="container">
            <div class="d-flex align-items-center">
                <div class="site-logo">
                    <a href="{{ url('/') }}" class="d-block">
                        {{-- <img src="{{ asset('frontend/images/logo.png') }}" alt="Image" class="img-fluid"> --}}
                        <i style="font-size: 50px" class="text-success fa-solid fa-book-open">LMS</i>
                    </a>
                </div>
                <div class="mr-auto">
                    <nav class="site-navigation position-relative text-right" role="navigation">
                        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">

                            <li class="{{ request()->routeIs('home.page') ? 'active' : ''}}">
                                <a href="{{ url('/') }}" class="nav-link text-left">Home</a>
                            </li>
                            
                            <li class="{{ request()->routeIs('about.page') ? 'active' : ''}}">
                                <a href="{{ route('about.page') }}" class="nav-link text-left">About</a>
                            </li>

                            <li class="{{ request()->routeIs('services.page') ? 'active' : ''}}">
                                <a href="{{ route('services.page') }}" class="nav-link text-left">Services</a>
                            </li>
                       
                            <li class="{{ request()->routeIs('blog.page') ? 'active' : ''}}">
                                <a href="{{ route('blog.page') }}" class="nav-link text-left">Blog</a>
                            </li>
                            <li class="{{ request()->routeIs('contact.page') ? 'active' : ''}}">
                                <a href="{{ route('contact.page') }}" class="nav-link text-left">Contact</a>
                            </li>
                        </ul>
                    </nav>
  
                </div>
                <div class="ml-auto">
                    <div class="social-wrap">
                        {{-- <a href="#"><span class="icon-facebook"></span></a>
                        <a href="#"><span class="icon-twitter"></span></a>
                        <a href="#"><span class="icon-linkedin"></span></a> --}}
  
  
                        <a href="#"
                            class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black"><span
                                class="icon-menu h3"></span></a>
                    </div>
                    @if (Route::has('login'))
                        <nav class="-mx-3 flex flex-1 justify-end">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="btn btn-primary text-white rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('login') }}"
                                    class="btn btn-primary text-white rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                    Log in
                                </a>
  
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="btn btn-primary text-white rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                        Register
                                    </a>
                                @endif
                            @endauth
                        </nav>
                    @endif
                </div>
  
            </div>
        </div>
  
    </header>