<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Admins</title>
    <link rel="stylesheet" href=" {{ asset('css/Admin/pages/adminlist.css') }} ">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
</head>

<body>
    <div class="sidenavbar">
        @include('Admin.shared.SideNav')
    </div>
    <div class="container">
        <div class="header">
            <h1>Manage Admins</h1>
            <span class="sub-header">{{ $CollegeAdmins->count() }} Admins</span>
            <a href=" {{ route('admin.collegeadminregister') }} " style=" text-decoration: none"><button class="add-admin-btn">
                <span class="material-symbols-outlined">add</span> Add Admins
            </button></a>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($CollegeAdmins as $collegeadmin)
                    <tr>
                        <td><img src="{{ asset('storage/images/collegeadmin/' . $collegeadmin->admin_profile) }}" alt="Profile Image" class="profile-img"></td>
                        <td>{{ $collegeadmin->firstname }} {{ $collegeadmin->lastname }}</td>
                        <td>{{ $collegeadmin->college_email }}</td>
                        <td><span class="role-badge">College Admin</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
