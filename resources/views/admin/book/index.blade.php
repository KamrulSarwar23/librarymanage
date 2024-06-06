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

        .card-body {}
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
                        <div class="card-body shadow-lg p-3 mb-5 bg-body-tertiary rounded">
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
                                                    <li><a class="dropdown-item btn-info {{ request()->routeIs('admin.book-by-category') && request()->route('id') == $item->id ? 'active' : '' }}"
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
                                                    <li><a class="dropdown-item btn-info {{ request()->routeIs('admin.book-by-author') && request()->route('id') == $item->id ? 'active' : '' }}"
                                                            href="{{ route('admin.book-by-author', $item->id) }}">{{ $item->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="dropdown m-2">
                                            <button class="btn btn-info dropdown-toggle py-2" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Publishers
                                            </button>
                                            <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto;">
                                                @foreach ($publisher as $item)
                                                    <li>
                                                        <a class="dropdown-item btn-info {{ request()->routeIs('admin.book-by-publisher') && request()->route('id') == $item->id ? 'active' : '' }}"
                                                            href="{{ route('admin.book-by-publisher', $item->id) }}">{{ $item->name }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>


                                    <li>
                                        <div class="dropdown mt-2 mb-3 ml-2">
                                            <button class="btn btn-info dropdown-toggle py-2" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Status
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item btn-info {{ request()->routeIs('books.filterByStatus') && request('status') === 'available' ? 'active' : '' }}"
                                                        href="{{ route('books.filterByStatus', ['status' => 'available']) }}">Available</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item btn-info {{ request()->routeIs('books.filterByStatus') && request('status') === 'not_available' ? 'active' : '' }}"
                                                        href="{{ route('books.filterByStatus', ['status' => 'not_available']) }}">Not
                                                        Available</a>
                                                </li>
                                            </ul>

                                        </div>
                                    </li>

                                    <li>
                                        <div class="dropdown ml-3 mt-2 mb-3">
                                            <button class="btn btn-info dropdown-toggle py-2" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Preview
                                            </button>

                                            <ul class="dropdown-menu">

                                                <li><a class="dropdown-item btn-info {{ request()->routeIs('active.book') ? 'active' : '' }}"
                                                        href="{{ route('active.book') }}">Active</a></li>
                                                <li><a class="dropdown-item btn-info {{ request()->routeIs('inactive.book') ? 'active' : '' }}"
                                                        href="{{ route('inactive.book') }}">Inactive</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="dropdown mt-2 mb-3 ml-3">
                                            <button class="btn btn-info dropdown-toggle py-2" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                Type
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item btn-info {{ request()->routeIs('books.filterByType') && request('type') === 'popular' ? 'active' : '' }}"
                                                        href="{{ route('books.filterByType', ['type' => 'popular']) }}">Popular</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item btn-info {{ request()->routeIs('books.filterByType') && request('type') === 'recent' ? 'active' : '' }}"
                                                        href="{{ route('books.filterByType', ['type' => 'recent']) }}">Recent</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item btn-info {{ request()->routeIs('books.filterByType') && request('type') === 'featured' ? 'active' : '' }}"
                                                        href="{{ route('books.filterByType', ['type' => 'featured']) }}">Featured</a>
                                                </li>

                                                <li>
                                                    <a class="dropdown-item btn-info {{ request()->routeIs('books.filterByType') && request('type') === 'recommended' ? 'active' : '' }}"
                                                        href="{{ route('books.filterByType', ['type' => 'recommended']) }}">Recommended</a>
                                                </li>

                                            </ul>

                                        </div>
                                    </li>



                                    <form action="{{ route('books.filterByDate') }}" method="GET"
                                        class="form-inline ml-2">
                                        <div class="form-group mx-sm-1 mr-2">
                                            <label for="start_date" class="sr-only">Start Date</label>
                                            <input type="date" name="start_date" id="start_date"
                                                value="{{ old('start_date') }}" class="form-control"
                                                placeholder="Start Date">
                                        </div>

                                        <div class="form-group mx-sm-2">
                                            <label for="end_date" class="sr-only">End Date</label>
                                            <input type="date" name="end_date" id="end_date"
                                                value="{{ old('end_date') }}"class="form-control" placeholder="End Date">
                                        </div>

                                        <button type="submit" class="btn btn-info py-2"><i
                                                class="fas fa-search"></i></button>
                                    </form>


                                    <li>
                                        <div class="dropdown ml-2 mt-2">
                                            <button class="btn btn-danger py-2">
                                                <a style="text-decoration: none; color:white"
                                                    href="{{ route('book.index') }}">Clear All Filter</a>
                                            </button>

                                        </div>
                                    </li>

                                    <li class="d-flex align-items-center ml-auto mr-5">
                                        <form action="{{ route('books.search-by-query') }}" method="GET" class="d-flex">
                                            <input class="form-control me-2 mr-2" type="text" placeholder="Search"
                                                name="search_query">
                                            <button type="submit" class="btn btn-info py-2"><i
                                                    class="fas fa-search"></i></button>
                                        </form>
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

                            @if (isset($type))
                                <div class="ml-3 mt-3 text-success">
                                    <h6>Search results for: '{{ $type }}'</h6>
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
                        </div>

                        <div class="card-body shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Cover Image</th>
                                    <th>Title</th>
                                    <th>Category Name</th>
                                    <th>Publisher Name</th>
                                    <th>Author Name</th>
                                    <th>Quantity</th>
                                    <th>Current Quantity</th>
                                    <th>Status</th>
                                    <th>Type</th>
                                    <th>Preview</th>
                                    <th>Action</th>
                                    {{-- <th>Delete</th> --}}


                                    @foreach ($books as $key => $book)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img width="80px" height="80px" class="py-2"
                                                    src="{{ asset('storage/book/' . $book->cover_image) }}"
                                                    alt="">
                                            </td>
                                            <td><a href="{{ route('book.details', $book->id) }}">{{ $book->title }}</a>
                                            </td>
                                            <td>

                                                <span
                                                    class="badge rounded-pill bg-info text-dark">{{ $book->category->name }}</span>
                                            </td>
                                            {{-- <td>{{ $book->category->name }}</td> --}}
                                            <td>{{ $book->publisher->name }}</td>
                                            <td>{{ $book->author->name }}</td>
                                            <td>{{ $book->quantity }}</td>
                                            <td>{{ $book->current_quantity }}</td>
                                            {{-- <td>{{ \Carbon\Carbon::parse($book->created_at)->format('F j, Y, g:i a') }} --}}
                                            </td>

                                            <td>
                                                @if (App\Helper\QuantityManage::isQuantityAvailable($book->id))
                                                    <span class="badge rounded-pill bg-primary text-light">Available</span>
                                                @else
                                                    <span class="badge rounded-pill bg-danger text-light">Not
                                                        Available</span>
                                                @endif
                                            </td>

                                            {{-- <td>
                                                <select class="form-select status-select" data-id="{{ $book->id }}">

                                                    <option value="available"
                                                        {{ $book->status == 'available' ? 'selected' : '' }}>Available
                                                    </option>

                                                    <option value="not_available"
                                                        {{ $book->status == 'not_available' ? 'selected' : '' }}>Not
                                                        Available
                                                    </option>
                                                </select>
                                            </td> --}}
                                            <td>
                                                <select class="form-select type-select" data-id="{{ $book->id }}">

                                                    <option value="popular"
                                                        {{ $book->type == 'popular' ? 'selected' : '' }}>Popular
                                                    </option>

                                                    <option value="recent"
                                                        {{ $book->type == 'recent' ? 'selected' : '' }}>
                                                        Recent
                                                    </option>

                                                    <option value="featured"
                                                        {{ $book->type == 'featured' ? 'selected' : '' }}>Featured
                                                    </option>

                                                    <option value="recommended"
                                                        {{ $book->type == 'recommended' ? 'selected' : '' }}>Recommended
                                                    </option>

                                                </select>

                                            </td>

                                            <td>
                                                @if ($book->preview == 'active')
                                                    <label class="custom-switch">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $book->id }}"
                                                            id="flexSwitchCheckDefault{{ $book->id }}"
                                                            class="custom-switch-input preview-change">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $book->id }}"
                                                            id="flexSwitchCheckDefault{{ $book->id }}"
                                                            class="custom-switch-input preview-change">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-info mr-2"
                                                    href="{{ route('book.edit', $book->id) }}"><i
                                                        class="fas fa-edit"></i></a>

                                                <a class="delete-item btn btn-danger mr-2"
                                                    href="{{ route('book.destroy', $book->id) }}"><i
                                                        class="fas fa-trash"></i></a>

                                                {{-- quantity.index --}}

                                                <div class="btn-group dropleft">
                                                    <a class="text-info mx-2" type="button" id="dropdownMenuButton"
                                                        data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        <h5><i class="fa fa-ellipsis-vertical"></i></h5>
                                                    </a>
                                                    <div class="dropdown-menu border bg-secondary"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('quantity.index', $book->id) }}">Add Qty</a>
                                                        <a class="dropdown-item" href="#">Book Inventory</a>
                                                    </div>
                                                </div>

                                            </td>

                                        </tr>
                                    @endforeach

                                    @if ($books->isEmpty())
                                        <div class="alert alert-danger mt-5" role="alert">
                                            No Data Found
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

            $('body').on('change', '.type-select', function() {
                let type = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('book.type.change') }}",
                    method: 'PUT',
                    data: {
                        type: type,
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


            $('body').on('click', '.preview-change', function() {

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('book.preview.change') }}",
                    method: 'PUT',
                    data: {
                        preview: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = 'An error occurred';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        toastr.error(errorMessage);
                    }
                });
            });
        });
    </script>
@endpush
