<?php
$name = isset($_GET['name']) ? $_GET['name'] : '';
$initials = getInitials($name);
$backgroundColor = isset($_GET['color']) ? $_GET['color'] : getRandomColor();
$image = createInitialsImage($initials, $backgroundColor);
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);

function getInitials($name) {
    if (str_contains($name, ' '))
        $nameParts = explode(' ', $name);
    else
        $nameParts = explode('+', $name);
    $initials = '';
    foreach ($nameParts as $part) {
        $initials .= strtoupper(substr($part, 0, 1));
    }
    return $initials;
}

function createInitialsImage($initials, $backgroundColor) {
    $imageSize = 400;
    $image = imagecreatetruecolor($imageSize, $imageSize);
    
    // Convert hex color to RGB
    $background = hexToRgb($backgroundColor);
    
    // Define the gradient's start and end colors
    $startColor = $background;
    $endColor = array(
        'r' => max(0, $background['r'] - 50),
        'g' => max(0, $background['g'] - 50),
        'b' => max(0, $background['b'] - 50)
    );

    // Create the gradient at a 45 degree angle
    for ($x = 0; $x < $imageSize; $x++) {
        for ($y = 0; $y < $imageSize; $y++) {
            $distance = sqrt($x * $x + $y * $y);
            $ratio = $distance / (sqrt(2) * $imageSize);

            $r = $startColor['r'] + ($endColor['r'] - $startColor['r']) * $ratio;
            $g = $startColor['g'] + ($endColor['g'] - $startColor['g']) * $ratio;
            $b = $startColor['b'] + ($endColor['b'] - $startColor['b']) * $ratio;

            $color = imagecolorallocate($image, $r, $g, $b);
            imagesetpixel($image, $x, $y, $color);
        }
    }

    // Set text color to white
    $textColor = imagecolorallocate($image, 255, 255, 255);
    
    // Font details
    $fontFile = 'main-bold.ttf';
    $fontWeight = "Bold";

    // Calculate text position
    $bbox = imagettfbbox(120, 0, $fontFile, $initials);
    $textX = ($imageSize - ($bbox[2] - $bbox[0])) / 2 - $bbox[0];
    $textY = ($imageSize - ($bbox[1] - $bbox[7])) / 2 - $bbox[7];

    // Add text to image
    imagettftext($image, 120, 0, $textX, $textY, $textColor, $fontFile, $initials, ['text' => $fontWeight]);

    return $image;
}

function hexToRgb($hex) {
    $hex = ltrim($hex, '#');
    list($r, $g, $b) = str_split($hex, 2);
    return ['r' => hexdec($r), 'g' => hexdec($g), 'b' => hexdec($b)];
}

function getRandomColor() {
    $colors = [
        '#219ebc', '#ffb703', '#ff006e', '#8338ec', '#3a86ff',
        '#f28482', '#84a59d', '#780000', '#034078', '#1282a2', '#4f772d'
    ];
    $randomIndex = array_rand($colors);
    return $colors[$randomIndex];
}
?>
