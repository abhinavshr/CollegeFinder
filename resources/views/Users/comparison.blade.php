<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                @foreach ($colleges as $college)
                    <option value="{{ $college->id }}">{{ $college->name }}</option>
                @endforeach
            </select>
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
            <div class="table-cell">Placement</div>
            <div class="table-cell college-1 placement">-</div>
            <div class="table-cell college-2 placement">-</div>
        </div>
    </div>
    <script>
        document.getElementById('firstcollege').addEventListener('change', function () {
            fetchCollegeData(this.value, 'college-1');
        });

        document.getElementById('secondcollege').addEventListener('change', function () {
            fetchCollegeData(this.value, 'college-2');
        });

        function fetchCollegeData(collegeId, targetClass) {
            if (!collegeId) return;

            fetch(`/colleges/${collegeId}`)
                .then(response => response.json())
                .then(data => {
                    console.log('Fetched College Data:', data);

                    if (data.message) {
                        alert('No college data found');
                        return;
                    }

                    document.querySelector(`.${targetClass}.entrance-exam`).textContent = data.entrance_exam || '-';
                    document.querySelector(`.${targetClass}.affiliated-university`).textContent = data.affiliated_university || '-';
                    document.querySelector(`.${targetClass}.available-faculties`).textContent = data.avaiable_ficilities || '-';
                    document.querySelector(`.${targetClass}.scholarship-options`).textContent = (data.scholarship_options.length > 0) ? data.scholarship_options.join(', ') : '-';
                    document.querySelector(`.${targetClass}.level-of-education`).textContent = data.level_of_education || '-';
                    document.querySelector(`.${targetClass}.location`).textContent = data.location || '-';
                    document.querySelector(`.${targetClass}.courses-offered`).textContent = data.courses_offered || '-';
                    document.querySelector(`.${targetClass}.alumni-network`).textContent = data.alumni_network || '-';
                    document.querySelector(`.${targetClass}.placement`).textContent = data.placement || '-';
                })
                .catch(error => console.error('Error fetching college data:', error));
        }
    </script>
    <script>
        const firstCollegeSelect = document.getElementById('firstcollege');
        const secondCollegeSelect = document.getElementById('secondcollege');

        firstCollegeSelect.addEventListener('change', function () {
            const firstCollegeId = this.value;
            const secondCollegeOptions = secondCollegeSelect.querySelectorAll('option');

            secondCollegeOptions.forEach(option => {
                if (option.value === firstCollegeId) {
                    option.style.display = 'none';
                } else {
                    option.style.display = '';
                }
            });
        });

        secondCollegeSelect.addEventListener('change', function () {
            const secondCollegeId = this.value;
            const firstCollegeOptions = firstCollegeSelect.querySelectorAll('option');

            firstCollegeOptions.forEach(option => {
                if (option.value === secondCollegeId) {
                    option.style.display = 'none';
                } else {
                    option.style.display = '';
                }
            });
        });
    </script>

    <div class="footer">
        @include('Users.Shared.Footer')
    </div>
</body>
</html>
