<?php

$privateKeyResource = openssl_pkey_new(array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
));

openssl_pkey_export($privateKeyResource, $privateKey);
$publicKey = openssl_pkey_get_details($privateKeyResource)['key'];

function encryptWithPrivateKey($data, $privateKey) {
    openssl_private_encrypt($data, $encryptedData, $privateKey);
    return base64_encode($encryptedData);
}
function decryptWithPublicKey($encryptedData, $publicKey) {
    openssl_public_decrypt(base64_decode($encryptedData), $decryptedData, $publicKey);
    return $decryptedData;
}

$id = hash("sha256", openssl_random_pseudo_bytes(64));

include "../../db.php";
$sql = "INSERT INTO `keys`(`id`, `accountId`, `projectId`, `name`, `publicKey`, `use`) VALUES ('$id', (SELECT accountId from `session` WHERE id = '$_COOKIE[session]'), (SELECT id FROM projects WHERE publicId = '$_POST[projectPublicId]' AND ownerName = '$_POST[owner]'), '$_POST[name]', '$publicKey', (SELECT `id` FROM `apps` WHERE url = '$_POST[use]'))";
$stmt = $conn->query($sql);

$customArray = array(
    "id" => $id,
    "privateKey" => $privateKey,
    "publicKey" => $publicKey
);

echo json_encode($customArray);
?>
