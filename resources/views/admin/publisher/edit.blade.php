@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Publisher</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Publisher</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('publisher.update', $publisher->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <img width="100px" height="100px"
                                    src="{{ asset('storage/publisher/' . $publisher->image) }}" alt="">

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image"
                                        value="{{ $publisher->image }}">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name"
                                        value="{{ $publisher->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email"
                                        value="{{ $publisher->email }}">
                                </div>

                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ $publisher->phone }}">
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $publisher->address }}">
                                </div>


                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $publisher->status == 'active' ? 'selected' : '' }} value="active">Active
                                        </option>
                                        <option {{ $publisher->status == 'inactive' ? 'selected' : '' }} value="inactive">
                                            Inactive</option>
                                    </select>
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
