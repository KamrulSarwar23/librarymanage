@extends('frontend.master')

@section('content')
    <style>
        body.book-details-page {
            background-image: none !important;
        }

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
            color: #c4c4c4;
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
    </style>

    <div class="container mt-3 ">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">

                <div class="row mt-4">

                    <div class="col-md-4 cover_image">
                        <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                            <img src="{{ asset('storage/book/' . $booksdetails->cover_image) }}"
                                alt="{{ $booksdetails->title }}" class="card-img-top img-fluid"
                                style="border-radius: 10px; height: 450px; object-fit: cover;">
                        </div>
                    </div>


                    <div class="col-md-8 text-dark">

                        <h2>{{ $booksdetails->title }}</h2>

                        @if ($totalCurrentQty !== 0)
                            <h5 class="text-primary mb-3">Available Book: {{ $totalCurrentQty }}</h5>
                        @else
                            <h5 class="text-primary mb-3">Available Book: Stock Out</h5>
                        @endif

                        <p>Book ID: {{ $booksdetails->isbn }}</p>
                        <p>Author: {{ $booksdetails->author->name }}</p>
                        <p>Publication: {{ \Carbon\Carbon::parse($booksdetails->publication_date)->format('F , Y') }}</p>

                        <p>Pages: {{ $booksdetails->number_of_pages }}</p>
                        <p>Category: {{ $booksdetails->category->name }}</p>
                        <p>Publisher: {{ $booksdetails->publisher->name }}</p>
                        <div class="star-rating d-inline-flex" title="">
                            <div class="star-rating d-inline-flex mx-1" title="">
                                <span
                                    class="rating-text theme-font theme-yellow mx-1">({{ round($booksdetails->rating->avg('rating'), 1) }})
                                </span>

                                <div class="back-stars mt-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endfor
                                    <div class="front-stars" style="width: {{ ($averageRating / 5) * 100 }}%">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endfor
                                    </div>

                                </div>

                            </div>
                            <span class="theme-font text-muted">({{ $totalReviews }} Reviews)</span>
                        </div>

                        <div class="content mt-3">
                            <p>
                                {!! $booksdetails->summary !!}
                            </p>
                        </div>


                        @auth
                            @if (App\Helper\AxistBookingRequestHelper::existsForBook($booksdetails->id, auth()->user()->id))
                                <form action="javascript:;">
                                    <button type="submit" class="btn btn-primary w-100">Already Exists</button>
                                </form>
                            @else
                                @if (App\Helper\QuantityManage::isQuantityAvailable($booksdetails->id))
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-bs-value="{{ $booksdetails->id }}">
                                        Borrow Request
                                    </button>
                                @else
                                    <form action="javascript:;">
                                        <button type="submit" class="btn btn-danger w-100">Not Available</button>
                                    </form>
                                @endif
                            @endif
                        @else
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                data-bs-target="#exampleModal" data-bs-value="{{ $booksdetails->id }}">
                                Borrow Request
                            </button>
                        @endauth





                        <div class="col-md-12 pt-2">
                            <hr>
                        </div>

                        <div class="row pb-5">
                            <div class="col-md-12  mt-4">

                                <div class="d-flex justify-content-between">
                                    <h3>Reviews</h3>
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop" id="add-review-btn"
                                            data-book="{{ $booksdetails->title }}">
                                            Add Review
                                        </button>

                                    </div>
                                </div>

                                @foreach ($booksReview as $item)
                                    <div class="card border-0 shadow-lg my-4">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <h5 class="mb-3">{{ $item->user->name }}</h4>
                                                    <span
                                                        class="text-muted">{{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y, g:i a') }}</span>
                                            </div>

                                            <div class="mb-3">
                                                <div class="star-rating d-inline-flex" title="Rating: {{ $item->rating }}">
                                                    <div class="back-stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                        @endfor

                                                        <div class="front-stars" style="width: {{ $item->rating * 20 }}%">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="content">
                                                <p>{{ $item->comment }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div>
                                    {{ $booksReview->links() }}
                                </div>


                            </div>
                        </div>
                    </div>

                </div>

                <div class="row mt-5">

                    @if (count($enjoyedbook) > 0)
                        <div class="col-md-12">
                            <h2 class="h3 mb-4">Readers also enjoyed</h2>
                        </div>
                    @endif

                    <div class="row mb-4">
                        @foreach ($enjoyedbook as $book)
                            <div class="col-md-3 mt-4">
                                <div class="card shadow-lg p-3 bg-white rounded">
                                    <a href="{{ route('book.details', $book->id) }}">
                                        <img src="{{ asset('storage/book/' . $book->cover_image) }}" class="card-img-top"
                                            alt="Book Cover" style="height: 260px; object-fit: cover;">
                                    </a>
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
                                            <span
                                                class="rating-text theme-font theme-yellow mx-1">({{ round($book->rating->avg('rating'), 1) }})</span>
                                        </div>
                                    </div>
                                    </a>
                                    @auth
                                        @if (App\Helper\AxistBookingRequestHelper::existsForBook($item->id, auth()->user()->id))
                                            <form action="javascript:;">
                                                <button type="submit" class="btn btn-primary w-100">Already Exists</button>
                                            </form>
                                        @else
                                            @if (App\Helper\QuantityManage::isQuantityAvailable($item->id))
                                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal" data-bs-value="{{ $item->id }}">
                                                    Borrow Request
                                                </button>
                                            @else
                                                <form action="javascript:;">
                                                    <button type="submit" class="btn btn-danger w-100">Not Available</button>
                                                </form>
                                            @endif
                                        @endif
                                    @else
                                        <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" data-bs-value="{{ $booksdetails->id }}">
                                            Borrow Request
                                        </button>
                                    @endauth
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Review for <strong
                                id="review-book-title">Atomic Habits</strong>
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('send.review') }}" method="POST" id="reviewForm">
                            @csrf
                            <div class="mb-3">
                                <label for="review" class="form-label">Review</label>
                                <textarea name="comment" id="review" class="form-control p-3" cols="5" rows="5"></textarea>
                            </div>
                            <div class="rating mb-3 ml-3" style="width: 10rem">

                                <input id="rating-5" type="radio" name="rating" value="5" /><label
                                    for="rating-5"><i class="fas fa-3x fa-star"></i></label>
                                <input id="rating-4" type="radio" name="rating" value="4" /><label
                                    for="rating-4"><i class="fas fa-3x fa-star"></i></label>
                                <input id="rating-3" type="radio" name="rating" value="3" /><label
                                    for="rating-3"><i class="fas fa-3x fa-star"></i></label>
                                <input id="rating-2" type="radio" name="rating" value="2" /><label
                                    for="rating-2"><i class="fas fa-3x fa-star"></i></label>
                                <input id="rating-1" type="radio" name="rating" value="1" /><label
                                    for="rating-1"><i class="fas fa-3x fa-star"></i></label>

                            </div>


                            <input type="hidden" name="book_id" value="{{ $booksdetails->id }}">

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        {{-- **** Modal ******** --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('book.borrow') }}" method="POST">
                        @csrf

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Borrow Request</h5>
                        </div>

                        <div class="modal-body">
                            <input id="book_id" name="bookId" type="hidden">
                            <input type="hidden" name="userId"
                                value="{{ auth()->check() ? auth()->user()->id : '' }}">
                            <label for="bookingDate" class="form-label">Select Your Return Date</label>
                            <input type="date" name="returned_at" id="bookingDate" class="form-control" required>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    @endsection


    @push('scripts')
        <script>
            document.getElementById('reviewForm').addEventListener('submit', function(event) {
                event.preventDefault();

                fetch(this.action, {
                        method: this.method,
                        body: new FormData(this)
                    })
                    .then(response => {
                        if (response.ok) {

                            var modal = document.querySelector('.modal');
                            var modalInstance = bootstrap.Modal.getInstance(modal);
                            modalInstance.hide();

                        } else {
                            console.error('Form submission failed:', response.statusText);
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting form:', error);
                    });
            });
        </script>

        <script>
            // **** Usre id And Book id *****
            document.addEventListener('DOMContentLoaded', function() {

                var exampleModal = document.getElementById('exampleModal');
                var bookIdInput = exampleModal.querySelector('#book_id');

                exampleModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var value = button.getAttribute('data-bs-value');
                    bookIdInput.value = value;
                });

                exampleModal.addEventListener('hidden.bs.modal', function() {
                    // Clear the input field
                    bookIdInput.value = '';
                });
            });

            // **** Work with date *****
            document.addEventListener('DOMContentLoaded', function() {
                var dateInput = document.getElementById('bookingDate');

                var today = new Date();
                var todayString = today.toISOString().split('T')[0];

                var fiveDaysFromNow = new Date();
                fiveDaysFromNow.setDate(today.getDate() + 3);
                var fiveDaysFromNowString = fiveDaysFromNow.toISOString().split('T')[0];

                dateInput.setAttribute('min', todayString);
                dateInput.setAttribute('max', fiveDaysFromNowString);

                // showing the corresponding book name in the review modal
                document.getElementById('add-review-btn').addEventListener('click', function() {
                    document.getElementById('review-book-title').textContent = this.getAttribute('data-book');
                })
            })
        </script>
    @endpush
