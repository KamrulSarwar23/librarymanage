@extends('frontend.master')


@section('section')
    <div class="container mt-5 pt-5">
        <section class="section">

            <div class="section-body">


                <div class="row mt-sm-4">

                </div>

                <div class="col-md-12 m-auto">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="mb-3 btn btn-danger" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                this.closest('form').submit()"
                            class="dropdown-item has-icon text-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </form>
                    <div class="card">

                        <form method="POST" action="{{ route('user.profile.update') }}" class="needs-validation"
                            novalidate="" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Update Profile</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group col-12">

                                    <div class="mb-3">
                                        <img width="100px" src="{{ asset(Auth::user()->image) }}" alt="">
                                    </div>

                                    <label>Image</label>
                                    <input type="file" name="image" class="form-control">

                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
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
                </div>



                <div class="col-md-12 m-auto py-5">


                    <div class="card">


                        <form method="POST" action="{{ route('user.password.update') }}" class="needs-validation"
                            novalidate="">
                            @csrf
                            <div class="card-header">
                                <h4>Update Password</h4>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="form-group col-12">
                                        <label>Current Password</label>
                                        <input type="text" name="current_password" class="form-control">

                                        @error('current_password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="form-group col-12">
                                        <label>New Password</label>
                                        <input type="text" name="password" class="form-control">

                                        @error('password')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror

                                    </div>

                                    <div class="form-group col-12">
                                        <label>Confirm Password</label>
                                        <input type="text" name="password_confirmation" class="form-control">
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
    </section>
@endsection
