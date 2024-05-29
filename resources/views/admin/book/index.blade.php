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
                                <a href="{{ route('book.create') }}" class="btn btn-primary">Create New</a>
                            </div>
                        </div>
                        <div class="custom-nav">
                            <ul class="nav">
                                 <li>
                                    <div class="dropdown mt-2 m-2">
                                        <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Category
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach ($category as $item)
                                                <li><a class="dropdown-item"
                                                        href="{{ route('admin.book-by-category', $item->id) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <div class="dropdown mt-2 m-2">
                                        <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Author
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach ($author as $item)
                                                <li><a class="dropdown-item"
                                                        href="{{ route('admin.book-by-author', $item->id) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>

                                <li>
                                    <div class="dropdown mt-2">
                                        <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            Publishers
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach ($publisher as $item)
                                                <li><a class="dropdown-item"
                                                        href="{{ route('admin.book-by-publisher', $item->id) }}">{{ $item->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <div class="dropdown m-2">
                                        <button class="btn btn-danger">
                                            <a style="text-decoration: none; color:white"
                                                href="{{ route('book.index') }}">Clear</a>
                                        </button>

                                    </div>
                                </li>

                            </ul>
                        </div>


                        @if (isset($categoryName))
                            <div class="text-success">
                                <h6>Search results for: "{{ $categoryName->name }}"</h6>
                            </div>
                        @endif


                        @if (isset($authorName))
                            <div class="text-success mt-3">
                                <h6>Search results for: "{{ $authorName->name }}"</h6>
                            </div>
                        @endif

                        @if (isset($publisherName))
                            <div class="text-success">
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



                                            <td><a class="btn btn-primary"
                                                    href="{{ route('book.edit', $book->id) }}">Edit</a>
                                            </td>

                                            <td>

                                                <a class="delete-item btn btn-danger"
                                                    href="{{ route('book.destroy', $book->id) }}">Delete</a>

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
