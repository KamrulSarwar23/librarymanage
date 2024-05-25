@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Categories</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <img width="100px" height="120px" src="{{ asset('storage/category/'. $category->image) }}" alt="">
                                <div class="form-group">
                                    <label>Image</label>
                        
                                    <input type="file" class="form-control" name="image" value="">
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" value="{{ $category->name }}">
                                </div>


                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $category->status == 'active' ? 'selected' : '' }} value="active">Active
                                        </option>
                                        <option {{ $category->status == 'inactive' ? 'selected' : '' }} value="inactive">
                                            Inactive</option>
                                    </select>
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
