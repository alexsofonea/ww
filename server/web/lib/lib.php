<?php
switch ($_GET['lib']) {
    case "socket":
        header('Content-Type: application/javascript');
        echo "const wwProject = {
    publicKeyId: '$_GET[key]'
};
";
        echo file_get_contents("socket.js");
        break;
    default:
        header('404 Not Found', true, 404);
        break;
}
