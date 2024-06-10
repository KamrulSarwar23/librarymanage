<!-- resources/views/reports/borrow_report.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Borrow Report</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
            background-color: #f9f9f9;
        }
        h1 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }
        p {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-bottom: 40px;
        }
        .table-container {
            width: 100%;
            overflow-x: auto;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 8px;
            background-color: #fff;
            padding: 20px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 12px 15px;
            text-align: left;
        }
        .table th {
            background-color: #4CAF50;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            border-bottom: 2px solid #e0e0e0;
        }

        th,td{
            font-size: 10px
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .table tr:hover {
            background-color: #e0f7fa;
        }
        .table td {
            border-bottom: 1px solid #e0e0e0;
            color: #555;
        }
        .table td:first-child {
            border-top-left-radius: 8px;
            border-bottom-left-radius: 8px;
        }
        .table td:last-child {
            border-top-right-radius: 8px;
            border-bottom-right-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>Borrow Report</h1>
    <p>Date Range: {{ $request->start_date }} to {{ $request->end_date }}</p>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Book</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Issued At</th>
                    <th>Due At</th>
                    <th>Returned At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($borrows as $borrow)
                    <tr>
                        <td>{{ $borrow->id }}</td>
                        <td>{{ $borrow->user->name }}</td>
                        <td>{{ $borrow->book->title }}</td>
                        <td>{{ $borrow->book->author->name }}</td>
                        <td>{{ $borrow->book->publisher->name }}</td>
                        <td>{{ $borrow->issued_at }}</td>
                        <td>{{ $borrow->due_at }}</td>
                        <td>{{ $borrow->returned_at }}</td>
                        <td>{{ ucfirst($borrow->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
