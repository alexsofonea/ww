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
                    <a><img src="/assets/logos/wwAccounts.png"> <font class="ww">ww</font>Accounts</a>
                </div>
                <div class="tabGroup active">
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2>Domain Integration</h2></td>
                                <td>
                                    <label class="switch" value="wwAccounts">
                                        <input type="checkbox" onchange="switchCapability(this)">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <p>Configure Account Management directley on your domain. Update the domain records to point to <font class="ww">WW</font> Servers.</p>

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

                        <div class="embed">
                            <div class="form mini">
                                <input id="keyName" class="input" placeholder="Account Domain" required="" type="text">
                                <span class="input-border"></span>
                                <a onclick="">Update</a>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2>Account Server</h2></td>
                                <td>
                                    <label class="switch" value="wwAccounts">
                                        <input type="checkbox" onchange="switchCapability(this)">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <p>Your login page stays on your website while <font class="ww">WW</font> Servers do the rest. Point your login forms to: </p>

                        <div class="embed">
                            account.ww.alexsofonea.com/[action]/<?php echo $_GET['user']; ?>/<?php echo $_GET['id']; ?>/
                        </div>

                        <a href="">Learn more about implementing.</a>
                    </div>
                    <div class="card">
                        <table>
                            <tr>
                                <td><h2>Independent Account Integraion</h2></td>
                                <td>
                                    <label class="switch" value="wwAccounts">
                                        <input type="checkbox" onchange="switchCapability(this)">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>

                        <p><font class="ww">WW</font> Servers take care of login process. Redirect your users to the folowing link for account manager.</p>
                        
                        <div class="embed">
                            <?php echo $_GET['id']; ?>.<?php echo $_GET['user']; ?>.account.ww.alexsofonea.com
                        </div>

                        <a href="">Learn more about implementing.</a>
                    </div>

                    <hr />

                    <div class="card">
                        <div class="embed">
                            <div class="form mini">
                                <input id="keyName" class="input" placeholder="Point back url" required="" type="text">
                                <span class="input-border"></span>
                                <a onclick="">Update</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <table>
                            <tr>
                                <td><h2>Payment System</h2></td>
                                <td>
                                    <label class="switch" value="wwAccounts">
                                        <input type="checkbox" onchange="switchCapability(this)">
                                        <span class="slider"></span>
                                    </label>
                                </td>
                            </tr>
                        </table>
                        <p><font class="ww">WW</font> Servers can handle all the in-app purchase checks and precessing (using AppStore Connect). Set it up in <font class="ww">WW</font>Kit for AppStore.</p>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container">
            <p class="project"><img src="<?php echo $picture; ?>"> <a href="/<?php echo $name; ?>"><?php echo $name; ?></a> / <b><a href="/<?php echo $name; ?>/<?php echo $_GET['id']; ?>"><?php echo $_GET['id']; ?></a></b></p><br />

            <div class="topKit">
                <img src="/assets/logos/wwAccounts.png">
                <h1><font class="ww">ww</font>Accounts</h1>
            </div>

            <div class="bgContainer" style="background-image: url('/assets/logos/wwAccounts.png')"></div>

            <div class="content">

            </div>
        </div>
    <?php } ?>
</body>

<script src="/project/script.js"></script>

</html>