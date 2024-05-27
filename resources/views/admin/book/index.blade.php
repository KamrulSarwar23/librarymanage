@extends('admin.layouts.master')

@section('content')

<style>
    .form-select {
        width: 100%;
        padding: .375rem 1.75rem .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #ffffff;
        background-color: #6abed8;
        background-clip: padding-box;
        border: 1px solid #dad3ce;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .form-select:focus {
        border-color: #5096e0;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
    }
    .form-select option {
        padding: 10px;
    }
</style>
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
                                       
                                            <td>
                                                <select class="form-select status-select" data-id="{{ $book->id }}">
                                                    <option value="reserved" {{ $book->status == 'reserved' ? 'selected' : '' }}>Reserved</option>
                                                    <option value="checked_out" {{ $book->status == 'checked_out' ? 'selected' : '' }}>Checked Out</option>
                                                    <option value="available" {{ $book->status == 'available' ? 'selected' : '' }}>Available</option>
                                                    <option value="lost" {{ $book->status == 'lost' ? 'selected' : '' }}>Lost</option>
                                                </select>
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


@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.status-select', function() {
                let status = $(this).val();
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('book.status') }}",
                    method: 'PUT',
                    data: {
                        status: status,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
