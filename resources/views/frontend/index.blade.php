@extends('frontend.master')

@section('section')
    <style>
        .search-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
        }

        .search-input {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            margin-right: 10px;
        }

        .search-button {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .search-icon {
            margin-right: 5px;
        }

        @media (max-width: 576px) {
            .search-input {
                border-radius: 0;
            }

            .search-button {
                border-radius: 0;
            }
        }
    </style>

    <div class="container mt-3 pb-5">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">
                <div class="d-flex justify-content-between">
                    <h2 class="mb-3">Books</h2>

                </div>

                <div class="container mt-5 mb-3">
                    <div class="card search-card shadow-lg border-0">
                        <div class="card-body">
                            <form action="{{ route('book.search') }}" method="POST" class="form-inline">
                                @csrf
                                <div class="input-group w-100">
                                    <input name="search_query" type="text" value="{{ old('search_query') }}"
                                        class="form-control form-control-lg search-input"
                                        placeholder="Search by book name, category, author, or publisher">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary btn-lg search-button">
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
                        <h5>Search results for: "{{ $searchQuery }}"</h5>
                    </div>
                @endif

                @if (isset($categoryName))
                    <div class="text-success">
                        <h5>Search results for: "{{ $categoryName->name }}"</h5>
                    </div>
                @endif


                @if (isset($authorName))
                    <div class="text-success mt-3">
                        <h5>Search results for: "{{ $authorName->name }}"</h5>
                    </div>
                @endif

                @if (isset($publisherName))
                    <div class="text-success">
                        <h5>Search results for: "{{ $publisherName->name }}"</h5>
                    </div>
                @endif

                @if ($books->isEmpty())
                    <div class="alert alert-danger mt-5" role="alert">
                        No data found.
                    </div>
                @endif



                <div class="row mt-4">
                    @foreach ($books as $book)
                        <div class="col-md-4 col-lg-3 mb-4">
                            <div class="card border-0 shadow-lg">
                                <a href="{{ route('book.details', $book->id) }}"><img height="300px"
                                        src="{{ asset('storage/book/' . $book->cover_image) }}" alt=""
                                        class="card-img-top"></a>
                                <div class="card-body">
                                    <h3 class="h4 heading"><a href="#">{{ $book->title }}</a></h3>
                                    <p>Author: {{ $book->author->name }}</p>
                                    {{-- <p>Category: {{ $book->category->name }}</p>
                                    <p>Publisher: {{ $book->publisher->name }}</p> --}}
                                    <div class="star-rating d-inline-flex ml-2" title="">

                                        <div class="star-rating d-inline-flex" title="">

                                            <span
                                                class="rating-text theme-font theme-yellow mx-1">({{ round($book->rating->avg('rating'), 1) }})
                                            </span>

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
                                        </div>
                                        <span class="theme-font text-muted">({{ $book->rating->count() }} Reviews)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div>
                    {{ $books->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
