<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <link rel="stylesheet" href=" {{ asset('css/collegeadmin/dashboard.css') }} ">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container">
        <div class="sidenav">
            @include('admin.shared.SideNav')
        </div>
        <div class="dashboard-container">
            <h1 class="dashboard-header">Dashboard</h1>
            <div class="dashboard-stats">
                <div class="stats-card">
                    <p>Total Colleges</p>
                    <strong>  {{ $colleges }} Colleges</strong>
                </div>
                <div class="stats-card">
                    <p>Total College Admin</p>
                    <strong> {{ $collegeadmin }}  Admins</strong>
                </div>
                <div class="stats-card">
                    <p>Total Users</p>
                    <strong> {{ $user }} Users</strong>
                </div>
            </div>
            <div class="user-register-trends">
                <h2>User Register Trends</h2>
                <div class="chart-container">
                    <canvas id="userRegisterChart"></canvas>
                </div>
                <script>
                    function getLast12Months() {
                        const months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
                        const today = new Date();
                        let labels = [];
                        for (let i = 11; i >= 0; i--) {
                            let monthIndex = (today.getMonth() - i + 12) % 12;
                            labels.push(months[monthIndex]);
                        }
                        return labels;
                    }

                    const userData = {!! json_encode($monthlyData) !!};

                    const ctx = document.getElementById('userRegisterChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: getLast12Months(),
                            datasets: [{
                                label: 'Registered Users',
                                data: userData,
                                borderColor: '#0056B3',
                                borderWidth: 2,
                                fill: false,
                                pointRadius: 5,
                                pointBackgroundColor: '#0056B3'
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: Math.max(...userData) * 3
                                }
                            }
                        }
                    });
                </script>
            </div>
            <div class="recent-activities">
                <h2 class="recent-activities-header">Recent Activities</h2>
                @foreach ($recentActivities as $activities)
                    <p><strong>{{ $activities->activity_type }}:</strong> {{ $activities->message }}</p>
                    <br><small class="activity-time" style="display: block;">({{ $activities->created_at->diffForHumans() }})</small>
                    <hr class="recent-activities-divider">
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
