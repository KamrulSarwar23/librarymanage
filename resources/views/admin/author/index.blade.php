@extends('admin.layouts.master')

@section('content')
    <style>
        li {
            list-style-type: none
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
                    <button class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter Authors
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('author.index') }}">All</a></li>
                        <li><a class="dropdown-item" href="{{ route('active.author') }}">Active</a></li>
                        <li><a class="dropdown-item" href="{{ route('pending.author') }}">Pending</a></li>
                    </ul>
                </div>
            </li>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Author</h4>
                            <div class="card-header-action">
                                <a href="{{ route('author.create') }}" class="btn btn-primary">Create New</a>
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
                                    <th>Edit</th>
                                    <th>Delete</th>


                                    @foreach ($authors as $author)
                                        <tr>
                                            <td>{{ $author->id }}</td>
                                            <td><img width="80px" height="80px" class="mb-3"
                                                    src="{{ asset('storage/author/' . $author->image) }}" alt="">
                                            </td>
                                            <td>{{ $author->name }}</td>
                                            <td>{{ $author->address }}</td>
                                            <td>{{ limitText($author->biography, 40) }}</td>
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

                                            <td><a class="btn btn-primary"
                                                    href="{{ route('author.edit', $author->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>
                                            </td>

                                            <td>

                                                <a class="delete-item btn btn-danger"
                                                    href="{{ route('author.destroy', $author->id) }}"><i
                                                        class="fas fa-trash"></i></a>

                                            </td>

                                        </tr>
                                    @endforeach

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
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endpush
