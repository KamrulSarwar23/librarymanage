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
                                <div class="form-group">
                                    <label>Add Books</label>

                                    <select name="book_id" class="form-control select2">
                                        <option value="">Select</option>

                                        @foreach ($books as $item)
                                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ old('name') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ old('email') }}">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ old('address') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student ID</label>
                                            <input type="text" class="form-control" name="student_id"
                                                value="{{ old('student_id') }}">
                                        </div>
                                    </div>
                                </div>



                                {{-- <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Issue Date</label>
                                            <input type="date" class="form-control" name="issue_date"
                                                value="{{ old('issue_date') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input type="date" class="form-control" name="due_date"
                                                value="{{ old('due_date') }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Return Date</label>
                                            <input type="date" class="form-control" name="return_date"
                                                value="{{ old('return_date') }}">
                                        </div>
                                    </div>
                                </div> --}}

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
                                    <th>Book</th>
                                    <th>Name</th>
                                    {{-- <th>Student ID</th> --}}
                                    <th>Email</th>
                                    {{-- <th>Phone</th> --}}
                                    {{-- <th>Address</th> --}}
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Return Date</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                    @foreach ($offlinebooks as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $item->book->title }}</td>
                                            <td>{{ $item->name }}</td>
                                            {{-- <td>{{ $item->student_id }}</td> --}}
                                            <td>{{ $item->email }}</td>
                                            {{-- <td>{{ $item->phone }}</td> --}}
                                            {{-- <td>{{ $item->address }}</td> --}}

                                            @if (!empty($item->issue_date))
                                            <td>{{ $item->issue_date }}</td>
                                            @else
                                            <td class="text-info">Not Activate Yet</td>
                                            @endif

                                            @if (!empty($item->due_date))
                                            <td>{{ $item->due_date }}</td>
                                            @else
                                            <td class="text-info">Not Activate Yet</td>
                                            @endif


                                            @if (!empty($item->return_date))
                                                <td>{{ $item->return_date }}</td>
                                            @else
                                                <td class="text-info">Not Return Yet</td>
                                            @endif

                                            <td>
                                                @if ($item->status == 'return')
                                                    <span class="badge rounded-pill bg-success">Return</span>
                                                @elseif ($item->status == 'active')
                                                    <span class="badge rounded-pill bg-info">Active</span>
                                                @else
                                                    <span class="badge rounded-pill bg-info">Pending</span>
                                                @endif

                                            </td>

                                            <td>
                                                <a class="btn btn-info mr-2"
                                                    href="{{ route('offline-book-borrow-edit', $item->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>

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
