<?php
    include "../var.php";
    include "../../db.php";

    $time = time();
    $session = $_COOKIE['session'] ?? "";

    $sql = "DELETE FROM `session` WHERE expiration < $time OR id='$session'; DELETE FROM `devices` WHERE session = '$session' OR NOT session IN (SELECT id FROM session);";
    $stmt = $conn->query($sql);
    sleep(0.1);
    setcookie("session", "", time(), "/");
    header("Location: " . ((isset($_GET['redirect']) && $_GET['redirect'] != "") ? $_GET['redirect'] : $url));
    die();
?>