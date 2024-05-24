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
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>User Name</th>
                                    <th>Email</th>
                                    <th>Edit</th>
                                    <th>Delete</th>


                                    <tr>
                                        <td>1</td>
                                        <td><img width="100px" class="py-2" src="" alt=""> </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>

                                        <td><a class="btn btn-primary" href="">Edit</a>
                                        </td>

                                        <td>

                                            <a class="delete-item btn btn-danger" href="">Delete</a>

                                        </td>

                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

