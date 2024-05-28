<div class="container-fluid shadow-lg header">
    <div class="container">
        <div class="d-flex justify-content-between">
            <h1 class="text-center"><a href="{{ route('home.page') }}"
                    class="h3 text-white text-decoration-none">LMS by Five
                    Dev</a></h1>


            <div class="custom-nav">
                <ul class="nav">

                    <li>
                        <div class="dropdown mt-2 m-2">
                            <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Category
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($category as $item)
                                    <li><a class="dropdown-item" href="{{ route('book.by-category', $item->id) }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li>
                        <div class="dropdown mt-2 m-2">
                            <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Author
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($author as $item)
                                    <li><a class="dropdown-item" href="{{ route('book.by-author', $item->id) }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>

                    <li>
                        <div class="dropdown mt-2">
                            <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Publishers
                            </button>
                            <ul class="dropdown-menu">
                                @foreach ($publisher as $item)
                                    <li><a class="dropdown-item" href="{{ route('book.by-publisher', $item->id) }}">{{ $item->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center navigation">
                @if (Route::has('login'))
                    <nav class="-mx-3 flex flex-1 justify-end">
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
                                        src="{{ asset(auth()->user()->image) }}" alt="">
                                </a>
                            @endif
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
</div>