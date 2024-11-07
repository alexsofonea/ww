<?php

    include "../../db.php";
    $sql = "UPDATE `projects` SET `picture`='$_POST[picture]' WHERE `publicId` = '$_POST[id]' AND `owner` = (SELECT `accountid` FROM `session` WHERE `id`='$_COOKIE[session]')";
    $stmt = $conn->query($sql);
    
?>