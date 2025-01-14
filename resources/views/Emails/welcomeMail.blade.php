<!DOCTYPE html>
<html>
<head>
    <title>Welcome to College Finder!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
            background-color: #FFFFFF;
            border: 1px solid #F4F4F4;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #0056B3;
            color: #FFFFFF;
            padding: 10px;
            text-align: center;
        }
        .header img {
            height: 40px;
            margin: 10px;
        }
        .header h1 {
            margin: 0;
            color: #FFFFFF;
        }
        .content {
            padding: 20px;
        }
        .button {
            background-color: #F5C518;
            color: #FFFFFF;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #F2C000;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo/logo.png') }}" alt="College Finder Logo">
            <h1>Welcome to College Finder!</h1>
        </div>
        <div class="content">
            <h2>Hi {{ $user->firstname }} {{ $user->lastname }},</h2>
            <p>Thank you for joining College Finder! We're excited to help you find your perfect college match.</p>
            <p>Get started by exploring our college database, taking our college matching quiz, or searching for colleges by location, major, and more.</p>
            <p>If you have any questions or need assistance, please don't hesitate to contact us at <a href="mailto:assistancecollegefinder@gmail.com">assistancecollegefinder@gmail.com</a>.</p>
            <p>Best regards,</p>
            <p>The College Finder Team</p>
        </div>
    </div>
</body>
</html>
