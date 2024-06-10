<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Book Return Reminder</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: "Arial", sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 0;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(90deg,
                    rgba(2, 0, 36, 1) 0%,
                    rgba(9, 121, 113, 1) 35%,
                    rgba(0, 212, 255, 1) 100%);
            color: #ffffff;
            padding: 30px 20px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }

        .header img {
            max-width: 80px;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            font-size: 20px;
            color: #333333;
        }

        .content p {
            font-size: 16px;
            color: #555555;
            line-height: 1.5;
        }

        .footer {
            text-align: center;
            padding: 15px 20px;
            color: #777777;
            border-top: 1px solid #dddddd;
            background-color: #f4f4f4;
            border-radius: 0 0 8px 8px;
        }

        .btn-custom {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }

        .btn-custom:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('logo/LMS-logo.jpeg') }}" alt="Library Logo" />
            <h1>Reminder For Return Books</h1>
        </div>
        <div class="content">
            <h2>Hello {{ $borrow->user->name }},</h2>
            <p>
                We are LMS. This is a friendly reminder that the return date for the book you
                borrowed is approaching.
            </p>
            <p>
                You have to return this before {{ \Carbon\Carbon::parse($borrow->due_at)->toFormattedDateString() }}
            </p>

            <p>
                Please make sure to return the book by the due date to avoid any late
                fees.
            </p>
            <p>If you have any questions, feel free to contact us.</p>
            <a href="{{ route('contact.page') }}" class="btn-custom">Contact Us</a>
        </div>
        <div class="footer">
            <p>Thank you for using our Library Management System.</p>
            <p><a href="{{ route('home.page') }}">Visit our website</a></p>
        </div>
    </div>
</body>

</html>
