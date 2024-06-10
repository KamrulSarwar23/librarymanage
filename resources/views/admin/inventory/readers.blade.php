@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Add Book Quantity</h1>
        </div>
        <div class="section-header">
            <h1 class="text-primary"><i class="fa-solid fa-link mr-2"></i>{{ $book->title }}</h1>
        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <th>Id</th>
                                    <th>User Name</th>
                                    <th>User Email</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th style="width: 5%">Notify</th>
                                    @foreach ($readers as $key => $reader)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $reader->user->name }}</td>
                                            <td>{{ $reader->user->email }}</td>
                                            <td>{{ $reader->issued_at }}</td>
                                            <td>{{ $reader->due_at }}</td>
                                            <td>
                                                @if ($reader->notify == 1)
                                                    <span class="badge bg-success">Already Notified</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Your Due date Not <br> passed
                                                        or
                                                        Server issue</span>
                                                @endif
                                            </td>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>


                                <div class="pagination">
                                    {{-- {{ $books->links() }} --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection


@push('scripts')
@endpush
