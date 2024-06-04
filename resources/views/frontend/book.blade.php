@extends('frontend.master')


<style>
    /*
body.book-details-page {
            background-image: none !important;

        } */

    .enjoyedbook a {
        text-decoration: none;
    }

    .rating {
        direction: rtl;
        unicode-bidi: bidi-override;
        color: #ddd;
        /* Personal choice */
        font-size: 7px;
        margin-left: -15px;
    }

    .rating input {
        display: none;
    }

    .rating label:hover,
    .rating label:hover~label,
    .rating input:checked+label,
    .rating input:checked+label~label {
        color: #3a92f7;
        font-size: 7px;
    }

    .front-stars,
    .back-stars,
    .star-rating {
        display: flex;
    }

    .star-rating {
        align-items: left;
        font-size: 15px;
        justify-content: left;
        margin-left: -5px;
    }

    .back-stars {
        color: #CCC;
        position: relative;
    }

    .front-stars {
        color: #3a92f7;
        overflow: hidden;
        position: absolute;
        top: 0;
        transition: all 0.5s;
    }

    .percent {
        color: #bb5252;
        font-size: 1.5em;
    }

    .custom-scrollbar {
        max-height: 200px;
        /* Adjust the max-height as needed */
        overflow-y: auto;
    }
</style>

