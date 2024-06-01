@extends('admin.layouts.master')

@section('content')
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

        li{
            list-style-type: none
        }
        td {
            white-space: nowrap;
        }

        th {
            white-space: nowrap;
        }
    </style>


    <section class="section">
        <div class="section-header">
            <h1>Reviews</h1>

        </div>

        <div class="section-body">

            <li>
                <div class="dropdown mt-2 mb-3">
                    <button class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filter Reviews
                    </button>

                    <ul class="dropdown-menu">
                         <li><a class="dropdown-item btn-info {{ request()->routeIs('admin.book-review') ? 'active' : '' }}" href="{{ route('admin.book-review') }}">All</a></li>
                            <li><a class="dropdown-item btn-info {{ request()->routeIs('active.review') ? 'active' : '' }}" href="{{ route('active.review') }}">Active</a></li>
                            <li><a class="dropdown-item btn-info {{ request()->routeIs('pending.review') ? 'active' : '' }}" href="{{ route('pending.review') }}">Pending</a></li>
                    </ul>
                </div>
            </li>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>Book Name</th>
                                    <th>Comment</th>
                                    <th>Rating</th>
                                    <th>Comment Date</th>
                                    <th>Status</th>
                                    <th>Delete</th>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>{{ $review->id }}</td>
                                            <td>{{ $review->user->name }}</td>
                                            <td>{{ $review->book->title }}</td>
                                            <td>{{ $review->comment }}</td>
                                            <td>
                                                <div class="mb-3">
                                                    <div class="star-rating d-inline-flex"
                                                        title="Rating: {{ $review->rating }}">
                                                        <div class="back-stars">

                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                            @endfor

                                                            <div class="front-stars" style="width: {{ $review->rating * 20 }}%">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                                @endfor
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <td>{{ \Carbon\Carbon::parse($review->created_at)->format('F j, Y, g:i a') }}
                                            </td>

                                            <td>
                                                @if ($review->status == 'active')
                                                    <label class="custom-switch">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $review->id }}"
                                                            id="flexSwitchCheckDefault{{ $review->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $review->id }}"
                                                            id="flexSwitchCheckDefault{{ $review->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>

                                            <td>

                                                <a class="delete-item btn btn-danger"
                                                    href="{{ route('book-reviews.delete', $review->id) }}"><i class="fas fa-trash"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach
                                    @if ($reviews->isEmpty())
                                    <div class="alert alert-danger mt-5" role="alert">
                                        No Data Found
                                    </div>
                                    @endif
                                </table>

                                <div class="pagination">
                                    {{ $reviews->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('book-reviews.status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
