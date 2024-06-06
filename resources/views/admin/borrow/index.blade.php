@extends('admin.layouts.master')


@section('content')
    <style>
        .enjoyedbook a {
            text-decoration: none;
        }


        .rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            color: #ddd;
            /* Personal choice */
            font-size: 7px;
            margin-left: -15px;
        }


        .rating input {
            display: none;
        }


        .rating label:hover,
        .rating label:hover~label,
        .rating input:checked+label,
        .rating input:checked+label~label {
            color: #3a92f7;
            font-size: 7px;
        }


        .front-stars,
        .back-stars,
        .star-rating {
            display: flex;
        }


        .star-rating {
            align-items: left;
            font-size: 15px;
            justify-content: left;
            margin-left: -5px;
        }


        .back-stars {
            color: #CCC;
            position: relative;
        }


        .front-stars {
            color: #3a92f7;
            overflow: hidden;
            position: absolute;
            top: 0;
            transition: all 0.5s;
        }




        .percent {
            color: #bb5252;
            font-size: 1.5em;
        }


        li {
            list-style-type: none
        }


        td {
            white-space: nowrap;
        }


        th {
            white-space: nowrap;
        }
    </style>




    <section class="section">
        <div class="section-header">
            <h1>Borrow Request</h1>


        </div>


        <div class="section-body">


            <li>
                {{-- <div class="dropdown mt-2 mb-3">
                   <button class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                       Filter Reviews
                   </button>


                   <ul class="dropdown-menu">
                       <li><a class="dropdown-item btn-info {{ request()->routeIs('admin.book-review') ? 'active' : '' }}"
                               href="{{ route('admin.book-review') }}">All</a></li>
                       <li><a class="dropdown-item btn-info {{ request()->routeIs('active.review') ? 'active' : '' }}"
                               href="{{ route('active.review') }}">Active</a></li>
                       <li><a class="dropdown-item btn-info {{ request()->routeIs('pending.review') ? 'active' : '' }}"
                               href="{{ route('pending.review') }}">Pending</a></li>
                   </ul>
               </div> --}}
            </li>


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Book Name</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Status</th>






                                    @foreach ($books as $book)
                                        <form action="{{ route('book-borrow.updateInfo') }}" method="POST">
                                            @csrf
                                            <tr>
                                                <td>{{ $book['username'] }}</td>
                                                <td>{{ $book['userEmail'] }}</td>
                                                <td>{{ $book['bookTitle'] }}</td>
                                                <input type="hidden" name="book_id" value="{{ $book['bookId'] }}" />
                                                <input type="hidden" name="user_id" value="{{ $book['userId'] }}">


                                                <td class="form-group">
                                                    <label for="issue_date" class="sr-only">Issue Date</label>
                                                    <input type="date" name="issued_at" value="{{ $book['issued_at'] }}"
                                                        class="form-control issue_date" placeholder="Issue Date">
                                                </td>


                                                <td class="form-group">
                                                    <label for="due_date" class="sr-only">Due Date</label>
                                                    <input type="date" name="due_at" value="{{ $book['due_at'] }}"
                                                        class="form-control due_date" placeholder="Due Date">
                                                </td>


                                                {{-- <td>
                                                   @if ($book['status'] == 'active')
                                                       <label class="custom-switch">
                                                           <input type="checkbox" checked name="custom-switch-checkbox"
                                                               data-id="{{ $book['bookId'] }}" id="flexSwitchCheckDefault{{ $book['bookId'] }}"
                                                               class="custom-switch-input change-status">
                                                           <span class="custom-switch-indicator"></span>
                                                       </label>
                                                   @else
                                                       <label class="custom-switch">
                                                           <input type="checkbox" name="custom-switch-checkbox"
                                                               data-id="{{ $book['bookId'] }}" id="flexSwitchCheckDefault{{ $book['bookId'] }}"
                                                               class="custom-switch-input change-status">
                                                           <span class="custom-switch-indicator"></span>
                                                       </label>
                                                   @endif
                                               </td> --}}

                                                {{-- <td>
                                                   <a class="delete-item btn btn-danger"
                                                       href="{{ route('book-reviews.delete', $review->id) }}"><i
                                                           class="fas fa-trash"></i></a>

                                               </td> --}}


                                                @if ($book['status'] === 'active')
                                                    <td>
                                                        <input type="hidden" name="status" value='inactive'>
                                                        <div class="d-flex flex-column align-items-center">
                                                            <small>Click To Disapprove</small>
                                                            <button type="input"
                                                                class="btn btn-warning">Disapprove</button>
                                                        </div>
                                                    </td>
                                                @else
                                                    <td>
                                                        <input type="hidden" name="status" value='active'>
                                                        <div class="d-flex flex-column align-items-center">
                                                            <small>Click To Approve</small>
                                                            <button type="input" class="btn btn-success">Approve</button>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        </form>
                                    @endforeach
                                    {{-- @if ($reviews->isEmpty())
                                       <div class="alert alert-danger mt-5" role="alert">
                                           No Data Found
                                       </div>
                                   @endif --}}
                                </table>


                                {{-- <div class="pagination">
                                   {{ $reviews->links() }}
                               </div> --}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>




    {{-- <table>
       <thead>
           <tr>
               <th>Username</th>
               <th>Book Title</th>
               <th>Issue date</th>
               <th>Due date</th>
           </tr>
       </thead>
       <tbody>
           @foreach ($data as $item)
               <tr>
                   <td>{{ $item['username'] }}</td>
                   <td>{{ $item['bookTitle'] }}</td>
                   <td>{{ $item['issued_at'] }}</td>
                   <td>{{ $item['due_at'] }}</td>
               </tr>
           @endforeach


       </tbody>
   </table> --}}
@endsection




@push('scripts')
    <script>
        $(document).ready(function() {
            $('body').on('click', '.change-status', function() {


                const isChecked = $(this).is(':checked');
                const issueDate = $('#issue_date').val();
                const dueDate = $('#due_date').val();
                const bookId = $('.book_id').val();
                const userId = $('.user_id').val();




                if (issueDate === "" || dueDate === "") {
                    alert('Please fill in the start date and end date');
                    return;
                }


                // $.ajax({
                //     url: "{{ route('book-borrow.updateInfo') }}",
                //     method: 'PUT',
                //     data: {
                //         status: isChecked,
                //         issueDate,
                //         dueDate,
                //         bookId,
                //         userId
                //     },
                //     success: function(data) {
                //         console.log(data)
                //         toastr.success(data.message);
                //     },
                //     error: function(xhr, status, error) {
                //         console.log(error);
                //     }
                // });
            });




        });
    </script>
@endpush
