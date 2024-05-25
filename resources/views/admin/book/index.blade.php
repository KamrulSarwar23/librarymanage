@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Book</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Book</h4>
                            <div class="card-header-action">
                                <a href="{{ route('book.create') }}" class="btn btn-primary">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Cover Image</th>
                                    <th>Title</th>
                                    <th>Category Name</th>
                                    <th>Publisher Name</th>
                                    <th>Author Name</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                    @foreach ($books as $book)
                                        <tr>
                                            <td>{{ $book->id }}</td>
                                            <td><img width="80px" height="80px" class="py-2" src="{{ asset('storage/book/'. $book->cover_image) }}" alt=""> </td>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->category->name }}</td>
                                            <td>{{ $book->publisher->name }}</td>
                                            <td>{{ $book->author->name }}</td>
                                       
                                            <td>@if ($book->status == 'reserved')
                                                <span class="btn btn-success">Reserved</span>
                                                @elseif ($book->status == 'checked_out')
                                                <span class="btn btn-info">Checked Out</span>
                                                @elseif ($book->status == 'available')
                                                <span class="btn btn-primary">Available</span>
                                                @else
                                                <span class="btn btn-secondary">Lost</span>
                                                @endif 
                                            </td>

                                            <td><a class="btn btn-primary" href="{{ route('book.edit', $book->id) }}">Edit</a>
                                            </td>

                                            <td>

                                                <a class="delete-item btn btn-danger" href="{{ route('book.destroy', $book->id) }}">Delete</a>

                                            </td>

                                        </tr>
                                    @endforeach
                                </table>

                                <div class="pagination">
                                    {{ $books->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
