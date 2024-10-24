<?php
include "../../db.php";
$sql = "DELETE FROM `wwConnect`
WHERE `forId` = '$_GET[id]'
LIMIT 1;";
$result = $conn->query($sql);
?>