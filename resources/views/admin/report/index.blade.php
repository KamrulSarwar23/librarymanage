@extends('admin.layouts.master')


@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Report</h1>

        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">

                        </div>

                        <div class="card-body">
                            <h2 class="mb-3">Generate Borrow Report</h2>
                            <form action="{{ route('generate.report') }}" method="POST">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="start_date">Start Date:</label>
                                        <input class="form-control" type="date" id="start_date" name="start_date">
                                    </div>

                                    <div class="col-md-6 mb-4">
                                        <label for="end_date">End Date:</label>
                                        <input class="form-control" type="date" id="end_date" name="end_date">
                                    </div>
                                </div>

                                <button class="btn btn-primary" type="submit">Generate Report</button>
                            </form>
                        </div>

                        

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
