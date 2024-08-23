<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>wwProject</title>
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
    <div class="container">
        <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $name; ?>"><?php echo $name; ?></a> / <b><a href="/<?php echo $name; ?>/<?php echo $_GET['id']; ?>"><?php echo $_GET['id']; ?></a></b></p><br />

        <div class="topKit">
            <img src="/assets/logos/wwKey.png">
            <h1>Private Routing</h1>
        </div>

        <img src="/assets/logos/wwKey.png" class="bg">

        <div class="tabs">
            <a>Capabilities</a>
        </div>

        <div class="content">
            <div class="tabGroup active">
                <div class="card">
                    <table>
                        <tr>
                            <td><h2><img src="/assets/logos/wwKey.png"> wwEnd-to-End Key</h2></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" onchange="enable(this)">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>

                    <div class="row">
                        <div class="option" onclick="location.assign('<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/wwKey');">
                            <img src="/assets/icons/key.svg">
                            <p>Private Routing</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="/project/script.js"></script>

</html>