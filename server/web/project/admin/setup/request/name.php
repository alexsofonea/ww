<?php
    function generateProjectId($name) {
        $id = strtolower($name);
        $id = preg_replace('/[^a-z0-9\s]/', '', $id);
        $id = trim($id);
        $id = preg_replace('/\s+/', '-', $id);

        return $id;
    }

    $id = hash("md2", uniqid());
    $pId = generateProjectId($_POST['name']);
    $pId2 = generateProjectId($_POST['myname']);
    include "../../db.php";
    $sql = "INSERT INTO `projects`(`id`, `publicId`, `ownerName`, `owner`, `name`, `description`, `tags`, `picture`, `domain`) VALUES ('$id', '$pId', '$pId2', (SELECT `accountid` FROM `session` WHERE `id`='$_COOKIE[session]'), '$_POST[name]', '', '', '', '')";
    $stmt = $conn->query($sql);
?>