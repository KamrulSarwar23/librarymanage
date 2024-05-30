@extends('frontend.master')

@section('section')
    <style>
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
    </style>

    <div class="container mt-3 ">
        <div class="row justify-content-center d-flex mt-5">
            <div class="col-md-12">
                <a href="{{ route('home.page') }}" class="text-decoration-none text-dark ">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> &nbsp; <strong>Back to books</strong>
                </a>
                <div class="row mt-4">

                    <div class="col-md-4">
                        <img height="450px" src="{{ asset('storage/book/' . $booksdetails->cover_image) }}" alt=""
                            class="card-img-top">
                    </div>

                    <div class="col-md-8">
                        <h3 class="h2 mb-3">{{ $booksdetails->title }}</h3>
                        <p class="h4 text-muted">Author: {{ $booksdetails->author->name }}</p>
                        <p>Category: {{ $booksdetails->category->name }}</p>
                        <p>Publisher: {{ $booksdetails->publisher->name }}</p>
                        <div class="star-rating d-inline-flex ml-2" title="">
                            <div class="star-rating d-inline-flex mx-2" title="">
                                <span
                                    class="rating-text theme-font theme-yellow mx-1">({{ round($booksdetails->rating->avg('rating'), 1) }})
                                </span>
                                
                                <div class="back-stars">
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


                        <div class="col-md-12 pt-2">
                            <hr>
                        </div>

                        <div class="row pb-5">
                            <div class="col-md-12  mt-4">

                                <div class="d-flex justify-content-between">
                                    <h3>Reviews</h3>
                                    <div>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#staticBackdrop">
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



                    @foreach ($enjoyedbook as $item)
                        <div class="col-md-3 col-lg-3 mb-4 enjoyedbook">
                            <a class="text-dark" href="{{ route('book.details', $item->id) }}">
                                <div class="card border-0 shadow-lg">
                                    <img height="250px" src="{{ asset('storage/book/' . $item->cover_image) }}"
                                        alt="" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="h4 heading">{{ limitText($item->title, 25) }}</h3>
                                        {{-- <p>{{ $item->author->name }}</p> --}}
                                        <div class="star-rating d-inline-flex ml-2" title="">
                                            <span
                                                class="rating-text theme-font theme-yellow">({{ round($item->rating->avg('rating'), 1) }})</span>
                                            <div class="star-rating d-inline-flex mx-2" title="">
                                                <div class="back-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="fa fa-star" aria-hidden="true"></i>
                                                    @endfor
                                                    <div class="front-stars"
                                                        style="width: {{ ($item->rating->avg('rating') / 5) * 100 }}%">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            @if ($i <= $item->rating->avg('rating') * 20)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            @else
                                                                <i class="fa fa-star-o" aria-hidden="true"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                            <span class="theme-font text-muted">({{ $item->rating->count('rating') }}
                                                Reviews)</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
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
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Review for <strong>Atomic Habits</strong>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('send.review') }}" method="POST" id="reviewForm">
                        @csrf
                        <div class="mb-3">
                            <label for="review" class="form-label">Review</label>
                            <textarea name="comment" id="review" class="form-control" cols="5" rows="5" placeholder="Review"></textarea>
                        </div>
                        <div class="rating mb-3" style="width: 10rem">

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
@endpush
