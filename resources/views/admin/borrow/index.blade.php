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


        li {
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
            <h1>Borrow Request</h1>


        </div>


        <div class="section-body">

            <div class="row">
                <div class="col-md-12">

                    <div class="card">



                        <li class="d-flex align-items-center ml-auto mr-5">



                            <div class="dropdown">
                                <button class="btn btn-info dropdown-toggle py-2 mt-3 mr-3" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    Filter By Status
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item btn-info {{ request()->routeIs('borrow-book-filter-by-status') && request('status') === 'return' ? 'active' : '' }}"
                                            href="{{ route('borrow-book-filter-by-status', ['status' => 'return']) }}">Returned</a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item btn-info {{ request()->routeIs('borrow-book-filter-by-status') && request('status') === 'active' ? 'active' : '' }}"
                                            href="{{ route('borrow-book-filter-by-status', ['status' => 'active']) }}">Active</a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item btn-info {{ request()->routeIs('borrow-book-filter-by-status') && request('status') === 'pending' ? 'active' : '' }}"
                                            href="{{ route('borrow-book-filter-by-status', ['status' => 'pending']) }}">Pending</a>
                                    </li>

                                    <li>
                                        <a class="dropdown-item btn-info {{ request()->routeIs('borrow-book-filter-by-status') && request('status') === 'reject' ? 'active' : '' }}"
                                            href="{{ route('borrow-book-filter-by-status', ['status' => 'reject']) }}">Rejected</a>
                                    </li>

                                </ul>

                            </div>

                            <a class=" mt-3 mr-3 btn btn-danger py-2" href="{{ route('book.borrowinfo') }}">Clear Search</a>
                            <form action="{{ route('book.borrow-search') }}" method="GET" class="d-flex mt-3">
                                <input class="form-control me-2 mr-2" type="text" placeholder="Search"
                                    name="search_query">
                                <button type="submit" class="btn btn-info py-2"><i
                                        class="fas fa-search"></i></button>
                            </form>

                        </li>



                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">

                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Book Name</th>
                                    <th>Request Time</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                    @foreach ($borrowedBooks as $book)
                                        <tr>

                                            <td>{{ $book->user->name }}</td>
                                            <td>{{ $book->user->email }}</td>
                                            <td>{{ $book->book->title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($book->created_at)->format('F j, Y, g:i a') }}</td>

                                            @if ($book->issued_at !== null)
                                                 <td>{{ \Carbon\Carbon::now()->format('F j, Y') }}</td>
                                            @else
                                                <td class="text-danger">Need To Update</td>
                                            @endif

                                            @if ($book->due_at !== null)
                                                <td>{{ \Carbon\Carbon::parse($book->due_at)->format('F j, Y') }}</td>
                                            @else
                                                <td class="text-danger">Need To Update</td>
                                            @endif

                                            @if ($book->returned_at !== null)
                                                <td>{{ \Carbon\Carbon::parse($book->returned_at)->format('F j, Y') }}
                                                </td>
                                            @else
                                                <td class="text-danger">Not Return Yet</td>
                                            @endif

                                            <td>
                                                @if ($book->status == 'active')
                                                    <button class="badge badge-pill badge-success">Active</button>
                                                @elseif($book->status == 'pending')
                                                    <button class="badge badge-pill badge-info">Pending</button>
                                                @elseif($book->status == 'return')
                                                    <button class="badge badge-pill badge-primary">Return</button>
                                                @else
                                                <button class="badge badge-pill badge-danger">Reject</button>
                                                @endif
                                            </td>

                                            <td>
                                                <a class="btn btn-info py-2 mr-2"
                                                    href="{{ route('book-borrow.edit', $book->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>

                                                <a class="delete-item btn btn-danger py-2"
                                                    href="{{ route('book.borrow-delete', $book->id) }}"><i
                                                        class="fas fa-trash"></i></a>

                                            </td>

                                        </tr>
                                    @endforeach

                                    @if ($borrowedBooks->isEmpty())
                                        <div class="alert alert-danger mt-5" role="alert">
                                            No Data Found
                                        </div>
                                    @endif

                                </table>


                                <div class="pagination">
                                    {{ $borrowedBooks->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
