@extends('admin.layouts.master')

@section('content')
    <style>
        td {
            white-space: nowrap;
        }

        th {
            white-space: nowrap;
        }
    </style>

    <section class="section">
        <div class="section-header">
            <h1>User</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create User</h4>
                            <div class="card-header-action">
                                <a href="{{ route('user-manage.create') }}" class="btn btn-info">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td  class="py-1 "><img style="border-radius: 50%" width="60px" height="60px"
                                                    src="{{ asset($user->image ?? 'frontend/images/user.png') }}" alt=""> </td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->status == 'active')
                                                    <label class="custom-switch">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $user->id }}"
                                                            id="flexSwitchCheckDefault{{ $user->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $user->id }}"
                                                            id="flexSwitchCheckDefault{{ $user->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>


                                            <td>
                                                {{-- <a class="btn btn-info mr-2"
                                                href="{{ route('user-manage.edit', $user->id) }}"><i class="fas fa-edit"></i>
                                            </a> --}}
                                                <a class="delete-item btn btn-danger"
                                                    href="{{ route('user-manage.destroy', $user->id) }}"><i
                                                        class="fas fa-trash"></i></a>

                                            </td>

                                        </tr>
                                    @endforeach

                                    @if ($users->isEmpty())
                                        <div class="alert alert-danger mt-5" role="alert">
                                            No Data Found
                                        </div>
                                    @endif

                                </table>
                                <div class="pagination">
                                    {{ $users->links() }}
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
                    url: "{{ route('user.status') }}",
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
