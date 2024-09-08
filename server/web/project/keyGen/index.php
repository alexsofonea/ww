<?php
// Generate the private and public key pair
$privateKeyResource = openssl_pkey_new(array(
    "private_key_bits" => 2048, // Key size (2048 bits is secure and standard)
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
));

// Extract the private key from the resource
openssl_pkey_export($privateKeyResource, $privateKey);

// Extract the public key from the private key
$publicKey = openssl_pkey_get_details($privateKeyResource)['key'];

// Save the keys to files (optional)
//file_put_contents('private_key.pem', $privateKey);
//file_put_contents('public_key.pem', $publicKey);

// Display the keys
echo "Private Key:\n$privateKey\n";
echo "Public Key:\n$publicKey\n";

// Function to encrypt data using the private key
function encryptWithPrivateKey($data, $privateKey) {
    openssl_private_encrypt($data, $encryptedData, $privateKey);
    return base64_encode($encryptedData);
}

// Function to decrypt data using the public key
function decryptWithPublicKey($encryptedData, $publicKey) {
    openssl_public_decrypt(base64_decode($encryptedData), $decryptedData, $publicKey);
    return $decryptedData;
}

// Example usage
$dataToEncrypt = "Secret message";

// Encrypt the data using the private key
$encryptedData = encryptWithPrivateKey($dataToEncrypt, $privateKey);
echo "\nEncrypted Data:\n$encryptedData\n";

// Decrypt the data using the public key
$decryptedData = decryptWithPublicKey($encryptedData, $publicKey);
echo "\nDecrypted Data:\n$decryptedData\n";

?>