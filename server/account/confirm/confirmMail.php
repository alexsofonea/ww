<?php
    function isValidEmail($email) {
        $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        if (preg_match($pattern, $email)) {
            return true;
        } else {
            return false;
        }
    }
    if (!isValidEmail($_POST['mail'])) {
        echo "email_error";
        die();
    }
?>

<?php include "../var.php"; ?>

<?php

function split_number($number) {
   $digits = [];
   while ($number > 0) {
       $digit = $number % 10;
       $digits[] = $digit;
       $number = (int)($number / 10);
   }
   
   return array_reverse($digits, true);
}

function send_confirmaton($name, $to, $code) {
   global $url, $logo, $app_name, $copyright, $color, $color2;
   $content = "
   <style>
        @font-face {
            font-family: 'Qartella';
            src: url('https://ww.alexsofonea.com/assets/font/Qartella-Light.eot');
            src: url('https://ww.alexsofonea.com/assets/font/Qartella-Light.eot?#iefix') format('embedded-opentype'),
                url('https://ww.alexsofonea.com/assets/font/Qartella-Light.woff2') format('woff2'),
                url('https://ww.alexsofonea.com/assets/font/Qartella-Light.woff') format('woff'),
                url('https://ww.alexsofonea.com/assets/font/Qartella-Light.svg#Qartella-Light') format('svg');
            font-weight: 300;
            font-style: normal;
            font-display: swap;
        }
   </style>";

   $content .= '
   
   <table style="position: fixed; top: 20px; left: 20px;">
       <tr>
           <td><img style="border-radius: 5px;" src="' . $url . '/' . $logo . '" width="30px"></td>
           <td><h1 style="margin: 0; display: inline-table; margin-left: 5px; margin-top: -2px; font-family: \'Qartella\';">' . $app_name . '</h1></td>
       </tr>
   </table>
   
   
   <div style="
       width: 90%;
       max-width: 600px;
       min-height: 500px;
       padding: 20px;
       position: absolute;
       top: 50%;
       left: 50%;
       transform: translate(-50%, -50%);
       text-align: center;">
      <h1 style="font-family: \'Qartella\';">Verify your ' . $app_name . ' Account</h1>
      <h4 style="font-size: 16px; font-family: \'Qartella\'; font-weight: 400;">Hello ' . $name . ', <br /><br /> Thank you for choosing ' . $app_name . '! We\'re thrilled to have you on board! To get started, please take a moment to confirm your account.<h4>
   
      <h4 style="font-family: \'Qartella\'; font-weight: 700; font-size: 40px;">';

      foreach (split_number($code) as $d)
         $content .= '<span style="padding: 5px 10px; border-radius: 5px; background-color: #' . $color2 . '; margin: 5px;">' . $d . '</span>';
      
      
         $content .= '</h4>
   
      <h4 style="font-size: 16px; font-family: \'Qartella\'; font-weight: 400;">Enter the code above or click the button below.<h4>
      <br />
      <h4 style="font-family: \'Qartella\'; font-weight: 400;"><a href="' . $url . '/account/confirm/' . $to . '/' . $code . '" style="font-size: 18px; padding: 10px 15px; border-radius: 10px; background-color: #' . $color . '; color: #000; text-decoration: none;">Confirm my account</a><h4>
      <br />
      <h4 style="font-size: 16px; font-family: \'Qartella\'; font-weight: 400;">' . $copyright . " " . date("Y") . '<h4>
   </div>';

   send_mail($to, "Confirm your " . $app_name . " Account", $content, $name);
}

include "../../db.php";
$code = rand(100000, 999999);

$sql = "SELECT * FROM accounts WHERE mail = '" . $_POST['mail'] . "'";
$stmt = $conn->query($sql);
if ($row = $stmt->fetch()) {
    $name = $row['name'];
    $sql = "UPDATE `accounts` SET `code`=" . $code . " WHERE mail='" . $_POST['mail'] . "'";
    $stmt = $conn->query($sql);
    send_confirmaton($name, $_POST['mail'], $code);
} else {
    echo "unregistered_error";
}
?>
