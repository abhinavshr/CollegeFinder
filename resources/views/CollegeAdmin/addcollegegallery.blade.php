<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add College Gallery</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/addcollegegallery.css') }} ">
</head>
<body>
    <div class="container">
        <h2>Add College Gallery</h2>
        <form action="{{ route('collegeadmin.college_gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="college_id">College</label>
            <select name="college_id" id="college_id" required>
                <option value="">Select College</option>
                @foreach ($colleges as $college)
                    <option value="{{ $college->id }}">{{ $college->name }}</option>
                @endforeach
            </select>

            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <label for="caption">Caption</label>
            <input type="text" name="caption" id="caption" placeholder="Enter image caption" required>

            <button type="submit">Add Gallery</button>
        </form>
    </div>
</body>
</html>
