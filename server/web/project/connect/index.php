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
            <img src="/assets/logos/wwConnect.png">
            <h1><font class="ww">ww</font>Connect</h1>
        </div>

        <div class="bgContainer" style="background-image: url('/assets/logos/wwConnect.png')"></div>

        <div class="content">
            <div class="tabs">
                <a><img src="/assets/logos/wwAccounts.png"> <font class="ww">ww</font>Accounts</a>
            </div>
            <div class="tabGroup active">
                <div class="card">
                    <h2>Domain Integration</h2><br />

                    <p>Configure Account Management directley on your domain. Update the domain records.</p>

                    <div class="records">
                        <p>Type</p>
                        <p>Host</p>
                        <p>Value</p>
                    </div>
                    <div class="records embed">
                        <p>CNAME</p>
                        <p>accounts</p>
                        <p>accounts.namespace.ww.alexsofonea.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="/project/script.js"></script>

</html>