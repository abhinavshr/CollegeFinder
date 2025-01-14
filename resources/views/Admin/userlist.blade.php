<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/pages/userlist.css') }}">
</head>

<body>
    <div class="sidenavbar">
        @include('Admin.shared.SideNav')
    </div>
    <div class="container">
        <div class="header">
            <h1>Manage Users</h1>
            <span class="sub-header">{{ $Users->total() }} Users</span>
        </div>

        <table class="user-table table table-striped">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Users as $user)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/images/user/' . $user->profile_picture) }}" alt="Profile Image" class="profile-img">
                        </td>
                        <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span class="type-badge">{{ $user->user_type }}</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    @if ($Users->onFirstPage())
                        <li class="page-item disabled">
                            <button class="page-link" disabled>Previous</button>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $Users->previousPageUrl() }}">
                                Previous
                            </a>
                        </li>
                    @endif

                    @for ($i = 1; $i <= $Users->lastPage(); $i++)
                        @if ($i == $Users->currentPage())
                            <li class="page-item active">
                                <button class="page-link">{{ $i }}</button>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $Users->url($i) }}">
                                    {{ $i }}
                                </a>
                            </li>
                        @endif
                    @endfor

                    @if ($Users->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $Users->nextPageUrl() }}">
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
    </div>
</body>

</html>
