<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit College</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/editcollege.css') }} ">
</head>

<body>
    <div class="container">
        <h1 class="edit-college-header">Edit College</h1>
        <form action="  " method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table>
                <tr>
                    <td><label for="name">College Name:</label></td>
                    <td><label for="location">College Location:</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="name" id="name" value="{{ old('name', $colleges->name) }}" placeholder="Enter College Name">
                        @error('name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="location" id="location" value="{{ old('location', $colleges->location) }}" placeholder="Enter College Location">
                        @error('location')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="city">College City:</label></td>
                    <td><label for="country">College Country:</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="city" id="city" value="{{ old('city', $colleges->city) }}" placeholder="Enter College City">
                        @error('city')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="country" id="country" value="{{ old('country', $colleges->country) }}" placeholder="Enter College Country">
                        @error('country')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="contact_email">College Email:</label></td>
                    <td><label for="contact_phone">College Number:</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $colleges->contact_email) }}" placeholder="Enter College Email">
                        @error('contact_email')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $colleges->contact_phone) }}"
                            placeholder="Enter College Number">
                        @error('contact_phone')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="website">College Website:</label></td>
                    <td><label for="logo">College Logo:</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="website" id="website" value="{{ old('website', $colleges->website) }}" placeholder="Enter College Website">
                        @error('website')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="file" name="logo" id="logo">
                        @if($colleges->logo)
                            <img src="{{ asset('storage/images/college/logo/' . $colleges->logo) }}" alt="College Logo" width="100">
                        @endif
                        @error('logo')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="affiliated_university">Affiliated University:</label></td>
                    <td><label for="level_of_education">Level of Education:</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="affiliated_university" id="affiliated_university" value="{{ old('affiliated_university', $colleges->affiliated_university) }}"
                            placeholder="Enter Affiliated University">
                        @error('affiliated_university')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <select name="level_of_education" id="level_of_education">
                            <option value="" disabled>Select Level of Education</option>
                            <option value="undergraduate" {{ old('level_of_education', $colleges->level_of_education) == 'undergraduate' ? 'selected' : '' }}>Undergraduate</option>
                            <option value="postgraduate" {{ old('level_of_education', $colleges->level_of_education) == 'postgraduate' ? 'selected' : '' }}>Postgraduate</option>
                            <option value="undergraduate_and_postgraduate" {{ old('level_of_education', $colleges->level_of_education) == 'undergraduate_and_postgraduate' ? 'selected' : '' }}>Undergraduate and Postgraduate</option>
                        </select>
                        @error('level_of_education')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="course_offered">Types of Courses Offered:</label></td>
                    <td><label for="alumni_network">Alumni Network:</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="course_offered" id="course_offered" value="{{ old('course_offered', $colleges->course_offered) }}" placeholder="Enter Types of Courses Offered">
                        @error('course_offered')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="alumni_network" id="alumni_network" value="{{ old('alumni_network', $colleges->alumni_network) }}" placeholder="Enter Alumni Network">
                        @error('alumni_network')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="placement_availability">Placement Availability:</label></td>
                    <td><label for="entrance_exam_required">Entrance Exam Required:</label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="placement_availability" id="placement_availability" value="{{ old('placement_availability', $colleges->placement_availability) }}"
                            placeholder="Enter Placement Availability">
                        @error('placement_availability')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td>
                        <input type="text" name="entrance_exams_required" id="entrance_exams_required" value="{{ old('entrance_exams_required', $colleges->entrance_exams_required) }}" placeholder="Enter Entrance Exam Required">
                        @error('entrance_exam_required')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="description">Description:</label></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <textarea name="description" id="description" placeholder="Enter College Description">{{ old('description', $colleges->description) }}</textarea>
                        @error('description')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
            </table>
            <button type="submit" style="margin-top: 20px" class="update-college">Update College</button>
        </form>
    </div>
</body>

</html>

