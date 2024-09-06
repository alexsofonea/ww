<?php

    include "../../db.php";
    $description = base64_encode($_POST['description']);
    $sql = "UPDATE `projects` SET `description`='$description' WHERE `publicId` = '$_POST[id]' AND `owner` = (SELECT `accountid` FROM `session` WHERE `id`='$_COOKIE[session]')";
    $stmt = $conn->query($sql);
    
    echo $sql;
?>