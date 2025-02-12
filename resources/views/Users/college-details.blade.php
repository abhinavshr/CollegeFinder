<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> {{ $college->name }} || College Finder</title>
    <link rel="stylesheet" href="{{ asset('css/users/college-details.css') }}">
</head>

<body>
    <div class="navbar">
        @include('Users.Shared.Nav')
    </div>
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="hero-content-image">
                <img src="{{ asset('storage/images/college/logo/' . $college->logo) }}" alt="College Logo">
            </div>
        </div>
        <div class="hero-content-heading">
            <h1>{{ $college->name }}</h1>
        </div>
    </div>
    <h2 class="college-info">College Information</h2>
    <div class="college-basic-info">
        <h3>Basic Information</h3>
        <p class="location"><strong>Location:</strong> {{ $college->location }}, {{ $college->city }},
            {{ $college->country }}</p>
        <p class="contact_email"><strong>Contact Email:</strong> <a href="mailto:{{ $college->contact_email }}">
                {{ $college->contact_email }} </a></p>
        <p class="contact_phone"><strong>Contact Number:</strong> <a href="tel:{{ $college->contact_phone }}">
                {{ $college->contact_phone }} </a></p>
        <p class="website"><strong>Website:</strong> <a href="{{ $college->website }}"
                target="_blank">{{ $college->website }}</a></p>
        <p><strong>Affiliated University:</strong> {{ $college->affiliated_university }} </p>
    </div>

    <div class="academic-details">
        <h3>Academic Details</h3>
        @if ($college->level_of_education == 'undergraduate_and_postgraduate')
            <p class="level-of-education"><strong>Level of Education:</strong> Undergraduate, Postgraduate </p>
        @elseif ($college->level_of_education == 'undergraduate')
            <p class="level-of-education"><strong>Level of Education:</strong> Undergraduate </p>
        @else
            <p class="level-of-education"><strong>Level of Education:</strong> Postgraduate </p>
        @endif
        <p class="course-offered"><strong>Types of Course:</strong> {{ $college->course_offered }} </p>
        <p class="description"><strong>Description:</strong> {{ $college->description }} </p>
    </div>

    <div class="career-alumni">
        <h3>Career and Alumni Network</h3>
        <p class="placement"><strong>Placement Available:</strong> {{ $college->placement_availability }} </p>
        <p><strong>Alumni Network:</strong> {{ $college->alumni_network }} </p>
    </div>

    <h2 class="our-course">Our Course</h2>

    <div class="college-course-offered">
        <table>
            <thead>
                <tr>
                    <th>Course Name</th>
                    <th>Duration</th>
                    <th>Semester Fees</th>
                    <th>Eligibility</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($college->courses as $course)
                    <tr>
                        <td>{{ $course->course_name }}</td>
                        <td>{{ $course->duration }}</td>
                        <td>{{ $course->fees }}</td>
                        <td>{{ $course->eligibility }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h2 class="entrance-exam">Entrance Exam Required</h2>

    <div class="entrance-exam-info">
        <p>{{ $college->entrance_exams_required }}</p>
    </div>

    <h2 class="scholarship">Scholarship</h2>

    <div class="scholarship-container">
        @foreach ($scholarships as $scholarship)
            <div class="scholarship-card">
                <h3 class="scholarship-name">{{ $scholarship->scholarship_name }}</h3>
                <p class="scholarship-benefits"><strong>Benefits:</strong> {{ $scholarship->benefits }} </p>
                <p><strong>Eligibility</strong> {{ $scholarship->eligibility }} </p>
            </div>
        @endforeach
    </div>

    <h2 class="college-gallery">College Gallery</h2>

    <div class="slider-container">
        <div class="college-gallery-container">
            @foreach ($galleries as $gallery)
                <div class="gallery-card">
                    <img src="{{ asset('storage/images/college/college_gallery/' . $gallery->image) }}"
                        alt="Gallery Image">
                </div>
            @endforeach
        </div>
    </div>

    <h2 class="reviews">Reviews</h2>

    @if (auth()->user()->user_type == 'Alumni')
        <div class="reviews-container">
            <form action="{{ route('user.reviews.store') }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" name="college_id" value="{{ $college->id }}">
                <input type="text" id="name" class="name" name="name" placeholder="Enter Your Full Name" >
                @error('name')
                    <div class="error" style="color: red">{{ $message }}</div>
                @enderror
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5">
                    <label for="star5">★</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4">★</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3">★</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2">★</label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1">★</label>
                    @error('rating')
                        <div class="error" style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <textarea name="review" class="review" id="review" cols="30" rows="10" placeholder="Enter Your Review here"></textarea>
                @error('review')
                    <div class="error" style="color: red">{{ $message }}</div>
                @enderror
                <br>
                <button type="submit" class="submit">Submit Review</button>
            </form>
        </div>
    @endif

    <div class="review-list">
        @foreach ($reviews as $review)
            <div class="review-card">
                <h3 class="review-name">{{ $review->name }}</h3>
                <p class="review-rating"><strong>Rating:</strong>
                    @for ($i = 1; $i <= 5; $i++)
                        <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" {{ $review->rating == $i ? 'checked' : '' }}>
                        <label class="star" for="star{{ $i }}">★</label>
                    @endfor
                </p>
                <p class="review-text"><strong>Review:</strong> {{ $review->review }} </p>
            </div>
        @endforeach
    </div>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const container = document.querySelector(".college-gallery-container");

        let scrollAmount = 0;
        let firstImageWidth = document.querySelector(".gallery-card").offsetWidth + 10;

        function slideImages() {
            scrollAmount += 0.3;
            container.style.transform = `translateX(-${scrollAmount}px)`;

            if (scrollAmount >= firstImageWidth) {
                container.appendChild(container.firstElementChild);
                container.style.transition = "none";
                container.style.transform = `translateX(0px)`;
                scrollAmount = 0;

                setTimeout(() => {
                    container.style.transition = "transform 0.3s linear";
                }, 50);
            }
        }

        setInterval(slideImages, 30);
    });
</script>

</html>