@section('content')
    <div class="container mt-3 mb-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="custom-nav mb-3">
                        <ul class="nav">
                            <li>
                                <div class="dropdown mr-2 mb-2">
                                    <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Category
                                    </button>
                                    <ul class="dropdown-menu custom-scrollbar">
                                        @foreach ($category as $item)
                                            <li><a class="dropdown-item"
                                                    href="{{ route('book.by-category', $item->id) }}">{{ $item->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <div class="dropdown mr-2">
                                    <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Author
                                    </button>
                                    <ul class="dropdown-menu custom-scrollbar">
                                        @foreach ($author as $item)
                                            <li><a class="dropdown-item"
                                                    href="{{ route('book.by-author', $item->id) }}">{{ $item->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <div class="dropdown mr-2">
                                    <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Publishers
                                    </button>
                                    <ul class="dropdown-menu custom-scrollbar">
                                        @foreach ($publisher as $item)
                                            <li><a class="dropdown-item"
                                                    href="{{ route('book.by-publisher', $item->id) }}">{{ $item->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <form action="{{ route('book.search') }}" method="POST" class="form-inline">
                        @csrf
                        <div class="input-group w-100">
                            <input name="search_query" type="text" value="{{ old('search_query') }}"
                                class="form-control form-control-lg search-input"
                                placeholder="Search by book, category, author, publisher">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-success btn-lg search-button">
                                    <i class="fa-solid fa-magnifying-glass search-icon"></i> Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @if (isset($searchQuery) && !empty($searchQuery))
            <div class="text-success">
                <h6 class="text-white">Search results for: "{{ $searchQuery }}"</h6>
            </div>
        @endif

        @if (isset($categoryName))
            <div>
                <h6 class="text-white">Search results for: "{{ $categoryName->name }}"</h6>
            </div>
        @endif


        @if (isset($authorName))
            <div>
                <h6 class="text-white">Search results for: "{{ $authorName->name }}"</h6>
            </div>
        @endif

        @if (isset($publisherName))
            <div>
                <h6 class="text-white">Search results for: "{{ $publisherName->name }}"</h6>
            </div>
        @endif

        @if ($books->isEmpty())
            <div class="alert alert-danger mt-5" role="alert">
                No data found.
            </div>
        @endif

        @if (count($books) > 0)
            @if (isset($categoryName) || isset($authorName) || isset($publisherName) || isset($searchQuery))
                <h2 class="text-white">Search Result</h2>
            @else
                <h2 class="text-white">All Books</h2>
            @endif
        @endif


        <div class="row mb-4">

            @foreach ($books as $book)
                <div class="col-md-4 col-lg-3 mt-4">
                    <a href="{{ route('book.details', $book->id) }}">
                        <div class="card shadow-lg p-3 bg-white rounded">
                            <img src="{{ asset('storage/book/' . $book->cover_image) }}" class="card-img-top"
                                alt="Book Cover" style="height: 260px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">
                                    <a class="text-muted"
                                        href="{{ route('book.details', $book->id) }}">{{ limitText($book->title, 20) }}</a>
                                </p>

                                <div class="star-rating"
                                    title="Average Rating: {{ round($book->rating->avg('rating'), 1) }}">
                                    <div class="back-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                        <div class="front-stars"
                                            style="width: {{ ($book->rating->avg('rating') / 5) * 100 }}%">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $book->rating->avg('rating') * 20)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>

                                    <span class="ml-1 theme-font text-muted">({{ $book->rating->count() }} Reviews)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach

        </div>


        @if (count($popularBook) > 0)
            <h2>Popular Books</h2>
        @endif

        <div class="row mb-4">

            @foreach ($popularBook as $book)
                <div class="col-md-4 col-lg-3 mt-4">
                    <a href="{{ route('book.details', $book->id) }}">
                        <div class="card shadow-lg p-3 bg-white rounded">
                            <img src="{{ asset('storage/book/' . $book->cover_image) }}" class="card-img-top"
                                alt="Book Cover" style="height: 260px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">
                                    <a class="text-muted"
                                        href="{{ route('book.details', $book->id) }}">{{ limitText($book->title, 15) }}</a>
                                </p>

                                <div class="star-rating d-inline-flex align-items-center"
                                    title="Average Rating: {{ round($book->rating->avg('rating'), 1) }}">
                                    <div class="back-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                        <div class="front-stars"
                                            style="width: {{ ($book->rating->avg('rating') / 5) * 100 }}%">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $book->rating->avg('rating') * 20)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    {{-- <span class="rating-text theme-font theme-yellow mx-1">({{ round($book->rating->avg('rating'), 1) }})</span> --}}
                                    <span class="ml-1 theme-font text-muted">({{ $book->rating->count() }} Reviews)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        @if (count($recommendedBook) > 0)
            <h2>Recommended Books</h2>
        @endif

        <div class="row mb-4">

            @foreach ($recommendedBook as $book)
                <div class="col-md-4 col-lg-3 mt-4">
                    <a href="{{ route('book.details', $book->id) }}">
                        <div class="card shadow-lg p-3 bg-white rounded">
                            <img src="{{ asset('storage/book/' . $book->cover_image) }}" class="card-img-top"
                                alt="Book Cover" style="height: 260px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">
                                    <a class="text-muted"
                                        href="{{ route('book.details', $book->id) }}">{{ limitText($book->title, 15) }}</a>
                                </p>

                                <div class="star-rating d-inline-flex align-items-center"
                                    title="Average Rating: {{ round($book->rating->avg('rating'), 1) }}">
                                    <div class="back-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                        <div class="front-stars"
                                            style="width: {{ ($book->rating->avg('rating') / 5) * 100 }}%">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $book->rating->avg('rating') * 20)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    {{-- <span class="rating-text theme-font theme-yellow mx-1">({{ round($book->rating->avg('rating'), 1) }})</span>  --}}
                                    <span class="ml-1 theme-font text-muted">({{ $book->rating->count() }} Reviews)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>


        @if (count($recentBook) > 0)
            <h2>Recent Books</h2>
        @endif

        <div class="row mb-4">

            @foreach ($recentBook as $book)
                <div class="col-md-4 col-lg-3 mt-4">
                    <a href="{{ route('book.details', $book->id) }}">
                        <div class="card shadow-lg p-3 bg-white rounded">
                            <img src="{{ asset('storage/book/' . $book->cover_image) }}" class="card-img-top"
                                alt="Book Cover" style="height: 260px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">
                                    <a class="text-muted"
                                        href="{{ route('book.details', $book->id) }}">{{ limitText($book->title, 15) }}</a>
                                </p>

                                <div class="star-rating d-inline-flex align-items-center"
                                    title="Average Rating: {{ round($book->rating->avg('rating'), 1) }}">
                                    <div class="back-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                        <div class="front-stars"
                                            style="width: {{ ($book->rating->avg('rating') / 5) * 100 }}%">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $book->rating->avg('rating') * 20)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    {{-- <span class="rating-text theme-font theme-yellow mx-1">({{ round($book->rating->avg('rating'), 1) }})</span>  --}}
                                    
                                    <span class="ml-1 theme-font text-muted">({{ $book->rating->count() }} Reviews)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>


        @if (count($featuredBook) > 0)
            <h2>Featured Books</h2>
        @endif

        <div class="row">

            @foreach ($featuredBook as $book)
                <div class="col-md-4 col-lg-3 mt-4">
                    <a href="{{ route('book.details', $book->id) }}">
                        <div class="card shadow-lg p-3 bg-white rounded">
                            <img src="{{ asset('storage/book/' . $book->cover_image) }}" class="card-img-top"
                                alt="Book Cover" style="height: 260px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text">
                                    <a class="text-muted"
                                        href="{{ route('book.details', $book->id) }}">{{ limitText($book->title, 15) }}</a>
                                </p>

                                <div class="star-rating d-inline-flex align-items-center"
                                    title="Average Rating: {{ round($book->rating->avg('rating'), 1) }}">
                                    <div class="back-stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                        <div class="front-stars"
                                            style="width: {{ ($book->rating->avg('rating') / 5) * 100 }}%">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $book->rating->avg('rating') * 20)
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                @else
                                                    <i class="fa fa-star-o" aria-hidden="true"></i>
                                                @endif
                                            @endfor
                                        </div>
                                    </div>
                                    {{-- <span class="rating-text theme-font theme-yellow mx-1">({{ round($book->rating->avg('rating'), 1) }})</span> --}}

                                    <span class="ml-1 theme-font text-muted">({{ $book->rating->count() }} Reviews)</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
