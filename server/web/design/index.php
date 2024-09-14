<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" contents="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>New wwProject</title>
    <link rel="stylesheet" href="/assets/font/stylesheet.css">
    <link rel="stylesheet" href="/assets/logo-font/stylesheet.css">
    <link rel="stylesheet" href="/style.css">
    <link rel="stylesheet" href="/design/style.css">
    <script src="/assets/lib/jquery.js"></script>
    <script src="/script.js"></script>
    <script src="/setup/script.js"></script>
</head>

<body>

    <?php
        include "../db.php";
        include "../account/accountId.php";
    ?>

    <div class="menu">
        <h4><font class="ww">WW</font>Design</h4>

        <a href="javascript:changecontents('simple')" class="active">Simple</a>
        <a href="javascript:changecontents('classic')">Classic</a>
        <a href="javascript:changecontents('playful')">Playful</a>
        <a href="javascript:changecontents('luxury')">Luxury</a>
    </div>

    <div class="search">

    </div>

    <div class="contents active" id="simple">
        <div class="fullFrame" style="background-image: url('/assets/temp/design.png')">
            <h4><font class="ww">WW</font>Design</h4>
        </div>
        <div class="grid">
            <?php for ($i = 0; $i < 50; $i++) { ?>
                <div class="element">
                    <iframe></iframe>
                    <img onclick="createActionMenuBig(this)" data-actions="someFunc();props;Copy Snippet|someFunc();props;Customize" src="/assets/icons/props.svg" >
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="contents" id="classic">
        <div class="fullFrame" style="background-image: url('/assets/temp/design.png')">
            <h4><font class="ww">WW</font>Design</h4>
        </div>
        <div class="grid">
            <?php for ($i = 0; $i < 50; $i++) { ?>
                <div class="element">
                    <iframe></iframe>
                    <img onclick="createActionMenuBig(this)" data-actions="someFunc();props;Copy Snippet|someFunc();props;Customize" src="/assets/icons/props.svg" >
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="contents" id="playful">
        <div class="fullFrame" style="background-image: url('/assets/temp/design.png')">
            <h4><font class="ww">WW</font>Design</h4>
        </div>
        <div class="grid">
            <?php for ($i = 0; $i < 50; $i++) { ?>
                <div class="element">
                    <iframe></iframe>
                    <img onclick="createActionMenuBig(this)" data-actions="someFunc();props;Copy Snippet|someFunc();props;Customize" src="/assets/icons/props.svg" >
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="contents" id="luxury">
        <div class="fullFrame" style="background-image: url('/assets/temp/design.png')">
            <h4><font class="ww">WW</font>Design</h4>
        </div>
        <div class="grid">
            <?php for ($i = 0; $i < 50; $i++) { ?>
                <div class="element">
                    <iframe></iframe>
                    <img onclick="createActionMenuBig(this)" data-actions="someFunc();props;Copy Snippet|someFunc();props;Customize" src="/assets/icons/props.svg" >
                </div>
            <?php } ?>
        </div>
    </div>


</body>
</html>