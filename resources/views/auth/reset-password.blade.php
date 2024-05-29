<style>
    .fa-book-open {
        color: green;
    }
</style>

@extends('auth.layout')

@section('section')
    <div class="container-login100">

        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('password.store') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <span class="login100-form-title p-b-26">
                    Reset Password
                </span>
                <span class="login100-form-title p-b-48">
                    <i class="fa-solid fa-book-open"></i>
                </span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100" data-placeholder="Email"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="input100" type="password" name="password">
                    <span class="focus-input100" data-placeholder="Password"></span>
                </div>

                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <span class="btn-show-pass">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    <input class="input100" type="password" name="password_confirmation">
                    <span class="focus-input100" data-placeholder="Password Confirmation"></span>
                </div>


                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Reset Password
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
