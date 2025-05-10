<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admnin Login</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/adminlogin.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Rubik+Wet+Paint&display=swap" rel="stylesheet">
</head>

<body>
    <div class="logincontainer">
        <img src=" {{ asset('images/admin/crown.png')}} " alt="Crown Image" class="crown">
        <h1 class="loginheader">Admin Portal</h1>
        <form action=" {{ route('admin.adminlogin.check')}} " method="post">
            @csrf
            <label for="email">Admin Email</label><br>
            <input type="email" placeholder="Enter Admin Email" name="email"><br>
            @if ($errors->has('email'))
                <p class="error">{{ $errors->first('email') }}</p>
            @endif
            <label for="password">Password</label><br>
            <input type="password" placeholder="Enter Password" name="password"><br>
            @if ($errors->has('password'))
                <p class="error">{{ $errors->first('password') }}</p>
            @endif
            <button type="submit" class="loginbutton">Authorize Access</button>
        </form>
    </div>
</body>

</html>
