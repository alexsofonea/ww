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
            <div class="element w60">
                <canvas id="topSalesChart" height="200px"></canvas>
                <script>
                    new Chart(document.getElementById('topSalesChart').getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: ['Item A', 'Item B', 'Item C', 'Item D', 'Item E'], // Example items
                            datasets: [{
                                label: 'Sales',
                                data: [150, 300, 200, 250, 180], // Example sales data for each item
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(255, 206, 86, 0.7)',
                                    'rgba(75, 192, 192, 0.7)',
                                    'rgba(153, 102, 255, 0.7)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(153, 102, 255, 1)'
                                ],
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
                                        text: 'Items'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Number of Sales'
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
                                            return 'Sales: ' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
            <div class="element w20">
                
            </div>
            <div class="element w20">
                
            </div>
        </div>
        <div class="row">
            <div class="element w50">
                <canvas id="revenueChart" height="400px"></canvas>
                <script>
                    new Chart(document.getElementById('revenueChart').getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            datasets: [{
                                label: 'Monthly Revenue',
                                data: [5000, 7000, 8000, 6000, 7500, 9000, 8500, 9500, 10000, 10500, 11000, 12000], // Example revenue data for each month
                                borderColor: 'rgba(255, 159, 64, 1)',
                                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                                borderWidth: 2,
                                pointBackgroundColor: 'rgba(255, 159, 64, 1)',
                                pointBorderColor: '#fff',
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: 'rgba(255, 159, 64, 1)',
                                tension: 0.3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    title: {
                                        display: false,
                                        text: 'Month'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Revenue ($)'
                                    },
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return 'Revenue: $' + tooltipItem.raw;
                                        }
                                    }
                                }
                            }
                        }
                    });
                </script>
            </div>
            <div class="element w50">
                <canvas id="conversionRateChart" height="400px"></canvas>
                <script>
                    new Chart(document.getElementById('conversionRateChart').getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                            datasets: [{
                                label: 'Conversion Rate (%)',
                                data: [2.5, 3.0, 2.8, 3.2, 3.5, 3.8, 4.0, 4.2, 3.9, 4.5, 4.8, 5.0], // Example conversion rate data
                                borderColor: 'rgba(75, 192, 192, 1)',
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderWidth: 2,
                                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                pointBorderColor: '#fff',
                                pointHoverBackgroundColor: '#fff',
                                pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                                tension: 0.3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    title: {
                                        display: false,
                                        text: 'Month'
                                    }
                                },
                                y: {
                                    title: {
                                        display: true,
                                        text: 'Conversion Rate (%)'
                                    },
                                    beginAtZero: true,
                                    max: 10 // Setting a maximum value for clearer visual representation
                                }
                            },
                            plugins: {
                                legend: {
                                    position: 'top'
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return 'Conversion Rate: ' + tooltipItem.raw + '%';
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