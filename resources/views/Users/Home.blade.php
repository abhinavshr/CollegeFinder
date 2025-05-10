<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/Users/home.css') }}">
</head>
<body>
    <div class="navbar">
        @include('Users.Shared.Nav')
    </div>

    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Find Your Dream College</h1>
            <p>Explore top colleges and universities across the country. Use our comprehensive college recommendations and resources to make well-informed decisions about your future.</p>
            <a href=" {{ route('user.search.colleges') }} " class="explore-button">Explore Colleges</a>
        </div>
    </div>

    <div class="features-section">
        <div class="feature-card">
            <img src=" {{ asset("images/users/database.png") }} " alt="Database Icon">
            <h3>Comprehensive Database</h3>
            <p>Access detailed information about thousands of colleges and universities.</p>
        </div>
        <div class="feature-card">
            <img src=" {{ asset("images/users/compare.png") }} " alt="Compare Icon">
            <h3>Compare Colleges</h3>
            <p>Step-by-step guidance through the college application process.</p>
        </div>
        <div class="feature-card">
            <img src=" {{ asset("images/users/recommendation.png") }} " alt="Recommendation Icon">
            <h3>Recommendation Engine</h3>
            <p>Get personalized college recommendations based on your interests and preferences.</p>
        </div>
    </div>

    <div class="footer">
        @include('Users.Shared.Footer')
    </div>
</body>
</html>
