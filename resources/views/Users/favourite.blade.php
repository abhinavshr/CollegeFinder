<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Favourite Colleges || College Finders</title>
    <link rel="stylesheet" href="{{ asset('css/Users/searchcollege.css') }}">
</head>

<body>
    <div class="navbar">
        @include('Users.Shared.Nav')
    </div>

    <div class="hero-section">
        <div class="hero-content">
            <h1>My Favourite Colleges</h1>
            <p>View the colleges you've added to your favourites</p>
        </div>
    </div>

    <div class="collegecard-container">
        @if ($favorites->count() > 0)
            @foreach ($favorites as $favorite)
                <a href="{{ route('user.colleges.show', ['id' => $favorite->college->id]) }}" style="text-decoration: none">
                    <div class="college-card">
                        <img src="{{ asset('storage/images/college/logo/' . $favorite->college->logo) }}"
                            alt="{{ $favorite->college->name }} Logo">
                        <h2>{{ $favorite->college->name }}</h2>
                        <p>{{ $favorite->college->location }}, {{ $favorite->college->city }}</p>
                        <button class="love-btn loved" disabled>
                            ❤️ Favourited
                        </button>
                    </div>
                </a>
            @endforeach
        @else
            <p style="text-align: center; font-size: 1.2rem; color: gray;">You haven't added any favourite colleges yet.</p>
        @endif
    </div>

    <div class="footer">
        @include('Users.Shared.Footer')
    </div>

    <script src="{{ asset('js/favorite.js') }}"></script>
</body>

</html>
