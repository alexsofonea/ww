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


<body>
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
                <h4>Promotional Materials Generator</h4>
            </div>
        </div>

        <video id="player" class="studio" loop muted autoplay playsinline></video>

        <script src="/project/admin/branding/script.js?cache=<?php echo time(); ?>"></script>
        <script>
            async function returnResult() {
                showLoading();
                for (const i of document.querySelectorAll('img.studio'))
                    i.remove();
                const inputText = document.getElementById('input').value;
                const response = await fetch(`https://ww.alexsofonea.com/project/admin/lib/backupImage2.php?gen=${encodeURIComponent(inputText)}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Access-Control-Allow-Origin': '*'
                    }
                });
                const imageUrl = await response.text();
                hideLoading();
                const imgElement = document.createElement('img');
                console.log(imageUrl);
                imgElement.src = "data:image/png;base64," + imageUrl;
                imgElement.className = 'studio';
                player.after(imgElement);
            }
        </script>

        <div class="input">
            <input id="input" type="text" placeholder="Describe your promotion.">
            <span class="input-border"></span>

            <div class="loader" style="display: none;">
                <svg viewBox="0 0 80 80">
                    <rect height="64" width="64" y="8" x="8"></rect>
                </svg>
            </div>
        </div>
        <p class="subInput">Press Enter to generate the logo. WW will use the branding settings specified in the SEO for more accurate generation. Generations can take up to a minute.</p>

        <script>
            document.querySelector('#input').addEventListener('keyup', function (e) {
                if (e.key === 'Enter') {
                    returnResult();
                }
            });
        </script>



    </div>
</body>
</html>