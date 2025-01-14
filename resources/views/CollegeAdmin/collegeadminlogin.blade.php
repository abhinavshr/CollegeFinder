<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Admin Login</title>
    <link rel="stylesheet" href="{{ asset('css/collegeadmin/collegeadminlogin.css') }}">
</head>

<body>
    <div class="login-container">
        <img src="{{ asset('images/collegeadmin/collegeadminloginlogo.png') }}" alt="Shield Icon">
        <h1>College Admin Login</h1>
        <form action="{{ route('collegeadmin.collegeadminlogin.check') }}" method="POST">
            @csrf
            <label for="college_email">Email:</label>
            <input type="email" id="college_email" name="college_email" required>
            @if ($errors->has('college_email'))
                <p class="error">{{ $errors->first('college_email') }}</p>
            @endif
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            @if ($errors->has('password'))
                <p class="error">{{ $errors->first('password') }}</p>
            @endif
            <button type="submit">Access Login</button>
        </form>
    </div>
</body>

</html>
