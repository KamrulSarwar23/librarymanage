@extends('frontend.master')

@section('content')

<style>

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

textarea.form-control {
    height: 150px;
}

input{
    background: rgb(98, 213, 221)
}

.text-danger {
    color: red;
    margin-top: 5px;
}


.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}



</style>

<div class="site-section mt-5">
    <div class="container bg-dark p-5 rounded">
        <form action="{{ route('send.message') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 form-group mb-4">
                    <label for="firstName">First Name</label>
                    <input type="text" name="firstName" class="form-control form-control-lg"
                        value="{{ old('firstName') }}">
                    @error('firstName')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 form-group mb-4">
                    <label for="lastName">Last Name</label>
                    <input type="text" name="lastName" class="form-control form-control-lg"
                        value="{{ old('lastName') }}">
                    @error('lastName')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 form-group mb-4">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg"
                        value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 form-group mb-4">
                    <label for="phone">Phone Number</label>
                    <input type="text" name="phone" class="form-control form-control-lg"
                        value="{{ old('phone') }}">
                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-12 form-group">
                    <label for="message">Message</label>
                    <textarea name="message" cols="30" rows="5" class="form-control">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <input type="submit" value="Send Message" class="btn btn-primary btn-lg px-5">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection
