<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>wwAccounts</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">
    <link rel="stylesheet" href="/assets/logo-font/stylesheet.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/project/style.css">
</head>

<?php
    include "../../db.php";
    include "../../account/accountId.php";
?>

<body>
    <?php if (isset($_GET['use']) && $_GET['use'] == "connect") { ?>
        <div class="container">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $name; ?>"><?php echo $name; ?></a> / <b><a href="/<?php echo $name; ?>/<?php echo $_GET['id']; ?>"><?php echo $_GET['id']; ?></a></b></p><br />

            <div class="topKit">
                <img src="/assets/logos/wwConnect.png">
                <h1><font class="ww">ww</font>Connect</h1>
            </div>

            <div class="bgContainer" style="background-image: url('/assets/logos/wwConnect.png')"></div>

            <div class="content">
                <div class="tabs">
                    <a><img src="/assets/logos/wwAnalytics.png"> <font class="ww">ww</font>Analytics</a>
                </div>
                <div class="tabGroup active">
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2>On-Server Analytics</h2></td>
                                <td>
                                    <label class="switch" value="wwLiveSocket Server">
                                        <input type="checkbox" onchange="switchCapability(this)">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <p>Your servers comunicate data to <font class="ww">ww</font>Analytics Servers. Loading will be faster for end-user, but more processing is required.</p>
                    </div>
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2>Front-End Analytics</h2></td>
                                <td>
                                    <label class="switch" value="wwLiveSocket Server">
                                        <input type="checkbox" onchange="switchCapability(this)">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <p>Your front-end users comunicate data to <font class="ww">ww</font>Analytics Servers. Less processing is required for your servers.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <div class="container">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $name; ?>"><?php echo $name; ?></a> / <b><a href="/<?php echo $name; ?>/<?php echo $_GET['id']; ?>"><?php echo $_GET['id']; ?></a></b></p><br />

            <div class="topKit">
                <img src="/assets/logos/wwAnalytics.png">
                <h1><font class="ww">ww</font>Analytics</h1>
            </div>

            <div class="bgContainer" style="background-image: url('/assets/logos/wwAnalytics.png')"></div>

            <div class="content">
                <div class="card">
                    <canvas id="myChart"></canvas>
                    <script>
                        const ctx = document.getElementById('myChart');

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                            labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                            datasets: [{
                                label: '# of Votes',
                                data: [12, 19, 3, 5, 2, 3],
                                borderWidth: 1
                            }]
                            },
                            options: {
                            scales: {
                                y: {
                                beginAtZero: true
                                }
                            }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

<script src="/project/script.js"></script>

</html>