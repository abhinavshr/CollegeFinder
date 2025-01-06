<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Gallery</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/collegegallery.css') }} ">
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
            <input type="text" placeholder="Search College">
            <a href=" {{ route('collegeadmin.addcollegegallery') }} "><button>Add Image</button></a>
        </div>

        <div class="grid">
            @foreach ($collegeGallerys as $collegeGallery)
            <div class="card">
                <img src="{{ asset('storage/images/college/college_gallery/' . $collegeGallery->image) }}" alt="{{ \App\Models\Colleges::find($collegeGallery->college_id)->name }}">
                <h3>{{ \App\Models\Colleges::find($collegeGallery->college_id)->name }}</h3>
                <p>{{ $collegeGallery->caption }}</p>
                <form action="{{ route('collegeadmin.collegegallery.delete', $collegeGallery->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>
