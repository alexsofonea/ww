<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>wwProfile</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">
    <link rel="stylesheet" href="/assets/logo-font/stylesheet.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/project/style.css">
</head>

<?php
    include "../db.php";
    include "../account/accountId.php";

    $sql = "SELECT * FROM `accounts` WHERE LOWER(name) = LOWER('$_GET[id]');";
    $stmt = $conn->query($sql);
    if ($row = $stmt->fetch()) {

    }
?>

<body onload="loadProject()">
    <div class="container">
        <div class="left-column">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $urlId; ?>/"><?php echo $urlId; ?></a></b></p><br />

            <div class="tabs">
                <a href="javascript: changeTab(0);" class="active"><font class="ww">WW</font>Projects</a>
                <a href="/design"><font class="ww">WW</font>Design</a>
            </div>

            <div class="content">
                <div class="tabGroup active">
                    <?php
                        $sql = "SELECT * FROM `projects` WHERE owner = '$myId';";
                        $stmt = $conn->query($sql);
                        while ($row2 = $stmt->fetch()) {
                    ?>
                        <div class="card" onclick="location.assign('<?php echo $row2['publicId']; ?>/');">
                            <table>
                                <tr>
                                    <td><h2><img src="<?php echo $row2['picture'] != "" ? "https://ww.alexsofonea.com/cloud/$row2[picture]" : "/assets/logos/ww.png"; ?>"><?php echo $row2['name']; ?></h2></td>
                                </tr>
                            </table>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="right-column">
            <img id='projectPicture' src='<?php echo str_contains($row['picture'], "/") ? "https://ww.alexsofonea.com/cloud/$row[picture]" : "/account/userImage/?name=" . str_replace(" ", "+", $name) . "&color=" . $row['picture']; ?>'>
            <h1><?php echo $row['name']; ?></h1><br />
            <p id="description"></p>

            <hr style="margin-top: 20px;" />


        </div>
    </div>
</body>

<script>
    const projectId = "<?php echo $row['publicId']; ?>";
</script>

<script src="/project/script.js"></script>

</html>