<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wwAdmin</title>
    <link rel="stylesheet" href="/project/admin/assets/font/stylesheet.css">

    <link rel="stylesheet" href="/project/admin/style.css?cache=<?php echo time(); ?>">

    <script src="/project/admin/lib/jquery.js"></script>
    <script src="/project/admin/script.js?cache=<?php echo time(); ?>?cache=<?php echo time(); ?>"></script>
</head>

<style>

</style>

<body>
    <?php include '/volume1/web/ww/project/admin/nav.php'; ?>
    <div class="content" id="content">
        <div class="topBar">
            <img class="profile" src="https://ww.alexsofonea.com/account/userImage/?name=Alex+Sofonea">
            <div class="separator"></div>
            <img src="/project/admin/assets/icons/star.svg">
            <img src="/project/admin/assets/icons/star.svg">
            <div class="separator"></div>
            <img src="/project/admin/assets/icons/star.svg">
            <img src="/project/admin/assets/icons/star.svg">

            <div class="left">
                <h4>Analytics</h4>
            </div>
        </div>
        
        <script src="/project/admin/lib/chart.js"></script>

        <div class="row">
            <div class="element w70">
                <canvas id="visitorsChart" height="100px"></canvas>
                <script>
                    new Chart(document.getElementById('visitorsChart').getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],  // Days of the week
                            datasets: [
                                {
                                    label: 'Visitors',
                                    data: [200, 250, 180, 300, 350, 400, 450],
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderWidth: 2,
                                    tension: 0.4  // Smooth line effect
                                },
                                {
                                    label: 'Unique Visitors',
                                    data: [150, 190, 140, 240, 280, 320, 370],
                                    borderColor: 'rgba(153, 102, 255, 1)',
                                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                                    borderWidth: 2,
                                    tension: 0.4
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            },
                            scales: {
                                x: {
                                    title: {
                                        display: false,
                                        text: 'Day of the Week'
                                    }
                                },
                                y: {
                                    title: {
                                        display: false,
                                        text: 'Number of Visitors'
                                    },
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                </script>
            </div>
            <div class="element w30">
                <canvas id="viewsChart" height="100px"></canvas>
                    <script>
                        new Chart(document.getElementById('viewsChart').getContext('2d'), {
                            type: 'radar',
                            data: {
                                labels: ['Home', 'About', 'Services', 'Contact', 'Blog', 'Portfolio', 'FAQ'],
                                datasets: [
                                    {
                                        label: 'Page Views',
                                        data: [120, 90, 80, 150, 200, 130, 100],
                                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                        borderColor: 'rgba(54, 162, 235, 1)',
                                        borderWidth: 2,
                                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                                        pointBorderColor: '#fff',
                                        pointHoverBackgroundColor: '#fff',
                                        pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    r: {
                                        beginAtZero: true,
                                        angleLines: {
                                            color: 'rgba(0, 0, 0, 0.1)'
                                        },
                                        grid: {
                                            color: 'rgba(0, 0, 0, 0.1)'
                                        },
                                        pointLabels: {
                                            color: '#666'
                                        }
                                    }
                                },
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltipItem.label + ': ' + tooltipItem.raw + ' views';
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    </script>
                
            </div>
        </div>
        <div class="row">
            <div class="element w40">
                <canvas id="regionChart" height="200px"></canvas>
                <script>
                    new Chart(document.getElementById('regionChart').getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: ['USA', 'Canada', 'UK', 'Germany', 'Australia'],
                            datasets: [{
                                label: 'Visitors by Region',
                                data: [300, 150, 200, 100, 250], // Example data
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(75, 192, 192, 0.7)',
                                    'rgba(153, 102, 255, 0.7)'
                                ],
                                borderColor: 'rgba(255, 255, 255, 0.8)',
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'right'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw + ' visitors';
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
            <div class="element w60">
                <canvas id="timeOfDayChart" height="200px"></canvas>
                <script>
                    new Chart(document.getElementById('timeOfDayChart').getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['12 AM', '3 AM', '6 AM', '9 AM', '12 PM', '3 PM', '6 PM', '9 PM'],
                            datasets: [{
                                label: 'Average Visitors by Time of Day',
                                data: [20, 15, 40, 100, 200, 150, 120, 60], // Example data
                                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    title: {
                                        display: false,
                                        text: 'Time of Day'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Average Number of Visitors'
                                    },
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return 'Visitors: ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>
        <div class="row">
            <div class="element w50">
                <canvas id="retentionChart" height="200px"></canvas>
                <script>
                    new Chart(document.getElementById('retentionChart').getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: ['Day 1', 'Day 7', 'Day 14', 'Day 30', 'Day 60', 'Day 90'],
                            datasets: [{
                                label: 'User Retention (%)',
                                data: [100, 75, 60, 45, 30, 20], // Example retention data
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 2,
                                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                pointBorderColor: '#fff',
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                                tension: 0.4
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Days Since Signup'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Retention Rate (%)'
                                    },
                                    beginAtZero: true,
                                    max: 100
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return 'Retention: ' + tooltipItem.raw + '%';
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
            <div class="element w50">
                <canvas id="retentionTimeChart" height="200px"></canvas>
                <script>
                    new Chart(document.getElementById('retentionTimeChart').getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['< 1 min', '1-5 mins', '5-15 mins', '15-30 mins', '30-60 mins', '> 1 hr'],
                            datasets: [{
                                label: 'Percentage of Users',
                                data: [10, 30, 25, 15, 10, 10], // Example data for time spent
                                backgroundColor: 'rgba(153, 102, 255, 0.7)',
                                borderColor: 'rgba(153, 102, 255, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Time Spent'
                                    }
                                },
                                y: {
                                    title: {
                                        display: false,
                                        text: 'Percentage of Users (%)'
                                    },
                                    beginAtZero: true,
                                    max: 100
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return 'Users: ' + tooltipItem.raw + '%';
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
        </div>


    </div>
</body>
</html>