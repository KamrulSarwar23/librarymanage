@extends('admin.layouts.master')

@section('content')
    <style>
        th,
        td {
            white-space: nowrap;
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
                                    <th>User</th>
                                    <th>Book</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Return Date</th>
                                    <th>Platform</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                    @foreach ($offlinebooks as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->user->email }}</td>
                                            <td>{{ $item->book->title }}</td>

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
                                            <td> {{ \Carbon\Carbon::parse($item->returned_at)->format('F j, Y, g:i a') }}</td>
                                            @else
                                                <td class="text-info">Not Return Yet</td>
                                            @endif

                                            <td><span class="badge rounded-pill bg-primary">{{ $item->platform }}</span></td>

                                            <td>
                                                @if ($item->status == 'return')
                                                    <span class="badge rounded-pill bg-info">Return</span>
                                                @else
                                                <span class="badge rounded-pill bg-success">Active</span>
                                                @endif
                                            </td>

                                            <td>
                                                <form id="updateForm" action="{{ route('offline-book-borrow-update', $item->id) }}" method="POST">
                                                    @csrf

                                                    @if ($item->status=='receive')
                                                    <button type="submit" class="btn btn-info applied">Update</button>
                                                    @else
                                                    <button type="submit" class="btn btn-info">Book Returned</button>
                                                    @endif

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
                            dropdown.append('<option value="' + book.id + '">' + book.title + ' (Available Book: ' + book.total_quantity +')' + '</option>');
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

            var fiveDaysFromNow = new Date();

             var borrowDays = {{ @$policy->days }};

            fiveDaysFromNow.setDate(today.getDate() + borrowDays);

            var fiveDaysFromNowString = fiveDaysFromNow.toISOString().split('T')[0];

            dateInput.setAttribute('min', todayString);
            dateInput.setAttribute('max', fiveDaysFromNowString);
        })
    </script>
@endpush
