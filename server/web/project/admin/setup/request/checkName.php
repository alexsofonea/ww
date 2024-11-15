<?php
    include "../../db.php";
    $sql = "SELECT COUNT(*) 
            FROM projects 
            WHERE publicId = '$_POST[name]' AND owner = (SELECT `accountid` FROM `session` WHERE `id`='$_COOKIE[session]');";
    $stmt = $conn->query($sql);
    if ($row = $stmt->fetch()) {
        echo $row[0];
    } else {
        echo "error";
    }
?>