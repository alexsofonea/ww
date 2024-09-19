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
                <div class="version" data-open="false">
                    <p id="versionPlaceholder" onclick="version();">Style <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>

                    <?php
                        include "../db.php";
                        $sql = "SELECT * FROM wwDesignCathegory";
                        $stmt = $conn->query($sql);
                        while ($row2 = $stmt->fetch()) {
                            echo "<style>@font-face {
                                    font-family: $row2[name];
                                    src: url('/design/assets/fonts/$row2[font]');
                                }</style>";
                            echo "<p class='v' onclick='' style='font-family: $row2[name]; line-height: 1.5;'><img src='/assets/icons/props.svg'> $row2[name]</p>";
                        }
                    ?>
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
                <div class="form mini">
                    <textarea class="input" id="jsInput" placeholder="Add loading JS" required="" rows="10" onkeyup="render()"></textarea>
                    <span class="input-border"></span>
                </div>
                <div class="form mini">
                    <textarea class="input" id="jsInput" placeholder="Add additional JS" required="" rows="10" onkeyup="render()"></textarea>
                    <span class="input-border"></span>
                </div>
                <a href="" style="float: right;">Submit</a>
                <br /><br /><br /><br />
            </div>

        </div>
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

        <br /><br />

        <?php
            include "../db.php";
            $sql = "SELECT * FROM wwDesignCathegory";
            $stmt = $conn->query($sql);
            while ($row2 = $stmt->fetch()) {
                echo "<style>@font-face {
                        font-family: $row2[name];
                        src: url('/design/assets/fonts/$row2[font]');
                    }</style>";
                echo "<a href='javascript:changecontents(\"$row2[name]\")'><font style='font-family: $row2[name]; font-size: 20px;'>$row2[name]</font></a>";
            }
        ?>
    </div>

    <div class="search">
        <table>
            <tr>
                <td><img src="/assets/icons/filter.svg"></td>
                <td><input type="text" placeholder="Search"></td>
                <td><img src="/assets/icons/search.svg"></td>
            </tr>
        </table>
    </div>

    <style>
        .search table {
            width: 100%;
        }
        .search img {
            width: 20px;
            aspect-ratio: 1;
            object-fit: contain;
            transform: translateY(2px);
        }
        .search input {
            width: 100%;
            padding: 0px 5px;
            border: none;
            outline: none;
            background-color: transparent;
            font-size: 18px;
        }
        .search tr td:first-child {
            width: 30px;
        }
        .search tr td:last-child {
            width: 30px;
            text-align: right;
        }
    </style>

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

    <div class="editor">
        <iframe></iframe>
        <div class="options">   
            <div class="version" data-open="false">
                <p id="versionPlaceholder" onclick="version();">Style <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>

                <p class="v" onclick=""><img src="/assets/icons/props.svg"> Something</p>
                <p class="v" onclick=""><img src="/assets/icons/props.svg"> Something</p>
                <p class="v" onclick=""><img src="/assets/icons/props.svg"> Something</p>
                <p class="v" onclick=""><img src="/assets/icons/props.svg"> Something</p>
                <p class="v" onclick=""><img src="/assets/icons/props.svg"> Something</p>
                <p class="v" onclick=""><img src="/assets/icons/props.svg"> Something</p>
            </div>
        </div>
    </div>
    <div class="backgroundBlur"></div>

    <style>
        .editor {
            position: fixed;
            top: 50%;
            right: 50%;
            transform: translate(50%, -50%);
            width: 70%;
            height: 70%;
            background-color: #f0f0f0;
            z-index: 100;
            border-radius: 40px;
            padding: 20px;
        }
        .editor iframe {
            height: 100%;
            aspect-ratio: 1;
            border: none;
            background-color: #FFF;
            border-radius: 20px;
        }
        .backgroundBlur {
            position: fixed;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            z-index: 99;
        }
        .editor .options {
            width: calc(100% - 70vh - 20px);
            height: 100%;
            overflow: scroll;
            float: right;
            min-width: inherit !important;
        }
        @supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
            .backgroundBlur {
                -webkit-backdrop-filter: blur(10px);
                backdrop-filter: blur(10px);
                background-color: rgba(255, 255, 255, 0.3);
            }
        }
    </style>

    <?php } ?>


</body>
</html>