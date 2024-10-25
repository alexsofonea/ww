<?php

include "../../../db.php";

if (isset($_GET['param'])) {
    $sql = "SELECT `project`, `server` FROM `wwLiveSocketServer` WHERE id = '$_GET[param]' and project = (SELECT projectId FROM `keys` WHERE id = '$_GET[id]');";
    $result = $conn->query($sql);
    if ($row = $result->fetch())
        echo json_encode(array("server" => $row['server'], "id" => $_GET['param'], "userId" => uniqid()));
    else {
        $id = $_GET['param'];
        $sql = "SELECT `server` FROM `wwConnect` WHERE `type` = 'socket' GROUP BY `server` ORDER BY COUNT(*) ASC LIMIT 1";
        $result = $conn->query($sql);
        if ($row = $result->fetch()) {
            $uniqid = uniqid();
            $sql = "INSERT INTO `wwLiveSocketServer`(`id`, `project`, `server`) VALUES ('$id', '$_GET[id]', '$row[server]'); INSERT INTO `wwConnect`(`id`, `type`, `server`, `project`, `forId`) VALUES ('$uniqid', 'socket', 'nameserver', (SELECT projectId FROM `keys` WHERE id = '$_GET[id]'), '$id');";
            $result = $conn->query($sql);
            echo json_encode(array("server" => $row['server'], "id" => $id, "userId" => uniqid()));
        } else {
            $uniqid = uniqid();
            $sql = "INSERT INTO `wwLiveSocketServer`(`id`, `project`, `server`) VALUES ('$id', '$_GET[id]', '$row[server]'); INSERT INTO `wwConnect`(`id`, `type`, `server`, `project`, `forId`) VALUES ('$uniqid', 'socket', 'nameserver', (SELECT projectId FROM `keys` WHERE id = '$_GET[id]'), '$id');";
            $result = $conn->query($sql);
            echo json_encode(array("server" => "nameserver", "id" => $id, "userId" => uniqid()));
        }
    }
} else {
    $id = hash("md5", uniqid());
    $sql = "SELECT `server` FROM `wwConnect` WHERE `type` = 'socket' GROUP BY `server` ORDER BY COUNT(*) ASC LIMIT 1";
    $result = $conn->query($sql);
    if ($row = $result->fetch()) {
        echo json_encode(array("server" => $row['server'], "id" => $id, "userId" => uniqid()));
        $uniqid = uniqid();
        $sql = "INSERT INTO `wwLiveSocketServer`(`id`, `project`, `server`) VALUES ('$id', '$_GET[id]', '$row[server]'); INSERT INTO `wwConnect`(`id`, `type`, `server`, `project`, `forId`) VALUES ('$uniqid', 'socket', '$row[server]', (SELECT projectId FROM `keys` WHERE id = '$_GET[id]'), '$id');";
        $result = $conn->query($sql);
    } else {
        echo json_encode(array("server" => "nameserver", "id" => $id, "userId" => uniqid()));
        $sql = "INSERT INTO `wwLiveSocketServer`(`id`, `project`, `server`) VALUES ('$id', '$_GET[id]', '$row[server]'); INSERT INTO `wwConnect`(`id`, `type`, `server`, `project`, `forId`) VALUES ('$uniqid', 'socket', 'nameserver', (SELECT projectId FROM `keys` WHERE id = '$_GET[id]'), '$id');";
        $result = $conn->query($sql);
    }
}


?>