<?php include "../var.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="../style.css">
    <title><?php echo $app_name; ?> - Log Out</title>
    <script src="../jquery.js"></script>
</head>

<style>
:root {
    --color1: #<?php echo $color; ?>;
    --color2: #<?php echo $color2; ?>;
}
</style>

<body onload="loadElements(); setTimeout(function () { location.assign('logout.php?redirect=<?php echo $_GET['redirect'] ?? ""; ?>'); }, 1000);">

<table id="app" onclick="location.assign('<?php echo $url; ?>');">
    <tr>
        <td><img class="logo" src="<?php echo $logo; ?>"></td>
        <td><h1><?php echo $app_name; ?></h1></td>
    </tr>
</table>
    
<div class="widget selected" style="text-align: center;">
    <h1>Logging you out</h1>
    <p id="error"></p>

    <br /><br /><br /><br />

    <div class="loading-anim" id="loading-anim" style="display: block; transform: translate(calc(-50% - 22.5px), -72px) scale(1.5);"><svg id="loading1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg><svg id="loading2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg></div>

</div>

<script src="../script.js"></script>


</html>