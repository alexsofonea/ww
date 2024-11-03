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
            <img src="/assets/icons/laptop.svg">
            <img src="/assets/icons/phone.svg">
            <div class="separator"></div>
            <img src="/assets/icons/star.svg">
            <img src="/assets/icons/idea.svg">

            <div class="left">
                <h4>Templates</h4>
            </div>
        </div>

        <style>
            .element {
                aspect-ratio: 16 / 9;
                overflow: hidden;
            }
            .element img {
                width: calc(100% + 30px);
                height: calc(100% + 30px);
                transform: translate(-15px, -15px);
                object-fit: cover;
            }
        </style>

        <div class="editor" id="editor" style="opacity: 0; pointer-events: none;">
            <img src='/cloud/demo/thum.jpeg'>
            <div class="options">  

            </div>
        </div>
        <div class="backgroundBlur" style="opacity: 0; pointer-events: none;" onclick="dismissEditor(this)"></div>

        <div class="row">
            <div class="element">
                <img src="/cloud/demo/thum.jpeg">
            </div>
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
        </div>
        <div class="row">
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
        </div>
        <div class="row">
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
        </div>
        <div class="row">
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
        </div>
        <div class="row">
            <div class="element">

            </div>
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
        </div>
        <div class="row">
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
        </div>
        <div class="row">
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
            <div class="element">
                
            </div>
        </div>


    </div>
</body>
</html>