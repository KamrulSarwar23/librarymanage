@extends('admin.layouts.master')

@section('content')
    <style>
        .form-select {
            width: 100%;
            padding: .375rem 1.75rem .375rem .75rem;
            font-size: 1rem;
            line-height: 1.5;
            color: #ffffff;
            background-color: #6abed8;
            background-clip: padding-box;
            border: 1px solid #dad3ce;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-select:focus {
            border-color: #5096e0;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .form-select option {
            padding: 10px;
        }

        td {
            white-space: nowrap;
        }

        th {
            white-space: nowrap;
        }

        form {
            margin-top: -10px;
        }
    </style>
    <section class="section">
        <div class="section-header">
            <h1>Book</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Book</h4>
                            <div class="card-header-action">
                                <a href="{{ route('book.create') }}" class="btn btn-info">Create New</a>
                            </div>
                        </div>

                        <div class="custom-nav">
                            <ul class="nav">
                                <li>
                                    <div class="dropdown mt-2 m-2">
                                        <button class="btn btn-info dropdown-toggle py-2" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Category
                                        </button>
                                        <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto;">
                                            @foreach ($category as $item)
                                                <li><a class="dropdown-item btn-info"
                                                        href="{{ route('admin.book-by-category', $item->id) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>


                                <li>
                                    <div class="dropdown mt-2 m-2">
                                        <button class="btn btn-info dropdown-toggle  py-2" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Author
                                        </button>
                                        <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto;">
                                            @foreach ($author as $item)
                                                <li><a class="dropdown-item btn-info"
                                                        href="{{ route('admin.book-by-author', $item->id) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <div class="dropdown m-2">
                                        <button class="btn btn-info dropdown-toggle  py-2" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Publishers
                                        </button>
                                        <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto;">
                                            @foreach ($publisher as $item)
                                                <li><a class="dropdown-item btn-info"
                                                        href="{{ route('admin.book-by-publisher', $item->id) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <div class="dropdown mt-2 mb-3 ml-2">
                                        <button class="btn btn-info dropdown-toggle  py-2" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Status
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item btn-info"
                                                    href="{{ route('books.filterByStatus', ['status' => 'available']) }}">Available</a>
                                            </li>
                                            <li><a class="dropdown-item btn-info"
                                                    href="{{ route('books.filterByStatus', ['status' => 'lost']) }}">Lost</a>
                                            </li>
                                            <li><a class="dropdown-item btn-info"
                                                    href="{{ route('books.filterByStatus', ['status' => 'reserved']) }}">Reserved</a>
                                            </li>
                                            <li><a class="dropdown-item btn-info"
                                                    href="{{ route('books.filterByStatus', ['status' => 'checked_out']) }}">Checked
                                                    Out</a></li>
                                        </ul>
                                    </div>
                                </li>

                                <form action="{{ route('books.filterByDate') }}" method="GET" class="form-inline ml-2">
                                    <div class="form-group mx-sm-1">
                                        <label for="start_date" class="sr-only">Start Date</label>
                                        <input type="date" name="start_date" id="start_date"
                                            value="{{ old('start_date') }}" class="form-control" placeholder="Start Date">
                                    </div>

                                    <div class="form-group mx-sm-2">
                                        <label for="end_date" class="sr-only">End Date</label>
                                        <input type="date" name="end_date" id="end_date"
                                            value="{{ old('end_date') }}"class="form-control" placeholder="End Date">
                                    </div>

                                    <button type="submit" class="btn btn-info py-2"><i class="fas fa-search"></i></button>
                                </form>




                                <li>
                                    <div class="dropdown ml-2 mt-2">
                                        <button class="btn btn-danger py-2">
                                            <a style="text-decoration: none; color:white"
                                                href="{{ route('book.index') }}">Clear</a>
                                        </button>

                                    </div>
                                </li>

                            </ul>
                        </div>


                        @if (isset($categoryName))
                            <div class="ml-3 mt-3 text-success">
                                <h6>Search results for: "{{ $categoryName->name }}"</h6>
                            </div>
                        @endif

                        @if (isset($status))
                            <div class="ml-3 mt-3 text-success">
                                <h6>Search results for: '{{ $status }}'</h6>
                            </div>
                        @endif

                        @if (isset($dateRange))
                            <div class="ml-3 mt-3 text-success">
                                @foreach ($dateRange as $item)
                                    <h6>Search results for: '{{ $item }}'</h6>
                                @endforeach

                            </div>
                        @endif


                        @if (isset($authorName))
                            <div class="text-success mt-3 ml-3">
                                <h6>Search results for: "{{ $authorName->name }}"</h6>
                            </div>
                        @endif

                        @if (isset($publisherName))
                            <div class="text-success mt-3 ml-3">
                                <h6>Search results for: "{{ $publisherName->name }}"</h6>
                            </div>
                        @endif




                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Cover Image</th>
                                    <th>Title</th>
                                    <th>Category Name</th>
                                    <th>Publisher Name</th>
                                    <th>Author Name</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            <td><img width="80px" height="80px" class="py-2"
                                                    src="{{ asset('storage/book/' . $book->cover_image) }}" alt="">
                                            </td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->category->name }}</td>
                                            <td>{{ $book->publisher->name }}</td>
                                            <td>{{ $book->author->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($book->created_at)->format('F j, Y, g:i a') }}
                                            </td>
                                            <td>
                                                <select class="form-select status-select" data-id="{{ $book->id }}">
                                                    <option value="reserved"
                                                        {{ $book->status == 'reserved' ? 'selected' : '' }}>Reserved
                                                    </option>
                                                    <option value="checked_out"
                                                        {{ $book->status == 'checked_out' ? 'selected' : '' }}>Checked Out
                                                    </option>
                                                    <option value="available"
                                                        {{ $book->status == 'available' ? 'selected' : '' }}>Available
                                                    </option>
                                                    <option value="lost" {{ $book->status == 'lost' ? 'selected' : '' }}>
                                                        Lost</option>
                                                </select>
                                            </td>



                                            <td><a class="btn btn-info" href="{{ route('book.edit', $book->id) }}"><i
                                                        class="fas fa-edit"></i></a>
                                            </td>

                                            <td>

                                                <a class="delete-item btn btn-danger"
                                                    href="{{ route('book.destroy', $book->id) }}"><i
                                                        class="fas fa-trash"></i></a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    @if ($books->isEmpty())
                                        <div class="alert alert-danger mt-5" role="alert">
                                            No data found.
                                        </div>
                                    @endif

                                </table>

                                <div class="pagination">
                                    {{ $books->links() }}
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
            $('body').on('change', '.status-select', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('book.status') }}",
                    method: 'PUT',
                    data: {
                        status: status,
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
