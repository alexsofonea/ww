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
                <h4>Logo Generator</h4>
            </div>
        </div>

        <style>
            .studio {
                position: relative;
                width: 100%;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            .input {
                z-index: 999;
                position: absolute;
                bottom: 100px;
                left: 50%;
                transform: translate(-50%, 0%);
                width: 80%;
                border-radius: 50px;
                padding: 10px 20px;
                border: 1px solid #e9ecef;
            }
            .input input {
                border: none;
                background: none;
                width: 100%;
                font-size: 18px;
                outline: none;
            }
            .input input::placeholder {
                color: #000;
            }
            @supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
                .input {
                    -webkit-backdrop-filter: blur(10px);
                    backdrop-filter: blur(10px);
                }
            }
        </style>

        <video id="player" class="studio" loop muted autoplay playsinline></video>

        <script>
            function supportsHEVCAlpha() {
                const navigator = window.navigator;
                const ua = navigator.userAgent.toLowerCase()
                const hasMediaCapabilities = !!(navigator.mediaCapabilities && navigator.mediaCapabilities.decodingInfo)
                const isSafari = ((ua.indexOf('safari') != -1) && (!(ua.indexOf('chrome')!= -1) && (ua.indexOf('version/')!= -1)))
                return isSafari && hasMediaCapabilities
            }

            const player = document.getElementById('player');
            player.src = supportsHEVCAlpha() ? 'ai.mov' : 'ai.webm';
        </script>

        <div class="input">
            <input type="text" placeholder="Describe your logo. WW will use the branding settings specified in the SEO.">
            <span class="input-border"></span>
        </div>

    </div>
</body>
</html>