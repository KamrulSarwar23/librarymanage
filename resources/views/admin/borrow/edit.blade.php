@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Borrow Request</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Borrow Request</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('book-borrow.updateInfo', $borrowRecords->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Issued Date</label>
                                            <input type="date" class="form-control" name="issued_at"
                                                value="{{ $borrowRecords->issued_at }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input type="date" class="form-control" name="due_at"
                                                value="{{ $borrowRecords->due_at }}">
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">

                                        <option {{ $borrowRecords->status == 'active' ? 'selected' : '' }} value="active">
                                            Approved</option>
                                        <option {{ $borrowRecords->status == 'reject' ? 'selected' : '' }} value="reject">
                                            Reject</option>

                                    </select>
                                </div>

                                <button type="submit" class="btn btn-info">Update</button>
                            </form>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h4>Returned Book</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('book.return', $borrowRecords->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Returned Date</label>
                                            <input type="date" class="form-control" name="returned_at"
                                                value="{{ $borrowRecords->returned_at }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="inputState">Status</label>
                                            <select id="inputState" class="form-control" name="status">
                                                <option value="return">Select</option>
                                                <option value="return">Return</option>

                                            </select>
                                        </div>
                                    </div>

                                </div>


                                <button type="submit" class="btn btn-info">Update</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
