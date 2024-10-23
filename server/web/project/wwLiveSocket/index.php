<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>wwAccounts</title>
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
    <?php if (isset($_GET['use']) && $_GET['use'] == "connect") { ?>
        <div class="container">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $name; ?>"><?php echo $name; ?></a> / <b><a href="/<?php echo $name; ?>/<?php echo $_GET['id']; ?>"><?php echo $_GET['id']; ?></a></b></p><br />

            <div class="topKit">
                <img src="/assets/logos/wwConnect.png">
                <h1><font class="ww">ww</font>Connect</h1>
            </div>

            <div class="bgContainer" style="background-image: url('/assets/logos/wwConnect.png')"></div>

            <div class="content">
                <div class="tabs">
                    <a><img src="/assets/logos/wwLiveSocket Server.png"> <font class="ww">ww</font>LiveSocket Server</a>
                </div>
                <div class="tabGroup active">
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2>Server Connection</h2></td>
                                <td>
                                    <label class="switch" value="wwLiveSocket Server">
                                        <input type="checkbox" onchange="switchCapability(this)">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <p>Your servers connect to <font class="ww">WW</font>Connect Servers to connect users to <font class="ww">ww</font>LiveSocket Server.</p>
                    </div>
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2>User Connection</h2></td>
                                <td>
                                    <label class="switch" value="wwLiveSocket Server">
                                        <input type="checkbox" onchange="switchCapability(this)">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <p>Your users connect directly to <font class="ww">ww</font>LiveSocket Server trough user interactions (for example sharing codes).</p>
                    </div>
                </div>
            </div>
        </div>
    <?php } else if (isset($_GET['use']) && $_GET['use'] == "privte-routing") { ?>
        <div class="container">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $name; ?>"><?php echo $name; ?></a> / <b><a href="/<?php echo $name; ?>/<?php echo $_GET['id']; ?>"><?php echo $_GET['id']; ?></a></b></p><br />

            <div class="topKit">
                <img src="/assets/logos/wwKey.png">
                <h1><font class="ww">ww</font>LiveSocket Private Routing</h1>
            </div>

            <div class="bgContainer" style="background-image: url('/assets/logos/wwKey.png')"></div>

            <div class="content">
                <div class="card">
                    <table>
                        <tr>
                            <td><h2>Route encrypted server connection trough <font class="ww">ww</font> Servers.</h2></td>
                            <td>
                                <label class="switch" value="wwLiveSocket Private Routing">
                                    <input type="checkbox" onchange="switchCapability(this)">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>

                    <p>This feature is intended for secure live server connection that require additional encryption. Connections will be slower.</p>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $name; ?>"><?php echo $name; ?></a> / <b><a href="/<?php echo $name; ?>/<?php echo $_GET['id']; ?>"><?php echo $_GET['id']; ?></a></b></p><br />

            <div class="topKit">
                <img src="/assets/logos/wwLiveSocket Server.png">
                <h1><font class="ww">ww</font>LiveSocket Server</h1>
            </div>

            <div class="bgContainer" style="background-image: url('/assets/logos/wwLiveSocket Server.png')"></div>

            <div class="content">
                <div class="card">
                    <table>
                        <tr>
                            <td><h2>Route encrypted server connection trough <font class="ww">ww</font> Servers.</h2></td>
                            <td>
                                <label class="switch" value="wwLiveSocket Private Routing">
                                    <input type="checkbox" onchange="switchCapability(this)">
                                    <span class="slider"></span>
                                </label>
                            </td>
                        </tr>
                    </table>

                    <p>This feature is intended for secure live server connection that require additional encryption. Connections will be slower.</p>
                </div>
            </div>
        </div>
    <?php } ?>
</body>

<script src="/project/script.js"></script>

</html>