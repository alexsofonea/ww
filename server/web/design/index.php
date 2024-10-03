<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" contents="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>wwDesign Library</title>
    <link rel="icon" href="/assets/logos/wwDesign.png">
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
                        $sql = "SELECT id, `name`, font FROM wwDesignCathegory
                                UNION
                                SELECT id, `name`, '' AS font FROM wwDesignTypes";
                        $stmt = $conn->query($sql);
                        $cathegories = [];
                        $types = [];
                        while ($row = $stmt->fetch()) {
                            if ($row['font'] == "") {
                                $types[$row['id']] = $row;
                            } else {
                                $cathegories[$row['id']] = $row;
                            }
                        }


                        foreach ($cathegories as $row2) {
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
                        foreach ($types as $row2) {
                            echo "<p class='v' value='$row2[id]' onclick='select(this)'><img src='/assets/icons/props.svg'> $row2[name]</p>";
                        }
                    ?>
                </div>
                <?php
                    $uploadText = "Update picture. Drag & drop it here.";
                    $upload = "/setup/cloudapi/upload-design.php";
                    $fileName = hash("md2", uniqid());
                    $otherFunc = "show(data)";
                    include "../setup/cloudapi/index.php";
                ?>
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

                <div class="version" id="versionPreview" data-open="false" data-nr="0">
                    <p onclick="version(this.parentElement);">Preview <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>

                    <p class='v' value='0' onclick='select(this); render();'><img src='/assets/icons/props.svg'> Style 0</p>
                </div>
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
        <script src="/design/admin.js"></script>
    <?php } else { ?>
        <?php
            include "../db.php";
            $sql = "SELECT 
                        wwDesign.id,
                        wwDesignCathegory.id AS cathegoryId,
                        wwDesignCathegory.name AS cathegory,
                        wwDesignCathegory.font AS cathegoryFont,
                        wwDesignCathegory.logo AS cathegoryLogo,
                        wwDesignTypes.id AS `typeId`,
                        wwDesignTypes.name AS `type`,
                        wwDesign.style,
                        wwDesign.html,
                        wwDesign.css,
                        wwDesign.js,
                        wwDesign.aditionalJs,
                        wwDesign.variables
                    FROM wwDesign
                    LEFT JOIN wwDesignCathegory ON wwDesign.category = wwDesignCathegory.id
                    LEFT JOIN wwDesignTypes ON wwDesign.type = wwDesignTypes.id ORDER BY wwDesign.type DESC";
            $stmt = $conn->query($sql);
            $cathegories = [];
            $types = [];
            $designs = [];
            while ($row = $stmt->fetch()) {
                if ($row['typeId'] == NULL) {
                    $designs[$row['cathegoryId']][$row['html']][5][] = [$row['style'], $row['css']];
                } else {
                    $cathegories[$row['cathegoryId']] = [$row['cathegory'], $row['cathegoryFont'], $row['cathegoryLogo']];
                    $types[$row['typeId']] = $row['type'];

                    $designs[$row['cathegoryId']][$row['id']] = [
                        $row['type'],
                        $row['html'],
                        $row['js'],
                        $row['aditionalJs'],
                        json_decode($row['variables']),
                        [[$row['style'], $row['css']]]
                    ];
                    //var_dump($row);
                }
            }

            function convertToCSS($json) {
                $cssArray = json_decode($json, true);
                $cssString = '';
            
                foreach ($cssArray as $selector => $properties) {
                    $cssString .= "$selector {\n";
            
                    foreach ($properties as $property => $value) {
                        $cssString .= "  $property: $value;\n";
                    }
            
                    $cssString .= "}\n";
                }
                return $cssString;
            }
            function replaceVariablesInCSS($css, $variables) {
                $pattern = '/\$(.+?);/';
                $css = preg_replace_callback($pattern, function($matches) use ($variables) {
                    $variableName = ucwords(str_replace('-', ' ', $matches[1]));
                    return $variables->$variableName . ";";
                }, $css);
                return $css;
            }
        ?>

    <div class="menu">
        <h4><font class="ww">WW</font>Design</h4>

        <br /><br />

        <?php
            foreach ($cathegories as $key => $value) {
                echo "<style>@font-face {
                        font-family: font$value[0];
                        src: url('/design/assets/fonts/$value[1]');
                    }</style>";
                echo "<a href='javascript:changecontents(\"$value[0]\")'><font style='font-family: font$value[0]; font-size: 20px;'>$value[0]</font></a>";
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

    <?php foreach ($cathegories as $key => $value) { ?>
        <div class="contents" id="<?php echo $value[0]; ?>">
            <div class="fullFrame" style="background-image: url('/assets/temp/design.png')">
                <h4><font class="ww">WW</font>Design <font style='font-family: font<?php echo $value[0]; ?> !important;'><?php echo $value[0]; ?></font></h4>
            </div>
            <div class="grid">
                <?php foreach ($designs[$key] as $id => $row) { ?>
                    <div class="element" id="element<?php echo $id; ?>" data-html="<?php echo base64_encode($row[1]); ?>" data-variation='<?php echo base64_encode(json_encode($row[5])); ?>' data-var='<?php echo base64_encode(json_encode($row[4])); ?>'>
                        <iframe onload="scaleIframes()" srcdoc='
                            <style>
                                body { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); margin: 0; }
                                <?php echo replaceVariablesInCSS(convertToCSS($row[5][0][1]), $row[4]); ?>
                            </style>
                            <?php echo $row[1]; ?>
                            <script>
                                var element = document.querySelector("wwElement");
                                <?php echo $row[2]; ?>
                            </script>
                        '></iframe>
                        <img onclick="createActionMenuBig(this)" data-actions="editor('<?php echo $id; ?>');props;Copy Snippet|someFunc();props;Customize" src="/assets/icons/props.svg" >
                    </div>
                <?php } ?>
                <?php /*for ($i = 0; $i < 50; $i++) { ?>
                    <div class="element">
                        <iframe></iframe>
                        <img onclick="createActionMenuBig(this)" data-actions="someFunc();props;Copy Snippet|someFunc();props;Customize" src="/assets/icons/props.svg" >
                    </div>
                <?php }*/ ?>
            </div>
        </div>
    <?php } ?>

    <div class="editor" id="editor" style="opacity: 0; pointer-events: none;">
        <iframe srcdoc=''></iframe>
        <div class="options">   
            <div class="version" data-open="false" id="styleVar">
                <p id="versionPlaceholder" onclick="version(this.parentElement);">Style <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>
            </div>

            <p>Properties</p>

            <div class="form op">
            </div>

            <a href="javascript: updateView()">Update</a>

            <p>Code</p>

            <div class="embed"><xmp></xmp></div>
        </div>
    </div>
    <div class="backgroundBlur" style="opacity: 0; pointer-events: none;" onclick="dismissEditor(this)"></div>


    <script src="/design/script.js"></script>

    <script>
        function scaleIframes(iframe) {
            console.log(iframe);
            const iframeDocument = iframe.document;
            const iframeBody = iframeDocument.body;

            // Get the dimensions of the iframe content
            const iframeWidth = iframeBody.scrollWidth;
            const iframeHeight = iframeBody.scrollHeight;

            // Get the size of the iframe itself
            const iframeDisplayWidth = iframe.offsetWidth;
            const iframeDisplayHeight = iframe.offsetHeight;

            // Calculate the scaling factor
            const scaleX = iframeDisplayWidth / iframeWidth;
            const scaleY = iframeDisplayHeight / iframeHeight;

            // Use the smaller scale to fit the content within the iframe
            const scale = Math.min(scaleX, scaleY);

            // Apply the scaling to the content of the iframe
            iframeBody.style.transform = `scale(${scale})`;
            iframeBody.style.transformOrigin = '0 0';
            iframeBody.style.width = `${iframeWidth}px`; // Keep the original width to ensure proper scaling
        }
    </script>

    <?php } ?>


</body>
</html>