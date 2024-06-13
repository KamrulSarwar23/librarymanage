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

        /* Style for the select element */
        .form_select {
            padding: 5px 8px;
            font-size: 16px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
            color: #495057;

        }

        /* Style for the select element when focused */
        .form_select:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
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

                        @if (!request()->status)
                            <li class="d-flex align-items-center ml-auto mr-5">

                                <a class=" mt-3 mr-3 btn btn-danger py-2" href="{{ route('book.borrowinfo') }}">Clear
                                    Search</a>

                                <form action="{{ route('book.borrow-search') }}" method="GET" class="d-flex mt-3">
                                    <input class="form-control me-2 mr-2" type="text" placeholder="Search"
                                        name="search_query">
                                    <button type="submit" class="btn btn-info py-2"><i class="fas fa-search"></i></button>
                                </form>

                            </li>
                        @endif


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Book</th>
                                
                                    <th>Platform</th>
                                    <th>Request Time</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Return Date</th>
                                    <th style="width: 20%">Status</th>

                                    @foreach ($borrowedBooks as $index => $book)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $book->user->name }}</td>
                                            <td>{{ $book->user->email }}</td>
                                            <td>{{ $book->book->title }}</td>
                                  
                                            <td><span class="badge rounded-pill bg-info">{{ $book->platform }}</span></td>
                                            <td>{{ \Carbon\Carbon::parse($book->created_at)->format('F j, Y, g:i a') }}
                                            </td>

                                            @if ($book->issued_at !== null)
                                                <td>{{ \Carbon\Carbon::now()->format('F j, Y') }}</td>
                                            @else
                                                <td class="text-danger">Need To Approve</td>
                                            @endif


                                            @if ($book->due_at !== null)
                                                <td>{{ \Carbon\Carbon::parse($book->due_at)->format('F j, Y') }}</td>
                                            @else
                                                <td class="text-danger">Need To Approve</td>
                                            @endif


                                            @if ($book->returned_at !== null)
                                                <td>{{ \Carbon\Carbon::parse($book->returned_at)->format('F j, Y') }}
                                                </td>
                                            @else
                                                <td class="text-danger">Not Return Yet</td>
                                            @endif
                                            

                                            <td>
                                                <form id="borrowForm{{ $book->id }}"
                                                    action="{{ route('book-borrow.updateInfo', $book->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select class="form_select {{ $book->status == 'pending' ? 'bg-secondary text-white' : '' }} {{ $book->status == 'receive' ? 'bg-info text-white' : '' }} {{ $book->status == 'reject' ? 'bg-danger text-white' : '' }} {{ $book->status == 'return' ? 'bg-success text-white' : '' }}"
                                                        name="status"
                                                        onchange="submitForm({{ $book->id }})">
                                                    <option disabled>Select One</option>
                                                    <option value="pending" {{ $book->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="receive" {{ $book->status == 'receive' ? 'selected' : '' }}>Receive</option>
                                                    <option value="reject" {{ $book->status == 'reject' ? 'selected' : '' }}>Reject</option>
                                                    <option value="return" {{ $book->status == 'return' ? 'selected' : '' }}>Return</option>
                                                </select>
                                                
                                                </form>
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

    <script>
        function submitForm(bookId) {
            document.getElementById('borrowForm' + bookId).submit();
        }
    </script>
@endsection
