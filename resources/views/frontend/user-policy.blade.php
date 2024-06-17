@extends('frontend.master')

@section('content')
    <section class="container bg-light shadow rounded my-5 p-5">

        <h2 class="mb-4">Book Borrow Policy</h2>
        <h4 class="text-primary mb-3">You Can Borrow Books for maximum {{ @$policy->days }} Days</h4>

        {!! @$policy->policy !!}
    </section>
@endsection
