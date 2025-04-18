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
                    <strong> {{ $colleges }} Colleges</strong>
                </div>
                <div class="stats-card">
                    <p>Total College Admin</p>
                    <strong> {{ $collegeadmin }} Admins</strong>
                </div>
                <div class="stats-card">
                    <p>Total Users</p>
                    <strong> {{ $user }} Users</strong>
                </div>
            </div>
            <div class="website-trends">
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

                        let rawUserData = {!! json_encode($monthlyData) !!} || [];

                        let labels = getLast12Months();
                        let filteredData = [];
                        let filteredLabels = [];

                        for (let i = 0; i < rawUserData.length; i++) {
                            if (rawUserData[i] > 0) {
                                filteredData.push(rawUserData[i]);
                                filteredLabels.push(labels[i]);
                            }
                        }

                        const ctx = document.getElementById('userRegisterChart').getContext('2d');

                        let gradient = ctx.createLinearGradient(0, 0, 0, 400);
                        gradient.addColorStop(0, 'rgba(0, 86, 179, 0.8)');
                        gradient.addColorStop(1, 'rgba(0, 86, 179, 0.2)');

                        new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: filteredLabels,
                                datasets: [{
                                    label: 'Registered Users',
                                    data: filteredData,
                                    borderColor: '#0056B3',
                                    borderWidth: 3,
                                    backgroundColor: gradient,
                                    fill: true,
                                    tension: 0.4,
                                    pointRadius: 6,
                                    pointBackgroundColor: '#0056B3',
                                    pointHoverRadius: 8,
                                    pointBorderWidth: 2,
                                    pointBorderColor: '#FFFFFF',
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                animation: {
                                    duration: 1800,
                                    easing: 'easeOutQuart',
                                    delay: (context) => context.dataIndex * 150,
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                        labels: {
                                            font: {
                                                size: 14,
                                                weight: 'bold',
                                            }
                                        }
                                    },
                                    tooltip: {
                                        backgroundColor: 'rgba(0, 86, 179, 0.8)',
                                        titleFont: {
                                            size: 14,
                                            weight: 'bold'
                                        },
                                        bodyFont: {
                                            size: 14
                                        },
                                        padding: 10,
                                        cornerRadius: 6,
                                        callbacks: {
                                            label: (tooltipItem) => `Users: ${tooltipItem.raw}`,
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: false,
                                        },
                                        ticks: {
                                            font: {
                                                size: 13
                                            },
                                            color: '#333',
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        suggestedMax: Math.max(10, ...filteredData) * 1.4,
                                        grid: {
                                            color: 'rgba(0, 86, 179, 0.2)',
                                            lineWidth: 1,
                                        },
                                        ticks: {
                                            font: {
                                                size: 13
                                            },
                                            color: '#333',
                                        }
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
                        <br><small class="activity-time"
                            style="display: block;">({{ $activities->created_at->diffForHumans() }})</small>
                        <hr class="recent-activities-divider">
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>
