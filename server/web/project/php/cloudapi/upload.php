<?php
$id = hash("md5", uniqid());
$targetDir = "../../../cloud/" . $id . "/";

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Process uploaded files
$total_count = count($_FILES['filesToUpload']['name']);
for ($i = 0; $i < $total_count; $i++) {
    // Get the full path of the file including directories
    $fullPath = $_FILES['filesToUpload']['name'][$i];
    
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