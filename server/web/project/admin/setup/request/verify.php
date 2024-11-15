<?php
function verifyTxtRecord($domain, $expectedValue) {
    $records = dns_get_record($domain, DNS_TXT);
    
    foreach ($records as $record) {
        if (isset($record['txt']) && $record['txt'] === $expectedValue) {
            return true;
        }
    }
    
    return false;
}

if (verifyTxtRecord("ww-domain-verification." . $_POST['domain'], "ww_05236f9f287db8171165ec4e47028f89")) {
    include "../../db.php";
    $sql = "UPDATE `projects` SET `domainVerify`='true' WHERE `publicId` = '$_POST[id]' AND `owner` = (SELECT `accountid` FROM `session` WHERE `id`='$_COOKIE[session]')";
    $stmt = $conn->query($sql);
    echo "true";
} else {
    echo "false";
}

?>