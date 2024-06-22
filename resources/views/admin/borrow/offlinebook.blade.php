@extends('admin.layouts.master')

@section('content')
    <style>
        th,
        td {
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
            <h1>Offline Book Borrow</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Offline Book Borrow</h4>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('offline-book-borrow-store') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Add Book</label>
                                            <select name="book_id" id="bookDropdown" class="form-control select2">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Add User</label>
                                            <select name="user_id" id="userDropdown" class="form-control select2">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input id="bookingDate" type="date" class="form-control" name="due_date"
                                                value="{{ old('due_date') }}">
                                        </div>
                                    </div>

                                </div>



                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>All Offline Book Borrows</h4>
                        </div>
                        <li class="d-flex align-items-center ml-auto mr-5">

                            <a class=" mt-3 mr-3 btn btn-danger py-2" href="{{ route('offline-book-borrow') }}">Clear
                                Search</a>

                            <form action="{{ route('offline-book-borrow-search') }}" method="GET" class="d-flex mt-3">
                                <input class="form-control me-2 mr-2" type="text" placeholder="Search"
                                    name="search_query">
                                <button type="submit" class="btn btn-info py-2"><i class="fas fa-search"></i></button>
                            </form>

                        </li>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Book</th>
                                    <th>Location</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Return Date</th>
                                    {{-- <th>Platform</th> --}}
                                    <th>Fine</th>
                                    <th>Action</th>

                                    @foreach ($offlinebooks as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->user->email }}</td>

                                            <td> <a
                                                    href="{{ route('book.details', $item->book_id) }}">{{ limitText($item->book->title, 20) }}</a>
                                            </td>
                                            <td><span class="badge badge-info">Shelf: {{ $item->book->shelf }}</span> <span class="badge badge-info">Row: {{ $item->book->row }}</span> </td>
                                        </td>
                                            <td>
                                                @if (!empty($item->issued_at))
                                                    {{ \Carbon\Carbon::parse($item->issued_at)->format('F j, Y, g:i a') }}
                                                @else
                                                    <span class="text-info">Not Activate Yet</span>
                                                @endif
                                            </td>

                                            @if (!empty($item->due_at))
                                                <td> {{ \Carbon\Carbon::parse($item->due_at)->format('F j, Y') }}</td>
                                            @else
                                                <td class="text-info">Not Activate Yet</td>
                                            @endif


                                            @if (!empty($item->returned_at))
                                                <td> {{ \Carbon\Carbon::parse($item->returned_at)->format('F j, Y, g:i a') }}
                                                </td>
                                            @else
                                                <td class="text-info">Not Return Yet</td>
                                            @endif

                                            {{-- <td><span class="badge rounded-pill bg-primary">{{ $item->platform }}</span>
                                            </td> --}}


                                            <td><span class="badge badge-danger">{{ $item->fine}} Taka</span></td>

                                            <td>
                                                <form id="borrowForm{{ $item->id }}"
                                                    action="{{ route('book-borrow.updateOfflineInfo', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select
                                                        class="form_select {{ $item->status == 'receive' ? 'bg-info text-white' : '' }} {{ $item->status == 'reject' ? 'bg-danger text-white' : '' }} {{ $item->status == 'return' ? 'bg-success text-white' : '' }}"
                                                        name="status" onchange="submitForm({{ $item->id }})">
                                                        <option disabled>Select One</option>
                                                        {{-- <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>Pending</option> --}}
                                                        <option value="receive"
                                                            {{ $item->status == 'receive' ? 'selected' : '' }}>Receive
                                                        </option>
                                                        <option value="reject"
                                                            {{ $item->status == 'reject' ? 'selected' : '' }}>Reject
                                                        </option>
                                                        <option value="return"
                                                            {{ $item->status == 'return' ? 'selected' : '' }}>Return
                                                        </option>
                                                    </select>

                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>

                                <div class="pagination">
                                    {{ $offlinebooks->links() }}
                                </div>

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


@push('scripts')
    <script>
        $(document).ready(function() {

            function loadBooks() {
                $.ajax({
                    url: '{{ route('ajax.books') }}',
                    method: 'GET',
                    success: function(data) {
                        let dropdown = $('#bookDropdown');
                        dropdown.empty();
                        dropdown.append('<option value="">Select</option>');

                        $.each(data, function(index, book) {
                            dropdown.append('<option value="' + book.id + '">' + book.title +
                                ' (Available Book: ' + book.total_quantity + ')' +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', error);
                    }
                });
            }


            function loadUsers() {
                $.ajax({
                    url: '{{ route('ajax.users') }}',
                    method: 'GET',
                    success: function(data) {
                        let dropdown = $('#userDropdown');
                        dropdown.empty();
                        dropdown.append('<option value="">Select</option>');

                        $.each(data, function(index, user) {
                            dropdown.append('<option value="' + user.id + '">' + user.email +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', error);
                    }
                });
            }
            // Load books on page load
            loadBooks();
            loadUsers();
        });
    </script>

    <script>
        // **** Work with date *****
        document.addEventListener('DOMContentLoaded', function() {
            var dateInput = document.getElementById('bookingDate');

            var today = new Date();
            var todayString = today.toISOString().split('T')[0];

            var DaysFromNow = new Date();

            var borrowDays = {{ @$policy->days }};

            DaysFromNow.setDate(today.getDate() + borrowDays);

            var DaysFromNowString = DaysFromNow.toISOString().split('T')[0];

            dateInput.setAttribute('min', todayString);
            dateInput.setAttribute('max', DaysFromNowString);
        })
    </script>
@endpush
