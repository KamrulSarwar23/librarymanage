@extends('admin.layouts.master')

@section('content')
    <style>
        th {
            white-space: nowrap;
        }

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
            <h1>Borrow Details</h1>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Borrow Information</h4>
                            <a href="{{ route('offline-book-borrow') }}" class="btn btn-primary">Back to List</a>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- Cover Image -->
                                <div class="col-md-4 text-center">
                                    <img width="200px" height="250px"
                                        src="{{ $borrowBook->book->cover_image ? asset('storage/book/' . $borrowBook->book->cover_image) : asset('frontend/images/book.jpg') }}"
                                        alt="Book Cover" class="shadow-sm">
                                </div>

                                <!-- Book Details -->
                                <div class="col-md-8">
                                    <table class="table table-striped">
                                        <tbody>
                                            <form id="borrowForm{{ $borrowBook->id }}"
                                                action="{{ route('book-borrow.updateInfo', $borrowBook->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select
                                                    class="mb-3 form_select {{ $borrowBook->status == 'pending' ? 'bg-secondary text-white' : '' }} {{ $borrowBook->status == 'receive' ? 'bg-info text-white' : '' }} {{ $borrowBook->status == 'reject' ? 'bg-danger text-white' : '' }} {{ $borrowBook->status == 'return' ? 'bg-success text-white' : '' }}"
                                                    name="status" onchange="submitForm({{ $borrowBook->id }})">
                                                    <option disabled>Select One</option>
                                                    <option value="pending"
                                                        {{ $borrowBook->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="receive"
                                                        {{ $borrowBook->status == 'receive' ? 'selected' : '' }}>Received
                                                    </option>
                                                    <option value="reject"
                                                        {{ $borrowBook->status == 'reject' ? 'selected' : '' }}>Rejected
                                                    </option>
                                                    <option value="return"
                                                        {{ $borrowBook->status == 'return' ? 'selected' : '' }}>Returned
                                                    </option>
                                                </select>

                                            </form>

                                            <tr>
                                                <th>Borrow ID:</th>
                                                <td>{{ $borrowBook->id }}</td>
                                            </tr>

                                            <tr>
                                                <th>User Name:</th>
                                                <td>{{ $borrowBook->user->name }}</td>
                                            </tr>

                                            <tr>
                                                <th>User Email:</th>
                                                <td>{{ $borrowBook->user->email }}</td>
                                            </tr>



                                            <tr>
                                                <th>Book Title:</th>
                                                <td>{{ $borrowBook->book->title }}</td>
                                            </tr>

                                            <tr>
                                                <th>Issued Date:</th>
                                                <td>

                                                    @if (!empty($borrowBook->issued_at))
                                                        {{ \Carbon\Carbon::parse($borrowBook->issued_at)->format('F j, Y, g:i a') }}
                                                    @else
                                                        <span class="text-info">Not Activate Yet</span>
                                                    @endif
                                                </td>
                                            </tr>

                                         <tr>
                                            <th>Due Date:</th>
                                            @if (!empty($borrowBook->due_at))
                                                <td> {{ \Carbon\Carbon::parse($borrowBook->due_at)->format('F j, Y') }}</td>
                                            @else
                                                <td class="text-info">Not Activate Yet</td>
                                            @endif
                                         </tr>

                                       <tr>
                                        <th>Return Date</th>
                                        @if (!empty($borrowBook->returned_at))
                                            <td> {{ \Carbon\Carbon::parse($borrowBook->returned_at)->format('F j, Y, g:i a') }}
                                            </td>
                                        @else
                                            <td class="text-info">Not Return Yet</td>
                                        @endif
                                       </tr>

                                       <tr>
                                        <th>Late Fine</th>
                                        <td><span class="badge badge-danger">{{ $borrowBook->fine}} Taka</span></td>
                                       </tr>


                                            <tr>
                                                <th>Book Location:</th>
                                                <td>
                                                    <span class="badge badge-info">Shelf:
                                                        {{ $borrowBook->book->shelf }}</span>
                                                    <span class="badge badge-info">Row: {{ $borrowBook->book->row }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Category:</th>
                                                <td>{{ $borrowBook->book->category->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Publisher:</th>
                                                <td>{{ $borrowBook->book->publisher->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Author:</th>
                                                <td>{{ $borrowBook->book->author->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>ISBN:</th>
                                                <td>{{ $borrowBook->book->isbn }}</td>
                                            </tr>

                                            <tr>
                                                <th>Book Quantity:</th>
                                                <td>{{ $borrowBook->book->quantities->sum('quantity') }}</td>
                                            </tr>

                                            <tr>
                                                <th>Book Current Quantity:</th>
                                                <td>{{ $borrowBook->book->quantities->sum('current_qty') }}</td>
                                            </tr>


                                            <tr>
                                                <th>Publication Date:</th>
                                                <td>{{ $borrowBook->book->publication_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Number of Pages:</th>
                                                <td>{{ $borrowBook->book->number_of_pages }}</td>
                                            </tr>
                                            <tr>
                                                <th>Summary:</th>
                                                <td>{{ $borrowBook->book->summary }}</td>
                                            </tr>

                                            <tr>
                                                <th>Status:</th>
                                                <td>
                                                    @if (App\Helper\QuantityManage::isQuantityAvailable($borrowBook->book->id))
                                                        <span class="badge bg-primary text-light">Available</span>
                                                    @else
                                                        <span class="badge bg-danger text-light">Not Available</span>
                                                    @endif
                                                </td>
                                            </tr>



                                        </tbody>
                                    </table>
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
