<?php

if (isset($_POST['password']) && isset($_POST['mail'])) {

    include "../../db.php";

    $password = openssl_encrypt($_POST['password'],"AES-128-ECB",$_POST['password']);

    $sql = "SELECT * FROM accounts WHERE mail = '" . $_POST['mail'] . "' AND password = '" . $password . "'";
    $stmt = $conn->query($sql);
    if ($row = $stmt->fetch()) {
        $id = $row['id'];
        $name = $row['name'];
        include "../session.php";
        sleep(0.5);
        echo "done";
    } else {
        sleep(2);
        echo "error";
    }

}
?>