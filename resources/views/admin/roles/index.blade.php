@extends('admin.layouts.master')

@section('content')
    <style>
        li {
            list-style: none;
        }

        td,
        th {
          
        }
    </style>

    <section class="section">
        <div class="section-header">
            <h1>Role</h1>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Role</h4>
                            <div class="card-header-action">
                                <a href="{{ route('roles.create') }}" class="btn btn-info">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table class="table table-striped">
                                    <th>Roles Name</th>
                                    <th>Permissons</th>
                                    <th>Created Date</th>

                                    {{-- @can('Edit Role') --}}
                                        <th>Roles Edit</th>
                                    {{-- @endcan --}}

                                    {{-- @can('Delete Role') --}}
                                        <th>Roles Delete</th>
                                    {{-- @endcan --}}


                                    @foreach ($roles as $role)
                                        <tr>
                                            <td><span class="badge badge-info">{{ $role->name }}</span></td>

                                            <td> <span class="">{{ $role->permissions->pluck('name')->implode(', ') }}</span> </td>

                                            <td><span>{{ \Carbon\Carbon::parse($role->created_at)->format('d M, Y') }}</span>
                                            </td>
                                            {{-- @can('Edit Role') --}}
                                                <td><a class="btn btn-info" href="{{ route('roles.edit', $role->id) }}">Edit</a>
                                                </td>
                                            {{-- @endcan --}}

                                            {{-- @can('Delete Role') --}}
                                                <td><a class="btn btn-danger"
                                                        href="{{ route('roles.delete', $role->id) }}">Delete</a></td>
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
