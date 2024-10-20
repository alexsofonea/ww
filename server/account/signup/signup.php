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
function isValidEmail($email) {
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    if (preg_match($pattern, $email)) {
        return true;
    } else {
        return false;
    }
}

if (isStrongPassword($_POST['password']) && isValidEmail($_POST['mail'])) {
    include "../../db.php";

    $id = hash("md2", uniqid());
    $publicId = hash("md2", $id);
    $password = openssl_encrypt($_POST['password'],"AES-128-ECB",$_POST['password']);

    $sql = "INSERT INTO `accounts`(`id`, `publicId`, `mail`, `password`, `name`, `picture`, `confirm`, `code`) VALUES ('" . $id . "','" . $publicId . "','" . $_POST['mail'] . "','" . $password . "','" . $_POST['name'] . "','" . sprintf('%06X', mt_rand(0, 0xFFFFFF)) . "',0," . rand(100000, 999999) . ");";

    $name = $_POST['name'];
    include "../session.php";

    sleep(1);
} else {
    echo "error 1";
}
?>