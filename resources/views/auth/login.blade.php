<style>
    .fa-book-open {
        color: green;
    }
</style>


@extends('auth.layout')

@section('title', 'Login')

@section('section')
<div class="container-login100">
    <div class="wrap-login100">
        
        <div class="text-center mb-3">
            <a class="txt2 text-primary" href="{{ route('home.page') }}">
              <span>Go Home </span>
            </a>
        </div>
        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
            @csrf
            <span class="login100-form-title p-b-26">
                Login
            </span>
            <span class="login100-form-title p-b-48">
                <i class="fa-solid fa-book-open"></i>
            </span>

            <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
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

            @if (session('status'))
                <h6 class="text-success mb-2 text-center">{{ session('status') }}</h6>
            @endif

            <div class="container-login100-form-btn">
                <div class="wrap-login100-form-btn">
                    <div class="login100-form-bgbtn"></div>
                    <button class="login100-form-btn">
                        Login
                    </button>
                </div>
            </div>

            <div class="text-center mt-3">
                @if (Route::has('password.request'))
                    <p class="text-danger">Forgot Your Password? <a class="text-primary" href="{{ route('password.request') }}">Click Here</a></p>
                @endif
            </div>

            <div class="text-center p-t-20">
                <span class="txt1">
                    Don’t have an account?
                </span>
                <a class="txt2 text-primary" href="{{ route('register') }}">
                    Sign Up
                </a>
            </div>

     

        </form>
    </div>
</div>

@endsection
