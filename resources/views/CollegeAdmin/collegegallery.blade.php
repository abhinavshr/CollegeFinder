<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Gallery</title>
    <link rel="stylesheet" href="{{ asset('css/collegeadmin/collegegallery.css') }}">
    <script>
        // JavaScript function to filter images based on the search term
        function performSearch() {
            let searchTerm = document.getElementById("search").value.toLowerCase(); // Get the search term
            let cards = document.querySelectorAll(".card"); // Get all cards
            let noResultsMessage = document.getElementById("noResultsMessage");

            let found = false;

            // Loop through all cards and hide/show based on search term
            cards.forEach(function(card) {
                let collegeName = card.querySelector("h3").textContent.toLowerCase(); // Get the college name
                if (collegeName.includes(searchTerm)) {
                    card.style.display = "block"; // Show the card
                    found = true;
                } else {
                    card.style.display = "none"; // Hide the card
                }
            });

            // If no cards are found, show the "No Image" message
            if (found) {
                noResultsMessage.style.display = "none";
            } else {
                noResultsMessage.style.display = "block";
            }
        }
    </script>
</head>
<body>
    <div class="sidenav">
        @include('admin.shared.sidenav')
    </div>
    <div class="header">
        <div class="header-content">
            <span class="greeting">Hello, {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</span>
            <h1 class="heading-collegegallery">College Gallery</h1>
        </div>
    </div>

    <div class="container">
        <div class="search-bar">
            <input type="text" id="search" placeholder="Search College" onkeyup="performSearch()" value="{{ request('search') }}">
            <a href="{{ route('collegeadmin.addcollegegallery') }}"><button>Add Image</button></a>
        </div>

        <div class="grid">
            <p id="noResultsMessage" style="display: none;">There is no image of this college.</p>

            @foreach ($collegeGallerys as $collegeGallery)
            <div class="card">
                <img src="{{ asset('storage/images/college/college_gallery/' . $collegeGallery->image) }}" alt="{{ $collegeGallery->college->name }}">
                <h3>{{ $collegeGallery->college->name }}</h3>
                <p>{{ $collegeGallery->caption }}</p>
                @auth('collegeadmin')
                <form action="{{ route('collegeadmin.collegegallery.delete', $collegeGallery->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
                @endauth
            </div>
            @endforeach
        </div>
    </div>

</body>
</html>
