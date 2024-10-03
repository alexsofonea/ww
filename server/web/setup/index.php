<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" contents="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>New wwProject</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">
    <link rel="stylesheet" href="/style.css">
    <script src="/assets/lib/jquery.js"></script>
</head>

<body>

    <?php
        include "../db.php";
        include "../account/accountId.php";
    ?>

    <div class="contents active" id="name">
        <h1>Let's start with a name for your project</h1>
        <div class="form">
            <input class="input" placeholder="Enter the name of the project" required="" type="text" id="projectName" onkeyup="updateName(this)">
            <span class="input-border"></span>
        </div>
        <br />
        <p>https://ww.alexsofonea.com/<?php echo $urlId; ?>/<b id="projectUrl"></b><font id="nameResponse"></font></p>
        <br />
        <button class="action" onclick="validateName()" disabled>Next</button>
    </div>
    <div class="contents" id="domain">
        <h1>Customize with your own domain</h1>
        <div class="form">
            <input class="input" placeholder="Enter your domain or subdomain" required="" type="text" id="projectDomain">
            <span class="input-border"></span>
        </div>
        <br />
        <a href="javascript:changecontents('domainconfirm')" class="action">I don't have a domain</a>
        <button class="action" onclick="validateDomain()">Next</button>
    </div>
    <div class="contents" id="domainadd">
        <a href="javascript:changecontents('domain')">Back</a>
        <h1>Let's verify your domain.</h1>

        <p>Please add the following domain records.</p>
        <div class="records">
            <p>Type</p>
            <p>Host</p>
            <p>Value</p>
        </div>
        <div class="records embed">
            <p>TXT</p>
            <p>ww-domain-verification</p>
            <p id="domainVerifyId"></p>
        </div>

        <br />
        <p>Note that it might take some time to verify the domain.</p>

        <a href="javascript:changecontents('domainconfirm2')" class="action">Skip verification</a>

        <button class="action" onclick="verfiyDomain(this)">Verify</button>
    </div>
    <div class="contents" id="domainconfirm">
        <a href="javascript:changecontents('domain')">Back</a>
        <h1>Note that some functionality might not be available without a domain.</h1>
        <button class="action" onclick="changecontents('domainconfirm2')">I understand</button>
    </div>
    <div class="contents" id="domainconfirm2">
        <a href="javascript:changecontents('domainadd')">Back</a>
        <h1>Note that some functionality might not be available until verification.</h1>
        <button class="action" onclick="changecontents('picture')">I understand</button>
    </div>
    <div class="contents" id="verify">
        <a href="javascript:changecontents('domainadd')">Back</a>
        <h1>Couldn't verify.</h1>
        <p>Ensure that the records are accurately set. If you have recently updated them, wait until the records are updated to continue verification.</p>

        <a href="javascript:changecontents('domainconfirm2')" class="action">Skip verification</a>
        <button class="action" onclick="changecontents('domainadd')">Try again</button>
    </div>
    <div class="contents" id="picture">
        <h1>Customize your project picture.</h1>

        <?php
            $uploadText = "Drag & drop the image file here.";
            $upload = "/setup/cloudapi/upload.php";
            $fileName = hash("md2", uniqid());
            $otherFunc = "savePicture('$fileName.jpg')";
            include "cloudapi/index.php";
        ?>

        <a href="javascript:changecontents('set')" class="action">I don't need a picture.</a>
    </div>

    <div class="contents" id="set">
        <h1>You're all set!</h1>

        <button class="action" id="lastButton">Open project</button>
    </div>


<script>
    const userName = "<?php echo $urlId; ?>";
</script>

<script src="/setup/script.js"></script>
<script src="/script.js"></script>

</body>
</html>