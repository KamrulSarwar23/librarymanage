@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Role</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Role</h4>
                        </div>
                        <div class="card-body">
                                       
                            <form action="{{ route('roles.store') }}" method="POST">
                                @csrf
                                <div>
                                    <input class="form-control my-2" type="text" name="name">
                                </div>
                
                                <div class="mt-5">
                                    @foreach ($permissions as $groupby => $permission)

                                   <h5> {{ $groupby }}</h5>

                                    @foreach ($permission as $item)
                                    <div>
                                        <input id="permission-{{ $item->id }}" type="checkbox" class="rounded m"
                                            name="permission[]" value="{{ $item->name }}">
                                        <label for="permission-{{ $item->id }}">{{ $item->name }}</label>
                                    </div>
                                    @endforeach
                                
                                    @endforeach
                                </div>
                                <button class="btn btn-primary mt-3">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
