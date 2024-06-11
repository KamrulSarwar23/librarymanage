<style>
    .fa-book-open {
        color: green;
    }
</style>

@extends('auth.layout')

@section('title', 'Register')

@section('section')
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="text-center mb-3">
                <a class="txt2 text-primary" href="{{ route('home.page') }}">
                  <span>Go Home </span>
                </a>
            </div>
            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                @csrf
                <span class="login100-form-title p-b-26">
                    Register
                </span>
                <span class="login100-form-title p-b-48">
                    <i class="fa-solid fa-book-open"></i>
                </span>

                <div class="wrap-input100 validate-input" data-validate = "Name Is Required">
                    <input class="input100" type="text" name="name">
                    <span class="focus-input100" data-placeholder="Name"></span>
                </div>

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

                @if (session('register'))
                <h6 class="text-success mb-2 text-center">{{ session('register') }}</h6>
                @endif

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                            Register
                        </button>
                    </div>
                </div>

                <div class="text-center pt-3">
                    <span class="txt1">
                        Already have an account?
                    </span>

                    <a class="txt2 text-primary" href="{{ route('login') }}">
                        Sign In
                    </a>
                </div>
            
            </form>
        </div>
    </div>

@endsection
