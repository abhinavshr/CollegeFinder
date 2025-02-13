<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
    <link rel="stylesheet" href="{{ asset('css/Users/aboutus.css') }}">
</head>
<body>
    <div class="navbar">
        @include('Users.Shared.Nav')
    </div>
    <div class="header">
        <h1 class="aboutus-header">Your Getway to Higher Education in Nepal</h1>
        <p class="aboutus-paragraph">connecting Nepali Students with the best educational opportunities since 2025</p>
    </div>
    <div class="stats-container">
        <div class="stats-card">
            <strong class="stats-value">{{ $totalColleges }}+</strong>
            <p class="stats-label">Colleges Included</p>
        </div>
        <div class="stats-card">
            <strong class="stats-value">{{ $totalStudents }}+</strong>
            <p class="stats-label">Student Registered</p>
        </div>
        <div class="stats-card">
            <strong class="stats-value">{{ $totalAlumni }}+</strong>
            <p class="stats-label">Alumni Connected</p>
        </div>
    </div>
    <div class="mission-section">
        <h2 class="mission-header">Our Mission</h2>
        <p class="mission-paragraph">At CollegeFinder Nepal, we are dedicated to empowering Nepali students in their pursuit of higher education. We understand the unique challenges faced by students in Nepal and provide comprehensive information about colleges, universities, and educational programs across the country. Our platform helps students navigate through various options in engineering, medicine, management, humanities, and more, while considering factors like location, fees, and career prospects. We're committed to making quality education accessible to every Nepali student.</p>
    </div>

    <div class="features-section">
        <div class="feature-card college-search">
            <img src=" {{ asset('images/icons/search.png') }} " alt="Search Icon">
            <h3>College Search</h3>
            <p>Advanced search tools to help you find the perfect college based on your preferences, location, and academic goals.</p>
        </div>
        <div class="feature-card compare-colleges">
            <img src=" {{ asset('images/icons/compare.png') }} " alt="Compare Icon">
            <h3>Compare Colleges</h3>
            <p>Side-by-side comparison tools to evaluate different colleges based on programs, fees, facilities, placement records, and student reviews.</p>
        </div>
        <div class="feature-card personalized-recommendations">
            <img src=" {{ asset('images/icons/recommendation.png') }} " alt="Recommendation Icon">
            <h3>Personalized Recommendations</h3>
            <p>Get personalized college recommendations based on your academics, interests, and career goals. Our expert counselors assist with applications and admissions tailored to you.</p>
        </div>
    </div>

    <div class="footer">
        @include('Users.Shared.Footer')
    </div>
</body>
</html>
