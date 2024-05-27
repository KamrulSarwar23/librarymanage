@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header">
                            <h4>Create User</h4>
                            <div class="card-header-action">
                                <a href="{{ route('user-manage.create') }}" class="btn btn-primary">Create New</a>
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td><img width="80px" height="100px" class="my-2"
                                                    src="{{ asset($user->image) }}" alt=""> </td>
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

                                            <td><a class="btn btn-primary"
                                                    href="{{ route('user-manage.edit', $user->id) }}">Edit</a>
                                            </td>

                                            <td>

                                                <a class="delete-item btn btn-danger"
                                                    href="{{ route('user-manage.destroy', $user->id) }}">Delete</a>

                                            </td>

                                        </tr>
                                    @endforeach
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