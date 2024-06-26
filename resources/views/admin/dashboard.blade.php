@extends('admin.layouts.master')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>Admin Dashboard</h1>
        </div>
        @if (count($newBookRequest) > 0)
        <section class="mt-4">
            <h4 class="mb-4 text-center">New Book Requests</h4>
            <div class="row">

                @foreach ($newBookRequest as $item)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-3">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <div class="d-flex align-items-center mb-3">

                                    <img style="border-radius: 50%" width="50px" height="50px"
                                        src="{{ asset($item->user->image ?? 'frontend/images/user.png') }}"
                                        alt="">

                                    <div class="ms-3">
                                        <h5 class="card-title mb-0">{{ $item->user->name }}</h5>
                                        <p class="text-muted card-title mb-0">{{ $item->user->email }}</p>
                                        <p class="card-subtitle text-muted">
                                            {{ \Carbon\Carbon::parse($item->created_at)->format('F j, Y, g:i a') }}</p>
                                    </div>
                                </div>

                                <h6 class="card-text flex-grow-1"><a
                                        href="{{ route('book.details', $item->book_id) }}">{{ $item->book->title }}</a>
                                </h6>
                                <a href="{{ route('book.borrowinfo') }}" class="btn btn-primary mt-auto">View Request</a>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    @endif
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('category.index') }}">
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
                <a href="{{ route('active.category') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Active Category</h4>
                            </div>
                            <div class="card-body">
                                {{ $activeCategory }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('pending.category') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending Category</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingCategory }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('author.index') }}">
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
                <a href="{{ route('active.author') }}">
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

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('pending.author') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending Authors</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingAuthor }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>



            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('publisher.index') }}">
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
                <a href="{{ route('active.publisher') }}">
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
                <a href="{{ route('pending.publisher') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending Publishers</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingPublishers }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('book.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Book</h4>
                            </div>
                            <div class="card-body">
                                {{ $allBook }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('active.book') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Active Book</h4>
                            </div>
                            <div class="card-body">
                                {{ $activeBook }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('inactive.book') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Inactive Book</h4>
                            </div>
                            <div class="card-body">
                                {{ $inactiveBook }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('book.borrowinfo') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>All Borrow Request</h4>
                            </div>
                            <div class="card-body">
                                {{ $allBorrow }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('book.borrowinfo') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Received Borrow Request</h4>
                            </div>
                            <div class="card-body">
                                {{ $receiveBorrow }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('book.borrowinfo') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Pending Borrow Request</h4>
                            </div>
                            <div class="card-body">
                                {{ $pendingBorrow }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('book.borrowinfo') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Reject Borrow Request</h4>
                            </div>
                            <div class="card-body">
                                {{ $rejectBorrow }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('book.borrowinfo') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Return Borrow Request</h4>
                            </div>
                            <div class="card-body">
                                {{ $returnBorrow }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>


            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('admin.book-review') }}">
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
                <a href="{{ route('active.review') }}">
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
                <a href="{{ route('pending.review') }}">
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
                <a href="{{ route('user-manage.index') }}">
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
                <a href="{{ route('user-manage.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Active User</h4>
                            </div>
                            <div class="card-body">
                                {{ $activeUser }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('user-manage.index') }}">
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

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <a href="{{ route('message.index') }}">
                    <div class="card card-statistic-1">
                        <div class="card-icon bg-info">
                            <i class="fas fa-th-large"></i>
                        </div>
                        <div class="card-wrap">
                            <div class="card-header">
                                <h4>Total Message</h4>
                            </div>
                            <div class="card-body">
                                {{ $allMessage }}
                            </div>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </section>


 



@endsection
