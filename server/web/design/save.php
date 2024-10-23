<?php
$sql = "";

$mainId = hash('md5', uniqid());
foreach ($_POST['css'] as $key => $content) {
    $id = hash('md5', uniqid());
    $css = json_encode($content);
    $name = $_POST['name'][$key];
    $variables = json_encode($_POST['variables']);
    if ($key == array_key_first($_POST['css']))
        $sql .= "INSERT INTO `wwDesign`(`id`, `category`, `type`, `style`, `html`, `css`, `js`, `aditionalJs`, `variables`) VALUES ('$mainId', '$_POST[category]', '$_POST[type]', '$name', '$_POST[html]', '$css', '$_POST[js]','$_POST[additionalJS]', '$variables');";
    else 
        $sql .= "INSERT INTO `wwDesign`(`id`, `category`, `type`, `style`, `html`, `css`, `js`, `aditionalJs`, `variables`) VALUES ('$id', '$_POST[category]', NULL, '$name', '$mainId', '$css', '', '', '');";
}

echo $sql;

include "../db.php";
$stmt = $conn->query($sql);
?>