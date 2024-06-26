@extends('admin.layouts.master')

@section('content')
    <style>
        li {
            list-style-type: none
        }

        .table-responsive {
            overflow-x: auto;
        }

        td {
            white-space: nowrap;
        }

        th {
            white-space: nowrap;
        }
    </style>

    <section class="section">
        <div class="section-header">
            <h1>Author</h1>

        </div>

        <div class="section-body">
            <li>
                <div class="dropdown mt-2 mb-3">
                    <button class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter Authors
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-info {{ request()->routeIs('author.index') ? 'active' : '' }}"
                                href="{{ route('author.index') }}">All</a></li>
                        <li><a class="dropdown-item btn-info {{ request()->routeIs('active.author') ? 'active' : '' }}"
                                href="{{ route('active.author') }}">Active</a></li>
                        <li><a class="dropdown-item btn-info {{ request()->routeIs('pending.author') ? 'active' : '' }}"
                                href="{{ route('pending.author') }}">Pending</a></li>
                    </ul>
                </div>
            </li>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Author</h4>
                            <div class="card-header-action">
                                <a href="{{ route('author.create') }}" class="btn btn-info">Create New</a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Biography</th>
                                    <th>Date of Birth</th>
                                    <th>Date of Death</th>
                                    <th>Status</th>
                                    {{-- <th>Edit</th> --}}
                                    <th>Action</th>


                                    @foreach ($authors as $index => $author)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td class="py-1"><img width="80px" height="80px" src="{{ $author->image ? asset('storage/book/' . $author->image) : asset('frontend/images/book.jpg') }}" alt="">
                                            </td>
                                            <td>{{ $author->name }}</td>
                                            <td>{{ $author->address }}</td>
                                            <td>{{ limitText($author->biography, 30) }}</td>
                                            <td>{{ $author->date_of_birth }}</td>
                                            <td>
                                                @if ($author->date_of_death == null)
                                                    Alive
                                                @else
                                                    {{ $author->date_of_death }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($author->status == 'active')
                                                    <label class="custom-switch">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $author->id }}"
                                                            id="flexSwitchCheckDefault{{ $author->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $author->id }}"
                                                            id="flexSwitchCheckDefault{{ $author->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>



                                            <td>
                                                <a class="btn btn-info mr-2"
                                                    href="{{ route('author.edit', $author->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>
                                                <a class="delete-item btn btn-danger"
                                                    href="{{ route('author.destroy', $author->id) }}"><i
                                                        class="fas fa-trash"></i></a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    @if ($authors->isEmpty())
                                        <div class="alert alert-danger mt-5" role="alert">
                                            No Data Found
                                        </div>
                                    @endif
                                </table>

                                <div class="pagination">
                                    {{ $authors->links() }}
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
            $('body').on('click', '.change-status', function() {

                let isChecked = $(this).is(':checked');
                let id = $(this).data('id');

                $.ajax({
                    url: "{{ route('author.status') }}",
                    method: 'PUT',
                    data: {
                        status: isChecked,
                        id: id
                    },
                    success: function(data) {
                        toastr.success(data.message);
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = 'An error occurred';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        }
                        toastr.error(errorMessage);
                    }
                });
            });
        });
    </script>
@endpush
