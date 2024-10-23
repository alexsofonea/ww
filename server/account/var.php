<?php
   
   /*include '../../db.php';

   $sql = "SELECT `id`, `name`, `description`, `picture`, `domain` FROM `projects` WHERE 1";*/


   $app_name = "wwEnterprised";
   $logo = "/ww.png";
   $motto = "Code Less,<br />Build Powerfully!";
   $motto2 = "Sign up and start add your projects!";
   $copyright = "&copy; Alex Sofonea & Tudor Nica";
   $url = "another-project.alex.accounts.ww.alexsofonea.com";

   $color = "1181A9";
   $color2 = "125973";

   function send_mail($to, $subject, $message, $name) {
      global $app_name;

      $link = explode("/", $_SERVER['REQUEST_URI']);
      $l = "";
      for ($i=0; $i<count($link)-3; $i++) {
         $l = $l . "../";
      }
      require_once($l . 'PHPMailer/PHPMailerAutoload.php');

      // Create an instance of PHPMailer
      $mail = new PHPMailer(true);

      try {
         // Server settings
         $mail->SMTPDebug = 0;
         $mail->isSMTP();
         $mail->Host       = 'smtp.mail.me.com';
         $mail->SMTPAuth   = true;
         $mail->Username   = 'alex05.sofonea@icloud.com'; 
         $mail->Password   = 'hpmr-czcp-ghqm-vxto';
         $mail->SMTPSecure = 'tls';
         $mail->Port       = 587;

         // Recipients
         $mail->setFrom('noreply@ww.alexsofonea.com', 'ww');
         $mail->addAddress($to, $name);

         // Content
         $mail->isHTML(true); // Set email format to HTML
         $mail->Subject = $subject;
         $mail->Body = $message;

         $mail->send();
         //echo 'Message has been sent';
      } catch (Exception $e) {
         //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
   }
?>