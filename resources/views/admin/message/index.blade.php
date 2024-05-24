@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Messages</h1>

        </div>

        <div class="section-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                          <div class="table-responsive">
                            <table class="table table-striped">
                                <th>Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Recieved Time</th>
                                <th>Delete</th>
                                @foreach ($messages as $message)
                                    <tr>
                                        <td>{{ $message->id }}</td>
                                        <td>{{ $message->firstName }}</td>
                                        <td>{{ $message->lastName }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td>{{ $message->phone }}</td>
                                        <td>{{ $message->message }}</td>
                                        <td>{{ \Carbon\Carbon::parse($message->created_at)->format('F j, Y, g:i a') }}</td>
                                        <td>

                                            <a class="delete-item btn btn-danger" href="{{ route('message.destroy', $message->id) }}">Delete</a>
                                        
                                        </td>
                                    </tr>
                                @endforeach

                            </table>
                          </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
