<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scholarship</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/scholarship.css') }} ">
</head>
<body>
    <div class="sidenav">
        @include('Admin.shared.SideNav')
    </div>
  <div class="container">
    <h1>Hello, {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h1>
    <h1 class="course-management-header">Scholarship Management</h1>
    @auth('collegeadmin')
    <a href=" {{ route('collegeadmin.scholarshipadd') }} " class="add-course-btn">Add Scholarship</a>
    @endauth
    <table>
      <thead>
        <tr>
          <th>Scholarship ID</th>
          <th>Scholarship Name</th>
          <th>College Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($scholarships as $scholarships)
        <tr>
          <td>{{ $scholarships->id }}</td>
          <td>{{ $scholarships->scholarship_name }}</td>
          <td>{{ $scholarships->college->name }}</td>
          <td>
            @auth('collegeadmin')
              <a href=" {{ route('collegeadmin.scholarshipdetail', $scholarships->id) }} " class="action-btn edit-btn">Edit</a>
              <form action=" {{ route('collegeadmin.scholarships.destroy', $scholarships->id) }} " method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');">
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
          <td colspan="5" style="text-align: center;">No scholarship is available.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</body>
</html>
