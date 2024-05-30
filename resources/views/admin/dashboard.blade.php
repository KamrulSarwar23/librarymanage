@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Admin Dashboard</h1>
        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Category</h4>
                            </div>
                            <div class="card-body">
                                {{ $allCategory }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Active Books</h4>
                            </div>
                            <div class="card-body">
                                {{ $activeCategory }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Authors</h4>
                            </div>
                            <div class="card-body">
                                {{ $allAuthor }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Active Authors</h4>
                            </div>
                            <div class="card-body">
                                {{ $activeAuthor }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Publishers</h4>
                            </div>
                            <div class="card-body">
                                {{ $allPublishers }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Active Publishers</h4>
                            </div>
                            <div class="card-body">
                                {{ $activePublishers }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Avaiable Book</h4>
                            </div>
                            <div class="card-body">
                                {{ $availableBook }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Reserved Book</h4>
                            </div>
                            <div class="card-body">
                                {{ $reservedBook }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Lost Book</h4>
                            </div>
                            <div class="card-body">
                                {{ $lostBook }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Checkout Book</h4>
                            </div>
                            <div class="card-body">
                                {{ $checkoutBook }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Reviews</h4>
                            </div>
                            <div class="card-body">
                                {{ $allReview }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Active Review</h4>
                            </div>
                            <div class="card-body">
                                {{ $activeReview }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending Review</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingReview }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total User</h4>
                            </div>
                            <div class="card-body">
                                {{ $allUser }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending User</h4>
                            </div>
                            <div class="card-body">
                                {{ $activeUser }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="#">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending User</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingUser }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </section>
@endsection
