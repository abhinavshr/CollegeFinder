<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Finder Sidebar</title>
    <link rel="stylesheet" href=" {{ asset('css/Admin/sidenav.css') }} ">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">

</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <div class="logo">
                <img src=" {{ asset('images/admin/whitelogo.png') }} " alt="Logo" class="logo-img">
                <span class="logo-text">College Finder</span>
            </div>
        </div>
        <ul class="menu">
            <li><a href="#admin-dashboard"><span class="material-symbols-outlined">home</span> Admin Dashboard</a></li>
            <li>
                @auth('admin')
                    <a href="{{ route('admin.collegelist') }}"><span class="material-symbols-outlined">school</span> College Management</a>
                @endauth

                @auth('collegeadmin')
                    <a href="{{ route('collegeadmin.collegelist') }}"><span class="material-symbols-outlined">school</span> College Management</a>
                @endauth
            </li>
            <li>
                @auth('admin')
                    <a href="{{ route('admin.courselist') }}"><span class="material-symbols-outlined">menu_book</span>Course Management</a>
                @endauth
                @auth('collegeadmin')
                    <a href="{{ route('collegeadmin.courselist') }}"><span class="material-symbols-outlined">menu_book</span>Course Management</a>
                @endauth
            </li>
            <li>
                @auth('admin')
                    <a href="{{ route('admin.adminlist') }}"><span class="material-symbols-outlined">list</span> Admin List</a>
                @endauth
                @auth('collegeadmin')
                    <a href="{{ route('collegeadmin.adminlist') }}"><span class="material-symbols-outlined">list</span> Admin List</a>
                @endauth
            </li>
            <li><a href="#user-list"><span class="material-symbols-outlined">list</span> User List</a></li>
            <li>
                @auth('admin')
                    <a href=" {{ route('admin.scholarshiplist') }} "><span class="material-symbols-outlined"> social_leaderboard </span> Scholarship</a>
                @endauth
                @auth('collegeadmin')
                    <a href=" {{ route('collegeadmin.scholarshiplist') }} "><span class="material-symbols-outlined"> social_leaderboard </span> Scholarship</a>
                @endauth
            </li>
            @auth('collegeadmin')
            <li><a href=" {{ route('collegeadmin.profile') }} "><span class="material-symbols-outlined">settings</span> Setting</a></li>
            @endauth
        </ul>
        <div class="logout">
            @auth('collegeadmin')
            <form action="{{ route('collegeadmin.collegeadminlogout') }}" method="POST">
                @csrf
                <button type="submit" class="logout"><span class="material-symbols-outlined">logout</span> College Admin Logout</button>
            </form>
            @endauth

            @auth('admin')
            <form action="{{ route('admin.adminlogout') }}" method="POST">
                @csrf
                <button type="submit" class="logout"><span class="material-symbols-outlined">logout</span> Logout</button>
            </form>
            @endauth
        </div>
    </div>
</body>

</html>
