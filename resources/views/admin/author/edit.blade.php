@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Author</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Author</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('author.update',$author->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <img width="100px" height="120px" src="{{ asset('storage/author/'. $author->image) }}" alt="">
                                <div class="form-group">
                                    <label>Image</label>
                                
                                    <input type="file" class="form-control" name="image">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $author->name }}">
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address"
                                        value="{{ $author->address }}">
                                </div>

                                <div class="form-group">
                                    <label>Biography</label>
                                    <textarea class="form-control summernote" name="biography" id="" cols="30" rows="15">
                                        {{ $author->biography }}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth"
                                        value="{{ $author->date_of_birth }}">
                                </div>

                                <div class="form-group">
                                    <label>Date of Death</label>
                                    <input type="date" class="form-control" name="date_of_death"
                                        value="{{ $author->date_of_death }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $author->status == 'active' ? 'selected' : '' }} value="active">Active
                                        </option>
                                        <option {{ $author->status == 'inactive' ? 'selected' : '' }} value="inactive">
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
