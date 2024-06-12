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

                        {{--  <div class="card-header">
                            <h4>Create New User</h4>
                            <div class="card-header-action">
                                <a href="{{ route('user-manage.create') }}" class="btn btn-info">Create New User</a>
                            </div>
                        </div>  --}}
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
                                            <input type="date" class="form-control" name="due_date"
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


                                            @if (!empty($item->issued_at))
                                                <td>{{ $item->issued_at }}</td>
                                            @else
                                                <td class="text-info">Not Activate Yet</td>
                                            @endif


                                            @if (!empty($item->due_at))
                                                <td>{{ $item->due_at }}</td>
                                            @else
                                                <td class="text-info">Not Activate Yet</td>
                                            @endif


                                            @if (!empty($item->returned_at))
                                                <td>{{ $item->returned_at }}</td>
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

                                                    <button type="submit" class="btn btn-primary applied">Update</button>
                                                </form>

                                            </td>

                                        </tr>
                                    @endforeach



                                </table>

                                <div class="pagination">

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
                            dropdown.append('<option value="' + book.id + '">' + book.title +
                                '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ', error);
                    }
                });
            };

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
@endpush
