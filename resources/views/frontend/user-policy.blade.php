@extends('frontend.master')

@section('content')
    <section class="container bg-light shadow rounded my-5 p-5">

        <h2 class="mb-4">Book Borrow Policy</h2>

        <h5 class="text-primary mb-3">For Borrow a Book First You Have To Register and Login</h5>

        <h5 class="text-primary mb-3">You Can Borrow Books for maximum {{ @$policy->days }} Days</h5>

        <h5 class="text-primary mb-4">Late Fine Per Day {{ @$policy->fine_amount }} Taka</h5>

        {!! @$policy->policy !!}
    </section>
@endsection
