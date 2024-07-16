@extends('admin.layouts.master')

@section('content')
    <style>
        li {
            list-style: none;
        }

        td,
        th {
            white-space: nowrap;
        }
    </style>

    <section class="section">
        <div class="section-header">
            <h1>Permission</h1>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Assign Role</h4>
                            <div class="card-header-action">
                                <a href="{{ route('users.create') }}" class="btn btn-info">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped">
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Created Date</th>

                                    {{-- @can('Edit User') --}}
                                        <th>Edit</th>
                                    {{-- @endcan --}}

                                    {{-- @can('Delete User') --}}
                                        <th>Delete</th>
                                    {{-- @endcan --}}

                                    @foreach ($users as $users)
                                        <tr>
                                            <td><span>{{ $users->name }}</span></td>
                                            <td><span>{{ $users->email }}</span></td>
                                            <td><span>{{ $users->roles->pluck('name')->implode(',') }}</span></td>
                                            <td><span>{{ \Carbon\Carbon::parse($users->created_at)->format('d M, Y') }}</span>
                                            </td>

                                            {{-- @can('Edit User') --}}
                                                <td><a class="btn btn-info" href="{{ route('users.edit', $users->id) }}">Edit
                                                        Role</a></td>
                                            {{-- @endcan --}}

                                            {{-- @can('Delete User') --}}
                                                <td><a class="btn btn-danger"
                                                        href="{{ route('users.delete', $users->id) }}">Delete User</a></td>
                                            {{-- @endcan --}}

                                        </tr>
                                    @endforeach
                                </table>

                                <div class="pagination">
                                    {{-- {{ $categories->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection




