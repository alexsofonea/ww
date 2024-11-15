<?php
$target_dir = "../../cloud/";

// Function to compress and crop the image
function processImage($filePath, $newFilePath, $targetWidth = 800, $targetHeight = 800) {
    list($width, $height, $type) = getimagesize($filePath);
    
    $srcImage = null;
    switch ($type) {
        case IMAGETYPE_JPEG:
            $srcImage = imagecreatefromjpeg($filePath);
            break;
        case IMAGETYPE_PNG:
            $srcImage = imagecreatefrompng($filePath);
            break;
        case IMAGETYPE_GIF:
            $srcImage = imagecreatefromgif($filePath);
            break;
        default:
            return false;
    }

    $srcWidth = $width;
    $srcHeight = $height;
    $x = 0;
    $y = 0;
    $newSize = min($width, $height);
    
    if ($width > $height) {
        $x = ($width - $height) / 2;
        $srcWidth = $height;
    } elseif ($height > $width) {
        $y = ($height - $width) / 2;
        $srcHeight = $width;
    }

    $dstImage = imagecreatetruecolor($targetWidth, $targetHeight);
    imagealphablending($dstImage, false);
    imagesavealpha($dstImage, true);
    $transparent = imagecolorallocatealpha($dstImage, 255, 255, 255, 127);
    imagefilledrectangle($dstImage, 0, 0, $targetWidth, $targetHeight, $transparent);

    // Crop and resize
    imagecopyresampled($dstImage, $srcImage, 0, 0, $x, $y, $targetWidth, $targetHeight, $srcWidth, $srcHeight);

    switch ($type) {
        case IMAGETYPE_JPEG:
            imagejpeg($dstImage, $newFilePath, 75); // Compression level 75 for JPEG
            break;
        case IMAGETYPE_PNG:
            imagepng($dstImage, $newFilePath, 6); // Compression level 6 for PNG
            break;
        case IMAGETYPE_GIF:
            imagegif($dstImage, $newFilePath);
            break;
    }

    // Free memory
    imagedestroy($srcImage);
    imagedestroy($dstImage);

    return true;
}

// Process uploaded files
$files = array_filter($_FILES['filesToUpload']['name']); 
$total_count = count($_FILES['filesToUpload']['name']);
for ($i = 0; $i < $total_count; $i++) {
    if (isset($_POST['id']))
        $fileName = $_POST['id'] . ".jpg"; // Change to a common image format
    else
        $fileName = basename($_FILES["filesToUpload"]["name"][$i]);
    
    $target_file = $target_dir . $fileName;
    $uploadOk = 1;
    $file_parts = pathinfo($target_file);
    $fileType = strtolower($file_parts['extension']);
    
    if (!in_array($fileType, ["jpg", "jpeg", "png", "gif"])) {
        $uploadOk = 0;
        echo "Unsupported file type.";
        continue;
    }
    
    if ($uploadOk == 0) {
        echo "error";
    } else {
        if (move_uploaded_file($_FILES["filesToUpload"]["tmp_name"][$i], $target_file)) {
            // Process the image
            if (processImage($target_file, $target_file)) {
                echo "done";
            } else {
                echo "upload_error";
            }
        } else {
            echo "upload_error";
        }
    }
}
?>