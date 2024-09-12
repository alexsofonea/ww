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
            <img src="/assets/logos/wwKey.png">
            <h1><font class="ww">ww</font>Keys Generation</h1>
        </div>

        <img src="/assets/logos/wwKey.png" class="bg">

        <div class="content">
            <div class="tabs">
                <a href="../wwAccounts" <?php if ($_GET['use'] == "wwAccounts") { echo "class='active'"; } ?>><img src="/assets/logos/wwAccounts.png"> <font class="ww">ww</font>Accounts</a>
                <a href="../wwLiveSocket" <?php if ($_GET['use'] == "wwLiveSocket") { echo "class='active'"; } ?>><img src="/assets/logos/wwLiveSocket Server.png"> <font class="ww">ww</font>LiveSocket Server</a>
                <a href="../wwAI" <?php if ($_GET['use'] == "wwAI") { echo "class='active'"; } ?>><img src="/assets/logos/wwAI Models.png"> <font class="ww">ww</font>AI</a>
                <a href="../wwAI" <?php if ($_GET['use'] == "wwDB") { echo "class='active'"; } ?>><img src="/assets/logos/wwSecure DataBase.png"> <font class="ww">ww</font>Secure DataBase</a>
            </div>
            <div class="tabGroup active">
                <div class="card">
                    <div class="form">
                        <input id="keyName" class="input" placeholder="Name the key" required="" type="text">
                        <span class="input-border"></span>
                        <a onclick="generate(this)">Generate</a>
                    </div>
                </div>
                <div class="card" id="generate" style="display: none;">
                    <h4>Key ID</h4>
                    <div class="embed"></div>
                    <h4>Public Key</h4>
                    <div class="embed"></div>
                    <h4>Private Key</h4>
                    <div class="embed"></div>
                    <br />
                    <p>Note that <font class="ww">WW</font> can not recover the private key after leaving this page.</p>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    function generate(el) {
        el.innerHTML = `<svg class="loader" viewBox="25 25 50 50"><circle r="20" cy="50" cx="50"></circle></svg>`;
        const name = document.getElementById("keyName").value;
        var generate = document.getElementById("generate");

        const data = {
            projectPublicId: '<?php echo $_GET["id"]; ?>',
            name: name,
            owner: '<?php echo $_GET["user"]; ?>',
            use: '<?php echo $_GET["use"]; ?>'
        };

        $.ajax({
            url: "/project/keyGen/generate.php",
            type: "POST",
            data: data,
            success: function(response) {
                const key = JSON.parse(response);

                generate.style.display = "block";
                generate = generate.querySelectorAll(".embed");

                generate[0].innerHTML = key["id"];
                generate[1].innerHTML = key["publicKey"].replace("\n", "<br>");
                generate[2].innerHTML = key["privateKey"].replace("\n", "<br>");


                const pemFileContent = key["privateKey"];
                const blob = new Blob([pemFileContent], { type: 'application/octet-stream' });
                const anchor = document.createElement('a');
                anchor.href = URL.createObjectURL(blob);
                anchor.download = name + '.pem';
                anchor.click();

                console.log(key);
            },
            error: function(xhr, status, error) {

            }
        });

        el.innerHTML = "Generate";
    }
</script>

<script src="/project/script.js"></script>

</html>