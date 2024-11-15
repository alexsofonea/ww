<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wwAdmin</title>
    <link rel="stylesheet" href="/project/admin/assets/font/stylesheet.css">

    <link rel="stylesheet" href="/project/admin/style.css?cache=<?php echo time(); ?>">

    <script src="/project/admin/lib/jquery.js"></script>
    <script src="/project/admin/script.js?cache=<?php echo time(); ?>?cache=<?php echo time(); ?>"></script>
</head>

<style>

</style>

<body onload="loadWebEditor()">
    <?php include '/volume1/web/ww/project/admin/nav.php'; ?>
    <div class="content" id="content">
        <div class="topBar">
            <img class="profile" src="https://ww.alexsofonea.com/account/userImage/?name=Alex+Sofonea">
            <div class="separator"></div>
            <img src="/project/admin/assets/icons/star.svg">
            <img src="/project/admin/assets/icons/star.svg">
            <div class="separator"></div>
            <img src="/project/admin/assets/icons/star.svg">
            <img src="/project/admin/assets/icons/star.svg">

            <div class="left">
                <h4>Overview</h4>
            </div>
        </div>

        <style>
            #editor {
                height: calc(100% + 30px + 60px);
            }
            iframe {
                width: calc(100% + 30px);
                height: calc(100% + 30px + 60px);
                border: none;
                transform: translate(-15px, -75px);
                z-index: -1;
                padding-top: 60px;
                box-sizing: border-box;
            }
            iframe body {
                margin-top: 60px;
            }
        </style>

        <div id="editor"></div>
        

        <script>
            function loadWebEditor() {
                document.querySelector("#editor").loadEditorPage('/project/admin/cloud/demo2/index.php');
            }
        </script>
    </div>
</body>

</html>