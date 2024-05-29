<style>
    .fa-book-open {
        color: green;
    }
</style>
@extends('auth.layout')

@section('section')


    <div class="container-login100">
      
        <div class="wrap-login100">
            <form class="login100-form validate-form" method="POST" action="{{ route('password.email') }}">
                @csrf
          
                <span class="login100-form-title p-b-26">
                   Forgot Password
                </span>
                <span class="login100-form-title p-b-48">
                    <i class="fa-solid fa-book-open"></i>
                </span>

                <div class="mb-4 text-sm text-gray-600">
                    <p>Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one</p>
                </div>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
                    <input class="input100" type="text" name="email">
                    <span class="focus-input100" data-placeholder="Email"></span>
                </div>

                @if (session('status'))
                <h6 class="text-success mb-2 text-center">{{ session('status') }}</h6>
                @endif

                {{-- <div class="text-center">
     
                    <button class="btn btn-success" type="submit">Email Password Reset Link</button>
                </div> --}}

                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn">
                        <div class="login100-form-bgbtn"></div>
                        <button class="login100-form-btn">
                           Send Link
                        </button>
                    </div>
                </div>

                <div class="text-center p-t-20">
                    <a class="txt2 text-primary" href="{{ route('login') }}">
                      <span>Go Back </span>
                    </a>
                </div>
        </div>
        </form>
    </div>
    </div>
@endsection
