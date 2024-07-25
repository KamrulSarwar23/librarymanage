@extends('admin.layouts.master')

<style>
    label {
        font-size: 18px
    }

    input {
        width: 20px
    }
</style>


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
                                    <input class="form-control my-2" type="text" name="name"
                                        placeholder="Role Name exp: Admin, Manager">
                                </div>

                                <div class="container mt-3">
                                    <button class="btn btn-primary mb-3">Submit</button>
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <input id="select-all-permissions" type="checkbox">
                                            <label for="select-all-permissions">Select All Permissions</label>
                                        </div>
                                    </div>
                                    @foreach ($permissions as $groupby => $permission)
                                        <div class="row mb-4">
                                            <div class="col-12">
                                                <h5>{{ $groupby }}</h5>
                                                @if (count($permission) > 1)
                                                    <input id="select-group-{{ $groupby }}" type="checkbox"
                                                        class="select-group">
                                                    <label for="select-group-{{ $groupby }}">Select All
                                                        {{ $groupby }}</label>
                                                @endif
                                            </div>
                                            <div class="col-12">
                                                <div class="d-flex flex-wrap">
                                                    @foreach ($permission as $item)
                                                        <div class="mb-2 mr-5">
                                                            <input id="permission-{{ $item->id }}" type="checkbox"
                                                                class="rounded permission-checkbox" name="permission[]"
                                                                value="{{ $item->name }}"
                                                                data-group="{{ $groupby }}">
                                                            <label
                                                                for="permission-{{ $item->id }}">{{ $item->name }}</label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button class="btn btn-primary mt-3">Submit</button>
                                </div>



                               
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all-permissions');
            const selectGroupCheckboxes = document.querySelectorAll('.select-group');
            const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');

            // Function to update "Select All" checkboxes based on permission checkboxes state
            function updateSelectAllCheckboxes() {
                let allPermissionsChecked = true;
                permissionCheckboxes.forEach(checkbox => {
                    if (!checkbox.checked) {
                        allPermissionsChecked = false;
                    }
                });
                selectAllCheckbox.checked = allPermissionsChecked;
           

                selectGroupCheckboxes.forEach(groupCheckbox => {
                    const group = groupCheckbox.id.replace('select-group-', '');
                    let allGroupChecked = true;
                    document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`).forEach(
                        checkbox => {
                            if (!checkbox.checked) {
                                allGroupChecked = false;
                            }
                        });
                    groupCheckbox.checked = allGroupChecked;
                });
            }

            // Initial update on page load
            updateSelectAllCheckboxes();

            // Event listener for "Select All Permissions" checkbox
            selectAllCheckbox.addEventListener('change', function() {
                const isChecked = this.checked;
                permissionCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
                selectGroupCheckboxes.forEach(checkbox => {
                    checkbox.checked = isChecked;
                });
            });

            // Event listener for group checkboxes
            selectGroupCheckboxes.forEach(groupCheckbox => {
                groupCheckbox.addEventListener('change', function() {
                    const group = this.id.replace('select-group-', '');
                    const isChecked = this.checked;
                    document.querySelectorAll(`.permission-checkbox[data-group="${group}"]`)
                        .forEach(checkbox => {
                            checkbox.checked = isChecked;
                        });
                });
            });

            // Event listener for permission checkboxes
            permissionCheckboxes.forEach(permissionCheckbox => {
                permissionCheckbox.addEventListener('change', function() {
                    updateSelectAllCheckboxes();
                });
            });


            selectGroupCheckboxes.forEach(permissionCheckbox => {
                permissionCheckbox.addEventListener('change', function() {
                    updateSelectAllCheckboxes();
                });
            });
        });
    </script>
@endsection
