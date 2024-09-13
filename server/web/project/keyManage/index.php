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
            <h1><font class="ww">ww</font>Keys Manager</h1>
        </div>

        <img src="/assets/logos/wwKey.png" class="bg">

        <div class="content">
            <div class="tabGroup active">
                <div class="card" id="generate">
                    <?php
                        $sql = "SELECT * FROM `keys` WHERE projectId = (SELECT id FROM projects WHERE publicId = '$_GET[id]' AND ownerName = '$_GET[user]') AND id = '$_GET[use]';";
                        $stmt = $conn->query($sql);
                        if ($row2 = $stmt->fetch()) {
                            echo "<h4>Key Nam</h4>";
                            echo "<div class='embed'>" . $row2["name"] . "</div>";
                            echo "<h4>Key ID</h4>";
                            echo "<div class='embed'>" . $row2["id"] . "</div>";
                            echo "<h4>Public Key</h4>";
                            echo "<div class='embed'>" . str_replace("\n", "<br />", $row2["publicKey"]) . "</div>";
                            echo "<h4>Key Use</h4>";
                            echo "<div class='embed'>" . $row2["use"] . "</div>";
                        }
                    ?>
                    <br />
                    <a onclick="rewoke(this)" style="float: right;">Revoke</a>
                    <br />
                    <br />
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