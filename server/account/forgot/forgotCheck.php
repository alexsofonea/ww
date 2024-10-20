<?php

if ((isset($_POST['mail']) && isset($_POST['code'])) || (isset($mail) && isset($code))) {
    if (!(isset($mail) && isset($code))) {
        $mail = $_POST['mail'];
        $code = $_POST['code'];
    }

    include "../../db.php";

    $sql = "SELECT * FROM accounts WHERE mail = '" . $mail . "' AND code = " . $code . "";
    $stmt = $conn->query($sql);
    if ($row = $stmt->fetch()) {
        echo "done";
    } else {
        sleep(2);
        echo "error";
    }

}
?>