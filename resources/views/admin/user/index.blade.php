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
                        <div class="card-header">
                            <h4>Create User</h4>
                            <div class="card-header-action">
                                <a href="{{ route('user-manage.create') }}" class="btn btn-primary">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped">
                                <th>Id</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>User Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Edit</th>
                                <th>Delete</th>

                                @foreach ($users as $user)
                                    <tr>
                                        <td>1</td>
                                        <td><img width="100px" class="py-2" src="{{ asset($user->image) }}"
                                                alt=""> </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ @$user->username }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>@if ($user->status == 'active')
                                            <span class="btn btn-success">{{ $user->status }}</span>
                                            @else
                                            <span class="btn btn-info">{{ $user->status }}</span>
                                        @endif 
                                        </td>
                                        <td><a class="btn btn-primary" href="{{ route('user-manage.edit', $user->id) }}">Edit</a>
                                        </td>

                                        <td>

                                            <a class="delete-item btn btn-danger" href="{{ route('user-manage.destroy', $user->id) }}">Delete</a>
                                        
                                        </td>

                                    </tr>
                                @endforeach
                            </table>
                          </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
