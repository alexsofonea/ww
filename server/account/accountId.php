<?php
    $app_name = "wwEnterprised";
    $logo = "/ww.png";
    $motto = "Code Less,<br />Build Powerfully!";
    $motto2 = "Sign up and start add your projects!";
    $copyright = "&copy; Alex Sofonea & Tudor Nica";
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>

<?php
if (!isset($loginUrl))
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/login";

if (!isset($_COOKIE['session'])) {
    //header("Location: " . $loginUrl);
    die();
}

function generateProjectId($name) {
    $id = strtolower($name);
    $id = preg_replace('/[^a-z0-9\s]/', '', $id);
    $id = trim($id);
    $id = preg_replace('/\s+/', '-', $id);

    return $id;
}


$session = $_COOKIE['session'];
$time = time();
$sql = "SELECT 
            session.id, 
            session.accountId, 
            accounts.name, 
            accounts.mail, 
            accounts.confirm, 
            accounts.picture, 
            accounts.publicId
        FROM 
            session 
        JOIN accounts ON session.accountId = accounts.id 
        WHERE 
            session.id = '$session';
                ";
$stmt = $conn->query($sql);
if ($row = $stmt->fetch()) {
    $myId = $row['accountId'];
    $name = $row['name'];
    $mail = $row['mail'];
    $publicId = $row['publicId'];

    $urlId = generateProjectId($name);

    $picture = str_contains($row['picture'], ".") ? "https://cloud-api.ww.alexsofonea.com/" . $row['picture'] : "/account/userImage/?name=" . str_replace(" ", "+", $name) . "&color=" . $row['picture'];
    if (!isset($noHTML) && intval($row['confirm']) == 0) {
        $mail = $row['mail'];
?>
        <style>
            .accountMessage {
                font-family: main;
                position: fixed;
                top: 45px;
                right: -500px;
                width: 330px;
                padding: 10px;
                border-radius: 20px;
                transition: all 0.4s ease-in-out;
                z-index: 9999999;
            }
            @supports (-webkit-backdrop-filter: none) or (backdrop-filter: none) {
                .accountMessage {
                    -webkit-backdrop-filter: blur(10px);
                    backdrop-filter: blur(10px);
                    background-color: rgba(0, 0, 0, 0.1);
                }
            }
            .accountMessage img {
                width: 50px;
                height: 50px;
                object-fit: cover;
                border-radius: 5px;
                margin-right: 10px;
            }
            .accountMessage h4, .accountMessage p {
                margin: 0;
                font-size: 16px;
                font-weight: 500;
            }
            .accountMessage a {
                background-color: rgba(0, 0, 0, 0.3);
                padding: 3px 5px;
                border-radius: 5px;
                text-decoration: none;
                color: #000;
                font-size: 14px;
            }
            .accountMessage .links {
                position: absolute;
                bottom: 12px;
                right: 15px;
            }
            @media (prefers-color-scheme: dark) { 
                .accountMessage a {
                    color: #FFF;
                }
            }
        </style>

        <script>
            function dismiss() {
                document.getElementsByClassName("accountMessage")[0].style.right = "-500px";
            }
            $(document).ready(function() { 
                var accountMessage = document.createElement("div");
                accountMessage.classList.add("accountMessage");
                document.body.appendChild(accountMessage);
                setTimeout(function () {
                    document.getElementsByClassName("accountMessage")[0].innerHTML = "<table><tr><td><img src='<?php echo $logo; ?>'></td><td><h4>Account Confirmation Required</h4><br /></td></tr></table><div class='links'><a href='<?php echo $url; ?>/account/confirm/<?php echo $mail; ?>'>Confirm</a><a href='javascript:dismiss()' style='background-color: transparent;'>Remind me later</a></div>";
                    document.getElementsByClassName("accountMessage")[0].style.right = "20px";
                }, 100);
             });
        </script>
<?php
    }
    if (!isset($noHTML)) {
        echo '<style>
            #accountImage {
                position: fixed; top: 10px; right: 20px; border-radius: 50px; width: 40px; height: 40px; z-index: 9999; object-fit: cover; cursor: pointer; box-shadow:  8px 8px 16px #b0b0b0, -8px -8px 16px #ffffff, inset 4px 4px 8px rgba(0, 0, 0, 0.1), inset -4px -4px 8px rgba(255, 255, 255, 0.7);
            }
            /*@media (prefers-color-scheme: dark) {
                #accountImage {
                    box-shadow:  8px 8px 16px #000000,
                                -8px -8px 16px #444444,
                                inset 4px 4px 8px rgba(0, 0, 0, 0.6),
                                inset -4px -4px 8px rgba(255, 255, 255, 0.4);
                };
            }*/
        </style>';
		 echo '<img onclick="location.assign(\'/account\');hapticFeedback();" src="' . $picture . '" id="accountImage">';
    }
} else {
    if (!isset($noHTML)) {
        $actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        setcookie("session", "", time(), "/");
        header("Location: https://ww.alexsofonea.com/account/logout/?redirect=" . $actual_link);
        die();
    } else {
        echo "login_session_error";
        die();
    }
}

if (isset($connection))
    $conn = null;

    // $subscribed = true;
?>