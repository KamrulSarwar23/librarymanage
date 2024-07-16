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
                            <h4>Create Permission</h4>
                        </div>
                        <div class="card-body">

                            <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group">
                                    <label>Permission Name</label>
                                   <select class="form-control" name="name">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission }}">{{ $permission }}</option>
                                    @endforeach
                                   </select>
                                </div>

                                <div class="form-group">
                                    <label>GroupBy</label>
                                   <select class="form-control" name="groupby">
                                    @foreach ($groupby as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                   </select>
                                </div>


                                <button type="submit" class="btn btn-info">Create</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
