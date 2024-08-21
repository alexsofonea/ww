<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>ww Admin</title>

    <link rel="stylesheet" href="/assets/font/stylesheet.css">
    <link rel="stylesheet" href="/assets/logo-font/stylesheet.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>
    body {
        margin: 0;
        font-family: 'Qartella';
        font-style: normal;
    }

    .gradient-blur.header {
        position: sticky;
        position: -webkit-sticky;
        top: 0;
        z-index: 998;
        top: 40px;
        right: 0px;
        width: calc(100% + 80px);
        height: 100px;
        transform: translate(-40px, -80px) rotate(180deg);
    }
    .gradient-blur {
        inset: auto 0 0 0;
        height: 100px;
        pointer-events: none;
    }

    .gradient-blur > div, .gradient-blur::before, .gradient-blur::after {
        position: absolute;
        inset: 0;
    }

    .gradient-blur::before {
        content: "";
        z-index: 1;
        -webkit-backdrop-filter: blur(0.5px);
                backdrop-filter: blur(0.5px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, black 12.5%, black 25%, rgba(0, 0, 0, 0) 37.5%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, black 12.5%, black 25%, rgba(0, 0, 0, 0) 37.5%);
    }

    .gradient-blur > div:nth-of-type(1) {
        z-index: 2;
        -webkit-backdrop-filter: blur(1px);
                backdrop-filter: blur(1px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 12.5%, black 25%, black 37.5%, rgba(0, 0, 0, 0) 50%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 12.5%, black 25%, black 37.5%, rgba(0, 0, 0, 0) 50%);
    }

    .gradient-blur > div:nth-of-type(2) {
        z-index: 3;
        -webkit-backdrop-filter: blur(2px);
                backdrop-filter: blur(2px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 25%, black 37.5%, black 50%, rgba(0, 0, 0, 0) 62.5%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 25%, black 37.5%, black 50%, rgba(0, 0, 0, 0) 62.5%);
    }

    .gradient-blur > div:nth-of-type(3) {
        z-index: 4;
        -webkit-backdrop-filter: blur(4px);
                backdrop-filter: blur(4px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 37.5%, black 50%, black 62.5%, rgba(0, 0, 0, 0) 75%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 37.5%, black 50%, black 62.5%, rgba(0, 0, 0, 0) 75%);
    }

    .gradient-blur > div:nth-of-type(4) {
        z-index: 5;
        -webkit-backdrop-filter: blur(8px);
                backdrop-filter: blur(8px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 50%, black 62.5%, black 75%, rgba(0, 0, 0, 0) 87.5%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 50%, black 62.5%, black 75%, rgba(0, 0, 0, 0) 87.5%);
    }

    .gradient-blur > div:nth-of-type(5) {
        z-index: 6;
        -webkit-backdrop-filter: blur(16px);
                backdrop-filter: blur(16px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 62.5%, black 75%, black 87.5%, rgba(0, 0, 0, 0) 100%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 62.5%, black 75%, black 87.5%, rgba(0, 0, 0, 0) 100%);
    }

    .gradient-blur > div:nth-of-type(6) {
        z-index: 7;
        -webkit-backdrop-filter: blur(32px);
                backdrop-filter: blur(32px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 75%, black 87.5%, black 100%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 75%, black 87.5%, black 100%);
    }

    .gradient-blur::after {
        content: "";
        z-index: 8;
        -webkit-backdrop-filter: blur(64px);
                backdrop-filter: blur(64px);
        -webkit-mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 87.5%, black 100%);
                mask: linear-gradient(to bottom, rgba(0, 0, 0, 0) 87.5%, black 100%);
    }

    .bar {
        width: calc(250px - 80px);
        height: calc(100vh - 80px);
        background-color: #626C78;
        position: absolute;
        padding: 40px;
        padding-right: 70px;
    }
    .content {
        width: calc(100vw - 250px - 80px);
        height: calc(100vh - 80px);
        border-radius: 30px 0px 0px 30px;
        background: linear-gradient(45deg, #F2F2F2, #F6F6F6);
        position: absolute;
        right: 0;
        padding: 40px;
        overflow: scroll;
        transition: all 0.2s;

    }
    .content:not(.select) {
        opacity: 0;
        pointer-events: none;
    }
    .logo {
        font-family: 'Neon';
        font-weight: 800;
        font-style: normal;
        font-size: 12px;
        text-align: center;
    }
    .logo font {
        font-family: 'Neon Heavy Outline';
        font-weight: 900;
        font-style: normal;
        font-size: 20px;
    }
    .bar .section {
        margin: 40px 0px;
        text-align: center;
    }
    .bar .section h4 {
        font-size: 30px;
    }
    .bar .section img:not(img[src$=".svg"]) {
        width: 60%;
        aspect-ratio: 1 / 1;
        object-fit: contain;
    }
    .bar .section a {
        display: block;
        cursor: pointer;
        margin-bottom: 10px;
        width: 100% !important;
        text-decoration: none;
    }
    .bar .section a p {
        display: inline-block;
        margin-left: 15px;
        transform: translateY(0px);
        font-size: 18px;
        color: rgba(0, 0, 0, .8);
    }
    .bar .section .sub {
        padding-left: 50px;
        text-align: left;
    }
    h1, h2, h3, h4, p {
        margin: 0;
    }
    img[src$=".svg"] {
        mask-image: linear-gradient(to right bottom, rgba(0, 0, 0, .8), rgba(0, 0, 0, .4));
        -webkit-mask-image: linear-gradient(to right bottom, rgba(0, 0, 0, .8), rgba(0, 0, 0, .4));
        width: 15px;
        height: 15px;
        object-fit: contain;
        display: inline-block;
    }
    .content h1 {
        position: sticky;
        position: -webkit-sticky;
        top: 0;
        z-index: 999;
    }

    .row {
        display: flex;
        align-items: stretch;
    }
    .content .row.first {
        margin-top: -70px !important;
    }
    .row:not(.content .row:last-child) {
        margin-bottom: 40px;
    }
    .row .element {
        background-color: #FFF;
        border-radius: 30px;
        padding: 20px;
    }
    .row .element:not(.row .element:last-child) {
        margin-right: 40px;
    }
</style>

<body>

    <div class="bar">
        <div class="logo">
            <font>ww</font>Enterprised
        </div>
        <div class="section">
            <img src="/assets/demo/logo.png">
            <h4>Restaurant</h4>
        </div>
        <div class="section">
            <a href="javascript:changeContent('analytics')"><img src="/assets/icons/analytics.svg"> <p>Analytics</p></a>
            <a href="javascript:changeContent('bookings')"><img src="/assets/icons/bookings.svg"> <p>Bookings</p></a>
            <a href="javascript:changeContent('manage')"><img src="/assets/icons/settings.svg"> <p>Manage</p></a>
        </div>

    </div>
    <div class="content select" id="analytics">
        <h1>Analytics</h1>
        <div class="gradient-blur header">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="row first">
            <div class="element" style="width: 80%;">
                <canvas id="myLineChart" height="300"></canvas>
            </div>
            <div class="element" style="width: 20%;">
                <canvas id="myPieChart" height="300"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="element" style="height: 500px; width: 30%;"></div>
            <div class="element" style="width: 50%;"></div>
            <div class="element" style="width: 20%;"></div>
        </div>
    </div>
    <div class="content" id="bookings">
        <h1>Bookings</h1>
        <div class="gradient-blur header">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="row first">
            <div class="element" style="width: 80%;"></div>
            <div class="element" style="width: 20%;"></div>
        </div>

        <div class="row">
            <div class="element" style="height: 500px; width: 30%;"></div>
            <div class="element" style="width: 50%;"></div>
            <div class="element" style="width: 20%;"></div>
        </div>
    </div>
    <div class="content" id="manage">
        <h1>Manage</h1>
        <div class="gradient-blur header">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="row first">
            <div class="element" style="width: 80%;"></div>
            <div class="element" style="width: 20%;"></div>
        </div>

        <div class="row">
            <div class="element" style="height: 500px; width: 30%;"></div>
            <div class="element" style="width: 50%;"></div>
            <div class="element" style="width: 20%;"></div>
        </div>
    </div>
</body>
</html>

<script>
    function changeContent(i) {
        const current = document.querySelector(".content.select");
        const next = document.getElementById(i);

        if (next != current) {
            current.style.opacity = "0";
            next.style.opacity = "1";

            setTimeout (function () {
                current.classList.remove("select");
                next.classList.add("select");
            });
        }
    }


    var ctx = document.getElementById('myLineChart').getContext('2d');
    var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'], // Custom labels
            datasets: [{
                label: 'Monthly Visits', // Remove or hide the dataset label
                data: [10, 20, 15, 25, 30, 35], // Custom values
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false, // Show or hide the legend
                    labels: {
                        // Customize legend labels if needed
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'], // Custom labels
            datasets: [{
                data: [12, 19, 3, 5, 2, 3], // Custom values
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true, // Show or hide the legend
                    position: 'top' // Position of the legend
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.label + ': ' + tooltipItem.raw;
                        }
                    }
                }
            }
        }
    });
</script>