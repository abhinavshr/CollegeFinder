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
      <div>
        <label for="first-name">First Name</label>
        <input type="text" id="first-name" value="{{ auth()->user()->firstname }}" disabled>
      </div>
      <div>
        <label for="last-name">Last Name</label>
        <input type="text" id="last-name" value=" {{ auth()->user()->lastname }} " disabled>
      </div>
      <div>
        <label for="college-email">College Email</label>
        <input type="email" id="college-email" value=" {{ auth()->user()->college_email }} " disabled>
      </div>
      <div>
        <label for="college-name">College Name</label>
        <input type="text" id="college-name" value=" {{ auth()->user()->college_name }} " disabled>
      </div>
      <button class="edit-icon">Edit</button>
    </div>

    <!-- Account Password Section -->
    <div class="section">
      <h3>Account Password</h3>
      <div class="password-section">
        <input type="password" id="password" placeholder="Enter Password">
        <input type="password" id="confirm-password" placeholder="Confirm Password">
      </div>
      <div class="buttons">
        <button class="cancel-btn">Cancel</button>
        <button class="update-btn">Update</button>
      </div>
    </div>

    <!-- Delete Account -->
    <button class="delete-btn">Delete</button>
  </div>
</body>
</html>
