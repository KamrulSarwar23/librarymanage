@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Permission</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Permission</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('permissions.update', $permissionId->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>GroupBy</label>
                                    <select class="form-control" name="name">
                                        @foreach ($permissions as $permission)
                                            <option {{ $permissionId->name == $permission ? 'selected' : '' }}
                                                value="{{ $permission }}">{{ $permission }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>GroupBy</label>
                                    <select class="form-control" name="groupby">
                                        @foreach ($groupby as $item)
                                            <option {{ $permissionId->groupby == $item ? 'selected' : '' }} value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <button type="submit" class="btn btn-info">Update</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
