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

    <?php if (isset($_GET['id']) && $_GET['id'] == "admin") { ?>
        <div class="mainContainer">
            <div class="preview">
                <img src="/assets/logos/wwDesign.png">
            </div>
            <div class="options">
                <br /><br /><br /><br />
                <div class="form mini">
                    <select class="input" style="appearance: none; -webkit-appearance: none; -moz-appearance: none; background-color: transparent; outline: none;">
                        <option selected disabled hidden>Cathegory</option>
                        <option>Simple</option>
                        <option>Classic</option>
                        <option>Playful</option>
                        <option>Luxury</option>
                    </select>
                    <span class="input-border"></span>
                </div>
                <div class="form mini">
                    <input class="input" placeholder="Type">
                    <span class="input-border"></span>
                </div>
                <div class="form mini">
                    <textarea class="input" id="htmlInput" placeholder="Add HTML" required="" rows="10" onkeyup="render()"></textarea>
                    <span class="input-border"></span>
                </div>
                <div class="form mini">
                    <textarea class="input" id="cssInput" placeholder="Add CSS" required="" rows="10" onkeyup="render()"></textarea>
                    <span class="input-border"></span>
                </div>
            </div>

        </div>

        <style>
            .form pre {
                display: none;
            }
            .mainContainer {
                display: flex;
                flex-direction: row;
            }
            .preview {
                height: calc(100vh - 20px);
                padding: 10px;
                aspect-ratio: 1;
                max-width: calc(70% - 10px);
                background-color: #ffffff;
                position: relative;
            }
            .preview iframe {
                width: 100%;
                height: 100%;
                border: none;
            }
            .preview img {
                width: 50%;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }
            .options {
                width: calc(100vw - 100vh - 20px);
                padding: 10px;
                min-width: calc(30% - 20px);
                height: calc(100vh - 20px);
                overflow: scroll;
            }

            iframe body {
                margin: 0;
            }
        </style>
        <script>
            function render() {
                var html = document.getElementById("htmlInput").value;
                var css = document.getElementById("cssInput").value;
                if (html == "" || css == "") return;
                var iframe = document.createElement("iframe");
                document.querySelector(".preview").innerHTML = "";
                document.querySelector(".preview").appendChild(iframe);

                var doc = iframe.contentWindow.document;
                doc.open();
                doc.write(html + "<style>" + css + "</style>");
                doc.close();

                var el = doc.body.firstChild;
                el.style.position = "absolute";
                el.style.top = "50%";
                el.style.left = "50%";
                el.style.transform = "translate(-50%, -50%)";
            }
        </script>
    <?php } else { ?>

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

    <?php } ?>


</body>
</html>