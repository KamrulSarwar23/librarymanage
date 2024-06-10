<div class="site-mobile-menu site-navbar-target">

    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>
<!-- .site-mobile-menu -->

<div class="site-navbar-wrap">
    <div class="site-navbar site-navbar-target js-sticky-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-3 col-lg-3">
                    <h1 class="my-0 site-logo"><a href="{{ route('home.page') }}">LMS</a></h1>
                </div>
                <div class="col-9 col-lg-9">
                    <nav class="site-navigation text-right" role="navigation">
                        <div class="container">
                            <div class="d-inline-block d-lg-none ml-md-0 mr-auto py-3">
                                <a href="#" class="site-menu-toggle js-menu-toggle text-black">
                                    <span class="icon-menu h3"></span>
                                </a>
                            </div>

                            <ul class="site-menu main-menu js-clone-nav d-none d-lg-block">

                                <li class="nav-item {{ request()->routeIs('home.page') ? 'active' : '' }}">
                                    <a href="{{ route('home.page') }}" class="nav-link">Home</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('all.books') ? 'active' : '' }}">
                                    <a href="{{ route('all.books') }}" class="nav-link">Books</a>
                                </li>
                                <li class="nav-item {{ request()->routeIs('contact.page') ? 'active' : '' }}">
                                    <a href="{{ route('contact.page') }}" class="nav-link">Contact</a>
                                </li>
                                <li class="nav-item" {{ request()->routeIs('policy.page') ? 'active' : '' }}>
                                    <a href="{{ route('policy.page') }}" class="nav-link">User Policy</a>
                                </li>



                                <li>
                                    @if (Route::has('login'))
                                        <nav class="mx-3 flex flex-1 justify-end">
                                            @auth
                                                @if (Auth::user()->role == 'admin')
                                                    <a href="{{ route('admin.dashboard') }}"
                                                        class="btn btn-primary text-white rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                        {{ Auth::user()->name }}
                                                    </a>
                                                @else
                                                    <a href="{{ route('user.dashboard') }}"
                                                        class="btn btn-primary text-white rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                        {{ Auth::user()->name }}
                                                        <img style="border-radius: 50%" width="45px" height="45px"
                                                            src="{{ asset(auth()->user()->image ?? 'frontend/images/default-profile-image.jpg') }}"
                                                            alt="">
                                                    </a>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}"
                                                    class="btn btn-success text-white mr-2 rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                    Log in
                                                </a>

                                                @if (Route::has('register'))
                                                    <a href="{{ route('register') }}"
                                                        class="btn btn-success text-white rounded-md px-3 py-2 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                        Register
                                                    </a>
                                                @endif
                                            @endauth
                                        </nav>
                                    @endif
                                </li>

                            </ul>
                        </div>
                    </nav>


                </div>
            </div>
        </div>
    </div>
</div>
<!-- END .site-navbar-wrap -->
