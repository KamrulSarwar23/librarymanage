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
                            <h4>Create Permission</h4>
                            <div class="card-header-action">
                                {{-- @can('Create Permission') --}}
                                <a href="{{ route('permissions.create') }}" class="btn btn-info">Create New</a>
                                {{-- @endcan --}}
                               
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Permission Name</th>
                                    <th>Permission Group</th>
                                    <th>Created Date</th>
                                    
                                    @can('Edit Permission')
                                    <th>Permission Edit</th>
                                    @endcan
                    
                                    @can('Delete Permission')
                                    <th>Permission Delete</th>
                                    @endcan

                    
                                   
                                    @foreach ($permissions as $permission)
                                   <tr>
                                    <td><span>{{ $permission->name }}</span></td>
                                    <td><span>{{ $permission->groupby }}</span></td>
                                    <td>{{ \Carbon\Carbon::parse($permission->created_at)->format('d M, Y') }}</td>
                    
                                    {{-- @can('Edit Permission') --}}
                                    <td><a class="btn btn-info" href="{{ route('permissions.edit', $permission->id) }}">Edit</a></td>
                                    {{-- @endcan --}}
                                   
                                    {{-- @can('Delete Permission') --}}
                                    <td><a class="btn btn-danger delete-item" href="{{ route('permissions.delete', $permission->id) }}">Delete</a></td>
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



