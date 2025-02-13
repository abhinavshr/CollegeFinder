<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href=" {{ asset('css/Users/nav.css') }} ">
</head>

<body>
    <nav class="navbar">
        <div class="brand"><a href="{{ route('user.home') }}" style="text-decoration: none; color: white">College Finder</a></div>
        <ul class="nav-links">
            <li><a href="{{ route('user.home') }}" class="{{ request()->routeIs('user.home') ? 'active' : '' }}">Home</a></li>
            <li><a href="{{ route('user.search.colleges') }}" class="{{ request()->routeIs('user.search.colleges') ? 'active' : '' }}">Search College</a></li>
            <li><a href="{{ route('user.compare') }}" class="{{ request()->routeIs('user.compare') ? 'active' : '' }}">Comparison</a></li>
            <li><a href="{{ route('user.aboutus') }}" class="{{ request()->routeIs('user.aboutus') ? 'active' : '' }}">About Us</a></li>
            <li><a href="{{ route('user.contactus') }}"
                    class="{{ request()->routeIs('user.contactus') ? 'active' : '' }}">Contact Us</a></li>
        </ul>

        @if (auth()->check())
            <div class="profile-icon">
                <div class="dropdown" onclick="toggleDropdown(event)">
                    <div class="icon">
                        <img src="{{ asset('storage/images/user/' . auth()->user()->profile_picture) }}"
                            onerror="this.src='{{ asset('images/profile.png') }}'" alt="{{ auth()->user()->username }}">
                    </div>
                    <div id="dropdown-content" class="dropdown-content">
                        <a href="{{ route('user.profile') }}">Profile</a>
                        <a href="#" onclick="document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('user.userlogout') }}" method="POST"
                            style="display: none;">
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

        <script>
            function toggleDropdown(event) {
                event.stopPropagation();
                var dropdown = event.currentTarget.querySelector(".dropdown-content");
                dropdown.classList.toggle("show");
            }

            window.onclick = function() {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                for (var i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        </script>

    </nav>
</body>

</html>

