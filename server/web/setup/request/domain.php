<?php

    //$verify = hash("md2", uniqid());

    $verify = "05236f9f287db8171165ec4e47028f89";
    
    include "../../db.php";
    $sql = "UPDATE `projects` SET `domain` = '$_POST[domain]' WHERE `publicId` = '$_POST[id]' AND `owner` = (SELECT `accountid` FROM `session` WHERE `id`='$_COOKIE[session]')";
    $stmt = $conn->query($sql);

    echo "ww_" . $verify;
?>