<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compare College</title>
    <link rel="stylesheet" href="{{ asset('css/Users/comparison.css') }}">

</head>

<body>
    <div class="navbar">
        @include('Users.Shared.Nav')
    </div>
    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Compare Colleges Side by Side</h1>
            <p>Make informed decisions by comparing colleges based on various parameters</p>
        </div>
    </div>
    <div class="collegecomparisonboox">
        <h2 class="comparison-header">Compare Colleges</h2>
        <div class="comparison-container">
            <select name="firstcollege" id="firstcollege">
                <option value="" disabled selected>Select First College</option>
                @foreach ($colleges as $college)
                    <option value="{{ $college->id }}">{{ $college->name }}</option>
                @endforeach
            </select>
            <strong> VS </strong>
            <select name="secondcollege" id="secondcollege">
                <option value="" disabled selected>Select Second College</option>
            </select>

            <script>
                document.getElementById('firstcollege').addEventListener('change', (e) => {
                    const selectedCollege = e.target.value;
                    const secondCollegeSelect = document.getElementById('secondcollege');
                    secondCollegeSelect.innerHTML = '';
                    @foreach ($colleges as $college)
                        if ({{ $college->id }} !== parseInt(selectedCollege)) {
                            const option = document.createElement('option');
                            option.value = {{ $college->id }};
                            option.text = '{{ $college->name }}';
                            secondCollegeSelect.appendChild(option);
                        }
                    @endforeach
                });
                document.getElementById('secondcollege').addEventListener('change', (e) => {
                    const selectedCollege = e.target.value;
                    const firstCollegeSelect = document.getElementById('firstcollege');
                    firstCollegeSelect.innerHTML = '';
                    @foreach ($colleges as $college)
                        if ({{ $college->id }} !== parseInt(selectedCollege)) {
                            const option = document.createElement('option');
                            option.value = {{ $college->id }};
                            option.text = '{{ $college->name }}';
                            firstCollegeSelect.appendChild(option);
                        }
                    @endforeach
                });
            </script>
        </div>
    </div>
    <div class="table-container">
        <div class="table-row table-header">
            <div class="table-cell">Features</div>
            <div class="table-cell">College 1</div>
            <div class="table-cell">College 2</div>
        </div>

        <div class="table-row">
            <div class="table-cell">Entrance Exam Required</div>
            <div class="table-cell college-1 entrance-exam">-</div>
            <div class="table-cell college-2 entrance-exam">-</div>
        </div>
        <div class="table-row">
            <div class="table-cell">Affiliated University</div>
            <div class="table-cell college-1 affiliated-university">-</div>
            <div class="table-cell college-2 affiliated-university">-</div>
        </div>
        <div class="table-row">
            <div class="table-cell">Available Faculties</div>
            <div class="table-cell college-1 available-faculties">-</div>
            <div class="table-cell college-2 available-faculties">-</div>
        </div>
        <div class="table-row">
            <div class="table-cell">Scholarship Options</div>
            <div class="table-cell college-1 scholarship-options">-</div>
            <div class="table-cell college-2 scholarship-options">-</div>
        </div>
        <div class="table-row">
            <div class="table-cell">Level of Education</div>
            <div class="table-cell college-1 level-of-education">-</div>
            <div class="table-cell college-2 level-of-education">-</div>
        </div>
        <div class="table-row">
            <div class="table-cell">Location</div>
            <div class="table-cell college-1 location">-</div>
            <div class="table-cell college-2 location">-</div>
        </div>
        <div class="table-row">
            <div class="table-cell">Type of Courses Offered</div>
            <div class="table-cell college-1 courses-offered">-</div>
            <div class="table-cell college-2 courses-offered">-</div>
        </div>
        <div class="table-row">
            <div class="table-cell">Alumni Network</div>
            <div class="table-cell college-1 alumni-network">-</div>
            <div class="table-cell college-2 alumni-network">-</div>
        </div>
        <div class="table-row">
            <div class="table-cell">Semester Fee</div>
            <div class="table-cell college-1 semester-fee">-</div>
            <div class="table-cell college-2 semester-fee">-</div>
        </div>
        <div class="table-row">
            <div class="table-cell">Placement</div>
            <div class="table-cell college-1 placement">-</div>
            <div class="table-cell college-2 placement">-</div>
        </div>
    </div>
</body>
</html>
