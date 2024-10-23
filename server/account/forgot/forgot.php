<?php

function isStrongPassword($password) {
    if (strlen($password) < 8) {
        return false;
    }
    if (!preg_match('/[A-Z]/', $password) && !preg_match('/[!?@#$%^&*()\-_=+{};:,<.>]/', $password)) {
        return false;
    }
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }
    return true;
}

if (isStrongPassword($_POST['password'])) {
    include "../../db.php";
    $password = openssl_encrypt($_POST['password'],"AES-128-ECB",$_POST['password']);
    $sql = "UPDATE `accounts` SET `password`='" . $password . "', code=0 WHERE mail='" . $_POST['mail'] . "' AND code=" . $_POST['code'] . "";
    $stmt = $conn->query($sql);
} else 
    echo "error";

?>