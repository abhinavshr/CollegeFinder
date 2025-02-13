<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $user->firstname }} {{  $user->lastname }} || User Profile</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/profile.css') }} ">
    <link rel="stylesheet" href=" {{ asset('css/users/profile.css') }} ">
</head>
<body>
    <div class="navbar">
        @include('Users.Shared.Nav')
    </div>
    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <img src="{{ asset('storage/images/user/' . auth()->user()->profile_picture) }}" alt="Profile Picture">
            <div class="college-info">
                <h2>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h2>
            </div>
            <button class="edit-icon" onclick="editProfile()">Edit</button>
            <div class="upload-image" style="display: none;">
                <form action=" {{ route('user.profile.update') }} " method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" id="upload-image" name="profile_picture" accept="image/*">
                    <button class="upload-btn" type="submit">Upload</button>
                </form>
            </div>
        </div>

        <script>
            function editProfile() {
                document.querySelector('.college-info').style.display = 'none';
                document.querySelector('.upload-image').style.display = 'block';
            }
        </script>

        <!-- Personal Information Section -->
        <div class="section">
            <h3>Personal Information</h3>
            <form action=" {{ route('user.profile.personalupdate') }} " method="POST">
                @csrf
                @method('PUT')
                <div>
                    <label for="firstname">First Name</label>
                    <input type="text" id="firstname" name="firstname"
                        value="{{ old('firstname', auth()->user()->firstname) }}" disabled>
                    @error('firstname')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="lastname">Last Name</label>
                    <input type="text" id="lastname" name="lastname"
                        value=" {{ old('lastname', auth()->user()->lastname) }} " disabled>
                    @error('lastname')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="date_of_birth">Date Of Birth</label>
                    <input type="date" id="date_of_birth" name="date_of_birth"
                        value=" {{ old('date_of_birth', auth()->user()->date_of_birth) }} " disabled>
                    @error('college_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="college_email">Email</label>
                    <input type="email" id="email" name="email"
                        value=" {{ old('email', auth()->user()->email) }} " disabled>
                    @error('college_email')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                <button class="update-btn" style="display: none;" type="submit">Update</button>
            </form>
            <button class="edit-icon" onclick="editPersonalInfo()">Edit</button>
        </div>

        <style>
            .error {
                color: red;
            }
        </style>

        <script>
            function editPersonalInfo() {
                const inputs = document.querySelectorAll('.section input');
                inputs.forEach(input => {
                    input.disabled = false;
                });
                document.querySelector('.edit-icon').style.display = 'none';
                document.querySelector('.update-btn').style.display = 'block';
            }
        </script>

        <!-- Account Password Section -->
        <div class="section">
            <h3>Account Password</h3>
            <form action=" {{ route('user.profile.passwordupdate') }} " method="POST">
                @csrf
                @method('PUT')
                <div class="password-section">
                    <input type="password" id="password" name="password" placeholder="Enter Password" required>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Confirm Password" required>
                </div>
                <div class="buttons">
                    <button type="submit" class="update-btn">Update</button>
                </div>
            </form>
            <div class="buttons">
            <button type="button" class="cancel-btn" onclick="clearPasswordFields()">Cancel</button>
        </div>
        </div>

        <script>
            function clearPasswordFields() {
                document.getElementById('password').value = '';
                document.getElementById('password_confirmation').value = '';
            }
        </script>

        <!-- Delete Account -->
        <form action=" {{ route('user.profile.delete') }} " method="POST">
            @csrf
            @method('DELETE')
            <button class="delete-btn">Delete</button>
        </form>
    </div>

    <div class="footer">
        @include('Users.Shared.Footer')
    </div>
</body>
</html>
