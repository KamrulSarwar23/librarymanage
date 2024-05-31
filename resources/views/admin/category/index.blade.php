@extends('admin.layouts.master')

<style>
    li{
        list-style: none;
    }

    td,th {
            white-space: nowrap;
        }

</style>

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Category</h1>

        </div>

        <div class="section-body">
            <li>
                <div class="dropdown mt-2 mb-3">
                    <button class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Filter Category
                    </button>

                    <ul class="dropdown-menu">
                            <li><a class="dropdown-item btn-info {{ request()->routeIs('category.index') ? 'active' : '' }}" href="{{ route('category.index') }}">All</a></li>
                            <li><a class="dropdown-item btn-info {{ request()->routeIs('active.category') ? 'active' : '' }}" href="{{ route('active.category') }}">Active</a></li>
                            <li><a class="dropdown-item btn-info {{ request()->routeIs('pending.category') ? 'active' : '' }}" href="{{ route('pending.category') }}">Pending</a></li>
                    </ul>
                </div>
            </li>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Create Category</h4>
                            <div class="card-header-action">
                                <a href="{{ route('category.create') }}" class="btn btn-info">Create New</a>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Status</th>

                                    {{-- <th>Edit</th> --}}
                                    <th>Action</th>


                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td><img width="80px" height="80px" class="py-2"
                                                    src="{{ asset('storage/category/' . $category->image) }}"
                                                    alt=""> </td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                
                                                @if ($category->status == 'active')
                                                    <label class="custom-switch">
                                                        <input type="checkbox" checked name="custom-switch-checkbox"
                                                            data-id="{{ $category->id }}"
                                                            id="flexSwitchCheckDefault{{ $category->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch">
                                                        <input type="checkbox" name="custom-switch-checkbox"
                                                            data-id="{{ $category->id }}"
                                                            id="flexSwitchCheckDefault{{ $category->id }}"
                                                            class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>

                                            {{-- <td>
                                            </td> --}}

                                            <td>
                                                <a class="btn btn-info py-2 mr-2"
                                                href="{{ route('category.edit', $category->id) }}"><i class="fas fa-edit"></i>
                                                </a>

                                                <a class="delete-item btn btn-danger py-2"
                                                    href="{{ route('category.destroy', $category->id) }}"><i class="fas fa-trash"></i></a>

                                            </td>

                                        </tr>
                                    @endforeach
                                    @if ($categories->isEmpty())
                                    <div class="alert alert-danger mt-5" role="alert">
                                       No Data Found
                                    </div>
                                    @endif

                                </table>

                                <div class="pagination">
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
<script>
    $(document).ready(function() {
        $('body').on('click', '.change-status', function() {

            let isChecked = $(this).is(':checked');
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('category.status') }}",
                method: 'PUT',
                data: {
                    status: isChecked,
                    id: id
                },
                success: function(data) {
                    toastr.success(data.message);
                },
                error: function(xhr, status, error) {
                    let errorMessage = 'An error occurred';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    toastr.error(errorMessage);
                }
            });
        });
    });
</script>

@endpush
