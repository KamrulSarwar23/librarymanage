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

                            <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div>
                                    <input class="form-control my-2" type="text" name="name"
                                        value="{{ $role->name }}">
                                </div>


                                <div class="form-group">
                                    <label for="permissions">Permissions</label>

                                    @foreach ($permissions as $groupby => $permission)
                                        <h5> {{ $groupby }}</h5>

                                        @foreach ($permission as $item)
                                            <div class="form-check">

                                                <input {{ $rolePermissions->contains($item->name) ? 'checked' : '' }}
                                                    type="checkbox" name="permission[]" value="{{ $item->name }}"
                                                    id="permission_{{ $item->id }}" class="form-check-input">

                                                <label for="permission_{{ $item->id }}"
                                                    class="form-check-label">{{ $item->name }}</label>
                                            </div>
                                        @endforeach
                                    @endforeach

                                    @if ($errors->has('permission'))
                                        <span class="text-danger">{{ $errors->first('permission') }}</span>
                                    @endif
                                </div>


                                <button class="btn btn-primary mt-2">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
