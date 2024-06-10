@extends('frontend.master')


@section('content')
    <style>
        body {
            background-image: none;
        }

        .nav-item .logout-form {
            display: flex;
            align-items: center;
        }

        .nav-item .logout-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #dc3545;
            /* Bootstrap's 'danger' color */
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 5px;
        }

        .nav-item .logout-link:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .nav-item .logout-link i {
            margin-right: 8px;
        }

        tr,
        td {
            white-space: nowrap;
        }
    </style>

    <!-- START MAIN CONTENT -->
    <div class="main_content">

        <!-- START SECTION SHOP -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="dashboard_menu">
                            <ul class="nav nav-tabs flex-column" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab"
                                        aria-controls="orders" aria-selected="false"><i
                                            class="ti-shopping-cart-full"></i>Orders</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail"
                                        role="tab" aria-controls="account-detail" aria-selected="true"><i
                                            class="ti-id-badge"></i>Account details</a>
                                </li>

                                <li class="nav-item">
                                    <form method="POST" action="{{ route('logout') }}" class="logout-form">
                                        @csrf
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); this.closest('form').submit();"
                                            class="logout-link">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-8">
                        <div class="tab-content dashboard_content">

                            <div class="tab-pane fade active show" id="orders" role="tabpanel"
                                aria-labelledby="orders-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3>Orders</h3>
                                    </div>

                                    @if ($borrowBooks->isNotEmpty())
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Serial</th>
                                                        <th>Book</th>
                                                        <th>Author</th>
                                                        <th>Publisher</th>
                                                        <th>Issued Date</th>
                                                        <th>Due Date</th>
                                                        <th>Return Date</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @foreach ($borrowBooks as $index => $item)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>

                                                            <td>{{ $item->book->title }}</td>

                                                            <td>{{ $item->book->author->name }}</td>

                                                            <td>{{ $item->book->publisher->name }}</td>

                                                            @if (!empty($item->issued_at))
                                                                <td>{{ $item->issued_at }}</td>
                                                            @else
                                                                <td>Not Updated Yet</td>
                                                            @endif

                                                            @if (!empty($item->due_at))
                                                                <td>{{ $item->due_at }}</td>
                                                            @else
                                                                <td>Not Updated Yet</td>
                                                            @endif

                                                            @if (!empty($item->returned_at))
                                                                <td>{{ $item->returned_at }}</td>
                                                            @else
                                                                <td>Not Updated Yet</td>
                                                            @endif

                                                            @if ($item->status == 'reject')
                                                                <td><span class="badge badge-danger">Rejected</span></td>
                                                            @elseif ($item->status == 'pending')
                                                                <td><span class="badge badge-info">Pending</span></td>
                                                            @elseif ($item->status == 'receive')
                                                                <td><span class="badge badge-success">Active</span></td>
                                                            @elseif ($item->status == 'return')
                                                                <td><span class="badge badge-primary">Returned</span></td>
                                                            @endif


                                                            <td><a href="{{ route('book.details', $item->book_id) }}"
                                                                    class="btn btn-fill-out btn-sm">View Book</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @else
                                    <h4 class="text-center mt-5 text-primary">You didn't added any books yet</h4>
                                    @endif

                                

                                </div>
                            </div>


                            <div class="tab-pane fade" id="account-detail" role="tabpanel"
                                aria-labelledby="account-detail-tab">
                                <div class="card">
                                    <form method="POST" action="{{ route('user.profile.update') }}"
                                        class="needs-validation" novalidate="" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="card-header">
                                            <h4>Update Profile</h4>
                                        </div>
                                        <div class="card-body">

                                            <div class="form-group col-12 mb-3">

                                                <div class="mb-3">
                                                    <img width="100px" src="{{ asset(Auth::user()->image) }}"
                                                        alt="">
                                                </div>

                                                <label>Image</label>
                                                <input type="file" name="image" class="form-control">

                                            </div>

                                            <div class="row">
                                                <div class="form-group col-md-6 col-12 mb-3">
                                                    <label>Name</label>
                                                    <input type="text" name="name" class="form-control"
                                                        value="{{ Auth::user()->name }}">

                                                </div>

                                                <div class="form-group col-md-6 col-12">
                                                    <label>Email</label>
                                                    <input type="text" name="email" class="form-control"
                                                        value="{{ Auth::user()->email }}" readonly>

                                                </div>
                                            </div>
                                        </div>

                                        @if (session('profile'))
                                            <h6 class="text-success mb-2 text-center">
                                                {{ session('profile') }}</h6>
                                        @endif
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                </div>


                                <div class="card">
                                    <form method="POST" action="{{ route('user.password.update') }}"
                                        class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="card-header">
                                            <h4>Update Password</h4>
                                        </div>
                                        <div class="card-body">

                                            <div class="row">

                                                <div class="form-group col-12 mb-3">
                                                    <label>Current Password</label>
                                                    <input type="text" name="current_password" class="form-control">

                                                    @error('current_password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror

                                                </div>

                                                <div class="form-group col-12 mb-3">
                                                    <label>New Password</label>
                                                    <input type="text" name="password" class="form-control">

                                                    @error('password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror

                                                </div>

                                                <div class="form-group col-12 mb-3">
                                                    <label>Confirm Password</label>
                                                    <input type="text" name="password_confirmation"
                                                        class="form-control">
                                                    @error('password_confirmation')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                            </div>


                                        </div>

                                        @if (session('success'))
                                            <h6 class="text-success mb-2 text-center">
                                                {{ session('success') }}</h6>
                                        @endif

                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">Save
                                                Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    </body>

    </html>
    </section>
@endsection
