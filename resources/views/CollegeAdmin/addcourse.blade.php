<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Course</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/addcourse.css') }} ">
</head>

<body>
    <div class="addcourseContainer">
        <h1 class="addcourseHeader">Add Course</h1>
        <form action=" {{ route('collegeadmin.courseadd.store') }} " method="POST">
            @csrf
            <table>
                <tr>
                    <td><label for="college_id">College Name:</label></td>
                    <td><label for="course_name">Course Name:</label></td>
                </tr>
                <tr>
                    <td>
                        <select name="college_id" id="college_id" required>
                            <option value="" disabled selected>Select College</option></option>
                            @foreach ($colleges as $college)
                                <option value="{{ $college->id }}">{{ $college->name }}</option>
                            @endforeach
                        </select>
                        @error('college_id')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td><input type="text" name="course_name" id="course_name" placeholder="Enter Course Name" value="{{ old('course_name') }}" required>
                        @error('course_name')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="duration">Duration:</label></td>
                    <td><label for="course_type">Course Type:</label></td>
                </tr>
                <tr>
                    <td><input type="number" name="duration" id="duration" placeholder="Enter Duration" value="{{ old('duration') }}" required>
                        @error('duration')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td><input type="text" name="course_type" id="course_type" placeholder="Enter Course Type" value="{{ old('course_type') }}" required>
                        @error('course_type')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="course_code">Course Code:</label></td>
                    <td><label for="fees">Per Semester Fees:</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="course_code" id="course_code" placeholder="Enter Course Code" value="{{ old('course_code') }}" required>
                        @error('course_code')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                    <td><input type="number" step="0.01" name="fees" id="fees" placeholder="Enter Fees" value="{{ old('fees') }}" required>
                        @error('fees')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label for="eligibility">Eligibility:</label></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="text" name="eligibility" id="eligibility" placeholder="Enter Eligibility" value="{{ old('eligibility') }}" required>
                        @error('eligibility')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">Add Course</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>

