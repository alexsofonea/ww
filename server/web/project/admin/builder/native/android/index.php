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
                <h4>Android Native App</h4>
            </div>
        </div>
        <div class="row">
            <div class="element w40">
                <div class="fileShow">
                    <img src="/assets/icons/image.svg">
                    <p>Home</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
                <div class="fileShow">
                    <img src="/assets/icons/image.svg">
                    <p>Contact</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
                <div class="fileShow">
                    <img src="/assets/icons/image.svg">
                    <p>About</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>
                <hr />
                <div class="fileShow">
                    <img src="/assets/icons/image.svg">
                    <p>Blog</p>
                    <img src="/assets/icons/properties.svg" class="o">
                </div>

                <br /><br /><br />

                <button style="position: absolute; bottom: 20px; right: 20px;">New Page</button>
            </div>
            <div class="element w60" id="editor" style="padding: 0;">
            </div>
            <style>
                .overlay {
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    pointer-events: none;
                    z-index: 9;
                }
                #editor {
                    overflow: hidden;
                    aspect-ratio: 1;
                    text-align: center;
                }
                #editor iframe {
                    aspect-ratio: 1;
                }
                iframe {
                    width: 290px;
                    height: 100%;
                    border: none;
                    z-index: -1;
                    box-sizing: border-box;
                }
            </style>
            <script>
                function loadWebEditor() {
                    document.querySelector("#editor").loadSimplePage('/project/admin/cloud/demo/index.php', '<img src="/project/admin/builder/native/android.png" class="overlay">');
                }
            </script>
        </div>


    </div>
</body>
</html>