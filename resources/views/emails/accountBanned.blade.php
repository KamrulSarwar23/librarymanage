<!DOCTYPE html>
<html>
<head>
    <title>Account Banned</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 1px solid #eeeeee;
        }
        .header h2 {
            margin: 0;
            color: #007bff;
        }
        .content {
            padding: 20px;
        }
        .content h3 {
            color: #007bff;
        }
        .content p {
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #eeeeee;
            margin-top: 20px;
            font-size: 0.9em;
            color: #999999;
        }
        .btn {
            display: inline-block;
            background-color: #1fc0cc;
            color: #ffffff;
            padding: 10px 20px;
            margin-top: 20px;
            text-decoration: none;
            border-radius: 4px;
        }
        .btn:hover {
            background-color: #1fc8d4;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Your Account Has Been Banned</h2>
        </div>
        <div class="content">
            <p>Hello, <strong>{{ $user->name }}</strong></p>
            <h3>You cant login in to your account.</h3>
        </div>
        <div class="footer">
            <h3>If you have any questions, feel free to <a href="http://127.0.0.1:8000/contact">contact us</a>.</h3>
            <h3>Thank you for choosing our service!</h3>
        </div>
    </div>
</body>
</html>
