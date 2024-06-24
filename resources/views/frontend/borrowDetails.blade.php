@extends('frontend.master')

@section('content')
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .section {
            padding: 20px;
        }

        .section-header h1 {
            text-align: center;
        }

        .section-body {
            display: flex;
            justify-content: center;
        }

        .card {
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            width: 100%;
            max-width: 1100px;
            margin: 20px;
        }

        .card-header {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h4 {
            margin: 0;
        }

        .card-header a {
            color: white;
            text-decoration: none;
            background: #44d18f;
            padding: 5px 10px;
            border-radius: 4px;
        }

        .card-body {
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-md-4,
        .col-md-8 {
            padding: 10px;
        }

        .col-md-4 {
            flex: 0 0 33.333%;
            text-align: center;
        }

        .col-md-8 {
            flex: 0 0 66.666%;
        }

        .table {
            width: 100%;
            border-collapse: collapse;

        }

        .table th,
        .table td {
            text-align: left;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            padding: 12px 8px;
        }


        .table th {
            white-space: nowrap;
        }

        .badge {
            display: inline-block;
            padding: 0.25em 0.4em;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
        }

        .badge-info {
            background-color: #17a2b8;
            color: white;
        }

        .badge-danger {
            background-color: #dc3545;
            color: white;
        }

        .badge-primary {
            background-color: #007bff;
            color: white;
        }

        .text-info {
            color: #17a2b8;
        }

        .text-light {
            color: white;
        }

        .bg-primary {
            background-color: #007bff;
        }

        .bg-danger {
            background-color: #dc3545;
        }
    </style>

    <body>

        <section class="section">
            <div class="section-header">
                <h1>Borrow Information</h1>
            </div>

            <div class="section-body">
                <div class="card">
                    <div class="card-header">
                        <h4>Book Information</h4>
                        <a href="{{ route('user.dashboard') }}">Back to List</a>

                    </div>

                    <div class="card-body">

                        <div class="row">


                            <!-- Cover Image -->
                            <div class="col-md-4">
                                <img width="200px" height="250px"
                                    src="{{ $borrowBook->book->cover_image ? asset('storage/book/' . $borrowBook->book->cover_image) : asset('frontend/images/book.jpg') }}"
                                    alt="Book Cover" class="shadow-sm">
                            </div>

                            <!-- Book Details -->
                            <div class="col-md-8">

                                <table class="table table-striped">
                                    <tbody>
                                        
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
                                            <th>Request Date:</th>
                                            <td>
                                                @if (!empty($borrowBook->created_at))
                                                    {{ \Carbon\Carbon::parse($borrowBook->created_at)->format('F j, Y, g:i a') }}
                                                @else
                                                    <span class="text-info">Not Activate Yet</span>
                                                @endif
                                            </td>
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
                                            <td><span class="badge badge-danger">{{ $borrowBook->fine }} Taka</span></td>
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
                                            @if ($borrowBook->status == 'reject')
                                                <td><span class="badge badge-danger">Rejected</span>
                                                </td>
                                            @elseif ($borrowBook->status == 'pending')
                                                <td><span class="badge badge-info">Pending</span></td>
                                            @elseif ($borrowBook->status == 'receive')
                                                <td><span class="badge badge-success">Received</span></td>
                                            @elseif ($borrowBook->status == 'return')
                                                <td><span class="badge badge-primary">Returned</span>
                                                </td>
                                            @endif
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </body>
@endsection
