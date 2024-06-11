@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Offline Book Borrow</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Offline Book Borrow</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('offline-book-borrow-update', $offlinebooks->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>Add Books</label>

                                    <select name="book_id" class="form-control select2">
                                        <option value="">Select</option>

                                        @foreach ($books as $item)
                                            <option {{ $item->id === $offlinebooks->book_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->title }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $offlinebooks->name }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ $offlinebooks->email }}">
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" name="phone"
                                                value="{{ $offlinebooks->phone }}">
                                        </div>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $offlinebooks->address }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Student ID</label>
                                            <input type="text" class="form-control" name="student_id"
                                                value="{{ $offlinebooks->student_id }}">
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Issue Date</label>
                                            <input type="date" class="form-control" name="issue_date"
                                                value="{{ $offlinebooks->issue_date }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input type="date" class="form-control" name="due_date"
                                                value="{{ $offlinebooks->due_date }}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Return Date</label>
                                            <input type="date" class="form-control" name="return_date"
                                                value="{{ $offlinebooks->return_date }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="inputState">Status</label>
                                            <select id="inputState" class="form-control" name="status">
                                                <option disabled>Select One</option>

                                                 <option {{ $offlinebooks->status == 'active' ? 'selected' : '' }} value="active">Active</option>
                                             
                                                <option {{ $offlinebooks->status == 'return' ? 'selected' : '' }} value="return">Return</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
