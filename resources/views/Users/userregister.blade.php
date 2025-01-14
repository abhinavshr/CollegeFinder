<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Finder</title>
    <link rel="stylesheet" href=" {{ asset('css/Users/userregister.css') }} ">
</head>
<body>
    <div class="background">
        <div class="form-container">
            <div class="form-header">
                <img src=" {{ asset('images/users/graduation-hat.png') }} " alt="Graduation Hat Icon" class="icon">
                <h1>College Finder</h1>
                <p>Find Your Perfect College Match</p>
            </div>
            <form action="{{ route('user.userregister.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="input-container">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Enter First name...." value="{{ old('firstname') }}">
                        @error('firstname')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-container">
                        <label for="lastname">Last Name:</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Enter Last name...." value="{{ old('lastname') }}">
                        @error('lastname')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-container">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="Enter email...." value="{{ old('email') }}">
                        @error('email')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-container">
                        <label for="date_of_birth">Date of Birth:</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-container">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter password....">
                        @error('password')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-container">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Enter Confirm password....">
                        @error('password_confirmation')
                        <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="input-container">
                    <label for="profile_picture">Profile Picture:</label>
                    <input type="file" id="profile_picture" name="profile_picture">
                    @error('profile_picture')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn-submit">Start Your College Journey</button>
            </form>
            <p class="login-link">Already Have an account? <a href=" {{ route('user.userlogin') }} ">Login</a></p>

        </div>
    </div>
</body>
</html>
