<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wwAdmin</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">

    <link rel="stylesheet" href="/style.css?cache=<?php echo time(); ?>">

    <script src="/lib/jquery.js"></script>
    <script src="/script.js?cache=<?php echo time(); ?>"></script>
</head>

<style>

</style>

<body>
    <?php include '/volume1/web/web-admin/nav.php'; ?>
    <div class="content" id="content">
        <div class="topBar">
            <img class="profile" src="https://ww.alexsofonea.com/account/userImage/?name=Alex+Sofonea">
            <div class="separator"></div>
            <img src="/assets/icons/star.svg">
            <img src="/assets/icons/star.svg">
            <div class="separator"></div>
            <img src="/assets/icons/star.svg">
            <img src="/assets/icons/star.svg">

            <div class="left">
                <h4>Connect</h4>
            </div>
        </div>

        <div class="row">
            <div class="element w70">
                <h4>Records</h4>
                <div class="records embed">
                    <p>CNAME</p>
                    <p>@</p>
                    <p>namespace.ww.alexsofonea.com</p>
                    <a onclick="certify()">Certify</a>
                </div>
                <div class="records embed">
                    <p>CNAME</p>
                    <p>status</p>
                    <p>namespace.ww.alexsofonea.com</p>
                    <a onclick="certify()">Certify</a>
                </div>
                <div class="records embed">
                    <p>CNAME</p>
                    <p>@</p>
                    <p>namespace.ww.alexsofonea.com</p>
                    <a onclick="certify()">Certify</a>
                </div>
                <div class="records embed">
                    <p>CNAME</p>
                    <p>status</p>
                    <p>namespace.ww.alexsofonea.com</p>
                    <a onclick="certify()">Certify</a>
                </div>
            </div>
            <div class="element w30">
                <h4>Domains</h4>
                <div class="fileShow">
                    <img src="/assets/icons/file.svg">
                    <p>alexsofonea.com</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
                <div class="fileShow">
                    <img src="/assets/icons/file.svg">
                    <p>status.alexsofonea.com</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
                <div class="fileShow">
                    <img src="/assets/icons/file.svg">
                    <p>wwdev.systems</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="element w40">
                
            </div>
            <div class="element w60">
                
            </div>
        </div>
        <div class="row">
            <div class="element w30">
                
            </div>
            <div class="element w50">
                
            </div>
            <div class="element w40">
                
            </div>
        </div>


    </div>
</body>
</html>