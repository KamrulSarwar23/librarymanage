@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User Policy</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-12">
                    <div class="card">

                        <div class="card-body">

                            <form action="{{ route('user-policy.store') }}" method="POST">
                                @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Days</label>
                                        <input type="text" class="form-control" name="days"
                                            value="{{ isset($policy) ? $policy->days : '' }}">
                                    </div>                               
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Per Day Fine Amount</label>
                                        <input type="text" class="form-control" name="fine_amount"
                                            value="{{ isset($policy) ? $policy->fine_amount : '' }}">
                                    </div>
                                </div>
                                
                            </div>

                                <div class="form-group">
                                    <label>Policy</label>
                                    <textarea class="form-control summernote" name="policy" id="" cols="30" rows="10">{{ isset($policy) ? $policy->policy : '' }}</textarea>
                                </div>

                                @if (isset($policy))
                                    <input type="text" hidden name="id" value="{{ $policy->id }}">
                                    <button type="submit" class="btn btn-info">Update</button>
                                @else
                                    <button type="submit" class="btn btn-info">Create</button>
                                @endif

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection
