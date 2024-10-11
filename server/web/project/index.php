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
        $projectId = $row['id'];
    } else {
        header("HTTP/1.0 404 Not Found");
        exit();
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


            <?php
                $sql = "SELECT
                            `keys`.id,
                            `keys`.name,
                            apps.url AS `use`,
                            capabilities.capId
                        FROM `keys`
                        LEFT JOIN capabilities ON capabilities.capId = `keys`.use
                        RIGHT JOIN apps ON `keys`.`use` = apps.id
                        WHERE capabilities.id = '$projectId' OR capabilities.id IS NULL

                        UNION

                        SELECT
                            `keys`.id,
                            `keys`.name,
                            apps.url AS `use`,
                            capabilities.capId
                        FROM capabilities
                        LEFT JOIN apps ON `capabilities`.`capId` = apps.id
                        LEFT JOIN `keys` ON capabilities.capId = `keys`.use
                        WHERE capabilities.id = '$projectId' OR `keys`.id IS NULL;";
                $stmt = $conn->query($sql);
                
                $keys = array();
                $capabilities = array();

                while ($row2 = $stmt->fetch()) {
                    if ($row2['capId'] != null)
                        $capabilities[$row2['use']] = true;
                    $keys[$row2['use']][$row2['id']] = $row2;
                }
            ?>

            <div class="tabs">
                <a href="javascript: changeTab(0);" class="active">Files</a>
                <a href="javascript: changeTab(1);">Clients</a>
                <a href="javascript: changeTab(2);">Capabilities</a>
                <a href="javascript: changeTab(3);">Keys</a>
                <a href="javascript: changeTab(4);">Domain</a>
                <a href="javascript: changeTab(5);">Settings</a>
            </div>

            <div class="content">
                <div class="tabGroup active">
                    <div class="card">
                        <div class="version" data-open="false" data-nr="0">
                            <p onclick="version(this.parentElement);">Version <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>

                            <p class='v' value='0' onclick='select(this); render();'><img src='/assets/icons/props.svg'> Style 0</p>
                        </div>

                        <hr />

                        <div class="fileShow">
                            <img src="/assets/icons/folder.svg">
                            <p>Folder Name</p>
                            <img src="/assets/icons/properties.svg" class="o">
                        </div>
                        <div class="fileShow">
                            <img src="/assets/icons/folder.svg">
                            <p>Folder Name</p>
                            <img src="/assets/icons/properties.svg" class="o">
                        </div>
                        <div class="fileShow">
                            <img src="/assets/icons/folder.svg">
                            <p>Folder Name</p>
                            <img src="/assets/icons/properties.svg" class="o">
                        </div>
                        <div class="fileShow">
                            <img src="/assets/icons/folder.svg">
                            <p>Folder Name</p>
                            <img src="/assets/icons/properties.svg" class="o">
                        </div>
                        <div class="fileShow">
                            <img src="/assets/icons/file.svg">
                            <p>File Name</p>
                            <img src="/assets/icons/properties.svg" class="o">
                        </div>
                    </div>
                    <div class="card">
                        <?php
                            $uploadText = "Deploy a new version. Drag & drop it here.";
                            $upload = "/project/php/cloudapi/upload.php";
                            $fileName = hash("md2", uniqid());
                            $otherFunc = "addFiles(data)";
                            include "php/cloudapi/index.php";
                        ?>
                    </div>
                </div>
                <div class="tabGroup">
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2>Clients</h2></td>
                                <td><a href="">Invite</a></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="tabGroup">
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwAccounts.png"> <font class="ww">ww</font>Accounts</h2></td>
                                <td>
                                    <label class="switch" value="wwAccounts">
                                        <input type="checkbox" onchange="switchCapability(this)" <?php if (isset($capabilities['wwAccounts'])) echo "checked"; ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option" onclick="location.assign('wwAccounts/');">
                                <img src="/assets/icons/user.svg">
                                <p>Manage Accounts</p>
                            </div>
                            <div class="option" onclick="location.assign('wwAccounts/connect/');">
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
                                    <label class="switch" value="wwLiveSocket">
                                        <input type="checkbox" onchange="switchCapability(this)" <?php if (isset($capabilities['wwLiveSocket'])) echo "checked"; ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option" onclick="location.assign('wwLiveSocket/');">
                                <img src="/assets/icons/server.svg">
                                <p>Manage Server</p>
                            </div>
                            <div class="option" onclick="location.assign('wwLiveSocket/privte-routing/');">
                                <img src="/assets/logos/wwKey.png">
                                <p>Private Routing</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="option" onclick="location.assign('wwLiveSocket/connect/');">
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
                                    <label class="switch" value="wwAnalytics">
                                        <input type="checkbox" onchange="switchCapability(this)" <?php if (isset($capabilities['wwAnalytics'])) echo "checked"; ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option" onclick="location.assign('wwAnalytics/');">
                                <img src="/assets/icons/statistic.svg">
                                <p>Track Analytics</p>
                            </div>
                            <div class="option" onclick="location.assign('wwAnalytics/connect/');">
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
                                    <label class="switch" value="wwAI">
                                        <input type="checkbox" onchange="switchCapability(this)" <?php if (isset($capabilities['wwAI'])) echo "checked"; ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option" onclick="location.assign('wwAI/queries/');">
                                <img src="/assets/icons/queries.svg">
                                <p>AI Queries</p>
                            </div>
                            <div class="option" onclick="location.assign('wwAI/');">
                                <img src="/assets/icons/ai.svg">
                                <p>My Models</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="option" onclick="location.assign('wwAI/connect');">
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
                                    <label class="switch" value="wwKit">
                                        <input type="checkbox" onchange="switchCapability(this)" <?php if (isset($capabilities['wwKit'])) echo "checked"; ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option" onclick="location.assign('wwKit/');">
                                <img src="/assets/icons/connections.svg">
                                <p>Connections</p>
                            </div>
                            <div class="option" onclick="location.assign('wwKit/aPNS/');">
                                <img src="/assets/icons/pn.svg">
                                <p>Push Notification Service</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="option" onclick="location.assign('wwKit/purchase/');">
                                <img src="/assets/icons/money.svg">
                                <p>Purchase Services</p>
                            </div>
                            <div class="option" onclick="location.assign('wwKit/connect/');">
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
                                    <label class="switch" value="wwDB">
                                        <input type="checkbox" onchange="switchCapability(this)" <?php if (isset($capabilities['wwDB'])) echo "checked"; ?>>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <div class="row">
                            <div class="option" onclick="location.assign('wwDB/');">
                                <img src="/assets/icons/db.svg">
                                <p>Manage Databases</p>
                            </div>
                            <div class="option" onclick="location.assign('wwDB/queries');">
                                <img src="/assets/icons/queries.svg">
                                <p>Queries</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="option" onclick="location.assign('wwDB/connect/');">
                                <img src="/assets/logos/wwConnect.png">
                                <p><font class="ww">ww</font>Connect</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabGroup">
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwAccounts.png"> <font class="ww">ww</font>Accounts</h2></td>
                                <td><a href="keyGen/wwAccounts">Add</a></td>
                            </tr>
                        </table>

                        <?php
                            if (isset($keys['wwAccounts']))
                                foreach ($keys['wwAccounts'] as $key)
                                    echo "<div class='embed'><font>$key[name]</font><xmp>$key[id]</xmp><a href='keyManage/$key[id]'>Manage</a></div>";
                            else    
                                echo "<div class='embed center'>No keys.</div>";
                        ?>
                    </div>
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwLiveSocket Server.png"> <font class="ww">ww</font>LiveSocket Server</h2></td>
                                <td><a href="keyGen/wwLiveSocket">Add</a></td>
                            </tr>
                        </table>

                        <?php
                            if (isset($keys['wwLiveSocket']))
                                foreach ($keys['wwLiveSocket'] as $key)
                                    echo "<div class='embed'><font>$key[name]</font><xmp>$key[id]</xmp><a href='keyManage/$key[id]'>Manage</a></div>";
                            else    
                                echo "<div class='embed center'>No keys.</div>";
                        ?>
                    </div>
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwAI Models.png"> <font class="ww">ww</font>AI Models</h2></td>
                                <td><a href="keyGen/wwAI">Add</a></td>
                            </tr>
                        </table>

                        <?php
                            if (isset($keys['wwAI']) && count($keys['wwAI']) > 0)
                                foreach ($keys['wwAI'] as $key)
                                    echo "<div class='embed'><font>$key[name]</font><xmp>$key[id]</xmp><a href='keyManage/$key[id]'>Manage</a></div>";
                            else    
                                echo "<div class='embed center'>No keys.</div>";
                        ?>
                    </div>
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwSecure DataBase.png"> <font class="ww">ww</font>Secure DataBase</h2></td>
                                <td><a href="keyGen/wwDB">Add</a></td>
                            </tr>
                        </table>

                        <?php
                            if (isset($keys['wwDB']))
                                foreach ($keys['wwDB'] as $key)
                                    echo "<div class='embed'><font>$key[name]</font><xmp>$key[id]</xmp><a href='keyManage/$key[id]'>Manage</a></div>";
                            else    
                                echo "<div class='embed center'>No keys.</div>";
                        ?>
                    </div>
                </div>
                <div class="tabGroup">
                    <div class="card disabled">
                        <table>
                            <tr>
                                <td><h2><img src="/assets/logos/wwSecure DataBase.png"> <font class="ww">ww</font>Domain</h2></td>
                                <td>
                                    <label class="switch">
                                        <input type="checkbox" onchange="switchCapability(this)" checked>
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
                                        <input type="checkbox" onchange="switchCapability(this)" checked>
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>
                        <div class='embed'><xmp><?php echo $row['domain']; ?></xmp><a href='domain'>Manage</a></div>
                    </div>
                </div>
                <div class="tabGroup">
                    <div class="card">
                        <div class="form mini">
                            <textarea class="input" placeholder="Add a description" required="" rows="7"><?php echo base64_decode($row['description']); ?></textarea>
                            <span class="input-border"></span>
                            <a onclick="updateDescription(this)">Update</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="form mini">
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
                            /*$uploadText = "Update picture. Drag & drop it here.";
                            $upload = "../setup/cloudapi/upload.php";
                            $fileName = hash("md2", uniqid());
                            $otherFunc = "savePicture('$fileName.jpg')";
                            include "../setup/cloudapi/index.php";*/
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
    const owner = "<?php echo $row['ownerName']; ?>";
</script>

<script src="/project/script.js"></script>

</html>