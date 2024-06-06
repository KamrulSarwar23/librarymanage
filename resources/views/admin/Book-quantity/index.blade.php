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
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .form-select:focus {
            border-color: #5096e0;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, .25);
        }

        .form-select option {
            padding: 10px;
        }

        td {
            white-space: nowrap;
        }

        th {
            white-space: nowrap;
        }

        form {
            margin-top: -10px;
        }
    </style>
    <section class="section">
        <div class="section-header">
            <h1>Add Book Quantity</h1>
        </div>
        <div class="section-header">
            <h1 class="text-primary"><i class="fa-solid fa-link mr-2"></i>{{ $book->title }}</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4></h4>
                            <div class="card-header-action">

                                <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Add More
                                </button>

                                {{-- <a href="{{ route('book.create') }}" class="btn btn-info">Add More</a> --}}
                            </div>
                        </div>

                        <div class="card-body shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Adding Date</th>
                                    <th>Quantity</th>
                                    <th>Current Quantity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    @foreach ($quantitys as $key => $quantity)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $quantity->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $quantity->quantity }}</td>
                                            <td>{{ $quantity->current_qty }}</td>
                                            {{-- <td>{{ $quantity->status }}</td> --}}


                                            <td>
                                                @if ($quantity->status == 'activate')
                                                    <label class="custom-switch">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $quantity->id }}"
                                                            id="flexSwitchCheckDefault{{ $quantity->id }}"
                                                            class="custom-switch-input preview-change">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $quantity->id }}"
                                                            id="flexSwitchCheckDefault{{ $quantity->id }}"
                                                            class="custom-switch-input preview-change">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>




                                            <td>
                                                <a class="delete-item btn btn-danger mr-2"
                                                    href="{{ route('quantity.delete', $quantity->id) }}"><i
                                                        class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>


                                <div class="pagination">
                                    {{-- {{ $books->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>


    {{-- Add More Modal --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title fs-5" id="exampleModalLabel">Add More Similar Book</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('quantity.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="text" name="book_id" value="{{ $book->id }}">
                            <label for="quantity" class="form-label">Add Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Add Quantity (2/5/9)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('change', '.custom-switch-input.preview-change', function() {
                let status = $(this).is(':checked') ? "activate" : "deactivate";
                let quantityId = $(this).data('id');
                let bookId = {{ $book->id }};

                console.log("Book ID:", bookId);

                $.ajax({
                    url: '{{ route('quantity.status', ['bookId' => $book->id]) }}',
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token for security
                        quantityId: quantityId,
                        status: status
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating status:', error);
                    }
                });
            });
        });
    </script>
@endpush
