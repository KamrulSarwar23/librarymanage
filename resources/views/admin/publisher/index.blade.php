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
            <h1>Publisher</h1>

        </div>

        <div class="section-body">
            <li>
                <div class="dropdown mt-2 mb-3">
                    <button class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Filter Publishers
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item btn-info {{ request()->routeIs('publisher.index') ? 'active' : '' }}"
                                href="{{ route('publisher.index') }}">All</a></li>
                        <li><a class="dropdown-item btn-info {{ request()->routeIs('active.publisher') ? 'active' : '' }}"
                                href="{{ route('active.publisher') }}">Active</a></li>
                        <li><a class="dropdown-item btn-info {{ request()->routeIs('pending.publisher') ? 'active' : '' }}"
                                href="{{ route('pending.publisher') }}">Pending</a></li>
                    </ul>
                </div>
            </li>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Publisher</h4>
                            <div class="card-header-action">
                                <a href="{{ route('publisher.create') }}" class="btn btn-info">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                    {{-- <th>Delete</th> --}}


                                    @foreach ($publishers as $publisher)
                                        <tr>
                                            <td>{{ $publisher->id }}</td>
                                            <td class="py-1"><img width="80px" height="80px" src="{{ $publisher->image ? asset('storage/book/' . $publisher->image) : asset('frontend/images/book.jpg') }}"
                                                    alt=""> </td>
                                            <td>{{ $publisher->name }}</td>
                                            <td>{{ $publisher->email }}</td>
                                            <td>{{ $publisher->phone }}</td>
                                            <td>{{ $publisher->address }}</td>

                                            <td>
                                                @if ($publisher->status == 'active')
                                                    <label class="custom-switch">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $publisher->id }}"
                                                            id="flexSwitchCheckDefault{{ $publisher->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $publisher->id }}"
                                                            id="flexSwitchCheckDefault{{ $publisher->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>


                                            {{-- <td>
                                            </td> --}}

                                            <td>
                                                <a class="btn btn-info mr-2"
                                                    href="{{ route('publisher.edit', $publisher->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                </a>

                                                <a class="delete-item btn btn-danger"
                                                    href="{{ route('publisher.destroy', $publisher->id) }}"><i
                                                        class="fas fa-trash"></i></a>

                                            </td>
                                        </tr>
                                    @endforeach

                                    @if ($publishers->isEmpty())
                                    <div class="alert alert-danger mt-5" role="alert">
                                        No Data Found
                                    </div>
                                    @endif
                                </table>

                                <div class="pagination">
                                    {{ $publishers->links() }}
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
                    url: "{{ route('publisher.status') }}",
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
