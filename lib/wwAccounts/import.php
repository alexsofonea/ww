<?php

$keyId = "[YOUR_KEY_ID]";
$privateKey = "[YOUR_PRIVATE_KEY]";

function encryptWithPrivateKey($data, $privateKey) {
 openssl_private_encrypt($data, $encryptedData, $privateKey);
 return base64_encode($encryptedData);
}
function decryptWithPublicKey($encryptedData, $publicKey) {
 openssl_public_decrypt(base64_decode($encryptedData), $decryptedData, $publicKey);
 return $decryptedData;
}
$dataAuth = $_GET['wwAuthResponse'];

$time = time();

$barerKey = encryptWithPrivateKey($time, $privateKey);

// URL of the API endpoint
$apiUrl = "https://ww.alexsofonea.com/lib/$keyId/accounts/verifyCallBack";

// Custom body for the API request
$requestBody = json_encode($_GET['wwAuthResponse']);

// Initialize cURL session
$ch = curl_init($apiUrl);

// Set cURL options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
 'Content-Type: application/json',
 'Accept: application/json',
 'Authorization: Bearer ' . $privateKey,
 'Time: ' . $time
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestBody);

// Execute cURL request
$response = curl_exec($ch);

// Check for cURL errors
if ($response === false) {
 die('cURL error: ' . curl_error($ch));
}

// Close cURL session
curl_close($ch);

// Decode the API response
$responseData = json_decode($response, true);

// Check the response and set cookies accordingly
if (isset($responseData['success']) && $responseData['success'] === true) {
    setcookie("session", $responseData['data'], time() + 3600 * 24 * 30, "/");
} else {
    echo "Login Session not authorized by wwAccounts";
}
?>