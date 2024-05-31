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
                            <h4>Edit Book</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <img width="80px" height="80px" src="{{ asset('storage/book/'. $book->cover_image) }}" alt="">

                                <div class="form-group">
                                    <label>Cover Image</label>
                                    <input type="file" class="form-control" name="cover_image">
                                </div>

                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" class="form-control" name="title" value="{{ $book->title }}">
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <select name="category" id="" class="form-control">
                                                @foreach ($categories as $category)
                                                    <option {{$book->category_id ==  $category->id ?'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Publishers</label>
                                            <select name="publisher" id="" class="form-control">

                                                @foreach ($publishers as $publisher)
                                                    <option {{$book->publisher_id ==  $publisher->id ?'selected' : '' }} value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Author</label>
                                            <select name="author" id="" class="form-control">
                                                @foreach ($authors as $author)
                                                    <option {{ $book->author_id == $author->id ? 'selected' : '' }} value="{{ $author->id }}">{{ $author->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                         

                    
                                </div>


                                <div class="form-group">
                                    <label>ISBN</label>
                                    <input type="text" class="form-control" name="isbn" value="{{ $book->isbn }}">
                                </div>

                                <div class="form-group">
                                    <label>Publication Date</label>
                                    <input type="date" class="form-control" name="publication_date" value="{{ $book->publication_date }}">
                                </div>

                                <div class="form-group">
                                    <label>Number Of Pages</label>
                                    <input type="text" class="form-control" name="number_of_pages" value="{{ $book->number_of_pages }}">
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="text" class="form-control" name="quantity" value="{{ $book->quantity }}">
                                </div>

                                <div class="form-group">
                                    <label>Summary</label>
                                    <textarea class="form-control summernote" name="summary" id="" cols="30" rows="10">
                                        {{ $book->summary }}
                                    </textarea>
                                </div>

                                <div class="form-group">
                                    <label for="inputState">Status</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $book->status == 'available' ? 'selected' : '' }} value="available">Available</option>
                                        <option {{ $book->status == 'checked_out' ? 'selected' : '' }} value="checked_out">Checked Out</option>
                                        <option {{ $book->status == 'reserved' ? 'selected' : '' }} value="reserved">Reserved</option>
                                        <option {{ $book->status == 'lost' ? 'selected' : '' }} value="lost">Lost</option>
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
