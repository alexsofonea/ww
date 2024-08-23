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
?>

<body onload="loadProject()">
    <div class="container">
        <div class="left-column">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $name; ?>/"><?php echo $name; ?></a> / <b><a href="/<?php echo $name; ?>/<?php echo $_GET['id']; ?>"><?php echo $_GET['id']; ?></a></b></p><br />
            <div class="tags">
                <tag>this</tag>
                <tag>is</tag>
                <tag>a</tag>
                <tag>tag</tag>
                <tag>this</tag>
                <tag>is</tag>
                <tag>a</tag>
                <tag>tag</tag>
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
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/connect');">
                                <img src="/assets/logos/wwConnect.png">
                                <p><font class="ww">ww</font>Connect</p>
                            </div>
                            <div class="option" onclick="location.assign('/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/privte-routing');">
                                <img src="/assets/logos/wwKey.png">
                                <p>Private Routing</p>
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

                        <div class="embed"><xmp><?php echo strtolower($_GET['id']); ?>.hosting.ww.alexsofonea.com</xmp></div>
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
                            <input class="input" placeholder="Enter your domain name" required="" type="text" id="projectName">
                            <span class="input-border"></span>
                        </div>

                        <div class="records">
                            <p>Type</p>
                            <p>Host</p>
                            <p>Value</p>
                        </div>
                        <div class="records embed">
                            <p>TXT</p>
                            <p>ww-domain-verification</p>
                            <p>ww_gsAt6dhsaXshZHZ</p>
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

                </div>
            </div>
        </div>
        <div class="right-column">
            <h1>Project Title</h1><br />
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Consectetur accusamus itaque unde fugit reprehenderit iste non quidem numquam. Tempore vel in magnam maiores distinctio doloremque ipsam error molestiae nostrum modi.</p>

            <hr style="margin-top: 20px;" />


        </div>
    </div>
</body>

<script src="/project/script.js"></script>

</html>