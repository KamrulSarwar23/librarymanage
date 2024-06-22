@extends('admin.layouts.master')

@section('content')

<style>
    th{
        white-space: nowrap;
    }
</style>
    <section class="section">
        <div class="section-header">
            <h1>Book Details</h1>
        </div>

        <div class="section-body">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h4>Book Information</h4>
                            <a href="{{ route('book.index') }}" class="btn btn-primary">Back to List</a>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <!-- Cover Image -->
                                <div class="col-md-4 text-center">
                                    <img width="200px" height="250px"
                                        src="{{ $book->cover_image ? asset('storage/book/' . $book->cover_image) : asset('frontend/images/book.jpg') }}"
                                        alt="Book Cover" class="shadow-sm">
                                </div>

                                <!-- Book Details -->
                                <div class="col-md-8">
                                    <table class="table table-borderless">
                                        <tbody>
                                            <tr>
                                                <th>ID:</th>
                                                <td>{{ $book->id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Title:</th>
                                                <td>{{ $book->title }}</td>
                                            </tr>
                                            <tr>
                                                <th>Location:</th>
                                                <td>
                                                    <span class="badge badge-info">Shelf: {{ $book->shelf }}</span>
                                                    <span class="badge badge-info">Row: {{ $book->row }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Category:</th>
                                                <td>{{ $book->category->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Publisher:</th>
                                                <td>{{ $book->publisher->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Author:</th>
                                                <td>{{ $book->author->name }}</td>
                                            </tr>
                                            <tr>
                                                <th>ISBN:</th>
                                                <td>{{ $book->isbn }}</td>
                                            </tr>
                                            <tr>
                                                <th>Publication Date:</th>
                                                <td>{{ $book->publication_date }}</td>
                                            </tr>
                                            <tr>
                                                <th>Number of Pages:</th>
                                                <td>{{ $book->number_of_pages }}</td>
                                            </tr>
                                            <tr>
                                                <th>Summary:</th>
                                                <td>{{ $book->summary }}</td>
                                            </tr>
                                            <tr>
                                                <th>Type:</th>
                                                <td>{{ ucfirst($book->type) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Preview:</th>
                                                <td>{{ ucfirst($book->preview) }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td>
                                                    @if (App\Helper\QuantityManage::isQuantityAvailable($book->id))
                                                        <span class="badge bg-primary text-light">Available</span>
                                                    @else
                                                        <span class="badge bg-danger text-light">Not Available</span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Quantity:</th>
                                                <td>{{ $book->quantities->sum('quantity') }}</td>
                                            </tr>
                                            <tr>
                                                <th>Current Quantity:</th>
                                                <td>{{ $book->quantities->sum('current_qty') }}</td>
                                            </tr>

                                         
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <a class="btn btn-info mr-2" href="{{ route('book.edit', $book->id) }}"><i
                                    class="fas fa-edit"></i></a>

                            <a class="delete-item btn btn-danger mr-2" href="{{ route('book.destroy', $book->id) }}"><i
                                    class="fas fa-trash"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
