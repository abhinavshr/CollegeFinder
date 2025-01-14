<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Admin Registration</title>
    <link rel="stylesheet" href="{{ asset('css/collegeadmin/collegeadminregister.css') }}">
</head>

<body>
    <div class="background">
        <div class="form-container">
            <div class="form-header">
                <img src="{{ asset('images/collegeadmin/collegeadminlogo.png') }}" alt="Admin Register" class="logo">
                <h1>College Finder Admin Portal</h1>
                <p>Register as College Administrator</p>
            </div>
            <form action="{{ route('admin.collegeadminregister') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <table>
                    <tr>
                        <td><label for="firstname">First Name:</label></td>
                        <td><label for="lastname">Last Name:</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" value="{{ old('firstname') }}" required>
                            @error('firstname')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" value="{{ old('lastname') }}" required>
                            @error('lastname')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label for="college_name">College Name:</label></td>
                        <td><label for="college_email">College Email:</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="college_name" name="college_name" placeholder="Enter your college name" value="{{ old('college_name') }}" required>
                            @error('college_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="email" id="college_email" name="college_email" placeholder="Enter your college email" value="{{ old('college_email') }}" required>
                            @error('college_email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><label for="confirm_password">Confirm Password:</label></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            @error('password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </td>
                        <td>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                            @error('confirm_password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label for="admin_profile">Admin Profile:</label></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="file" name="admin_profile" id="admin_profile">
                            @error('admin_profile')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </td>
                    </tr>
                </table>
                <button type="submit">Register as College Admin</button>
            </form>
        </div>
    </div>
</body>

</html>

