@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Publisher</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Publisher</h4>
                            <div class="card-header-action">
                                <a href="{{ route('publisher.create') }}" class="btn btn-primary">Create New</a>
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
                                    <th>Edit</th>
                                    <th>Delete</th>


                                    @foreach ($publishers as $publisher)
                                        <tr>
                                            <td>{{ $publisher->id }}</td>
                                            <td><img width="80px" height="80px" class="py-2"
                                                    src="{{ asset('storage/publisher/' . $publisher->image) }}"
                                                    alt=""> </td>
                                            <td>{{ $publisher->name }}</td>
                                            <td>{{ $publisher->email }}</td>
                                            <td>{{ $publisher->phone }}</td>
                                            <td>{{ $publisher->address }}</td>
                                            <td>
                                                @if ($publisher->status == 'active')
                                                    <span class="btn btn-success">{{ $publisher->status }}</span>
                                                @else
                                                    <span class="btn btn-info">{{ $publisher->status }}</span>
                                                @endif
                                            </td>
                                            <td><a class="btn btn-primary"
                                                    href="{{ route('publisher.edit', $publisher->id) }}">Edit</a>
                                            </td>

                                            <td>
                                                <a class="delete-item btn btn-danger"
                                                    href="{{ route('publisher.destroy', $publisher->id) }}">Delete</a>

                                            </td>
                                        </tr>
                                    @endforeach
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
