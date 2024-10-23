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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<?php
    include "../../db.php";
    include "../../account/accountId.php";
?>

<body>
    <div class="container">
        <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $name; ?>"><?php echo $name; ?></a> / <b><a href="/<?php echo $name; ?>/<?php echo $_GET['id']; ?>"><?php echo $_GET['id']; ?></a></b></p><br />

        <div class="topKit">
            <img src="/assets/logos/wwSecure DataBase.png">
            <h1><font class="ww">ww</font>Domain Manager</h1>
        </div>

        <div class="bgContainer" style="background-image: url('/assets/logos/wwSecure DataBase.png')"></div>

        <div class="content">
            <div class="tabGroup active">
                <div class="card">
                    <div class="form">
                        <input class="input" placeholder="Domain Name" required="" type="text">
                        <span class="input-border"></span>
                        <a onclick="generate(this)">Verify</a>
                    </div>
                </div>
                <div class="card">
                    <h4>Records</h4>
                    
                    <div class="records">
                        <p>Type</p>
                        <p>Host</p>
                        <p>Value</p>
                    </div>
                    <div class="records embed">
                        <p>CNAME</p>
                        <p>accounts</p>
                        <p>accounts.namespace.ww.alexsofonea.com</p>
                        <a onclick="certify()">Certify</a>
                    </div>
                    <div class="records embed">
                        <p>CNAME</p>
                        <p>connect</p>
                        <p>connect.namespace.ww.alexsofonea.com</p>
                    </div>
                    <div class="records embed">
                        <p>ALIAS</p>
                        <p>@</p>
                        <p>namespace.ww.alexsofonea.com</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function rewoke(el) {
        el.innerHTML = `<svg class="loader" viewBox="25 25 50 50"><circle r="20" cy="50" cx="50"></circle></svg>`;

        const data = {
            projectPublicId: '<?php echo $_GET["id"]; ?>',
            owner: '<?php echo $_GET["user"]; ?>',
            id: '<?php echo $_GET["use"]; ?>'
        };

        $.ajax({
            url: "/project/keyManage/revoke.php",
            type: "POST",
            data: data,
            success: function(response) {
                if (response == "success")
                    window.location.href = "/<?php echo $_GET["user"]; ?>/<?php echo $_GET["id"]; ?>";
                else
                    alert("An error occurred");
            },
            error: function(xhr, status, error) {

            }
        });

        el.innerHTML = "Revoke";
    }
</script>

<script src="/project/script.js"></script>

</html>