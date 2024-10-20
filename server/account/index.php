<?php include "var.php"; ?>
<?php
    if (isset($_POST['action'])) {
        include "../db.php";
        switch($_POST['action']) {
            case "delete":
                if ($_POST['id'] != $_COOKIE['session']) {
                    $sql = "DELETE FROM session
                    WHERE id = '" . $_POST['id'] . "' AND accountId IN (
                        SELECT accountId
                        FROM session
                        WHERE id = '" . $_COOKIE['session'] . "'
                    );";
                    $stmt = $conn->query($sql);
                    echo "done";
                } else {
                    echo "error";
                }
                die();
            case "deleteAll":
                $sql = "DELETE FROM session
                WHERE id <> '" . $_COOKIE['session'] . "' AND accountId IN (
                    SELECT accountId
                    FROM session
                    WHERE id = '" . $_COOKIE['session'] . "'
                );";
                $stmt = $conn->query($sql);
                echo "done";
                die();
            case "update":
                $profilePic = false;
                if (isset($_FILES['image']) && $_FILES['image']['name'] != "") {
                    $uploadDir = '../cloud/';
                    $randomFileName = hash("md2", uniqid()) . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $uploadFilePath = $uploadDir . basename($randomFileName);
                    $imageType = exif_imagetype($_FILES['image']['tmp_name']);
                    $image = null;
                    switch ($imageType) {
                        case IMAGETYPE_JPEG:
                            $image = imagecreatefromjpeg($_FILES['image']['tmp_name']);
                            break;
                        case IMAGETYPE_PNG:
                            $image = imagecreatefrompng($_FILES['image']['tmp_name']);
                            break;
                        default:
                            echo "image_type_error";
                            exit;
                    }
                
                    if ($image) {
                        $width = imagesx($image);
                        $height = imagesy($image);
                        $minDim = min($width, $height);
                        $srcX = ($width - $minDim) / 2;
                        $srcY = ($height - $minDim) / 2;
                        $newImage = imagecreatetruecolor(200, 200);
                        imagecopyresampled($newImage, $image, 0, 0, $srcX, $srcY, 200, 200, $minDim, $minDim);
                        switch ($imageType) {
                            case IMAGETYPE_JPEG:
                                imagejpeg($newImage, $uploadFilePath);
                                break;
                            case IMAGETYPE_PNG:
                                imagepng($newImage, $uploadFilePath);
                                break;
                        }
                        imagedestroy($image);
                        imagedestroy($newImage);
                        $profilePic = $randomFileName;
                    } else {
                        echo "image_error";
                    }
                } else if (isset($_POST['noPic']) && $_POST['noPic'] == "true")
                    $profilePic = sprintf('%06X', mt_rand(0, 0xFFFFFF));
                $name = $_POST['name'];
                $mail = $_POST['mail'];
                $session = $_COOKIE['session'];
                if ($profilePic != false)
                    $profilePic2 = "picture = '$profilePic', ";
                else
                    $profilePic2 = "";
                $sql = "UPDATE accounts
                    SET 
                        name = '$name',
                        $profilePic2
                        confirm = CASE
                                    WHEN mail != '$mail' THEN 0
                                    ELSE confirm
                                END,
                        mail = '$mail'
                    WHERE id = (SELECT accountId from `session` WHERE id = '$session');";
                if ($profilePic != "")
                    $sql .= "SELECT picture
                            FROM accounts
                            WHERE id = (SELECT accountId FROM `session` WHERE id = '$session');";
                $stmt = $conn->query($sql);
                //echo $sql;
                if ($profilePic2 != "" && $row = $stmt->fetch()) {
                    unlink("../cloud/" . $row['picture']);
                    echo $profilePic;
                } else if ($profilePic2 != "")
                    echo $profilePic;
                die();
        }
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="viewport-fit=cover, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css?cashe=<?php echo time(); ?>">
    <title><?php echo $app_name; ?> Account</title>
    <script src="jquery.js"></script>
    <script src="/script.js"></script>
</head>


<?php
    include "../../db.php";
    include "accountId.php";
?>

<style>
:root {
    --color1: #<?php echo $color; ?>;
    --color2: #<?php echo $color2; ?>;
}
</style>

<body onload="loadElements(); <?php if (isset($_GET['slide'])) { echo "slide(" . $_GET['slide'] . ");"; } ?>">

<table id="app" onclick="location.assign('<?php echo $url; ?>');hapticFeedback();">
    <tr>
        <td><img class="logo" src="<?php echo $logo; ?>"></td>
        <td><h1><?php echo $app_name; ?></h1></td>
    </tr>
</table>

<div class="actionMenu" style="left: 50%; transform: translate(-50%, -50%);">
    <div class="action" onclick="slide(1);hapticFeedback();">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><defs></defs><g id="a"/><g id="b"/><g id="c"/><g id="d"/><g id="e"/><g id="f"/><g id="g"/><g id="h"/><g id="i"/><g id="j"/><g id="k"/><g id="l"/><g id="m"/><g id="n"/><g id="o"/><g id="p"/><g id="q"/><g id="r"><g><path class="v" d="M11.5,12.75c2.34,0,4.25-1.91,4.25-4.25s-1.91-4.25-4.25-4.25-4.25,1.91-4.25,4.25,1.91,4.25,4.25,4.25Zm0-7c1.52,0,2.75,1.23,2.75,2.75s-1.23,2.75-2.75,2.75-2.75-1.23-2.75-2.75,1.23-2.75,2.75-2.75Z"/><path class="v" d="M17.92,16.06c-1.34-.82-3.54-1.81-6.42-1.81s-5.08,.98-6.43,1.81c-.52,.32-.82,.86-.82,1.46v3.49c0,.96,.82,1.75,1.83,1.75h10.83c1.01,0,1.83-.79,1.83-1.75v-3.48c0-.6-.31-1.14-.83-1.46Zm-.67,4.94c0,.14-.15,.25-.33,.25H6.08c-.18,0-.33-.11-.33-.25v-3.49c0-.07,.04-.14,.11-.18,1.18-.72,3.11-1.58,5.64-1.58s4.46,.86,5.64,1.58c.07,.04,.11,.11,.11,.19v3.48Z"/><path class="v" d="M19,9.25c-.41,0-.75,.34-.75,.75v1c0,.69-.56,1.25-1.25,1.25h-1c-.41,0-.75,.34-.75,.75s.34,.75,.75,.75h1c1.52,0,2.75-1.23,2.75-2.75v-1c0-.41-.34-.75-.75-.75Z"/><path class="v" d="M17,2.25h-1c-.41,0-.75,.34-.75,.75s.34,.75,.75,.75h1c.69,0,1.25,.56,1.25,1.25v1c0,.41,.34,.75,.75,.75s.75-.34,.75-.75v-1c0-1.52-1.23-2.75-2.75-2.75Z"/><path class="v" d="M4,6.75c.41,0,.75-.34,.75-.75v-1c0-.69,.56-1.25,1.25-1.25h1c.41,0,.75-.34,.75-.75s-.34-.75-.75-.75h-1c-1.52,0-2.75,1.23-2.75,2.75v1c0,.41,.34,.75,.75,.75Z"/><path class="v" d="M7,13.75c.41,0,.75-.34,.75-.75s-.34-.75-.75-.75h-1c-.69,0-1.25-.56-1.25-1.25v-1c0-.41-.34-.75-.75-.75s-.75,.34-.75,.75v1c0,1.52,1.23,2.75,2.75,2.75h1Z"/></g></g><g id="s"/><g id="t"/><g id="u"/></svg>
        <p>Basic Info</p>
    </div>
    <div class="action" onclick="slide(2);hapticFeedback();">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><g id="a"/><g id="b"/><g id="c"/><g id="d"/><g id="e"/><g id="f"/><g id="g"/><g id="h"/><g id="i"/><g id="j"/><g id="k"/><g id="l"/><g id="m"/><g id="n"/><g id="o"/><g id="p"/><g id="q"/><g id="r"><g><path d="M20,8.25h-5c-.96,0-1.75,.79-1.75,1.75v3.25h-2.84c-.07,0-.13-.03-.18-.07l-.41-.41c-.33-.33-.78-.51-1.24-.51h-3.84V4c0-.14,.11-.25,.25-.25h14c.14,0,.25,.11,.25,.25v2c0,.41,.34,.75,.75,.75s.75-.34,.75-.75v-2c0-.96-.79-1.75-1.75-1.75H5c-.96,0-1.75,.79-1.75,1.75V12.25h-.25c-.41,0-.75,.34-.75,.75v2c0,1.52,1.23,2.75,2.75,2.75H13.25v1.25c0,.96,.79,1.75,1.75,1.75h5c.96,0,1.75-.79,1.75-1.75V10c0-.96-.79-1.75-1.75-1.75ZM5,16.25c-.69,0-1.25-.56-1.25-1.25v-1.25h4.84c.07,0,.13,.03,.18,.07l.41,.41c.33,.33,.78,.51,1.24,.51h2.84v1.5H5Zm15.25,2.75c0,.14-.11,.25-.25,.25h-5c-.14,0-.25-.11-.25-.25V10c0-.14,.11-.25,.25-.25h5c.14,0,.25,.11,.25,.25v9Z"/><path d="M18,16.25h-1c-.41,0-.75,.34-.75,.75s.34,.75,.75,.75h1c.41,0,.75-.34,.75-.75s-.34-.75-.75-.75Z"/></g></g><g id="s"/><g id="t"/><g id="u"/></svg>
        <p>Device sessions</p>
    </div>
    <hr />
    <div class="action" onclick="confirm('Are you sure you want to sign out?', function () { location.assign('logout'); hapticFeedback(); });">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><defs></defs><g id="a"/><g id="b"><g><path class="v" d="M10,11.75c2.62,0,4.75-2.13,4.75-4.75s-2.13-4.75-4.75-4.75-4.75,2.13-4.75,4.75,2.13,4.75,4.75,4.75Zm0-8c1.79,0,3.25,1.46,3.25,3.25s-1.46,3.25-3.25,3.25-3.25-1.46-3.25-3.25,1.46-3.25,3.25-3.25Z"/><path class="v" d="M16.87,15.05c-2.64-1.49-5.19-1.8-6.87-1.8-3.02,0-5.4,.98-6.87,1.8-.54,.31-.88,.89-.88,1.52v3.43c0,.96,.79,1.75,1.75,1.75h12c.96,0,1.75-.79,1.75-1.75v-3.42c0-.64-.34-1.22-.88-1.53Zm-.62,4.95c0,.14-.11,.25-.25,.25H4c-.14,0-.25-.11-.25-.25v-3.43c0-.09,.04-.17,.12-.21,1.31-.73,3.43-1.61,6.13-1.61,1.49,0,3.77,.28,6.13,1.61,.07,.04,.12,.13,.12,.22v3.42Z"/><path class="v" d="M16.66,4.56c-.29,.29-.29,.77,0,1.06,.79,.79,.79,2.07,0,2.85-.29,.29-.29,.77,0,1.06,.15,.15,.34,.22,.53,.22s.38-.07,.53-.22c1.37-1.37,1.37-3.6,0-4.97-.29-.29-.77-.29-1.06,0Z"/><path class="v" d="M20.31,3.6c-.29-.29-.77-.29-1.06,0s-.29,.77,0,1.06c1.33,1.33,1.33,3.48,0,4.81-.29,.29-.29,.77,0,1.06,.15,.15,.34,.22,.53,.22s.38-.07,.53-.22c1.91-1.91,1.91-5.02,0-6.93Z"/></g></g><g id="c"/><g id="d"/><g id="e"/><g id="f"/><g id="g"/><g id="h"/><g id="i"/><g id="j"/><g id="k"/><g id="l"/><g id="m"/><g id="n"/><g id="o"/><g id="p"/><g id="q"/><g id="r"/><g id="s"/><g id="t"/><g id="u"/></svg>
        <p>Log out</p>
    </div>
</div>
    
<div class="widget selected">
    <h1 style="text-align: center;">
        <script>
            const now = new Date();
            const currentHour = now.getHours();

            let greeting = "";

            if (currentHour >= 4 && currentHour < 11) {
                greeting = "Good morning";
            } else if (currentHour >= 11 && currentHour < 15) {
                greeting = "Hello";
            } else if (currentHour >= 15 && currentHour < 19) {
                greeting = "Good afternoon";
            } else if (currentHour >= 19 && currentHour < 21) {
                greeting = "Good evening";
            } else if (currentHour >= 21 && currentHour < 24) {
                greeting = "Good night";
            } else if (currentHour >= 0 && currentHour < 4) {
                greeting = "Good night";
            }
            
            document.write(greeting + ", <?php echo $name; ?>");
        </script>
    </h1>
</div>

<div id="menuBg" onclick="closeMenus()" style="display: none;" data-open="false"></div>

<div class="widget">
    <h1>Basic info</h1>

    <form action="index.php" method="post" id="accontInfo">
        <input type="hidden" name="action" value="update">
        <div class="user-box">
            <div class="input">
                <input type='text' name="name" id="name" value="<?php echo $name; ?>" autocomplete="no" required placeholder = " "/>
                <p>Name</p>
            </div>
        </div>

        <div class="user-box">
            <div class="input">
                <input type='text' name="mail" id="mail" value="<?php echo $mail; ?>" autocomplete="no" required placeholder = " "/>
                <p>Mail</p>
            </div>
        </div>

        <br />
        <?php if (str_contains($picture, ".")) { ?>
            <p id="uploadDiv" onclick="document.getElementById('fileInput').click();"><input type='file' name="image" id="fileInput" style="display: none;"/><img src="<?php echo $picture; ?>"></p>
            <p style="cursor: pointer; text-align: center;" id="removePic" onclick="removePicture()">Remove picture.</p>
        <?php } else { ?>
            <p id="uploadDiv" onclick="document.getElementById('fileInput').click();"><input type='file' name="image" id="fileInput" style="display: none;"/><text>Add profile picture.</text></p>
            <p style="cursor: pointer; display: none; text-align: center;" id="removePic" onclick="removePicture()">Remove picture.</p>
        <?php } ?>
        <button type="submit" class="big_action" id="submitButton">Update info</button>

        <div class="loading-anim" id="loading-anim"><svg id="loading1" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg><svg id="loading2" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2 12C2 6.47715 6.47715 2 12 2V5C8.13401 5 5 8.13401 5 12H2Z"/></svg></div>

        <!--<br /><br /><br /><br />
        <center><a href="javascript:accountDeletion()" style="filter: brightness(0.7);">Request Account Deletion</a></center>-->
    </form>
</div>

<div class="popUp" id="basicInfoUpdate">
    <h4>Your info was updated.</h4>
</div>

<div class="widget">
    <h1>Device Sessions</h1>

    <div class="user-box" style="height: fit-content;">
    <?php
        $sql = "SELECT * FROM `session` WHERE accountId = '" . $myId . "'";
        $stmt = $conn->query($sql);
        $sessions = array();
        $wigets = 5;
        while ($row = $stmt->fetch()) {
            $sessions[] = array($row['device'], $row['lon'], $row['lat'], date("H:m d.m.Y", $row['date']), $row['id']);
            $th = $row['id'] == $_COOKIE['session'] ? " (this device)" : "";
            echo "<a id='session_" . $row['id'] . "' href='javascript: slide(" . ($wigets++) . ");'>" . $row['device'] . $th . "</a>";
        }
    ?>
    </div>

    <button class="big_action" style="background-color: var(--red);" onclick="deleteSessions(this, '<?php echo $_COOKIE['session']; ?>');hapticFeedback();">Log all devices out</button>
</div>

<?php
    foreach ($sessions as $s) {
        ?>

        <div class="widget">
            <h1><?php echo $s[0]; ?></h1>
            <p style="transform: translateY(-50px)"><?php if ($s[4] == $_COOKIE['session']) { ?><b>This device </b><br /><?php } ?>Logged in on <b><?php echo $s[3]; ?></b></p>

            <iframe
                width="100%"
                height="350"
                style="border: none; border-radius: 10px; margin:auto;"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                src="https://maps.google.com/maps?q=<?php echo $s[2]; ?>,<?php echo $s[1]; ?>&t=&z=10&ie=UTF8&iwloc=&output=embed">
                </iframe>

            <?php if ($s[4] != $_COOKIE['session']) { ?>
                <button class="big_action" style="background-color: var(--red);" onclick="deleteSession('<?php echo $s[4]; ?>')">Log this device out</button>
            <?php } ?>
        </div>

        <?php
    }
?>



<script src="script.js"></script>
<script>
function accountDeletion() {
    confirm("Are you sure you want to delete your WW Account?", function () {
        prompt("Confirm by writing your name <b><?php echo $name; ?></b>.", function () {
            alert("Request sent.");
        }, "<?php echo $name; ?>");
    });
}

document.getElementById('fileInput').addEventListener('change', function(event) {
    submitFileInput(event);
});
</script>
    
</body>


</html>