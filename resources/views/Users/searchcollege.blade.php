<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Serach College</title>
    <link rel="stylesheet" href="{{ asset('css/Users/searchcollege.css') }}">
</head>

<body>
    <div class="navbar">
        @include('Users.Shared.Nav')
    </div>
    <div class="hero-section">
        <div class="hero-content">
            <h1>Find Your Perfect Colleges</h1>
            <p>Search through thousands of colleges and get personalized recommendations</p>
        </div>
    </div>
    <div class="search-container">
        <form action="{{ route('user.search.colleges') }}" method="GET">
            <input type="text" name="search" placeholder="Search Colleges">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="recommendations-container">
        <form action="{{ route('user.search.colleges') }}" method="GET">
            <label for="location">Location:</label>
            <select name="location" id="location">
                <option value="" disabled selected>Select Location You Want To Read</option>
                @php
                    $locations = [];
                @endphp
                @foreach ($colleges as $college)
                    @if (!in_array($college->location, $locations))
                        <option value="{{ $college->location }}">{{ $college->location }}</option>
                        @php
                            array_push($locations, $college->location);
                        @endphp
                    @endif
                @endforeach
            </select>
            <label for="city">City</label>
            <select name="city" id="city">
                <option value="" disabled selected>Select City You Want To Read</option>
                @php
                    $cities = [];
                @endphp
                @foreach ($colleges as $college)
                    @if (!in_array($college->city, $cities))
                        <option value="{{ $college->city }}">{{ $college->city }}</option>
                        @php
                            array_push($cities, $college->city);
                        @endphp
                    @endif
                @endforeach
            </select>
            <label for="level_of_education">Level Of Education</label>
            <select name="level_of_education" id="level_of_education">
                <option value="" disabled selected>Choose the Level of Education You Want To Study</option>
                <option value="undergraduate">Undergraduate</option>
                <option value="postgraduate">Postgraduate</option>
                <option value="undergraduate_and_postgraduate">Both</option>
            </select>
            <label for="course_offered">Course Offored</label>
            <select name="course_offered" id="course_offered">
                <option value="" disabled selected>Choose the Course You Want To Study</option>
                @php
                    $codes = [];
                @endphp
                @foreach ($coureses as $course)
                    @if (!in_array($course->course_code, $codes))
                        <option value="{{ $course->course_code }}">{{ $course->course_code }}</option>
                        @php
                            array_push($codes, $course->course_code);
                        @endphp
                    @endif
                @endforeach
            </select>
            <input type="submit" value="Get Recommendations">
        </form>
    </div>
    <div class="collegecard-container">
        @if ($colleges->count() > 0)
            @foreach ($colleges as $college)
                <a href="{{ route('user.colleges.show', ['id' => $college->id]) }}" style="text-decoration: none">
                    <div class="college-card">
                        <img src="{{ asset('storage/images/college/logo/' . $college->logo) }}"
                            alt="{{ $college->name }} Logo">
                        <h2>{{ $college->name }}</h2>
                        <p>{{ $college->location }}, {{ $college->city }}</p>
                        <button class="love-btn" data-college-id="{{ $college->id }}">
                            ❤️ Favorite
                        </button>
                    </div>
                </a>
            @endforeach
        @else
            <p>No colleges found matching your search.</p>
        @endif
    </div>
    <div class="pagination-container">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                @if ($colleges->onFirstPage())
                    <li class="page-item disabled">
                        <button class="page-link" disabled>Previous</button>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $colleges->previousPageUrl() }}">
                            Previous
                        </a>
                    </li>
                @endif

                @for ($i = 1; $i <= $colleges->lastPage(); $i++)
                    @if ($i == $colleges->currentPage())
                        <li class="page-item active">
                            <button class="page-link">{{ $i }}</button>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $colleges->url($i) }}">
                                {{ $i }}
                            </a>
                        </li>
                    @endif
                @endfor

                @if ($colleges->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $colleges->nextPageUrl() }}">
                            Next
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <button class="page-link" disabled>Next</button>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    <div class="footer">
        @include('Users.Shared.Footer')
    </div>
</body>
<script src=" {{ asset('js/favorite.js') }} "></script>

</html>
