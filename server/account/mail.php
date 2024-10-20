<?php
   /*$link = explode("/", $_SERVER['REQUEST_URI']);
   $l = "";
   for ($i=0; $i<count($link)-3; $i++) {
      $l = $l . "../";
   }
   require_once($l . 'PHPMailer/PHPMailerAutoload.php');

   // Create an instance of PHPMailer
   $mail = new PHPMailer(true);

   try {
      // Server settings
      $mail->SMTPDebug = 2; // Enable verbose debug output
      $mail->isSMTP(); // Set mailer to use SMTP
      $mail->Host       = 'smtp.mail.me.com'; // Specify iCloud SMTP server
      $mail->SMTPAuth   = true; // Enable SMTP authentication
      $mail->Username   = 'alex05.sofonea@icloud.com'; // Your iCloud email address
      $mail->Password   = 'hpmr-czcp-ghqm-vxto'; // Your app-specific password
      $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
      $mail->Port       = 587; // TCP port to connect to

      // Recipients
      $mail->setFrom('studio@alexsofonea.com', 'Studio');
      $mail->addAddress('alex05.sofonea@gmail.com', 'Recipient Name'); // Add a recipient

      // Content
      $mail->isHTML(true); // Set email format to HTML
      $mail->Subject = 'Here is the subject';
      $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $mail->send();
      echo 'Message has been sent';
   } catch (Exception $e) {
      echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   }*/

   ?>