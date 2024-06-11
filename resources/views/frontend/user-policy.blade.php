@extends('frontend.master')

@section('content')
    <section class="container bg-light shadow rounded my-5 p-5">

        <h2>Book Borrow Duration</h2>
        <h3 class="text-primary mb-3">You Can Borrow Books for  {{ @$policy->days }} Days</h3>

        {!! @$policy->policy !!}
    </section>
@endsection
