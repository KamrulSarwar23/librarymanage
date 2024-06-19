@extends('frontend.master')

@section('content')
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .main_content {
            padding: 40px 0;
        }

        .dashboard_menu {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        td,
        th {
            white-space: nowrap;
        }

        .dashboard_menu .nav-item {
            margin-bottom: 10px;
        }

        .dashboard_menu .nav-link {
            color: #555;
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dashboard_menu .nav-link:hover,
        .dashboard_menu .nav-link.active {
            background-color: #4CAF50;
            color: #fff;
        }

        .dashboard_menu .nav-link i {
            margin-right: 8px;
        }

        .logout-form {
            display: flex;
            align-items: center;
        }

        .logout-link {
            display: flex;
            align-items: center;
            padding: 10px 15px;
            color: #dc3545;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            border-radius: 4px;
        }

        .logout-link:hover {
            background-color: #dc3545;
            color: #fff;
        }

        .logout-link i {
            margin-right: 8px;
        }

        .card {
            background-color: #fff;
            border: none;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #4CAF50;
            color: #fff;
            padding: 15px 20px;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            padding: 15px 20px;
            background-color: #f9f9f9;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            text-align: right;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 12px 15px;
            text-align: left;
        }

        .table th {
            background-color: #4CAF50;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-bottom: 2px solid #e0e0e0;
            font-size: 12px;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #e0f7fa;
        }

        .table td {
            border-bottom: 1px solid #e0e0e0;
            color: #555;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-danger {
            background-color: #dc3545;
            color: #fff;
        }

        .badge-info {
            background-color: #17a2b8;
            color: #fff;
        }

        .badge-success {
            background-color: #28a745;
            color: #fff;
        }

        .badge-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-fill-out {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-fill-out:hover {
            background-color: #45a049;
        }

        .form-control {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 10px;
        }

        .form-control:focus {
            border-color: #4CAF50;
            box-shadow: none;
        }

        .text-danger {
            color: #dc3545;
        }

        .text-success {
            color: #28a745;
        }

        .text-primary {
            color: #007bff;
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
                                            class="ti-shopping-cart-full"></i>Book Request</a>
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
                                        <h3>All Book Request</h3>
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
                                                            <th>Action</th>
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
                                                                    <td><span class="badge badge-danger">Rejected</span>
                                                                    </td>
                                                                @elseif ($item->status == 'pending')
                                                                    <td><span class="badge badge-info">Pending</span></td>
                                                                @elseif ($item->status == 'receive')
                                                                    <td><span class="badge badge-success">Active</span></td>
                                                                @elseif ($item->status == 'return')
                                                                    <td><span class="badge badge-primary">Returned</span>
                                                                    </td>
                                                                @endif
                                                                <td><a href="{{ route('book.details', $item->book_id) }}"
                                                                        class="btn btn-fill-out btn-sm">View Book</a></td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @else
                                        <h4 class="text-center mt-3 py-5 text-primary">You didn't add any books yet</h4>
                                    @endif

                                    <div>
                                        {{ $borrowBooks->links() }}
                                    </div>
                                    
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
                                            <h6 class="text-success mb-2 text-center">{{ session('profile') }}</h6>
                                        @endif
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
                                                    <input type="password" name="current_password" class="form-control">
                                                    @error('current_password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-12 mb-3">
                                                    <label>New Password</label>
                                                    <input type="password" name="password" class="form-control">
                                                    @error('password')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-12 mb-3">
                                                    <label>Confirm Password</label>
                                                    <input type="password" name="password_confirmation"
                                                        class="form-control">
                                                    @error('password_confirmation')
                                                        <p class="text-danger">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        @if (session('success'))
                                            <h6 class="text-success mb-2 text-center">{{ session('success') }}</h6>
                                        @endif
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
@endsection
