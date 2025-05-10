<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Management</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/collegeview.css') }} ">
</head>
<body>
    <div class="sidenav">
        @include('Admin.shared.SideNav')
    </div>
    <div class="container">
        <h1>Hello, {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}</h1>
        <h1 class="college-management-header">College Management</h1>
        <div class="search-container">
            <form action="{{ route('collegeadmin.collegelist') }}" method="GET" id="search-form">
                <input
                    type="text"
                    name="search"
                    placeholder="Search College"
                    value="{{ $search ?? '' }}"
                    oninput="document.getElementById('search-form').submit()"
                >
            </form>
            @auth('admin')
            @else
            <a href="{{ route('collegeadmin.collegeadd') }}">
                <button type="button">Add College</button>
            </a>
            @endauth
        </div>

        @if (count($colleges) > 0)
        <table>
            <thead>
                <tr>
                    <th>College Id</th>
                    <th>College Name</th>
                    <th>Last Modified</th>
                    <th>Last Update</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($colleges as $college)
                <tr>
                    <td>{{ $college->id }}</td>
                    <td>
                        <img src="{{ asset('storage/images/college/logo/' . $college->logo) }}" alt="College Logo" class="college-logo">
                        {{ $college->name }}
                    </td>
                    <td>{{ $college->updated_at ? $college->updated_at->format('Y/m/d') : '' }}</td>
                    <td>{{ $college->updated_at ? $college->updated_at->diffForHumans() : '' }}</td>
                    <td class="action-buttons">
                        @auth('collegeadmin')
                            <a href=" {{ route('collegeadmin.collegedetail', $college->id) }}"><button class="edit-btn">Edit</button></a>
                            <form action="{{ route('collegeadmin.collegedelete', $college->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this college?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        @else
                            <span>Administrators do not have access to this functionality</span>
                        @endauth
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p class="error">There are no colleges registered.</p>
        @endif
    </div>
</body>
</html>

