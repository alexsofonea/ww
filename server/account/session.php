<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}

$user_agent = $_SERVER['HTTP_USER_AGENT'];
function getOS() { 
    global $user_agent;
    $os_platform  = "Unknown OS Platform";
    $os_array     = array(
                          '/windows nt 10/i'      =>  'Windows 10 PC',
                          '/windows nt 6.3/i'     =>  'Windows 8.1 PC',
                          '/windows nt 6.2/i'     =>  'Windows 8 PC',
                          '/windows nt 6.1/i'     =>  'Windows 7 PC',
                          '/windows nt 6.0/i'     =>  'Windows Vista PC',
                          '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64 PC',
                          '/windows nt 5.1/i'     =>  'Windows XP PC',
                          '/windows xp/i'         =>  'Windows XP PC',
                          '/windows nt 5.0/i'     =>  'Windows 2000 PC',
                          '/windows me/i'         =>  'Windows ME PC',
                          '/win98/i'              =>  'Windows 98 PC',
                          '/win95/i'              =>  'Windows 95 PC',
                          '/win16/i'              =>  'Windows 3.11 PC',
                          '/macintosh|mac os x/i' =>  'Mac OS X',
                          '/mac_powerpc/i'        =>  'Mac OS 9',
                          '/linux/i'              =>  'Linux',
                          '/ubuntu/i'             =>  'Ubuntu',
                          '/iphone/i'             =>  'iPhone',
                          '/ipod/i'               =>  'iPod',
                          '/ipad/i'               =>  'iPad',
                          '/android/i'            =>  'Android',
                          '/blackberry/i'         =>  'BlackBerry',
                          '/webos/i'              =>  'Mobile'
                    );
    foreach ($os_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $os_platform = $value;
    return $os_platform;
}

function getBrowser() {
    global $user_agent;
    $browser        = "Unknown Browser";
    $browser_array = array(
                            '/msie/i'      => 'Internet Explorer',
                            '/firefox/i'   => 'Firefox',
                            '/safari/i'    => 'Safari',
                            '/chrome/i'    => 'Chrome',
                            '/edge/i'      => 'Edge',
                            '/opera/i'     => 'Opera',
                            '/netscape/i'  => 'Netscape',
                            '/maxthon/i'   => 'Maxthon',
                            '/konqueror/i' => 'Konqueror',
                            '/mobile/i'    => 'Handheld Browser'
                     );
    foreach ($browser_array as $regex => $value)
        if (preg_match($regex, $user_agent))
            $browser = $value;
    return $browser;
}


$user_os        = getOS();
$user_browser   = getBrowser();

$apiURL = json_decode(file_get_contents("http://ip-api.com/json/" . $ip));


$sId = hash("md2", uniqid());
$exp = time() + (3600*12*30);
if (!isset($sql) || !str_contains($sql, "INSERT INTO `accounts`"))
    $sql = "INSERT INTO `session`(`id`, `accountId`, `ip`, `lon`, `lat`, `device`, `deviceId`, `date`, `expiration`) VALUES ('" . $sId . "','" . $id . "','" . $ip . "'," . (isset($apiURL->lon) ? ($apiURL->lon) : "0") . "," . (isset($apiURL->lat) ? ($apiURL->lat) : "0") . ", '" . $user_os . " on " . $user_browser . "',''," . time() . "," . $exp . ");";
else
    $sql .= "INSERT INTO `session`(`id`, `accountId`, `ip`, `lon`, `lat`, `device`, `deviceId`, `date`, `expiration`) VALUES ('" . $sId . "','" . $id . "','" . $ip . "'," . (isset($apiURL->lon) ? ($apiURL->lon) : "0") . "," . (isset($apiURL->lat) ? ($apiURL->lat) : "0") . ", '" . $user_os . " on " . $user_browser . "', ''," . time() . "," . $exp . ");";

$stmt = $conn->query($sql);

setcookie("session", $sId, $exp, "/");
?>