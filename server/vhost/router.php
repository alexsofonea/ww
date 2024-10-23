<?php
$domain = $_SERVER['HTTP_HOST'];

if ($domain == "gnets.myds.me") {
    header("Location: https://alexsofonea.com");
    die();
}

$rootFolders = [
    'wwdev.systems' => '../../cloud/vhost/wwdev.systems/'
];

// Check if the domain is in the array of known domains
if (array_key_exists($domain, $rootFolders)) {
    // Set the correct root folder based on the domain
    $rootFolder = $rootFolders[$domain];
} else {
    header("HTTP/1.0 404 Not Found");
    echo "Domain not recognized.";
    exit;
}

// Get the requested file path
$requestedFile = isset($_GET['path']) ? $_GET['path'] : '';

// If the requested path is empty or ends in a directory, look for 'index' file
if ($requestedFile === '' || substr($requestedFile, -1) === '/') {
    // Try loading index.php, index.html, or index.css, depending on what exists
    $possibleIndexFiles = ['index.php', 'index.html', 'index.css']; // Add other default index files if needed

    foreach ($possibleIndexFiles as $indexFile) {
        $indexPath = $rootFolder . '/' . $requestedFile . $indexFile;
        if (file_exists($indexPath)) {
            $requestedFile = $requestedFile . $indexFile;
            $fullPath = $indexPath;
            break;
        }
    }
}

// Create the full path to the requested file
$fullPath = $rootFolder . '/' . $requestedFile;

// Check if the file exists and is not a directory
if (file_exists($fullPath) && !is_dir($fullPath)) {
    // Serve static files (e.g., images, CSS, JS)
    $mimeType = mime_content_type($fullPath);
    header('Content-Type: ' . $mimeType);
    readfile($fullPath);
    exit;
} else {
    // If file not found, return a 404 error
    header("HTTP/1.0 404 Not Found");
    echo "File not found.";
}
?>