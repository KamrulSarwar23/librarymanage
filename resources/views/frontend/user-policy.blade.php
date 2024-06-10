@extends('frontend.master')

@section('content')
    <section class="container bg-light shadow rounded my-5 py-2">
        {!! @$policy->policy !!}
    </section>
@endsection
