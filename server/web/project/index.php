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
    include "../db.php";
    include "../account/accountId.php";


    $sql = "SELECT * FROM `projects` WHERE publicId = '$_GET[id]' AND `ownerName` = '$_GET[user]';";
    $stmt = $conn->query($sql);
    if ($row = $stmt->fetch()) {

    }
?>

<body onload="loadProject()">
    <div class="container">
        <div class="left-column">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $urlId; ?>/"><?php echo $urlId; ?></a> / <b><a href="/<?php echo $urlId; ?>/<?php echo $row['publicId']; ?>"><?php echo $row['publicId']; ?></a></b></p><br />
            <div class="tags" id="tags">
                <?php
                    if ($row['tags'] != "")
                        foreach(json_decode($row['tags']) as $tag)
                            echo "<tag>$tag</tag>";
                ?>
            </div>

            <div class="tabs">
                <a href="javascript: changeTab(0);" class="active">Capabilities</a>
                <a href="javascript: changeTab(1);">Domain</a>
                <a href="javascript: changeTab(2);">Settings</a>
            </div>

            <div class="content">
                <div class="tabGroup active">
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwAccounts.png"> <font class="ww">ww</font>Accounts</h2></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="enable(this)" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option">
                                <img src="/assets/icons/user.svg">
                                <p>Manage Accounts</p>
                            </div>
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/connect');">
                                <img src="/assets/logos/wwConnect.png">
                                <p><font class="ww">ww</font>Connect</p>
                            </div>
                        </div>
                    </div>
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwLiveSocket Server.png"> <font class="ww">ww</font>LiveSocket Server</h2></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="enable(this)" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/liveSocketServer');">
                                <img src="/assets/icons/server.svg">
                                <p>Manage Server</p>
                            </div>
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/privte-routing');">
                                <img src="/assets/logos/wwKey.png">
                                <p>Private Routing</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/connect');">
                                <img src="/assets/logos/wwConnect.png">
                                <p><font class="ww">ww</font>Connect</p>
                            </div>
                        </div>
                    </div>
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwAnalytics.png"> <font class="ww">ww</font>Analytics</h2></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="enable(this)" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option">
                                <img src="/assets/icons/statistic.svg">
                                <p>Track Analytics</p>
                            </div>
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/connect');">
                                <img src="/assets/logos/wwConnect.png">
                                <p><font class="ww">ww</font>Connect</p>
                            </div>
                        </div>
                    </div>
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwAI Models.png"> <font class="ww">ww</font>AI Models</h2></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="enable(this)" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option">
                                <img src="/assets/icons/queries.svg">
                                <p>AI Queries</p>
                            </div>
                            <div class="option">
                                <img src="/assets/icons/ai.svg">
                                <p>My Models</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/connect');">
                                <img src="/assets/logos/wwConnect.png">
                                <p><font class="ww">ww</font>Connect</p>
                            </div>
                        </div>
                    </div>
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwKit for AppStore.png"> <font class="ww">ww</font>Kit for AppStore</h2></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="enable(this)" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option">
                                <img src="/assets/icons/connections.svg">
                                <p>Connections</p>
                            </div>
                            <div class="option">
                                <img src="/assets/icons/pn.svg">
                                <p>Push Notification Service</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="option">
                                <img src="/assets/icons/money.svg">
                                <p>Purchase Services</p>
                            </div>
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/connect');">
                                <img src="/assets/logos/wwConnect.png">
                                <p><font class="ww">ww</font>Connect</p>
                            </div>
                        </div>
                    </div>
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwSecure DataBase.png"> <font class="ww">ww</font>Secure DataBase</h2></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="enable(this)" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option">
                                <img src="/assets/icons/db.svg">
                                <p>Manage Databases</p>
                            </div>
                            <div class="option">
                                <img src="/assets/icons/queries.svg">
                                <p>Queries</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/connect');">
                                <img src="/assets/logos/wwConnect.png">
                                <p><font class="ww">ww</font>Connect</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabGroup">
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwSecure DataBase.png"> <font class="ww">ww</font>Domain</h2></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="enable(this)" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="embed"><xmp><?php echo $row['publicId']; ?>.<?php echo $row['ownerName']; ?>.hosting.ww.alexsofonea.com</xmp></div>
                    </div>
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwSecure DataBase.png"> Custom Domain</h2></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="enable(this)" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="form">
                            <input class="input" placeholder="Enter your domain name" required="" type="text" id="projectName" value="<?php echo $row['domain']; ?>">
                            <span class="input-border"></span>
                        </div>

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
                <div class="tabGroup">
                    <div class="card">
                        <div class="form">
                            <textarea class="input" placeholder="Add a description" required=""></textarea>
                            <span class="input-border"></span>
                            <a onclick="updateDescription(this)">Update</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="form">
                            <input class="input" placeholder="Add a tag" required="" type="text">
                            <span class="input-border"></span>
                            <a onclick="addTag(this)">Add Tag</a>
                        </div>
                        <div class="tags" id="tags2">
                            <?php
                                if ($row['tags'] != "")
                                    foreach(json_decode($row['tags']) as $tag)
                                        echo "<tag onclick='removeTag(this)'>$tag</tag>";
                            ?>
                        </div>
                    </div>
                    <div class="card">
                        <?php
                            $uploadText = "Update picture. Drag & drop it here.";
                            $upload = "../setup/cloudapi/upload.php";
                            $fileName = hash("md2", uniqid());
                            $otherFunc = "savePicture('$fileName.jpg')";
                            include "../setup/cloudapi/index.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-column">
            <?php echo $row['picture'] != "" ? "<img id='projectPicture' src='https://ww.alexsofonea.com/cloud/$row[picture]'>" : ""; ?>
            <h1><?php echo $row['name']; ?></h1><br />
            <p id="description"><?php echo base64_decode($row['description']); ?></p>

            <hr style="margin-top: 20px;" />


        </div>
    </div>
</body>

<script>
    const projectId = "<?php echo $row['publicId']; ?>";
</script>

<script src="/project/script.js"></script>

</html>