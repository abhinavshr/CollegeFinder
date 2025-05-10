<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/profile.css') }} ">
</head>

<body>
    <div class="sidenav">
        @include('Admin.shared.SideNav')
    </div>
    <div class="profile-container">
        <!-- Profile Header -->
        <div class="profile-header">
            <img src="{{ asset('storage/images/collegeadmin/' . auth()->user()->admin_profile) }}" alt="Profile Picture">
            <div class="college-info">
                <h2>{{ auth()->user()->college_name }}</h2>
                <p>{{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</p>
            </div>
            <button class="edit-icon" onclick="editProfile()">Edit</button>
            <div class="upload-image" style="display: none;">
                <form action="{{ route('collegeadmin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" id="upload-image" name="admin_profile" accept="image/*">
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
            <form action="{{ route('collegeadmin.profile.personalupdate') }}" method="POST">
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
                    <label for="college_name">College Name</label>
                    <input type="text" id="college_name" name="college_name"
                        value=" {{ old('college_name', auth()->user()->college_name) }} " disabled>
                    @error('college_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="college_email">College Email</label>
                    <input type="email" id="college_email" name="college_email"
                        value=" {{ old('college_email', auth()->user()->college_email) }} " disabled>
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
            <form action="{{ route('collegeadmin.profile.passwordupdate') }}" method="POST">
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
        <form action="{{ route('collegeadmin.profile.delete') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="delete-btn">Delete</button>
        </form>
    </div>
</body>

</html>
