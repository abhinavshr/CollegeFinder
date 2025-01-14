<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Course Management</title>
  <link rel="stylesheet" href=" {{ asset('css/collegeadmin/courseview.css') }} ">
</head>
<body>
    <div class="sidenav">
        @include('Admin.shared.SideNav')
    </div>
  <div class="container">
    <h1>Hello, {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h1>
    <h1 class="course-management-header">Course Management</h1>
    @auth('collegeadmin')
    <a href=" {{ route('collegeadmin.courseadd') }} " class="add-course-btn">Add Course</a>
    @endauth
    <table>
      <thead>
        <tr>
          <th>Course ID</th>
          <th>Course Name</th>
          <th>Course Type</th>
          <th>Duration</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($courses as $course)
        <tr>
          <td>{{ $course->id }}</td>
          <td>{{ $course->course_name }}</td>
          <td>{{ $course->course_type }}</td>
          <td>{{ $course->duration }} Years</td>
          <td>
            @auth('collegeadmin')
              <a href=" {{ route('collegeadmin.coursedetail', $course->id) }} " class="action-btn edit-btn">Edit</a>
              <form action=" {{ route('collegeadmin.coursedelete', $course->id) }} " method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn delete-btn">Delete</button>
              </form>
            @else
              <span>Administrators do not have access to this functionality</span>
            @endauth
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="5" style="text-align: center;">No course is available.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</body>
</html>

