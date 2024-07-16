
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

                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div>
                                    <label for="roles" class="form-label mt-3">Roles</label>
                                    <select name="roles[]" id="roles" class="form-control select2" multiple>
                                        @foreach ($roles as $role)
                                            <option {{ $user->roles->pluck('name')->contains($role->name) ? 'selected' : '' }} value="{{ $role->name }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>


    <script>
        $(document).ready(function() {
            $('#roles').select2({
                placeholder: "Select roles",
                allowClear: true
            });
        });
    </script>
@endsection


