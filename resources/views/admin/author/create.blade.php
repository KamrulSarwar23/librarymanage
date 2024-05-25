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
                            <h4>Create Author</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" name="address" value="{{ old('address') }}">
                                </div>

                                <div class="form-group">
                                    <label>Biography</label>
                                    <textarea class="form-control summernote" name="biography" id="" cols="30" rows="15">
                                        {{ old('biography') }}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label>Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}">
                                </div>

                                <div class="form-group">
                                    <label>Date of Death</label>
                                    <input type="date" class="form-control" name="date_of_death" value="{{ old('date_of_death') }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary">Create</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
