<?php
$id = hash("md5", uniqid());
$targetDir = "../../../cloud/vhost/" . $id . "/";

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Allowed file types
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'css', 'js', 'html'];

// Function to check if a file has a valid extension
function isAllowedFileType($filename, $allowedExtensions) {
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    //return in_array(strtolower($ext), $allowedExtensions);
    return true;
}

var_dump($_FILES);

// Process uploaded files
$total_count = count($_FILES['filesToUpload']['name']);
for ($i = 0; $i < $total_count; $i++) {
    // Get the full path of the file including directories
    $fullPath = $_FILES['filesToUpload']['name'][$i];
    
    // Check if the file type is allowed
    if (!isAllowedFileType($fullPath, $allowedExtensions)) {
        echo "Error: " . $fullPath . " is not an allowed file type.\n";
        continue; // Skip this file
    }

    // Create the target file path
    $target_file = $targetDir . $fullPath;
    
    // Ensure that the directory exists
    $dirName = dirname($target_file);
    if (!file_exists($dirName)) {
        mkdir($dirName, 0777, true);
    }

    // Move the uploaded file
    if (move_uploaded_file($_FILES["filesToUpload"]["tmp_name"][$i], $target_file)) {
        echo "Uploaded: " . $target_file . "\n";
    } else {
        echo "Upload error for: " . $fullPath . "\n";
    }
}
?>