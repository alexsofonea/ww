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
        include "../../db.php";
        include "../../account/accountId.php";
    ?>

        <div class="mainContainer">
            <div class="preview" style="padding: 0; height: 100vh;">
                <iframe src="https://beta.alexsofonea.com/client/aleartizan/"></iframe>
            </div>
            <div class="options">
                <br /><br /><br /><br />  
                <div class="version" data-open="false">
                    <p onclick="version(this.parentElement);">Collection <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><path d="M201.4 342.6c12.5 12.5 32.8 12.5 45.3 0l160-160c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L224 274.7 86.6 137.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l160 160z"/></svg></p>

                    <?php
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
                <?php
                    $uploadText = "Update picture. Drag & drop it here.";
                    $upload = "/setup/cloudapi/upload-design.php";
                    $fileName = hash("md2", uniqid());
                    $otherFunc = "show(data)";
                    include "../../setup/cloudapi/index.php";
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

                <div class="form mini op" name="variables">
                    <div>
                        <input value="Variable Name" disabled>
                        <input placeholder="Default Value">
                    </div>
                    <div>
                        <input value="Variable Name" disabled>
                        <input placeholder="Default Value">
                    </div>
                    <div>
                        <input value="Variable Name" disabled>
                        <input placeholder="Default Value">
                    </div>
                    <div>
                        <input value="Variable Name" disabled>
                        <input placeholder="Default Value">
                    </div>
                </div>
                <hr />
                <a href="javascript: save()" style="float: right;">Save</a>
                <br /><br /><br /><br />
            </div>

        </div>
        <script src="/design/admin.js"></script>

</body>
</html>