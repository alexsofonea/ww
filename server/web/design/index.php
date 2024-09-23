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
                    <p onclick="version(this.parentElement);">Collection <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>

                    <?php
                        include "../db.php";
                        $sql = "SELECT * FROM wwDesignCathegory";
                        $stmt = $conn->query($sql);
                        while ($row2 = $stmt->fetch()) {
                            echo "<style>@font-face {
                                    font-family: $row2[name];
                                    src: url('/design/assets/fonts/$row2[font]');
                                }</style>";
                            echo "<p class='v' value='$row2[id]' onclick='select(this)'><img src='/assets/icons/props.svg'><font style='font-family: $row2[name]; line-height: 1.5;'>$row2[name]</font></p>";
                        }
                    ?>
                </div>
                <div class="version" data-open="false">
                    <p onclick="version(this.parentElement);">Type <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>

                    <?php
                        include "../db.php";
                        $sql = "SELECT * FROM wwDesignTypes";
                        $stmt = $conn->query($sql);
                        while ($row2 = $stmt->fetch()) {
                            echo "<p class='v' value='$row2[id]' onclick='select(this)'><img src='/assets/icons/props.svg'> $row2[name]</p>";
                        }
                    ?>
                </div>
                <hr />
                <div class="form mini">
                    <textarea class="input" id="htmlInput" placeholder="Add HTML" required="" rows="10" onkeyup="render()"></textarea>
                    <span class="input-border"></span>
                </div>
                <hr />
                <div class="form mini">
                    <input class="input" name="styleName" placeholder="Variation Name" value="Default Style">
                    <span class="input-border"></span>
                </div>
                <div class="form mini">
                    <textarea class="input" id="cssInput" placeholder="Add CSS" required="" rows="10" onkeyup="parseCSS(this)"></textarea>
                    <span class="input-border"></span>
                </div>
                <a onclick="addVariation(this)" style="float: right;">Add Variation</a><br /><br /><br />
                <hr />
                <div class="form mini op" name="variables">
                    <div>
                        <input placeholder="Variable Name">
                        <input placeholder="Default Value">
                    </div>
                </div>
                <a onclick="addVariable(this)" style="float: right;">Add Variable</a><br /><br /><br />
                <hr />
                <div class="form mini">
                    <textarea class="input" id="jsInput" placeholder="Add loading JS" required="" rows="10" onkeyup="render()"></textarea>
                    <span class="input-border"></span>
                </div>
                <div class="form mini">
                    <textarea class="input" id="jsInput2" placeholder="Add additional JS" required="" rows="10" onkeyup="render()"></textarea>
                    <span class="input-border"></span>
                </div>
                <a href="javascript: save()" style="float: right;">Submit</a>
                <br /><br /><br /><br />
            </div>

        </div>
        <script>
            var cssCode = Array(), defalutCSS = "";

            function addVariation(el) {
                el.outerHTML = "<div class='form mini'><input class='input' name='styleName' placeholder='Variation Name'><span class='input-border'></span></div><div class='form mini'><textarea class='input' id='cssInput' placeholder='Add CSS' required='' rows='10' onkeyup='parseCSS(this)'></textarea><span class='input-border'></span></div><a onclick='addVariation(this)' style='float: right;'>Add Variation</a>";
            }
            function addVariable(el) {
                el.outerHTML = "<div class='form mini op' name='variables'><div><input placeholder='Variable Name'><input placeholder='Default Value'></div></div><a onclick='addVariable(this)' style='float: right;'>Add Variable</a>";
            }
            function render() {
                var html = document.getElementById("htmlInput").value;
                var css = defalutCSS;
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
            function parseCSS(css) {
                const cssObj = {};
                const rules = css.value.match(/[^{]*\{[^}]*\}/g);

                if (defalutCSS == "") defalutCSS = css.value;

                var parent = css.parentElement;

                rules.forEach(rule => {
                    const [selectors, properties] = rule.split('{');
                    const selector = selectors.trim().toLowerCase();

                    const propertyObj = {};
                    properties
                    .trim()
                    .slice(0, -1)
                    .split(';')
                    .filter(prop => prop.trim())
                    .forEach(prop => {
                        const [key, value] = prop.split(':');
                        propertyObj[key.trim()] = value.trim();
                    });

                    cssObj[selector] = propertyObj;
                });

                if (cssObj.length == 0) return;

                parent.innerHTML = "";
                parent.setAttribute("class", "css");

                Object.keys(cssObj).forEach(selector => {
                    var p = document.createElement("div");
                    p.setAttribute("name", "css");
                    p.setAttribute("class", "form mini op");
                    parent.appendChild(p);
                    const properties = cssObj[selector];
                    if (selector != "")
                        p.innerHTML += `<div><input type='text' value='${selector}'></div>`;
                    Object.keys(properties).forEach(property => {
                        const value = properties[property];
                        if (value != "")
                            p.innerHTML += `<div><input type='text' value='${property}'><input type='text' value='${value}'></div>`;
                    });
                });

                cssCode.push(cssObj);
            }

            function reParseCSS() {
                var css = [];
                document.querySelectorAll('.css').forEach(ele => {
                    console.log(ele);
                    var cssObj = {};
                    ele.querySelectorAll('[name="css"]').forEach(el => {
                        const inputs = el.getElementsByTagName("input");
                        var selector = inputs[0].value;
                        var data = {};
                        for (var i = 1; i < inputs.length - 1; i += 2) {
                            var property = inputs[i].value;
                            var value = inputs[i + 1].value;
                            data[property] = value;
                        }
                        cssObj[selector] = data;
                    });
                    css.push(cssObj);
                });
                return css;
            }

            function getVariables() {
                var variables = Array();
                var vars = document.getElementsByName("variables");
                for (var i = 0; i < vars.length; i++) {
                    var children = vars[i].getElementsByTagName("input");
                    variables.push({
                        [children[0].value]: children[1].value
                    });
                }
                return variables;
            }

            function save() {
                var names = Array();
                document.getElementsByName("styleName").forEach(el => {
                    names.push(el.value);
                });
                var data = {
                    'category': document.getElementsByClassName("version")[0].getAttribute("value") ?? "",
                    'type': document.getElementsByClassName("version")[1].getAttribute("value") ?? "",
                    'name': names,
                    'css': reParseCSS(),
                    'html': document.getElementById("htmlInput").value,
                    'variables': getVariables(),
                    'js': document.getElementById("jsInput").value,
                    'additionalJS': document.getElementById("jsInput2").value
                };

                //if (!data.collection || !data.type || !data.name || !data.css.length || !data.variables.length || !data.js || !data.additionalJS)
                    //return;

                console.log(data);

                $.ajax({
                    type: "POST",
                    url: "/design/save.php",
                    data: data,
                    success: function (response) {
                        console.log(response);
                    }
                });
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
        <iframe srcdoc='<style>
                        wwDesign-button.natural.style-1{
                            height: fit-content;
                            width: fit-content;
                            background-color: #8BC34A;
                            padding: 12px 24px;
                            font-size: 18px;
                            border-radius: 6px;
                            user-select: none;
                            color: #33691E;
                            font-weight: 500;
                            transition: all 200ms ease-out;

                            position: absolute;
                            top: 50%;
                            left: 50%;
                            transform: translate(-50%, -50%);
                        }

                        wwDesign-button.natural.style-1:hover{
                            transform: translate(-50%, -50%) scale(1.05);
                            background-color: #7CB342;
                        }
                    </style>

                    <wwDesign-button class="natural style-1">Follow Us</wwDesign-button>'></iframe>
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

            <p>Properties</p>

            <div class="form op">
                <div>
                    <input value="Text Color" disabled>
                    <input placeholder="#33691E">
                </div>
                <div>
                    <input value="Background Color" disabled>
                    <input placeholder="#8BC34A">
                </div>
                <div>
                    <input value="Hover Effect Color" disabled>
                    <input placeholder="#7CB342">
                </div>
                <div>
                    <input value="Border Radius" disabled>
                    <input placeholder="20px">
                </div>
            </div>

            <p>Code</p>

            <div class="embed"><xmp><wwDesign-button class="natural style-1">Follow Us</wwDesign-button></xmp></div>
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
        .editor .embed {
            overflow-X: scroll;
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
            width: calc(100% - 70vh - 30px);
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