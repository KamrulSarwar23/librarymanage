{{-- <x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

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
