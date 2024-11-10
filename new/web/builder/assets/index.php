<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wwAdmin</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">

    <link rel="stylesheet" href="/style.css?cache=<?php echo time(); ?>">

    <script src="/lib/jquery.js"></script>
    <script src="/script.js?cache=<?php echo time(); ?>"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<style>

</style>

<body>
    <?php include '/volume1/web/web-admin/nav.php'; ?>
    <div class="content" id="content">
        <div class="topBar">
            <img class="profile" src="https://ww.alexsofonea.com/account/userImage/?name=Alex+Sofonea">
            <div class="separator"></div>
            <img src="/assets/icons/star.svg">
            <img src="/assets/icons/star.svg">
            <div class="separator"></div>
            <img src="/assets/icons/star.svg">
            <img src="/assets/icons/star.svg">

            <div class="left">
                <h4>Assets</h4>
            </div>
        </div>

        <div class="row">
            <div class="element w80"> 
                <?php
                    $uploadText = "Drag & drop the image file here.";
                    $upload = "/builder/assets/cloudapi/upload.php";
                    $fileName = hash("md2", uniqid());
                    $otherFunc = "savePicture('$fileName.jpg')";
                    include "cloudapi/index.php";
                ?>
            </div>
            <div class="element w20">
                <h4>Storage</h4>
                <canvas id="storageChart" height="200px"></canvas>
                <script>
                    new Chart(document.getElementById('storageChart').getContext('2d'), {
                        type: 'pie',
                        data: {
                            labels: ['Page Files', 'Assets', 'Free Space'],
                            datasets: [{
                                label: 'Storage Distribution',
                                data: [3, 40, 57],
                                backgroundColor: [
                                    '#e63946',
                                    '#1d3557',
                                    '#e5e5e5'
                                ]
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.label + ': ' + tooltipItem.raw + '%';
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
            <div class="element w100">
                <div class="fileShow">
                    <img src="/assets/icons/file.svg">
                    <p>File</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
                <div class="fileShow">
                    <img src="/assets/icons/file.svg">
                    <p>File</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
                <div class="fileShow">
                    <img src="/assets/icons/file.svg">
                    <p>File</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
                <div class="fileShow">
                    <img src="/assets/icons/file.svg">
                    <p>File</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
            </div>
        </div>


    </div>
</body>
</html>