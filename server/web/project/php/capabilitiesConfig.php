<?php

    include "../../db.php";

    if ($_POST['check'] == 'true') {
        $sql = "INSERT INTO `capabilities`(`id`, `capId`) VALUES ((SELECT id FROM projects WHERE publicId = '$_POST[projectPublicId]' AND ownerName = '$_POST[owner]' AND owner = (SELECT accountId from `session` WHERE id = '$_COOKIE[session]')), (SELECT `id` FROM `apps` WHERE url = '$_POST[capability]'))";
    } else {
        $sql = "DELETE FROM `capabilities` WHERE  id = (SELECT id FROM projects WHERE publicId = '$_POST[projectPublicId]' AND ownerName = '$_POST[owner]' AND owner = (SELECT accountId from `session` WHERE id = '$_COOKIE[session]')) AND capId = (SELECT `id` FROM `apps` WHERE url = '$_POST[capability]')";
    }

    
    $stmt = $conn->query($sql);

    echo $sql;

?>