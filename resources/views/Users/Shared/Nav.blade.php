<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/Users/nav.css') }}">
</head>

<body>
    <nav class="navbar">
        <div class="brand">
            <a href="{{ route('user.home') }}" style="text-decoration: none; color: white">College Finder</a>
        </div>

        <ul class="nav-links">
            <li><a href="{{ route('user.home') }}" class="{{ request()->routeIs('user.home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('user.search.colleges') }}" class="{{ request()->routeIs('user.search.colleges') ? 'active' : '' }}">Search College</a></li>
            <li><a href="{{ route('user.compare') }}" class="{{ request()->routeIs('user.compare') ? 'active' : '' }}">Comparison</a></li>
            <li><a href="{{ route('user.aboutus') }}" class="{{ request()->routeIs('user.aboutus') ? 'active' : '' }}">About Us</a></li>
            <li><a href="{{ route('user.contactus') }}" class="{{ request()->routeIs('user.contactus') ? 'active' : '' }}">Contact Us</a></li>
        </ul>

        <div class="menu-toggle" onclick="toggleDrawer()">&#9776;</div>

        <div class="drawer" id="drawer">
            <ul>
                <li><a href="{{ route('user.home') }}">Home</a></li>
                <li><a href="{{ route('user.search.colleges') }}">Search College</a></li>
                <li><a href="{{ route('user.compare') }}">Comparison</a></li>
                <li><a href="{{ route('user.aboutus') }}">About Us</a></li>
                <li><a href="{{ route('user.contactus') }}">Contact Us</a></li>
            </ul>
        </div>

        @if (auth()->check())
            <div class="profile-icon">
                <div class="dropdown" onclick="toggleDropdown(event)">
                    <div class="icon">
                        <img src="{{ asset('storage/images/user/' . auth()->user()->profile_picture) }}"
                             onerror="this.src='{{ asset('images/profile.png') }}'"
                             alt="{{ auth()->user()->username }}">
                    </div>
                    <div id="dropdown-content" class="dropdown-content">
                        <a href="{{ route('user.profile') }}">Profile</a>
                        <a href="{{ route('user.favouritecollege') }}">My Favourite Colleges</a>
                        <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('user.userlogout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="login-btn">
                <a href="{{ route('user.userlogin') }}" class="btn">Login</a>
            </div>
        @endif
    </nav>

    <script>
        function toggleDropdown(event) {
            event.stopPropagation();
            const dropdown = event.currentTarget.querySelector(".dropdown-content");
            dropdown.classList.toggle("show");
        }

        window.onclick = function () {
            const dropdowns = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < dropdowns.length; i++) {
                if (dropdowns[i].classList.contains('show')) {
                    dropdowns[i].classList.remove('show');
                }
            }
        }

        function toggleDrawer() {
            document.getElementById("drawer").classList.toggle("show-drawer");
        }
    </script>
</body>

</html>
