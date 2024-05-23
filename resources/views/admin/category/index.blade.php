@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Category</h4>
                            <div class="card-header-action">
                                <a href="{{ route('category.create') }}" class="btn btn-primary">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">
                          <table class="table table-striped">
                            <th>Id</th>
                            <th>Name</th>
                            <th>Edit</th>
                            <th>Delete</th>

                            <tr>
                                <td>1</td>
                                <td>Kamrul Hasan</td>
                                <td><a class="btn btn-primary" href="{{ route('category.edit', 1) }}">Edit</a></td>
                                <td><a class="btn btn-danger" href="">Delete</a></td>
                            </tr>
                          </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

