<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="{{ asset('css/Users/userlogin.css') }}">
</head>
<body>
  <div class="background">
    <div class="login-container">
      <div class="logo">
        <img src="{{ asset('images/users/graduation-hat.png') }}" alt="Logo" class="logo-image">
      </div>
      <h1>Welcome Back</h1>
      <p>Glad to see you again<br>Login to your account below</p>
      <form action="{{ route('user.userlogin.check') }}" method="POST">
        @csrf
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter email..." value="{{ old('email') }}" required>
          @error('email')
          <span class="error-message">{{ $message }}</span>
          @enderror
        </div>
        <div class="input-group password-group">
            <label for="password">Password</label>
            <div class="password-container">
              <input type="password" id="password" name="password" placeholder="Enter password..." required>
              <span class="toggle-password">
                <img src="{{ asset('images/icons/eye.png') }}" id="eye-icon" alt="Show Password">
              </span>
            </div>
            @error('password')
            <span class="error-message">{{ $message }}</span>
            @enderror
          </div>

        <button type="submit" class="login-btn">Login</button>
      </form>
      <p class="signup-text">
        Don’t have an account? <a href="{{ route('user.userregister') }}">Sign up for free</a>
      </p>
    </div>
  </div>
  <script src=" {{asset('js/showpassword.js')}} "></script>
</body>
</html>
