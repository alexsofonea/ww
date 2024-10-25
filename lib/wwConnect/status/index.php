<?php

include "../../db.php";

$sql = "SELECT `server`
FROM `wwConnect`
GROUP BY `server`
ORDER BY COUNT(*) ASC
LIMIT 1;";

$result = $conn->query($sql);

if ($row = $result->fetch()) {
    echo $row['server'];
} else {
    echo "nameserver";
}