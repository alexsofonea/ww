<?php

include "../../db.php";
$sql = "DELETE FROM `keys` WHERE projectId = (SELECT id FROM projects WHERE publicId = '$_POST[projectPublicId]' AND ownerName = '$_POST[owner]' AND owner = (SELECT accountId FROM session WHERE id = '$_COOKIE[session]')) AND id = '$_POST[id]';";
$stmt = $conn->query($sql);

echo "success";

?>