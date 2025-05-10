<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>College Admins</title>
    <link rel="stylesheet" href="{{ asset('css/Admin/pages/adminlist.css') }}">
</head>

<body>
    <div class="sidenavbar">
        @include('Admin.shared.SideNav')
    </div>
    <div class="container">
        <div class="header">
            <h1>Manage Admins</h1>
            <span class="sub-header">{{ $CollegeAdmins->total() }} Admins</span>
            @auth('admin')
            <a href="{{ route('admin.collegeadminregister') }}" style="text-decoration: none">
                <button class="add-admin-btn">
                    <span class="material-symbols-outlined">add</span> Add Admins
                </button>
            </a>
            @endauth
        </div>

        <table class="admin-table table table-striped">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($CollegeAdmins as $collegeadmin)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/images/collegeadmin/' . $collegeadmin->admin_profile) }}" alt="Profile Image" class="profile-img">
                        </td>
                        <td>{{ $collegeadmin->firstname }} {{ $collegeadmin->lastname }}</td>
                        <td>{{ $collegeadmin->college_email }}</td>
                        <td><span class="role-badge">College Admin</span></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="pagination-container">
            <div class="pagination-container">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        @if ($CollegeAdmins->onFirstPage())
                            <li class="page-item disabled">
                                <button class="page-link" disabled>Previous</button>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $CollegeAdmins->previousPageUrl() }}">
                                    Previous
                                </a>
                            </li>
                        @endif

                        @for ($i = 1; $i <= $CollegeAdmins->lastPage(); $i++)
                            @if ($i == $CollegeAdmins->currentPage())
                                <li class="page-item active">
                                    <button class="page-link">{{ $i }}</button>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $CollegeAdmins->url($i) }}">
                                        {{ $i }}
                                    </a>
                                </li>
                            @endif
                        @endfor

                        @if ($CollegeAdmins->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $CollegeAdmins->nextPageUrl() }}">
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
    </div>
</body>

</html>

