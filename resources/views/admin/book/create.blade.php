@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Book</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Book</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Cover Image</label>
                                    <input type="file" class="form-control" name="cover_image">
                                </div>

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title">
                                </div>

                                <div class="row">
                              
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category" id="" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Publishers</label>
                                            <select name="publisher" id="" class="form-control">

                                                @foreach ($publishers as $publisher)
                                                    <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Author</label>
                                            <select name="author" id="" class="form-control">
                                                @foreach ($authors as $author)
                                                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input type="text" class="form-control" name="isbn">
                                </div>

                                <div class="form-group">
                                    <label>Publication Date</label>
                                    <input type="date" class="form-control" name="publication_date">
                                </div>

                                <div class="form-group">
                                    <label>Number Of Pages</label>
                                    <input type="text" class="form-control" name="number_of_pages">
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" class="form-control" name="quantity">
                                </div>

                                <div class="form-group">
                                    <label>Summary</label>
                                    <textarea class="form-control summernote" name="summary" id="" cols="30" rows="10"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="available">Available</option>
                                        <option value="checked_out">Checked Out</option>
                                        <option value="reserved">Reserved</option>
                                        <option value="lost">Lost</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-info">Create</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
